<?php 
echo '<link rel="stylesheet" href="'. base_url ().'assets/min/css/gallery.css?ver=1">';
include 'template/header_page.php';?>
<style>
div.gallery {
    margin: 20px;
    border: none;
    float: left;
    width: auto;
}

</style>
<section class="bg-white pb-60" style="padding-top: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12  text-center justify-content-center align-self-center">
                <div id="gallery-first">
                    <?php foreach ($products as $row) { ?>
                    <div class="gallery">
                        <a href="<?=base_url(). 'store/' . str_slug($row->name);?>" class="img-click" data-id="<?php echo $row->product_id;?>"><img
                                class=" gallery-item rounded img-fluid" loading="lazy" src="<?php echo imgBasePathUrl($row->thumb); ?>"
                                title="<?php echo $row->name?>" /></a>
                        <div class="desc"><?php echo $row->name?></div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>
<?php include 'template/footer.php';?>