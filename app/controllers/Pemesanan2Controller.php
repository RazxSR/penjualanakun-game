<?php 
/**
 * Pemesanan2 Page Controller
 * @category  Controller
 */
class Pemesanan2Controller extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "pemesanan2";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("pemesanan2.idpembelian", 
			"pemesanan2.idpembayaran", 
			"pemesanan2.iduser", 
			"user.username AS user_username", 
			"pemesanan2.iditem", 
			"pemesanan2.tglpembelian", 
			"pemesanan2.jumlah", 
			"product.deskripsi AS product_deskripsi", 
			"product.harga AS product_harga", 
			"jumlah*harga AS total");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				pemesanan2.idpembelian LIKE ? OR 
				pemesanan2.idpembayaran LIKE ? OR 
				pemesanan2.iduser LIKE ? OR 
				pemesanan2.iditem LIKE ? OR 
				pemesanan2.tglpembelian LIKE ? OR 
				pemesanan2.jumlah LIKE ? OR 
				product.idproduct LIKE ? OR 
				product.akungame LIKE ? OR 
				product.deskripsi LIKE ? OR 
				product.img LIKE ? OR 
				product.harga LIKE ? OR 
				pemesanan2.total LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "pemesanan2/search.php";
		}
		$db->join("user", "pemesanan2.iduser = user.idpembeli", "INNER");
		$db->join("product", "pemesanan2.iditem = product.idproduct", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("pemesanan2.idpembelian", ORDER_TYPE);
		}
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = "Pemesanan2";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("pemesanan2/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("pemesanan2.idpembelian", 
			"pemesanan2.idpembayaran", 
			"pemesanan2.iduser", 
			"user.username AS user_username", 
			"pemesanan2.iditem", 
			"pemesanan2.tglpembelian", 
			"pemesanan2.jumlah", 
			"product.idproduct AS product_idproduct", 
			"product.akungame AS product_akungame", 
			"product.deskripsi AS product_deskripsi", 
			"product.img AS product_img", 
			"product.harga AS product_harga");
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("pemesanan2.idpembelian", $rec_id);; //select record based on primary key
		}
		$db->join("user", "pemesanan2.iduser = user.idpembeli", "INNER");
		$db->join("product", "pemesanan2.iditem = product.idproduct", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = "View  Pemesanan2";
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error("No record found");
			}
		}
		return $this->render_view("pemesanan2/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("idpembayaran","iduser","iditem","tglpembelian","jumlah");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'idpembayaran' => 'required',
				'iditem' => 'required',
				'jumlah' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'idpembayaran' => 'sanitize_string',
				'iditem' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['iduser'] = USER_ID;
$modeldata['tglpembelian'] = datetime_now();
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Record added successfully", "success");
					return	$this->redirect("pemesanan2");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Add New Pemesanan2";
		$this->render_view("pemesanan2/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("idpembelian","idpembayaran","iduser","iditem","tglpembelian","jumlah");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'idpembayaran' => 'required',
				'iditem' => 'required',
				'jumlah' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'idpembayaran' => 'sanitize_string',
				'iditem' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['iduser'] = USER_ID;
$modeldata['tglpembelian'] = datetime_now();
			if($this->validated()){
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
				$db->where("pemesanan2.idpembelian", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Record updated successfully", "success");
					return $this->redirect("pemesanan2");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = "No record updated";
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("pemesanan2");
					}
				}
			}
		}
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
		$db->where("pemesanan2.idpembelian", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "Edit  Pemesanan2";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("pemesanan2/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("idpembelian","idpembayaran","iduser","iditem","tglpembelian","jumlah");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'idpembayaran' => 'required',
				'iditem' => 'required',
				'jumlah' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'idpembayaran' => 'sanitize_string',
				'iditem' => 'sanitize_string',
				'jumlah' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
				$db->where("pemesanan2.idpembelian", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = "No record updated";
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("pemesanan2.idpembelian", $arr_rec_id, "in");
		$allowed_roles = array ('admin');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("pemesanan2.iduser", get_active_user('idpembeli') );
		}
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg("Record deleted successfully", "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("pemesanan2");
	}
}
