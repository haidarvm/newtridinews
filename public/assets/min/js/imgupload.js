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
});