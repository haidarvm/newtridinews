<?php
$css  = '
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/jquery.fileupload.css">
        <link href="' . base_url() . 'assets/min/css/daterangepicker.css" rel="stylesheet">
		<link href="' . base_url() . 'assets/min/css/bootstrap-clockpicker.min.css" rel="stylesheet">';
include 'template/header.php';?>
<div class="content-wrapper" style="padding:2rem 1rem;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="<?php echo base_url();?>admin/posts/save_page"  method="POST" enctype="multipart/form-data">
                    <?php echo !empty($post->ID) ? '<input type="hidden" name="ID" value="'.$post->ID.'" />' : '' ;?>
                    <?php echo !empty($post->filepath) ? '<input type="hidden" name="image_featured_id" value="'.$post->image_featured_id.'" />' : '' ;?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="postTitle"  class="col-1 col-form-label">Title</label>
                                <div class="col-11">
                                    <input type="text" class="form-control" name="post_title" id="postTitle" value="<?php echo !empty($post->post_title) ?  $post->post_title : ""; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="postDate"  class="col-1 col-form-label">Tanggal Terbit</label>
                                <div class="col-4">
                                    <input type="text" class="form-control" name="post_date" id="postDate" value="<?php echo !empty($post->post_date) ?  indoDate($post->post_date) : ""; ?>" />
                                </div>
                                <div class="col-4 clockpicker">
                                    <input type="text" class="form-control" name="post_time" id="postTime" value="<?php echo !empty($post->post_date) ?  getTimeOnly($post->post_date) : ""; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-1 col-form-label">Status</label>
                                <div class="col-4">
                                    <button type="button" class="btn btn-<?php echo $post->post_status =='publish' ? 'primary' : 'success';?>"> <?php echo  $post->post_status;?> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="keyword"  class="col-1 col-form-label">Image Caption</label>
                                <div class="col-11">
                                    <input type="text" class="form-control" name="img_caption" id="img_caption" value="<?php echo !empty($post->img_caption) ?  $post->img_caption : ""; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="keyword"  class="col-1 col-form-label">Video</label>
                                <div class="col-11">
                                    <input type="text" class="form-control" name="link" id="link" value="<?php echo !empty($post->link) ?  $post->link : ""; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea id="posteditor" class="content" name="post_content"><?php echo !empty($post->post_content) ? ($post->post_content) : '';?></textarea>
                    </div>
                    <div class="form-group">
                        <img class="img-fluid" src="<?php echo imgBasePathUrl($post->img_mid); ?>" />
                    </div>
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add Image...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="filename" data-url="<?php echo base_url().'admin/posts/img_upload/'. $post->ID;?>" multiple>
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->              
                    <div class="form-group">
                        <label for="postTitle" class="">Image</label>
                        <div id="files" class="files"><div class="urlpath"></div></div>   
                    </div>
                    <div class="form-group">
                        <?php echo !empty($post->portal_id) ? '<input type="hidden" name="portal_id" value="'.$post->portal_id.'" />' : '' ;?>

                        <button class="btn btn-primary mr-2" type="submit" name="submit" value="publish"><i class="fas fa-paper-plane"></i> Publish</button>
                        <button class="btn btn-success mr-2" type="submit" name="submit" value="draft"><i class="fas fa-save"></i> Save</button>
                        <a class="btn btn-warning" target="blank" href="<?php echo base_url().'read/'. $post->ID;?>"><i class="fas fa-eye"></i> Preview</a>
                        <a class="btn btn-primary" href="<?php echo base_url();?>admin/posts/pages/all/all/all/1"><i class="fas fa-times-circle"></i> Cancel</a>
                        <!-- <a class="btn btn-danger" href="<?php echo base_url().'admin/posts/delete/'.$post->ID;?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')"><i class="fas fa-trash-alt"></i> Delete</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 

