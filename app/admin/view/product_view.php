<?php
$css  = '
        <link rel="stylesheet" href="'. base_url ().'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/jquery.fileupload.css">
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/jquery-ui.min.css">';
include 'template/header.php';?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="forms-sample" action="<?=base_url();?>admin/product/save" method="POST"
                                enctype="multipart/form-data">
                                <?php echo !empty($product->product_id) ? '<input type="hidden" name="product_id" value="' . $product->product_id . '" />' : '' ;?>
                                <?php echo !empty($product->path) ? '<input type="hidden" name="path" value="' . $product->path . '" />' : '' ;?>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="<?php echo !empty($product->name) ? $product->name : ''; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="name">Price</label>
                                    <input type="number" class="form-control" name="price" id="price"
                                        value="<?php echo !empty($product->price) ? $product->price : ''; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="posteditor" class="content" rows="30"
                                        name="description"><?php echo !empty($product->description) ? $product->description : '';?></textarea>
                                </div>

                                <?php if (!empty($product->path)) { ?>
                                <div class="form-group">
                                    <img class="img-fluid" id="image-feature"
                                        src="<?= imgBasePathUrl($product->path); ?>" />
                                </div>
                                <?php } ?>
                                <div class="row">
                                    <?php foreach($product_imgs as $product_img) { ?>
                                        <div class="col">
                                            <img id="img-<?=$product_img->product_img_id;?>" src="<?php echo imgBasePathUrl($product_img->thumb); ?>" />
                                            <br />
                                            <button id="del-<?=$product_img->product_img_id;?>" class="mt-2 btn btn-sm btn-danger" onclick="deletePhoto(<?=$product_img->product_img_id?>); return false;" >Delete</button>
                                        </div>
                                    <?php  } ?>
                                </div>
                                <img id="image-two" src="" />
                                <div class="form-group">
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Add Featuerd Image...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="filename"
                                            data-url="<?=base_url() . 'admin/product/img/' . $product->product_id;?>"
                                            multiple>
                                    </span>
                                </div>
                                
                                <div class="form-group">
                                    <span class="btn btn-danger fileinput-button pt-2">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Add Multi image...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="productoupload" type="file" name="filename" data-url="<?=base_url().'admin/product/img_multi_upload/'. $product->product_id;?>" multiple>
                                    </span>
                                </div>
                                <br>
                                <br>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <!-- The global progress bar -->
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                            <!-- The container for the uploaded files -->
                            <div class="form-group">
                                <label for="postname" class="">Image</label>
                                <div id="files" class="files">
                                    <div class="urlpath"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="statusActive"
                                                value="1" <?=$product->status == 1 ? "checked" : "";?>> Active </label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status"
                                                id="statusDisabled" value="0"
                                                <?=$product->status == 0 ? "checked" : "";?>> Disabled </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="metaDescription">Short Description</label>
                                <input type="hidden" name='post_date' value=""/>
                                <input type="text" class="form-control" name="meta_description" id="meta_description"
                                    value="<?php echo !empty($product->meta_description) ? $product->meta_description : ''; ?>"
                                     />
                            </div>
                            <div class="form-group">

                                <button class="btn btn-primary mr-2" type="submit" name="submit" value="publish"><i
                                        class="mdi mdi-send "></i> Publish</button>
                                <a class="btn btn-warning" target="blank" href="<?= base_url(). $product->path;?>"><i
                                        class="mdi mdi-eye "></i>
                                    Preview</a>
                                <a class="btn btn-danger" href="<?=base_url();?>admin/product"><i
                                        class="mdi mdi-close "></i> Cancel</a>
                            </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
$javascript = ' <script>            
                var base_url = "' . base_url() . '";
                function deletePhoto(id) {
                    var r = confirm("Apakah Anda yakin ingin hapus foto ini?");

                    if (r === false) {
                    return false;
                    }
                    $("#img-"+id).hide();
                    $("#del-"+id).hide();
                    $.ajax({
                        //the url to send the data to
                        url: base_url + "admin/product/delete_img/" + id,
                        //the data to send to
                        data: {photo_id : id},
                        //type. for eg: GET, POST
                        type: "POST",
                        //datatype expected to get in reply form server
                        dataType: "json",
                        //on success
                        success: function(data){
                            console.log(data)
                            //do something after something is recieved from php
                        },
                        //on error
                        error: function(){
                            //bad request
                        }
                    }); 
                }      
                </script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.upload.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.colors.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.fontsize.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.cleanpaste.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery.ui.widget.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery-ui.min.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery.iframe-transport.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery.fileupload.js"></script>
                <script src="'. base_url ().'assets/min/js/select2.min.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/daterangepicker.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/bootstrap-clockpicker.min.js"></script>
                <script type="text/javascript" src="' . base_url() . 'assets/min/js/product.js"></script>
                <script type="text/javascript" src="' . base_url() . 'assets/min/js/imgupload.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/post-view.js?v=1.6"></script>';
include 'template/footer.php';?>