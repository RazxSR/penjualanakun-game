<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="">
        <div class="container-fluid">
            <div class="row py-3">
                <div class="col-md-12 comp-grid">
                    <h4 class="record-title">
                        <script>
                            $(".navbar-nav.mr-auto").html('<form action="<?php print_link("product");?>" methode="get"><div class ="input-group p-1 border rounded ft-search"><input class="form-control border-0 no-shadow"  placeholder="search" name="search" type="text" value="<?php echo get_value('search');?>" autocomplete="off"><div class="input-group-append p-2"><i class="icon-magnifier"></i></div></div></form>');
                            </script>
                            <style>
                                .no-shadow, .no-shadow:hover, .no-shadow:focus{
                                box-shadow:0 0 0 rgba(0,0,0,0);
                                }
                            </style></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="">
                <div class="container p-4">
                    <div class="row ">
                        <div class="col-sm-12 comp-grid">
                            <div class=""><div class="col-12">
                                <h1 class="display-5 bold mb-3 text-center">Kategori Akun Game</h1>
                            </div></div>
                        </div>
                        <div class="col-md-6 md-2  comp-grid">
                            <div class="">
                                <style>
                                    .image-container img {
                                    float:left;
                                    margin-right:40px; /* Jarak antar gambar */
                                    width: 100px; /* Atur ukuran gambar */
                                    height: auto;
                                    position:relative;
                                    left: 67%; 
                                </style>
                                <div class="image-container" >
                                    <img src="assets/images/freefire.png" height = "25%" width="25%">
                                        <img src="assets/images/pubg.png" height = "25%" width="25%" >
                                            <img src="assets/images/ml.jpg" height = "25%" width="25%" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="">
                            <div class="container">
                                <div class="row ">
                                    <div class="col-md-12 comp-grid">
                                        <div class=" ">
                                            <?php  
                                            $this->render_page("game/sm_list?limit_count=20" , array( 'show_header' => false,'show_footer' => false,'show_pagination' => false )); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="bg-light">
                            <div class="container p-3">
                                <div class="row py-5">
                                    <div class="col-sm-12 comp-grid">
                                        <div class=" ">
                                            <?php  
                                            $this->render_page("grid/sm_list1?limit_count=6" , array( 'show_header' => false,'show_footer' => false,'show_pagination' => false )); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
