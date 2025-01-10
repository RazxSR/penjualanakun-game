<?php
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
if (!empty($records)) {
?>
<!--record-->
<?php
$counter = 0;
foreach($records as $data){
$rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
$counter++;
?>
<div class="col-sm-4">
    <div class="bg-light p-2 mb-3 animated bounceIn">
        <div class="mb-2">  <a href="<?php print_link("kategori/view/$data[id]") ?>">
            <span class="font-weight-light text-muted ">
                Id:  
            </span>
        <?php echo $data['id']; ?></a></div>
        <div class="mb-2">  
            <span  data-value="<?php echo $data['nama']; ?>" 
                data-pk="<?php echo $data['id'] ?>" 
                data-url="<?php print_link("kategori/editfield/" . urlencode($data['id'])); ?>" 
                data-name="nama" 
                data-title="Enter Nama" 
                data-placement="left" 
                data-toggle="click" 
                data-type="text" 
                data-mode="popover" 
                data-showbuttons="left" 
                class="is-editable" >
                <span class="font-weight-light text-muted ">
                    Nama:  
                </span>
                <?php echo $data['nama']; ?> 
            </span>
        </div>
        <div class="td-btn">
            <a class="btn btn-sm btn-success has-tooltip page-modal" title="View Record" href="<?php print_link("kategori/view/$rec_id"); ?>">
                <i class="fa fa-eye"></i> View
            </a>
            <a class="btn btn-sm btn-info has-tooltip page-modal" title="Edit This Record" href="<?php print_link("kategori/edit/$rec_id"); ?>">
                <i class="fa fa-edit"></i> Edit
            </a>
            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="Delete this record" href="<?php print_link("kategori/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                <i class="fa fa-times"></i>
                Delete
            </a>
        </div>
    </div>
</div>
<?php 
}
?>
<?php
} else {
?>
<td class="no-record-found col-12" colspan="100">
    <h4 class="text-muted text-center ">
        No Record Found
    </h4>
</td>
<?php
}
?>
