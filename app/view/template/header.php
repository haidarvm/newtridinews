<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    $homeDescription = 'Tridinews, berita terkini, berita terbaru, berita Jawa Barat, berita Bandung, berita nasional, politik, hukum, ekonomi, bisnis, olahraga, Persib Bandung, pendidikan, kesehatan, teknologi, lifestyle, budaya, wisata Jawa Barat, UMKM, berita daerah';
    $dataKeywords = '';
    if (!empty($keywords)) {
        foreach ($keywords as $keyword) {
            $dataKeywords .= $keyword->keyword . ',';
        }
    } else {
        $dataKeywords = 'Tridinews, berita terkini, berita terbaru, berita Jawa Barat, berita Bandung, berita nasional, politik, hukum, ekonomi, bisnis, olahraga, Persib Bandung, pendidikan, kesehatan, teknologi, lifestyle, budaya, wisata Jawa Barat, UMKM, berita daerah';
    }
    $amp_link = !empty($id) ? '<link rel="amphtml" href="' . base_url() . 'amp/' . $id . '/' . str_slug($title) . '">' : '';
    // $metaKeyword = empty($keywords) ? $homeKeyword : explode(',', $keywords);
    $metaDescriptionClean = empty($metaDescription) ? $homeDescription : $metaDescription;
    $metaTitle = !empty($title) ? $title : " Tridinews.com";
    $metaImg = !empty($imgMid) ? imgBasePathUrl($imgMid) : base_url() . 'assets/img/' . env('LOGO') . '.png';
    $amp_link = !empty($read->ID) ? '<link rel="amphtml" href="' . readAmpUrl($read->post_date, $read->post_title) . '">' : '';
    $dable_section = !empty($read->cat_name) ? '<meta property="article:section" content="' . $read->cat_name . '">' : '';
    $article_publish = !empty($read->post_date) ? '<meta property="article:published_time" content="' . isoDate($read->post_date) . '">' : '';
    ?>
    <title><?= $metaTitle; ?> </title>
    <meta name="description" content="<?= $metaDescriptionClean ?>">
    <link rel="canonical" href="https:<?= $request->fullUrl() ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="googlebot" content="index,follow" />
    <meta name="author" content="<?php echo !empty($author) ? $author : 'Tim Tridinews'; ?>" />

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="<?php echo base_url(); ?>" />
    <meta property="og:title" content="<?= $metaTitle ?>" />
    <meta property="og:description" content="<?= $metaDescriptionClean ?>" />
    <meta property="og:url" content="https:<?= $request->fullUrl(); ?>" />
    <meta property="og:image" content="<?= $metaImg ?>" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $metaTitle ?>">
    <meta name="twitter:image" content="<?= $metaImg ?>">
    <?php echo $amp_link; ?>


    <meta name="title" content="<?= $metaTitle ?>">
    <meta name="keywords" content="<?= $dataKeywords ?>">
    <meta name="googlebot-news" content="index,follow" />
    <meta http-equiv="content-language" content="In-Id" />
    <?php
    if (getUri($request->fullUrl(), 3) != 'category') { ?>
        <link rel="alternate" type="application/rss+xml" title="republikbobotoh.com RSS Feed" href="<?= base_url() ?>rss" />
    <?php } else { ?>
        <link rel="alternate" type="application/rss+xml" title="republikbobotoh.com RSS Feed <?= $cat_name ?>" href="<?= base_url() . 'rss/' . $cat_slug ?>" />
    <?php } ?>
    <script type='application/ld+json'>
        {
            "@context": "http://schema.org",
            "@type": "NewsArticle",
            "headline": "<?= $metaTitle; ?>",
            "image": ["<?= $metaImg; ?>"],
            "datePublished": "<?= !empty($read->post_date) ? isoDate($read->post_date) : date('c'); ?>",
            "dateModified": "<?= !empty($read->post_date) ? isoDate($read->post_date) : date('c'); ?>",
            "author": {
                "@type": "Person",
                "name": "<?= !empty($author) ? $author : 'Tim Republik Bobotoh'; ?>",
                "url": "<?= base_url(); ?>"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Republik Bobotoh",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://republikbobotoh.com/assets/img/favicon.png"
                }
            },
            "sameAs": [
                "https://www.facebook.com/republikbobotohdotcom",
                "https://twitter.com/republikbobotoh",
                "https://instagram.com/republikbobotoh",
                "https://www.youtube.com/user/off2340"
            ]
        }
    </script>

    <script type='application/ld+json'>
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "url": "https://republikbobotoh.com",
            "potentialAction": [{
                "@type": "SearchAction",
                "target": "https://republikbobotoh.com/search/{search_term_string}",
                "query-input": "required name=search_term_string"
            }]
        }
    </script>
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="<?= base_url(); ?>icon.png?ver=1.1">
    <link rel="icon" href="<?= base_url(); ?>assets/img/favicon.png" type="image/x-icon" />

    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/styles.css?ver=1.2" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/custom.css?ver=2.6" rel="stylesheet">

    <!-- Google search console -->
    <meta name="google-site-verification" content="uu1qC36EjJYOESAiJaMsOhe6sWTTwHtbsDP73hr11QA" />
    <!-- adsense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5477080546673808"
        crossorigin="anonymous"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-CQTKKGRM79"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-CQTKKGRM79');
    </script>

