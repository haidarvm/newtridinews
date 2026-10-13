var product_id = $('input[name="product_id"]').val();

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
    ],
    imageWidthModalEdit: true,
    lang: "id",
    resetCss: false,
    semantic: {
        'div': '' // Editor does nothing on div tags now
    },
    tagsToRemove: ['p'],
    plugins: {
        // Add imagur parameters to upload plugin for demo purposes
        upload: {
            serverPath: base_url + 'admin/product/img/' + product_id,
            fileFieldName: 'filename',
            urlPropertyName: "data.url"
        }
    }
});