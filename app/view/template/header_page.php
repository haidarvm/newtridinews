<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    $homeKeyword = '';
    $homeDescription = env('APP') . ' - Persib: Satu Nama Berjuta Cerita .';
    $dataKeywords = '';
    if (!empty($keywords)) {
        foreach ($keywords as $keyword) {
            $dataKeywords .= $keyword->keyword . ',';
        }
    } else {
        $dataKeywords = 'Persib, bobotoh, viking, piala menpora, sepakbola, latihan persib, rbnews, republik bobotoh, pssi, liga satu, liga 1';
    }
    $amp_link = !empty($id) ? '<link rel="amphtml" href="' . base_url() . 'amp/' . $id . '/' . str_slug($title) . '">' : '' ;
    // $metaKeyword = empty($keywords) ? $homeKeyword : explode(',', $keywords);
    $metaDescriptionClean = empty($metaDescription) ? $homeDescription : $metaDescription;
    $metaTitle = !empty($title) ? $title : ucfirst(env('APP')) ;
    $metaImg = !empty($imgMid) ? imgBasePathUrl($imgMid) : base_url() . 'assets/img/' . env('LOGO') . '.png';
    $amp_link = !empty($read->ID) ? '<link rel="amphtml" href="' .readAmpUrl($read->post_date, $read->post_title) . '">' : '' ;?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,  shrink-to-fit=no,user-scalable=no">
    <meta name="description" content="<?=$metaDescriptionClean?>">
    <meta name="title" content="<?= $metaTitle ?>">
    <meta name="keywords" content="<?=$dataKeywords?>">
    <meta name="author" content="haidarvm">
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="In-Id" />
    <link rel="canonical" href="<?= $request->fullUrl() ?>">
    <meta property="og:site_name" content="<?php echo base_url();?>" />
    <meta property="og:title" content="<?= $metaTitle ?>" />
    <meta property="og:description" content="<?=$metaDescriptionClean?>" />
    <meta property="og:url" content="<?=$request->fullUrl();?>" />
    <meta property="og:image" content="<?=$metaImg?>" />
    <meta property="og:type" content="website" />
    <?php echo $amp_link;?>
    <?php
    if (getUri($request->fullUrl(),3) != 'category') {?>
    <link rel="alternate" type="application/rss+xml" title="republikbobotoh.com RSS Feed" href="<?=base_url()?>rss" />
    <?php } else { ?>
    <link rel="alternate" type="application/rss+xml" title="republikbobotoh.com RSS Feed <?=$cat_name?>" href="<?=base_url() . 'rss/' . $cat_slug?>" />
    <?php } ?>
    <script type='application/ld+json'>
    {
    "@context" : "http://schema.org",
    "@type" : "Organization",
    "name" : "republikbobotoh",
    "url" : "https://republikbobotoh.com",
    "sameAs" : [
        "https://www.facebook.com/republikbobotoh",
        "https://twitter.com/republikbobotoh",
        "https://instagram.com/republikbobotoh",
        "https://www.youtube.com/user/off2340"
    ],
    "logo": "https://republikbobotoh.com/assets/img/favicon.png"
    }
    </script>

    <script type='application/ld+json'>
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "url": "https://republikbobotoh.com",
            "potentialAction": [
                {
                    "@type": "SearchAction",
                    "target": "https://republikbobotoh.com/search/{search_term_string}",
                    "query-input": "required name=search_term_string"
                }
            ]
        }
    </script>
    <title><?=$metaTitle;?> </title>
    <!-- favicon.ico in the root directory -->
    <link rel="apple-touch-icon" href="<?=base_url();?>icon.png">
    <link rel="icon" href="<?=base_url();?>assets/img/favicon.png" type="image/x-icon" />

    <meta name="theme-color" content="#030303">
    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,700;1,300;1,500&family=Poppins:ital,wght@0,300;0,500;0,700;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="<?=base_url();?>assets/css/styles.css?ver=1.1" rel="stylesheet">
    <link href="<?=base_url();?>assets/css/custom.css?ver=1.7" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177872763-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-177872763-1');
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
                                <?php //echo date('D d M Y');?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="list-unstyled topbar-right">
                            <ul class="topbar-sosmed">
                                <li>
                                    <a target="_blank" href="https://www.facebook.com/republikbobotohcom"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://twitter.com/republikbobot0h"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.instagram.com/republikbobotohcom/"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a target="_blank" href="https://www.youtube.com/c/REPUBLIKBOBOTOHTV"><i class="fa fa-youtube"></i></a>
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
                            <a href="<?=base_url();?>">
                                <img src="<?=base_url();?>assets/img/logo-rb.png" alt="Republik Bobotoh" class="img-fluid logo">
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-8 d-none d-sm-block ">
                        <figure class="mt-3 ">
                            <a href="https://www.bankbjb.co.id/ina" target="_blank">
                                <img src="<?=base_url();?>assets/img/klan/bjb-musisi.jpg" alt="Bank Musisi" loading="lazy" class="img-fluid logo">
                            </a>
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
                        <a href="<?=base_url();?>">
                            <img src="<?=base_url();?>assets/img/logo-rb.png" width="250" alt="Republik Bobotoh" class="img-fluid logo">
                        </a>
                    </figure>
                    <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                        <ul class="navbar-nav ">
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>"> Home </a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/persib"> Persib </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/bobotoh"> Bobotoh
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/bolnas"> Bolnas </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/gorowok-bobotoh">
                                    Gorowok Bobotoh </a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/bisnis-bobotoh">
                                    Bisnis Bobotoh </a></li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/video"> Video </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/photo"> Foto </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>store"> LOCAL LOYAL </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link active " href="<?=base_url();?>category/ragam" >
                                Ragam
                                </a>
                                <!-- <ul class="dropdown-menu dropdown-menu-left">
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/ragam"> ragam </a></li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/ragam"> Viral </a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/ragam"> Bola Dunia </a></li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/sport"> Sport </a></li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/gaya-hidup"> Gaya Hidup </a></li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/ekbis"> Ekbis </a></li>
                                    <li><a class="dropdown-item" href="<?=base_url();?>category/tekno"> Tekno </a></li>
                                </ul> -->
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?=base_url();?>category/piala-dunia"> Piala Dunia </a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#"> Agama/Islam </a></li> -->
                        </ul>


                        <!-- Search bar.// -->
                        <ul class="navbar-nav ">
                            <li class="nav-item search hidden-xs hidden-sm "> <a class="nav-link" href="#">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- Search content bar.// -->
                        <div class="top-search navigation-shadow">
                            <div class="container">
                                <div class="input-group ">
                                    <form action="#">

                                        <div class="row no-gutters mt-3">
                                            <div class="col">
                                                <input class="form-control border-secondary border-right-0 rounded-0"
                                                    type="search" value="" placeholder="Search "
                                                    id="example-search-input4">
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"
                                                    href="/search-result.html">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Search content bar.// -->
                    </div> <!-- navbar-collapse.// -->
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
                                    <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                        placeholder="Search">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
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
                                        href="<?=base_url();?>"> Home </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/persib"> Persib </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/bobotoh"> Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/bolnas"> Bolanas </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/gorowok-bobotoh">Gorowok Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/bisnis-bobotoh">Bisnis Bobotoh </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/video"> Video </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>category/photo"> Foto </a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="<?=base_url();?>store"> Local Loyal </a></li>
                                        <li class="nav-item dropdown">
                            <a class="nav-link active " href="<?=base_url();?>category/ragam" > Ragam
                            </a>
                            <a class="nav-link active " href="<?=base_url();?>category/piala-dumia" > Piala Dunia
                            </a>
                            <!-- <ul class="dropdown-menu dropdown-menu-left">
                                <li><a class="dropdown-item" href="<?=base_url();?>category/rbnews"> Rbnews </a></li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/viral">Viral </a>
                                </li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/viral">Bola Dunia</a></li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/viral">Sport</a></li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/gaya-hidup">Gaya Hidup</a></li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/ekbis">Ekbis</a></li>
                                <li><a class="dropdown-item" href="<?=base_url();?>category/tekno">Tekno</a></li>
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
                        <a href="https://www.bankbjb.co.id/ina" target="_blank">
                            <img src="<?=base_url();?>assets/img/klan/bjb-musisi.jpg" loading="lazy" alt="BJB HUT General" class="img-fluid logo sidebar_bjb">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </header>