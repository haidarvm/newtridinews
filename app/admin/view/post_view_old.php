<?php
$css  = '
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/jquery.fileupload.css">
        <link href="' . base_url() . 'assets/min/css/daterangepicker.css" rel="stylesheet">
		<link href="' . base_url() . 'assets/min/css/bootstrap-clockpicker.min.css" rel="stylesheet">';
include 'template/header.php';?>
<?php
$selected = array();
foreach ($categories as $category) {
    if (!empty($cat[0]->category_id)) {
        foreach ($cat as $getCat) {
            $selected[] = $getCat->category_id == $category->category_id ? $category->category_id : '';
        }
    }
}
$clean_selected = array_filter($selected);
$res_selected = array_values($clean_selected);?>
<div class="content-wrapper"  style="padding:2rem 0;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="<?=base_url();?>admin/posts/save" method="POST"
                    enctype="multipart/form-data">
                    <?php echo !empty($post->ID) ? '<input type="hidden" name="ID" value="' . $post->ID . '" />' : '' ;?>
                    <?php echo !empty($post->filepath) ? '<input type="hidden" name="image_featured_id" value="' . $post->image_featured_id . '" />' : '' ;?>
                    <div class="form-group row">
                        <label for="postTitle" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="post_title" id="postTitle"
                                value="<?php echo !empty($post->post_title) ? $post->post_title : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postTitle" class="col-sm-2 col-form-label">Sub-Heading</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sub_heading" id="postTitle"
                                value="<?php echo !empty($post->sub_heading) ? $post->sub_heading : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="postDate" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="post_date" id="postDate"
                                value="<?php echo !empty($post->post_date) ? indoDate($post->post_date) : ''; ?>" />
                        </div>
                        <div class="col-sm-2 clockpicker">
                            <input type="text" class="form-control" name="post_time" id="postTime"
                                value="<?php echo !empty($post->post_date) ? getTimeOnly($post->post_date) : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Rubrik</label>
                        <div class="col-4">
                            <select class="form-control" name="category_id">
                                <?php
                            foreach ($categories as $category) {
                                // print_r($selected);?>
                                <option value="<?php echo $category->category_id; ?>"
                                    <?php  echo !empty($res_selected[0]) && $category->category_id == $res_selected[0] ? 'selected' : '' ; ?>>
                                    <?php echo $category->category_name; ?></option>
                                <?php
                            }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Subrubrik</label>
                        <div class="col-4">
                            <select class="form-control" name="category_id2">
                                <option></option>
                                <?php
                            foreach ($categories as $category) {
                                // print_r($selected);?>
                                <option value="<?php echo $category->category_id; ?>"
                                    <?php echo !empty($res_selected[1]) && $res_selected[1] == $category->category_id ? 'selected' : '' ; ?>>
                                    <?php echo $category->category_name; ?></option>
                                <?php
                            }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <button type="button"
                                class="btn btn-<?php echo $post->post_status == 'publish' ? 'primary' : 'success';?>">
                                <?php echo  $post->post_status;?> </button>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-4">
                                    <select name="post_status" class="form-control" id="exampleFormControlSelect1">
                                        <option value="publish" <?php echo 'publish' == $post->post_status ? 'selected' : ''; ?>>Pubilsh</option>
                                        <option value="draft" <?php echo 'draft' == $post->post_status ? 'selected' : ''; ?>>Draft</option>
                                        <option value="future" <?php echo 'future' == $post->post_status ? 'selected' : ''; ?>>Terjadwalkan</option>
                                        <option value="trash" <?php echo 'trash' == $post->post_status ? 'selected' : ''; ?>>Hapus</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label">Wartawan</label>
                        <div class="col-4">
                            <select name="reporter_id" class="form-control" id="exampleFormControlSelect1">
                                <?php foreach ($reporters as $reporter) {?>
                                <option value="<?php echo $reporter->reporter_id; ?>"
                                    <?php echo $reporter->reporter_id == $post->reporter_id ? 'selected' : ''; ?>>
                                    <?php echo $reporter->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keyword" class="col-sm-2 col-form-label">Keyword</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="keyword" id="keyword"
                                value="<?php echo !empty($post->keyword) ? $post->keyword : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="img-caption" class="col-sm-2 col-form-label">Image Caption</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="img_caption" id="img_caption"
                                value="<?php echo !empty($post->img_caption) ? $post->img_caption : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keyword" class="col-sm-2 col-form-label">Video</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="link" id="link"
                                value="<?php echo !empty($post->link) ? $post->link : ''; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="checkbox checkbox-inline checkbox-success">
                                <input id="Headline" type="checkbox" name="headline"
                                    <?php echo !empty($post->headline) ? 'checked' : '';?>>
                                <label for="Headline"> Headline</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea id="posteditor" class="content"
                            name="post_content"><?php echo !empty($post->post_content) ? $post->post_content : '';?></textarea>
                    </div>
                    <div class="form-group">
                        <img class="img-fluid" id="image-feature"
                            src="<?php echo imgBasePathUrl($post->img_mid); ?>" />
                        <img id="image-two" src="" />
                    </div>
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add Image...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="filename"
                            data-url="<?=base_url() . 'admin/posts/img/' . $post->ID;?>" multiple>
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
                        <div id="files" class="files">
                            <div class="urlpath"></div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="form-group">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#haidarModal">
                            Gallery
                        </button>
                    </div>
                    <div class="form-group">
                        <?php echo !empty($post->portal_id) ? '<input type="hidden" name="portal_id" value="' . $post->portal_id . '" />' : '' ;?>
                        <input type="hidden" name="image_featured_id" value="" />
                        <button class="btn btn-primary mr-2" type="submit" name="submit" value="publish"><i
                                class="fas fa-paper-plane"></i> Publish</button>
                        <button class="btn btn-success mr-2" type="submit" name="submit" value="draft"><i
                                class="fas fa-save"></i> Save</button>
                        <a class="btn btn-warning" target="blank"
                            href="<?=base_url() . 'read/' . $post->ID;?>"><i class="fas fa-eye"></i> Preview</a>
                        <a class="btn btn-primary" href="<?=base_url();?>admin/posts/all/all/all/all/all/1"><i
                                class="fas fa-times-circle"></i> Cancel</a>
                        <a class="btn btn-danger" href="<?=base_url() . 'admin/posts/delete/' . $post->ID;?>"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus?')"><i
                                class="fas fa-trash-alt"></i> Delete</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal " id="haidarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
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
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="gallery-search" />
                            </div>
                            <div class="col-sm-2">
                                <input type="submit" id="search" class="btn btn-info" value="search">
                            </div>
                        </div>
                    </form>
                    <div id="gallery"></div>
                    <div id="gallery-first">
                        <?php foreach ($gallery as $row) { ?>
                        <a href="javascript:void(0)" class="img-click"
                            onclick=imageCheck(<?=$row->image_featured_id . ',"' . $row->img_thumb . '"'?>)><img
                                class="lazy gallery-item"
                                data-src="<?php echo imgBasePathUrl($row->img_thumb); ?>" /></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<?php
$javascript = '
                    <script src="' . base_url() . 'assets/min/js/pagination.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.upload.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.colors.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.fontsize.min.js"></script>
                    <script src="' . base_url() . 'assets/min/js/trumbowyg.cleanpaste.js"></script>
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
                                ["viewHTML"],
                                ["formatting"],
                                ["strong", "em", "del"],
                                ["superscript", "subscript"],
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
                            semantic: false,
                            tagsToRemove: [\'p\'],
                            plugins: {
                                // Add imagur parameters to upload plugin for demo purposes
                                upload: {
                                    serverPath: "' . base_url() . 'admin/posts/img_center/' . $post->ID . '" ,
                                    fileFieldName: \'filename\',
                                    urlPropertyName: "data.url"
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
                ' .
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
                    });
                    
                    function gal_temp(data) {
                        var html = '';
                        $.each(data.items, function(index, item) {
                            var imgCheck = (item.image_featured_id) + ',\'' + item.img_thumb + '\'' ;
                             html += '<a href=\"javascript:void(0)\"  onclick=\"imageCheck(' + imgCheck + ')\" class=\"img-click\" data-id=\"'+ item.image_featured_id +'\" ><img src=\"" . base_url() . "assets/uploads/' + item.img_thumb + '\" class=\"gallery-item lazy\" alt=\"' +  item.post_title + '\"/></a>';
                        });
                        // console.log(html);
                        return html;
                    }
                    
                    function imageCheck(id, img) {
                        console.log(id);
                        $('input[name=\"image_featured_id\"]').val(id);
                        $('.modal').modal('hide');
                        $('#image-feature').hide();
                        $('#image-two').attr('src', '" . base_url() . "assets/uploads/' + img);
                    }

                    $('#search').on('click', function(e) {           
                        // var url = $(this).attr('href');
                        var url = '" . base_url() . "admin/get_gallery/1/60/' + $(\"#gallery-search\").val() ;
                        console.log($(\"#gallery-search\").val());
                        // $('#gallery').load(url);
                        // e.preventDefault();
                        $('#gallery-first').empty();
                        e.preventDefault();
                        $.getJSON(url, function(data) {
                           var html = gal_temp(data);
                           $('#gallery').html(html);
                        });
                        $.getScript(\"" . base_url() . "assets/min/js/loadjs.js\"); 
                      });
                   

                    document.addEventListener(\"DOMContentLoaded\", function() {
                        var lazyloadImages = document.querySelectorAll(\"img.lazy\");    
                        var lazyloadThrottleTimeout;
                        
                        function lazyload () {
                        if(lazyloadThrottleTimeout) {
                            clearTimeout(lazyloadThrottleTimeout);
                        }    
                        
                        lazyloadThrottleTimeout = setTimeout(function() {
                            var scrollTop = window.pageYOffset;
                            lazyloadImages.forEach(function(img) {
                                if(img.offsetTop < (window.innerHeight + scrollTop)) {
                                    img.src = img.dataset.src;
                                    img.classList.remove('lazy');
                                }
                            });
                            if(lazyloadImages.length == 0) { 
                                document.removeEventListener(\"scroll\", lazyload);
                                window.removeEventListener(\"resize\", lazyload);
                                window.removeEventListener(\"orientationChange\", lazyload);
                            }
                        }, 20);
                        }
                        
                        document.addEventListener(\"scroll\", lazyload);
                        window.addEventListener(\"resize\", lazyload);
                        window.addEventListener(\"orientationChange\", lazyload);
                    });
                    "
                . '</script>';
include 'template/footer.php';?>