</head>

<body>
    <!-- Header news -->
    <header class="bg-light">
        <!-- Navbar  Top-->
        <div class="topbar d-none d-sm-block">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="topbar-left">
                            <div class="topbar-text">
                                <?php //echo date('D d M Y');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="list-unstyled topbar-right">
                            <ul class="topbar-sosmed">
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/tridinews"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://twitter.com/republikbobot0h"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/tridinews/"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.youtube.com/channel/UCN8gbUv8e6vn2NZNxrTHbCQ"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Navbar Top  -->
        <!-- Navbar  -->
        <!-- logo -->
        <div class="bg-white ">
            <div class="container">
                <div class="row">
                    <div class=" col-sm-12 col-md-4 my-auto d-none d-sm-block ">
                        <figure class="mb-4 mt-4">
                            <a href="<?= base_url(); ?>">
                                <img src="<?= base_url(); ?>assets/img/logo-tridi.png" alt="Tridinews" class="img-fluid logo">
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-8 d-none d-sm-block ">
                        <figure class="mt-3 ">
                            <?php $bjb = !empty($ads) ? $ads->getAds(1) : '';
                            if (!empty($bjb->status) && $bjb->status == 1) { ?>
                                <a href="<?= base_url() . "ads/" . $bjb->ads_id; ?>" target="_blank">
                                    <img src="<?= imgBasePathUrl($bjb->path); ?>" alt="<?= $bjb->title; ?>" loading="lazy" class="img-fluid logo">
                                </a>
                            <?php } ?>
                        </figure>
                    </div>
                </div>
            </div>
        </div>

        <!-- end logo -->
        <!-- Navbar Desktop menu  -->
        <div class="navigation-wrap navigation-shadow">
            <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
                <div class="container">
                    <div class="offcanvas-header">
                        <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                            <span class="navbar-toggler-icon"></span>
                        </div>
                    </div>
                    <figure class="mb-0 mx-auto d-block d-sm-none sticky-logo">
                        <a href="<?= base_url(); ?>">
                            <img src="<?= base_url(); ?>assets/img/logo-rb.png" width="250" alt="Republik Bobotoh" class="img-fluid logo">
                        </a>
                    </figure>
                    <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                        <ul class="navbar-nav">
                            <!-- Home / Logo -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>">
                                    <img width="50" src="<?= base_url(); ?>new-assets/images/logo-small.png?v=1.1" alt="Home">
                                </a>
                            </li>

                            <!-- News (Dropdown) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?= base_url(); ?>news" data-toggle="dropdown"> News </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>bandung-raya"> Bandung Raya </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>jabar"> Jabar </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>nasional"> Nasional </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>internasional"> Internasional </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>inspiratif"> Inspiratif </a></li>
                                </ul>
                            </li>

                            <!-- Ekonomi & Bisnis -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>ekonomi-bisnis"> Ekonomi & Bisnis </a>
                            </li>

                            <!-- Rupamedia (Dropdown) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?= base_url(); ?>rupamedia" data-toggle="dropdown"> Rupamedia </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>otomotif"> Otomotif </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>tekno"> Tekno </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>musik-film"> Musik & Film </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>wisata-kuliner"> Wisata & Kuliner </a></li>
                                </ul>
                            </li>

                            <!-- Olahraga (Dropdown) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="<?= base_url(); ?>olahraga" data-toggle="dropdown"> Olahraga </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>sepakbola"> Sepakbola </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>otosport"> Otosport </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>sport"> Sport </a></li>
                                </ul>
                            </li>

                            <!-- Video (Dropdown) -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Video </a>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>video/videonews"> Video News </a></li>
                                    <li><a class="dropdown-item" href="<?= base_url(); ?>video/videografis"> Video Grafis </a></li>
                                </ul>
                            </li>

                            <!-- Advertorial -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url(); ?>advertorial"> Advertorial </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- End Navbar menu  -->
        <!-- Navbar Mobile sidebar menu  -->
        <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-aside" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="widget__form-search-bar  ">
                            <div class="row no-gutters">
                                <div class="col">

                                    <form action="<?= base_url(); ?>search/post" method="post">
                                        <input class="form-control border-secondary border-right-0 rounded-0" type="search" name="search" value=""
                                            placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <nav class="list-group list-group-flush">
                            <ul class="navbar-nav ">
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>"> Home </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/persib"> Persib </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/bobotoh"> Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/bolnas"> Bolanas </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/gorowok-bobotoh">Gorowok Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/bisnis-bobotoh">Bisnis Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/catatan-balad-bobotoh">Catatan Balad Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/video"> Video </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>category/photo"> Foto </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?= base_url(); ?>store"> Local Loyal </a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link active " href="<?= base_url(); ?>category/ragam"> Ragam
                                    </a>
                                    <a class="nav-link active " href="<?= base_url(); ?>category/bola-dunia"> Bola Dunia
                                    </a>
                                    <!-- <ul class="dropdown-menu dropdown-menu-left">
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/ragam"> ragam </a></li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/viral">Viral </a>
                                </li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/viral">Bola Dunia</a></li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/viral">Sport</a></li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/gaya-hidup">Gaya Hidup</a></li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/ekbis">Ekbis</a></li>
                                <li><a class="dropdown-item" href="<?= base_url(); ?>category/tekno">Tekno</a></li>
                            </ul> -->
                                </li>
                            </ul>

                        </nav>
                    </div>
                </div>
            </div> <!-- modal-bialog .// -->
        </div> <!-- modal.// -->
        <!-- End Navbar sidebar menu  -->
        <!-- End Navbar  -->
        <div class="container ">
            <div class="row">
                <div class="col-md-8">
                    <figure class="mt-3 ">
                        <a href="<?= !empty($bjb->url); ?>" target="_blank">
                            <!-- video / ads
                            <a href="#" target="_blank">
                                <!-- <img src="<?= base_url(); ?>assets/img/" alt="Sobat Konser Musik" loading="lazy" class="img-fluid logo sidebar_bjb"> 
                            </a> -->
                            <!-- <video  class="lazy sidebar_bjb embed-responsive embed-responsive-16by9" id="video"  preload="none" muted autoplay controls loop>
                                <source data-src="<?= base_url(); ?>assets/img/espresso.mp4" >
                            </video> -->

                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </header>
    <?php if (empty($photos)) { ?>
        <?php $under_menu = !empty($ads) ? $ads->getAds(2) : '';
        if (!empty($under_menu->status) && $under_menu->status == 1) { ?>
            <div class="container ">
                <div class="row">
                    <div class="col-12">
                        <figure class="mt-3 ">
                            <a href="<?= base_url() . "ads/" . $under_menu->ads_id; ?>" target="_blank">
                                <img src="<?= imgBasePathUrl($under_menu->path); ?>" alt="<?= $under_menu->title; ?>" class="img-fluid mx-auto d-block">
                            </a>
                        </figure>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>