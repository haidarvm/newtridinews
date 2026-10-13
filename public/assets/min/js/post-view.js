$(function() {
    var galleryModal = new bootstrap.Modal(document.getElementById('galleryModal'));
    var bacaModal = new bootstrap.Modal(document.getElementById('bacaModal'));

    function showBacaJuga() {
        bacaModal.toggle();
    }

    var post_id = $('input[name="ID"]').val();
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
            ["fullscreen"],
            ["bacaJuga"]
        ],
        btnsDef: {
            bacaJuga: {
                fn: function() {
                    showBacaJuga()
                },
                tag: 'tagName',
                title: 'baca juga',
                text: 'Show baca juga',
                isSupported: function() { return true; },
                key: 'K',
                ico: 'blockquote',
                param: '',
                forceCSS: false,
                class: '',
                hasIcon: true
            }
        },
        removeformatPasted: false,
        imageWidthModalEdit: true,
        lang: "id",
        resetCss: false,
        semantic: {
            'div': '' // Editor does nothing on div tags now
        },
        // tagsToRemove: ['p'],
        plugins: {
            // Add imagur parameters to upload plugin for demo purposes
            upload: {
                serverPath: base_url + 'admin/posts/img_center/' + post_id,
                fileFieldName: 'filename',
                urlPropertyName: "data.url"
            }
        }
    });

});
$('input[name="post_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    locale: {
        format: 'DD-MM-YYYY'
    }
});
$('.clockpicker').clockpicker();
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
                    .append($('<span class="text-danger"/>').text(file.error));
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
                    $('.urlpath').append('<img src="' + file.url + '" />');
                    $('.urlpath').append('<a href="' + file.url + '">Link</a>');
                    // console.log(file.url);
                    var link = $('<a>').attr('target', '_blank').prop('href', file.url);
                    var node = $('<p/>').append($('<span/>').text(file.url));
                    node.appendTo(data.context);
                    // console.log(data.context);
                    $(data.context.children()[index]).wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index]).append('<br>').append(error);
                }
            });
        }).on('fileuploadfail', function(e, data) {
            $.each(data.files, function(index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#photoupload').fileupload({
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
                    .append($('<span class="text-danger"/>').text(file.error));
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
                    $('.urlpath').append('<img src="' + file.url + '" />');
                    $('.urlpath').append('<a href="' + file.url + '">Link</a>');
                    // console.log(file.url);
                    var link = $('<a>').attr('target', '_blank').prop('href', file.url);
                    var node = $('<p/>').append($('<span/>').text(file.url));
                    node.appendTo(data.context);
                    // console.log(data.context);
                    $(data.context.children()[index]).wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index]).append('<br>').append(error);
                }
            });
        }).on('fileuploadfail', function(e, data) {
            $.each(data.files, function(index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

    $('#productoupload').fileupload({
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
                    .append($('<span class="text-danger"/>').text(file.error));
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
                    $('.urlpath').append('<img src="' + file.url + '" />');
                    $('.urlpath').append('<a href="' + file.url + '">Link</a>');
                    // console.log(file.url);
                    var link = $('<a>').attr('target', '_blank').prop('href', file.url);
                    var node = $('<p/>').append($('<span/>').text(file.url));
                    node.appendTo(data.context);
                    // console.log(data.context);
                    $(data.context.children()[index]).wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index]).append('<br>').append(error);
                }
            });
        }).on('fileuploadfail', function(e, data) {
            $.each(data.files, function(index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');

});
function b64EncodeUnicode(str) {
    return btoa(
        new TextEncoder().encode(str)
            .reduce((data, byte) => data + String.fromCharCode(byte), '')
    );
}

function gallery_new(data) {
    var html = '';
    $.each(data.items, function(index, item) {
        var imgCheck = "'" + item.image_featured_id + "'" + ",'" + item.img_thumb + "','" + b64EncodeUnicode(item.img_caption) + "'";
        var title = item.post_title.substring(0, 25);
        var caption = item.caption != null ? item.img_caption.substring(0, 25) : title;
        html += '<div class="gallery"><a href="javascript:void(0)"  onclick="imageCheck(' + imgCheck + ')" class="img-click" data-id="' + item.image_featured_id + '" ><img class="gallery-item" src="' + base_url + 'assets/uploads/' + item.img_thumb + '" class="gallery-item" alt="' + title + '"/></a><div class="desc"> ' + caption + '</div></div>';
    });
    return html;
}

function baca_new(data) {
    var html = '';
    $.each(data.items, function(index, item) {
        var imgCheck = "'" + item.image_featured_id + "'" + ",'" + item.img_thumb + "','" + b64EncodeUnicode(item.img_caption) + "'";
        var title = item.post_title.substring(0, 25);
        var caption = item.caption != null ? item.img_caption.substring(0, 25) : title;
        html += '<div class="gallery"><a href="javascript:void(0)"  onclick="imageCheck(' + imgCheck + ')" class="img-click" data-id="' + item.image_featured_id + '" ><img class="gallery-item" src="' + base_url + 'assets/uploads/' + item.img_thumb + '" class="gallery-item" alt="' + title + '"/></a><div class="desc"> ' + caption + '</div></div>';
    });
    return html;
}


function imageCheck(id, img, caption) {
    $('input[name="image_featured_id"]').val(id);
    $('.modal').modal('hide');
    $('#image-feature').hide();
    $('#image-two').attr('src', base_url + 'assets/uploads/' + img);
    $('#img_caption').val(atob(caption));
}


$(".img-click").click(function(event) {
    console.log("uwais");
    $('input[name="image_featured_id"]').val($(this).attr('data-id'));
    $('.modal').modal('hide');
    $('#image-feature').hide();
    $('#image-two').attr('src', $('img', this).attr('src'));
    $('#img_caption').val($('img', this).attr('title'));
    event.preventDefault();
});

$('#search').on('click', function(e) {
    // var url = $(this).attr('href');
    var url = base_url + "admin/gallery/1/100/" + $("#gallery-search").val();
    console.log($("#gallery-search").val());
    // $('#gallery').load(url);
    // e.preventDefault();
    $('#gallery-first').empty();
    e.preventDefault();
    $.getJSON(url, function(data) {

        var html = gallery_new(data);
        $('#gallery-first').html(html);
    });
    // $.getScript('assets/min/js/loadjs.js?ver=1.1"'); 
});

$('#search-baca').on('click', function(e) {
    // var url = $(this).attr('href');
    var url = base_url + "admin/baca/1/100/" + $("#baca-search").val();
    console.log($("#baca-search").val());
    // $('#gallery').load(url);
    // e.preventDefault();
    $('#baca-first').empty();
    e.preventDefault();
    $.getJSON(url, function(data) {

        var html = baca_new(data);
        $('#baca-first').html(html);
    });
    // $.getScript('assets/min/js/loadjs.js?ver=1.1"'); 
});

//$('#edit-photo').on('click', function(e) {           
//});




$(function() {
    function split(val) {
        return val.split(/,\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }

    $("#description").keyup(function() {
        $("#desc_count").text(" Sisa: " + (155 - $(this).val().length));
    });

    $('#keyword')
        // don't navigate away from the field on tab when selecting an item
        .on('keydown', function(event) {
            if (event.keyCode === $.ui.keyCode.TAB &&
                $(this).autocomplete('instance').menu.active) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function(request, response) {
                $.getJSON(base_url + "api/keyword", {
                    term: extractLast(request.term)
                }, response);
            },
            search: function() {
                // custom minLength
                var term = extractLast(this.value);
                if (term.length < 2) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function(event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push('');
                this.value = terms.join(',', '');
                console.log(ui.item.id + ' val ' + ui.item.value);
                var keywords = $('#keywords');
                if (ui.item.id) {
                    keywords.val(keywords.val() + ',' + ui.item.id);
                } else {
                    console.log($('#keyword').val());
                }
                console.log($('#keyword').val());
                return false;
            }
        })


});