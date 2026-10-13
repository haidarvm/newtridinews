


$(document).ready(function() {
    $('.img-click').on("click",function(){
        var imgid = $(this).data("id");
        console.log('haidar');
        console.log(imgid);
        console.log('hallow');
    });

    
});


function imageCheck(id, img) {
    console.log(id);
    $('input[name="image_featured_id"]').val(id);
    $('.modal').modal('hide');
    $('#image-feature').hide();
    $('#image-two').attr('src', 'https://republikbobotoh.com/assets/uploads/' + img);
}