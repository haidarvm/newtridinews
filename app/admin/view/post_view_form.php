<?php
$css  = '
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/jquery.fileupload.css">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/jquery-ui.min.css">
        <link href="'. base_url ().'assets/min/css/daterangepicker.css" rel="stylesheet">
		<link href="'. base_url ().'assets/min/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    	<link rel="stylesheet" href="'. base_url ().'assets/min/css/gallery.css?ver=1">';
include 'template/header.php';?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-8">
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
                                    <label for="post_content">Content</label>
                                    <textarea id="posteditor" class="content" rows="30"
                                        name="post_content"><?php echo !empty($post->post_content) ? $post->post_content : '';?></textarea>
                                </div>
                                <?php if(!empty($post->img_mid)) { ?>
                                <div class="form-group">
                                    <img class="img-fluid" id="image-feature"
                                        src="<?= imgBasePathUrl($post->img_mid); ?>" />
                                </div>
                                <?php } ?>
                                <img id="image-two" src="" />
                                <span class="btn btn-success fileinput-button">
                                    <span><i class="mdi mdi-file-image"></i> Add Image...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="filename"
                                        data-url="<?=base_url() . 'admin/posts/img/' . $post->ID;?>" multiple>
                                </span>
                                <br>
                                <br>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Rubrik</label>
                                <select class="form-control" name="category_id">
                                    <?php
                            $selected = !empty($cat[0]->category_id) ? $cat[0]->category_id : "" ;
                        foreach ($categories as $category) {
                            // print_r($selected);?>
                                    <option value="<?php echo $category->category_id; ?>"
                                        <?php  echo !empty($category->category_id) && $category->category_id == $selected ? 'selected' : '' ; ?>>
                                        <?php echo $category->category_name; ?></option>
                                    <?php
                        }?>
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
                                <textarea class="form-control" rows="3" name="keyword"
                                    id="keyword"><?=!empty($keywords_name) ?  $keywords_name : "" ;?></textarea>
                                <input type="hidden" name="keywords" id="keywords"
                                    value="<?=!empty($keywords_id) ? $keywords_id : "";?>" />
                            </div>
                            <div class="form-group">
                                <label for="keyword">New Keyword</label>
                                <textarea class="form-control" rows="3" name="new_keywords"
                                    id="new_keywords"></textarea>
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
                                <textarea class="form-control" rows="3" name="description" id="description"
                                    maxlength="160"><?php echo !empty($post->description) ? $post->description : ''; ?></textarea>
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
                                <button type="button" class="btn btn-danger ml-2 " data-toggle="modal"
                                    data-target="#galleryModal">
                                    <i class="mdi mdi-folder-image"></i>
                                    Gallery
                                </button>
                            </div>
                            <hr>
                            <div class="form-group">
                                <input type="hidden" name="image_featured_id" value="" />
                                <button class="btn btn-gradient-info ml-2 mr-2 mb-3" type="submit" name="submit"
                                    value="publish"><i class="mdi mdi-send "></i> Publish</button>
                                <button class="btn btn-gradient-success ml-2 mr-2 mb-3" type="submit" name="submit"
                                    value="draft"><i class="mdi mdi-content-save "></i> Save</button>
                                <a class="btn btn-gradient-warning ml-2 mr-2 mb-3" target="blank"
                                    href="<?=base_url() . 'read/' . $post->ID;?>"><i class="mdi mdi-eye "></i>
                                    Preview</a>
                                <a class="btn btn-gradient-primary ml-2 mr-2 mb-3"
                                    href="<?=base_url();?>admin/posts/all/all/all/all/all/all/1"><i
                                        class="mdi mdi-close "></i> Cancel</a>
                                <a class="btn btn-gradient-danger ml-2 mr-2 mb-3"
                                    href="<?=base_url() . 'admin/posts/delete/' . $post->ID;?>"
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

    <!-- Modal Gallery -->
    <div class="modal " id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <div class="col-sm-12">
                            <form id="search_form" onsubmit="return false">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <input type="text" class="form-control" id="gallery-search" />
                                        </div>
                                        <div class="col-sm-1 col-lg-1">
                                            <input type="submit" id="search" class="btn btn-sm btn-info" value="search">
                                        </div>
                                        <div class="col-sm-1 col-lg-1">
                                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                                Close</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="gallery-first">
                        <?php foreach ($gallery as $row) { 
                                $caption = !empty($row->img_caption) ? substr($row->img_caption, 0, 25) : '';  ?>
                        <div class="gallery">
                            <a href="#" class="img-click" data-id="<?php echo $row->image_featured_id;?>"><img
                                    class="gallery-item" loading="lazy"
                                    src="<?php echo imgBasePathUrl($row->img_thumb); ?>"
                                    title="<?php echo $caption?>" /></a>
                            <div class="desc"><?php echo $caption?></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Baca Modal -->
    <div class="modal" id="bacaModal" tabindex="-1" role="dialog" aria-labelledby="bacaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bacaModalLabel">Baca Juga</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="search_baca_form" onsubmit="return false">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6">
                                            <input type="text" class="form-control" id="baca-search" />
                                        </div>
                                        <div class="col-sm-1 col-lg-1">
                                            <input type="submit" id="search-baca" class="btn btn-sm btn-info"
                                                value="search">
                                        </div>
                                        <div class="col-sm-1 col-lg-1">
                                            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                                Close</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="baca-first">
                        <table class="table table-striped stylish-table table-responsive">
                            <thead>
                                <tr>
                                    <th> No</th>
                                    <th> Img</th>
                                    <th> Tgl Terbit</th>
                                    <th> Title</th>
                                    <th> Keyword</th>
                                    <th> Rubrik</th>
                                    <th> Redaktur</th>
                                    <th> Viewer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // $paging = $page != 1 ? ($page - 1) * 20 + 1 : 1;
                                $i = 1;
                                foreach ($latest as $row) {  
                                    $viewer = $row->total_pageviews;
                                    $up = "";
                                    if (in_array($viewer, range(1,100))) {
                                        $badge = "warning";
                                    } elseif (in_array($viewer, range(101,200))) {
                                        $badge = "danger";
                                    } elseif(in_array($viewer, range(201,600))) {
                                        $badge = "primary";
                                    } elseif(in_array($viewer, range(600,1100))) {
                                        $badge = "info";
                                    } elseif($viewer > 1100) {
                                        $badge = "success";
                                        $up = '<i class="mdi mdi-arrow-up"></i>';
                                    } else {
                                        $badge = "warning";
                                    }
                                    ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><img width="150" src="<?php echo imgBasePathUrl($row->img_thumb); ?>" /></td>
                                    <td><?php echo ($row->post_date); ?></td>
                                    <td>
                                        <h6><a href="#" onclick="getBacaJuga('<?=$row->post_title?>', '<?=readUrl($row->post_date, $row->post_title)?>' )"><?php echo $row->post_title; ?></a></h6>
                                        <p class="small text-danger">
                                            <?php echo $row->post_status =='publish' ? '<span class="badge badge-success">'.$row->post_status.'</span>' : '<span class="badge badge-danger">'.$row->post_status.'</span>';?>
                                        </p>
                                    </td>
                                    <td><?php echo $row->keyword; ?></td>
                                    <td><?php echo $row->cat_name; ?></td>
                                    <td><span class="text-primary"><?php echo $row->display_name; ?></span></td>
                                    <td><span class="badge badge-<?=$badge;?>"><?php echo $up.$viewer; ?></label></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
$javascript = ' 
                <script>            
                var base_url = "'.base_url().'";
               
                </script>
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
                <script type="text/javascript" src="'. base_url ().'assets/min/js/post-view.js?v=2.2"></script>
                <script>            
                                    
                    function getBacaJuga(title, url) {
                        $("#bacaModal").modal().hide();
                        $(".modal-backdrop").remove();
                        $("#posteditor").trumbowyg("execCmd", {
                            cmd: "insertHTML",
                            param:  "<b><a href=" + url +" >Baca Juga : " +title + "</a></b>",
                            forceCss: true
                        });
                    }
                </script>
                
                ';
include 'template/footer.php';?>