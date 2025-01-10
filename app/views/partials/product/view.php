<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("product/add");
$can_edit = ACL::is_allowed("product/edit");
$can_view = ACL::is_allowed("product/view");
$can_delete = ACL::is_allowed("product/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 ">
                    <h4 class="record-title"></h4>
                </div>
                <div class="col-sm-12 comp-grid">
                    <div class=""><div class="row align-items-center">
                        <div class="col-lg-4 col-md-5 col-12">
                            <!-- Gambar -->
                            <div class="image-container">
                                <?php Html::page_img($data['img'], 350, 200, 1); ?>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <!-- Deskripsi -->
                            <div class="description-container">
                                <h5 class="text-muted mb-2" style="font-size: 20px;"><?php echo $data['akungame']; ?></h5>
                                <p class="text-capitalize bold" style="line-height: 1.5; font-size: 20px; text-align: justify;"><?php echo $data['deskripsi']; ?></p>
                                <div class="text-success bold" style="font-size: 20px;">Rp<?php echo $data['harga']; ?></div>
                            </div>
                        </div>
                    </div></div>
                </div>
                <div class="col-sm-8  p-3 mb-4 kiri comp-grid">
                    <?php $modal_id = "modal-" . random_str(); ?>
                    <a href="<?php print_link("pemesanan2/add") ?>"  class="btn btn-outline-success btn-large-custom  tombol  open-page-modal">
                        Beli Sekarang 
                    </a>
                    <div data-backdrop="true" id="<?php  echo $modal_id ?>" class="modal fade"  role="dialog" aria-labelledby="<?php  echo $modal_id ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0 ">
                                </div>
                                <div style="top: 5px; right:5px; z-index: 999;" class="position-absolute">
                                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">&times;</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                </div>
            </div>
        </div>
    </div>
</section>
