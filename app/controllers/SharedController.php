<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * product_akungame_option_list Model Action
     * @return array
     */
	function product_akungame_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM game";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_username_value_exist Model Action
     * @return array
     */
	function user_username_value_exist($val){
		$db = $this->GetModel();
		$db->where("username", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * pemesanan2_iditem_option_list Model Action
     * @return array
     */
	function pemesanan2_iditem_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT idproduct AS value,deskripsi AS label FROM product";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

}
