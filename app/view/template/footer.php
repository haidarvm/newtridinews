<footer>
    <div class="wrapper__footer bg__footer-dark pb-0">
        <div class="mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8 my-auto ">
                        <div class="social__media">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a target="_blank" href="https://www.facebook.com/tridinews"
                                        class="btn btn-social rounded text-white facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a target="_blank" href="https://twitter.com/tridinews"
                                        class="btn btn-social rounded text-white twitter">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a target="_blank" href="https://www.instagram.com/tridinews/"
                                        class="btn btn-social rounded text-white instagram">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a target="_blank" href="https://www.youtube.com/channel/UCN8gbUv8e6vn2NZNxrTHbCQ"
                                        class="btn btn-social rounded text-white telegram">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer bottom -->
    <div class="wrapper__footer-bottom bg__footer-dark">
        <div class="container ">
            <div class="row">
                <div class="col-md-12">
                    <div class="border-top-1 bg__footer-bottom-section">
                        <ul class="list-inline link-column">
                            <li class="list-inline-item">
                                <a href="<?=base_url();?>page/tentang-kami">
                                    Tentang Kami
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?=base_url();?>page/redaksi">
                                    Redaksi
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?=base_url();?>page/privacy-policy">
                                    Ketentuan Layanan
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?=base_url();?>page/media-siber"> Pedoman Media Siber</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="<?=base_url();?>page/beriklan">
                                    Beriklan
                                </a>
                            </li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <span>
                                    Copyright © <?=date("Y");?> tridinews.com
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
</section>


<a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

<script type="text/javascript" src="<?=base_url();?>assets/js/index.bundle.js?537a1bbd0e5129401d28"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var lazyVideos = [].slice.call(document.querySelectorAll("video.lazy"));

    if ("IntersectionObserver" in window) {
        var lazyVideoObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(video) {
                if (video.isIntersecting) {
                    for (var source in video.target.children) {
                        var videoSource = video.target.children[source];
                        if (typeof videoSource.tagName === "string" && videoSource.tagName ===
                            "SOURCE") {
                            videoSource.src = videoSource.dataset.src;
                        }
                    }

                    video.target.load();
                    video.target.classList.remove("lazy");
                    lazyVideoObserver.unobserve(video.target);
                }
            });
        });

        lazyVideos.forEach(function(lazyVideo) {
            lazyVideoObserver.observe(lazyVideo);
        });
    }
});

$(document).ready(function() {
    $('.slider-thumbnails').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrow:true,
        asNavFor: '.slider',
        focusOnSelect: true
    });



    $('.slider').slick({
        infinite: false,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        lazyLoad: 'ondemand',
        asNavFor: '.slider-thumbnails',
        // mobileFirst: true, //add this one
        // variableWidth: true,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('.slidering').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

    api_url = '<?php echo base_url() . 'api/';?>';
    var page_last = 2;
    // function load_click(page){
    $(".load_button_last").click(function() {
        page_last++;
        $.ajax({
            type: "GET",
            url: api_url + "latest_home/" + page_last,
            // data: "{page : page_last}", //last_id kita berarti 15
            dataType: "html",
            success: function(data) {
                var html = '';
                $.each(JSON.parse(data), function(index, item) {
                    // console.log(item);
                    html += `<div class="mb-3">
                            <div class="card__post card__post-list">
                                <div class="image-st">
                                    <a href="` + item.url + `">
									<img class="img-fluid " src=" ` + item.thumbnail + `" alt="` + item.post_title + `">
									</a>
                                </div>
                                <div class="card__post__body ">
                                    <div class="card__post__content">
                                        <div class="card__post__author-info mb-2">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <span class="text-blue text-capitalize">
                                                    ` + item.cat_name + `
                                                    </span>
                                                </li>
                                                <li class="list-inline-item">
                                                    <span class="text-blue text-capitalize">
                                                    ` + item.post_date + `
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card__post__title">
                                            <h5><a
                                                    href="` + item.url + `">` + item.post_title + `</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                });
                // return html;
                $(".load-more").append(html);
            }
        });
    });

    // Load HTML file content into an element
    // $('#klasmen').load('.html');

    // // Load specific part of HTML file
    // $('#klasmen').load('bola_klasmen.html #klasmen-div');

    // With callback function
    $.ajaxSetup({ cache: false });
    $('#klasmen').load('<?=base_url();?>klasemen_simple.html', function(response, status, xhr) {
        if (status == "error") {
            console.log("Error: " + xhr.status + " " + xhr.statusText);
        } else {
            console.log("HTML loaded successfully!");
        }
    });

    function checkLazyWidgets() {
        let windowBottom = $(window).scrollTop() + $(window).height();

        // Looping setiap elemen dengan class .lazy-widget
        $('.lazy-widget').each(function() {
            let $widget = $(this);

            // Cek apakah widget ini sudah di-load sebelumnya
            if ($widget.data('loaded')) return;

            let targetTop = $widget.offset().top;

            // Jika posisi scroll sudah mendekati widget (buffer 200px)
            if (windowBottom > (targetTop - 100)) {
                // Tandai widget ini sudah diproses agar tidak request ganda
                $widget.data('loaded', true);

                let targetUrl = "<?= rtrim(base_url(), '/') ?>" + $widget.data('url');
                console.log("Loading widget from: " + targetUrl);
                // Load HTML dari Webman
                $widget.load(targetUrl, function(responseText, textStatus) {
                    if (textStatus === "error") {
                        $widget.html('<p class="error">Gagal memuat widget.</p>');
                    }
                });
            }
        });
    }

    // Jalankan pengecekan saat user melakukan scroll
    $(window).on('scroll', checkLazyWidgets);

    // Jalankan 1x di awal untuk widget yang kebetulan posisinya sudah ada di layar atas
    checkLazyWidgets();


});
</script>
</body>

</html>