<?php
$css  = '
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/jquery.fileupload.css">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/jquery-ui.min.css">
        <link href="'. base_url ().'assets/min/css/daterangepicker.css" rel="stylesheet">
		<link href="'. base_url ().'assets/min/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/gallery.css">';
include 'template/header.php';?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <form class="forms-sample" action="<?=base_url();?>admin/posts/save" method="POST"
                                enctype="multipart/form-data">
                                <?php echo !empty($post->ID) ? '<input type="hidden" name="ID" value="' . $post->ID . '" />' : '' ;?>
                                <?php echo !empty($post->filepath) ? '<input type="hidden" name="image_featured_id" value="' . $post->image_featured_id . '" />' : '' ;?>
                                <div class="form-group">
                                    <label for="postTitle">Title</label>
                                    <input type="text" class="form-control" name="post_title" id="postTitle"
                                        value="<?php echo !empty($post->post_title) ? $post->post_title : ''; ?>" />
                                </div>

                                <div class="form-group">
                                    <label for="postTitle">Content</label>
                                    <textarea id="posteditor" class="content" rows="30"
                                        name="post_content"><?php echo !empty($post->post_content) ? $post->post_content : '';?></textarea>
                                </div>
                                <?php if(!empty($post->img_mid)) { ?>
                                <div class="form-group">
                                    <img class="img-fluid" id="image-feature"
                                        src="<?= imgBasePathUrl($post->img_mid); ?>" />
                                </div>
                                <?php } ?>
                                    <div class="row">
                                    <?php foreach($photos as $photo) { ?>
                                    <div class="col">
                                    <img id="img-<?=$photo->photo_id;?>" src="<?php echo imgBasePathUrl($photo->img_thumb); ?>" />
                                    <br />
                                    <button id="del-<?=$photo->photo_id;?>" class="mt-2 btn btn-sm btn-danger" onclick="deletePhoto(<?=$photo->photo_id?>); return false;" >Delete</button>
                                    </div>
                                    <?php  } ?>
                                    </div>
                                <img id="image-two" src="" />
                            <div class="form-group">
                                <span class="btn btn-info fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add Feature Image...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="filename"
                                        data-url="<?=base_url() . 'admin/posts/img/' . $post->ID;?>" multiple>
                                </span>
                            </div>
                            <div class="form-group">
                                <span class="btn btn-success fileinput-button pt-2">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add Photos...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="photoupload" type="file" name="filename" data-url="<?=base_url().'admin/posts/photo_upload/'. $post->ID;?>" multiple>
                                </span>
                            </div>
                        </div>

                        <div class="col-4 ">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Rubrik</label>
                                <select class="form-control" name="category_id">
                                    <option value="619" selected>Photo</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <div class="checkbox checkbox-inline checkbox-success">
                                        <input id="Headline" type="checkbox" name="headline"
                                            <?php echo !empty($post->headline) ? 'checked' : '';?>>
                                        <label for="Headline"> Headline</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="postDate">Tanggal Terbit</label>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="post_date" id="postDate"
                                            value="<?php echo !empty($post->post_date) ? indoDate($post->post_date) : ''; ?>" />
                                    </div>
                                    <div class="col-sm-4 clockpicker">
                                        <input type="text" class="form-control" name="post_time" id="postTime"
                                            value="<?php echo !empty($post->post_date) ? getTimeOnly($post->post_date) : ''; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keyword">Keyword</label>
                                <?php 
                                if(!empty($keywords[0]['keyword'])) {
                                    foreach($keywords as $keyword)  { 
                                    $all_keyword_name[] = $keyword->keyword;
                                    $all_keyword_id[] = $keyword->keyword_id;
                                    }
                                    $keywords_name = implode(",",$all_keyword_name);
                                    $keywords_id =  implode(",",$all_keyword_id);
                                }
                                 ?>
                                <textarea class="form-control"  rows="3" name="keyword"  id="keyword"><?=!empty($keywords_name) ?  $keywords_name : "" ;?></textarea>
                                <input type="hidden" name="keywords" id="keywords" value="<?=!empty($keywords_id) ? $keywords_id : "";?>" />
                            </div>
                            <div class="form-group">
                                <label for="keyword">New Keyword</label>
                                <textarea class="form-control"  rows="3" name="new_keywords"  id="new_keywords"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="img-caption">Image Caption</label>
                                <input type="text" class="form-control" name="img_caption" id="img_caption"
                                    value="<?php echo !empty($post->img_caption) ? $post->img_caption : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="img-caption">Image author</label>
                                <input type="text" class="form-control" name="img_author" id="img_caption"
                                    value="<?php echo !empty($post->img_author) ? $post->img_author : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="description">Description <span id="desc_count"></span></label>
                                <textarea class="form-control" rows="3" name="description"  id="description" maxlength="155"><?php echo !empty($post->description) ? $post->description : ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keyword">Video</label>
                                <input type="text" class="form-control" name="link" id="link"
                                    value="<?php echo !empty($post->link) ? $post->link : ''; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="keyword">Wartawan</label>
                                <select class="form-control" name="reporter_id">
                                    <?php
                        foreach ($reporters as $reporter) {
                            // print_r($selected);?>
                                    <option value="<?php echo $reporter->reporter_id; ?>"
                                        <?php  echo !empty($reporter->reporter_id) && $reporter->reporter_id == $post->reporter_id ? 'selected' : '' ; ?>>
                                        <?php echo $reporter->name; ?></option>
                                    <?php
                        }?>
                                </select>
                            </div>
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
                                <label for="postTitle" class="">Image</label>
                                <div id="files" class="files">
                                    <div class="urlpath"></div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#haidarModal">
                                    Gallery
                                </button>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="image_featured_id" value="" />
                                <button class="btn btn-primary mr-2" type="submit" name="submit" value="publish"><i
                                        class="mdi mdi-send "></i> Publish</button>
                                <button class="btn btn-success mr-2" type="submit" name="submit" value="draft"><i
                                        class="mdi mdi-content-save"></i> Save</button>
                                <a class="btn btn-warning" target="blank"
                                    href="<?=base_url() . 'read/' . $post->ID;?>"><i class="mdi mdi-eye "></i>
                                    Preview</a>
                                <a class="btn btn-primary" href="<?=base_url();?>admin/posts/all/all/all/all/all/all/1"><i
                                        class="mdi mdi-close "></i> Cancel</a>
                                <a class="btn btn-danger" href="<?=base_url() . 'admin/posts/delete/' . $post->ID;?>"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')"><i
                                        class="mdi mdi-delete "></i> Delete</a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal " id="haidarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gallery</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form id="search_form" onsubmit="return false">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="gallery-search" />
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="submit" id="search" class="btn btn-info" value="search">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="gallery-first">
                            <?php foreach ($gallery as $row) { ?>
                            <div class="gallery">
                            <a href="#" class="img-click" data-id="<?php echo $row->image_featured_id;?>" ><img class="lazy gallery-item"
                                    data-src="<?php echo imgBasePathUrl($row->img_thumb); ?>" title="<?php echo $row->img_caption?>" /></a>
                                    <div class="desc"><?php echo substr($row->img_caption, 0, 14); ?></div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

        <?php
$javascript = ' <script>    
                var base_url = "'.base_url().'";
                function deletePhoto(id) {
                    var r = confirm("Apakah Anda yakin ingin hapus foto ini?");

                    if (r === false) {
                    return false;
                    }
                    $("#img-"+id).hide();
                    $("#del-"+id).hide();
                    $.ajax({
                        //the url to send the data to
                        url: base_url + "admin/posts/delete_photo/" + id,
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
                <script src="'. base_url ().'assets/min/js/pagination.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.upload.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.colors.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.fontsize.min.js"></script>
                <script src="'. base_url ().'assets/min/js/trumbowyg.cleanpaste.js"></script>
                <script src="'. base_url ().'assets/min/js/jquery.ui.widget.js"></script>
                <script src="'. base_url ().'assets/min/js/jquery-ui.min.js"></script>
                <script src="'. base_url ().'assets/min/js/jquery.iframe-transport.js"></script>
                <script src="'. base_url ().'assets/min/js/jquery.fileupload.js"></script>
                <script src="'. base_url ().'assets/min/js/select2.min.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/moment.min.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/daterangepicker.js"></script>
                <!-- Clock Picker -->
                <script type="text/javascript" src="'. base_url ().'assets/min/js/bootstrap-clockpicker.min.js"></script>
                <script type="text/javascript" src="'. base_url ().'assets/min/js/post-view.js?v=1.6"></script>';
include 'template/footer.php';?>