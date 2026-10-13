<?php
$css  = '
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
                            <form class="forms-sample" action="<?=base_url();?>admin/ads/save" method="POST"
                                enctype="multipart/form-data">
                                <?php echo !empty($ads->ads_id) ? '<input type="hidden" name="ads_id" value="' . $ads->ads_id . '" />' : '' ;?>
                                <?php echo !empty($ads->path) ? '<input type="hidden" name="path" value="' . $ads->path . '" />' : '' ;?>
                                <div class="form-group">
                                    <label for="postTitle">Title</label>
                                    <input type="text" class="form-control" name="title" id="postTitle"
                                        value="<?php echo !empty($ads->title) ? $ads->title : ''; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="postTitle">Position</label>
                                    <input type="text" class="form-control" name="position" id="position"
                                        value="<?php echo !empty($ads->position) ? $ads->position : ''; ?>" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="postTitle">Url</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                        value="<?php echo !empty($ads->url) ? $ads->url : ''; ?>" />
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="statusActive" value="1" <?=$ads->status == 1 ? "checked" : "";?>> Active </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="status" id="statusDisabled" value="0" <?=$ads->status == 0 ? "checked" : "";?>> Disabled </label>
                                        </div>
                                    </div>
                                </div>

                                <?php if (!empty($ads->path)) { ?>
                                <div class="form-group">
                                    <img class="img-fluid" id="image-feature"
                                        src="<?= imgBasePathUrl($ads->path); ?>" />
                                </div>
                                <?php } ?>
                                <img id="image-two" src="" />
                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Add Image...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="filename"
                                        data-url="<?=base_url() . 'admin/ads/img/' . $ads->ads_id;?>" multiple>
                                </span>
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
                                <label for="postTitle" class="">Image</label>
                                <div id="files" class="files">
                                    <div class="urlpath"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary mr-2" type="submit" name="submit" value="publish"><i
                                        class="mdi mdi-send "></i> Publish</button>
                                <a class="btn btn-warning" target="blank"
                                    href="<?= base_url(). $ads->path;?>"><i class="mdi mdi-eye "></i>
                                    Preview</a>
                                <a class="btn btn-danger" href="<?=base_url();?>admin/ads"><i
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
                </script>
                <script src="' . base_url() . 'assets/min/js/jquery.ui.widget.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery-ui.min.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery.iframe-transport.js"></script>
                <script src="' . base_url() . 'assets/min/js/jquery.fileupload.js"></script>
                <script type="text/javascript" src="' . base_url() . 'assets/min/js/imgupload.js"></script>';
include 'template/footer.php';?>