$javascript = '<!-- Datatables-->
                    <script src="' . base_url() . 'assets/min/js/pagination.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.upload.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.colors.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.fontsize.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/jquery.ui.widget.js"></script>
                    <script src="' . base_url() . 'assets/min/js/jquery.iframe-transport.js"></script>
                    <script src="' . base_url() . 'assets/min/js/jquery.fileupload.js"></script>
                    <script src="' . base_url() . 'assets/min/js/select2.min.js"></script>
                    <script type="text/javascript" src="' . base_url() . 'assets/min/js/moment.min.js"></script>
                    <script type="text/javascript" src="' . base_url() . 'assets/min/js/daterangepicker.js"></script>
                   
                    <!-- Clock Picker -->
                    <script type="text/javascript" src="' . base_url() . 'assets/min/js/bootstrap-clockpicker.min.js"></script>
                    <script>
                    $(function() {
                        $("#posteditor").trumbowyg({
                            btns: [
                                // ["viewHTML"],
                                ["formatting"],
                                ["strong", "em", "del", "underline"],
                                ["superscript", "subscript"],
                                ["fontsize"],
                                ["foreColor", "backColor"],
                                ["link"],
                                ["image", "upload", "insertImage"], // Our fresh created dropdown
                                ["justifyLeft", "justifyCenter", "justifyRight", "justifyFull"],
                                ["unorderedList", "orderedList"],
                                ["horizontalRule"],
                                ["removeformat"],
                                ["fullscreen"]
                            ],
                            imageWidthModalEdit: true,
                            lang: "id",
                            resetCss: false,
                            semantic: true,
                            tagsToRemove: [\'p\'],
                            plugins: {
                                // Add imagur parameters to upload plugin for demo purposes
                                upload: {
                                    serverPath: "'.base_url().'admin/center_upload/'. $post->ID.'" ,
                                    fileFieldName: \'filename\',
                                    urlPropertyName: "upload_data.url"
                                }
                            }
                        });
                    });
                    $(\'input[name="post_date"]\').daterangepicker({
                        singleDatePicker: true,
                        showDropdowns: true,
                        locale: {
                            format: \'DD-MM-YYYY\'
                        }
                    });
                    $(\'.clockpicker\').clockpicker();
                '.  
                    "
                    $('.basic-select').select2({
                        multiple: false
                    });
                    $(function() {
                        $('#fileupload').fileupload({
                                dataType: 'json',
                                add: function(e, data) {
                                    data.context = $('<p/>').text('Uploading...').appendTo(document.body);
                                    data.submit();
                                },
                                done: function(e, data) {
                                    data.context.text('Upload finished.');
                                }
                            }).on('fileuploadadd', function(e, data) {
                                data.context = $('<div/>').appendTo('#files');
                                $.each(data.files, function(index, file) {
                                    var node = $('<p/>').append($('<span/>').text(file.name));
                                    node.appendTo(data.context);
                                });
                            }).on('fileuploadprocessalways', function(e, data) {
                                var index = data.index,
                                    file = data.files[index],
                                    node = $(data.context.children()[index]);
                                if (file.preview) {
                                    node
                                        .prepend('<br>')
                                        .prepend(file.preview);
                                }
                                if (file.error) {
                                    node
                                        .append('<br>')
                                        .append($('<span class=\"text-danger\"/>').text(file.error));
                                }
                                if (index + 1 === data.files.length) {
                                    data.context.find('button')
                                        .text('Upload')
                                        .prop('disabled', !!data.files.error);
                                }
                            }).on('fileuploadprogressall', function(e, data) {
                                var progress = parseInt(data.loaded / data.total * 100, 10);
                                $('#progress .progress-bar').css(
                                    'width',
                                    progress + '%'
                                );
                            }).on('fileuploaddone', function(e, data) {
                                console.log('done fileuploaddone selesai');
                                data.context = $('<div/>').appendTo('#files');
                                $.each(data.result, function(index, file) {
                                    // console.log(data.result.url);
                                    console.log(file);
                                    if (file.url) {
                                        $('.urlpath').append('<img src=\"' + file.url + '\" />');
                                        $('.urlpath').append('<a href=\"' + file.url + '\">Link</a>');
                                        // console.log(file.url);
                                        var link = $('<a>').attr('target', '_blank').prop('href', file.url);
                                        var node = $('<p/>').append($('<span/>').text(file.url));
                                        node.appendTo(data.context);
                                        // console.log(data.context);
                                        $(data.context.children()[index]).wrap(link);
                                    } else if (file.error) {
                                        var error = $('<span class=\"text-danger\"/>').text(file.error);
                                        $(data.context.children()[index]).append('<br>').append(error);
                                    }
                                });
                            }).on('fileuploadfail', function(e, data) {
                                $.each(data.files, function(index) {
                                    var error = $('<span class=\"text-danger\"/>').text('File upload failed.');
                                    $(data.context.children()[index])
                                        .append('<br>')
                                        .append(error);
                                });
                            }).prop('disabled', !$.support.fileInput)
                            .parent().addClass($.support.fileInput ? undefined : 'disabled');
                    });"
                    
                .'</script>';
include 'template/footer.php';?>