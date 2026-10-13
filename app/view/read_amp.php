<!doctype html>
<html ⚡ lang="en">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <?php
    $dataKeywords = '';
    if (!empty($keywords)) {
        foreach ($keywords as $keyword) {
            $dataKeywords .= $keyword->keyword . ',';
        }
    }
    $homeDescription = env('APP') . ' - Persib: Satu Nama Berjuta Cerita. Jadwal Persib, berita persib, bobotoh,Pertandingan Persib, liga satu, liga 1,Klasemen Liga 1';
    $metaDescriptionClean = empty($metaDescription) ? $metaDescription : $homeDescription ; 
    ?>
    <meta name="title" content="<?= $title ?>">
    <meta name="keywords" content="<?= $dataKeywords ?>">
    <meta name="author" content="<?= $read->display_name ?>">
    <meta name="googlebot-news" content="index,follow" />
    <meta name="google-site-verification" content="-UfG48aacgVoLiMxm8adlIJx9KTbQFF1X-vtchjq_nI" />
    <meta name="googlebot" content="index,follow" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="In-Id" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Meta  Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@republikbobotoh">
    <meta name="twitter:title" content="republikbobotoh - Persib: Satu Nama Berjuta Cerita">
    <meta name="twitter:image:src"
        content="<?= !empty($image) ? $image : base_url() . 'assets/img/noimage.jpg'  ?>">
    <meta name="twitter:image:alt" content="republikbobotoh">
    <meta name="twitter:domain" content="<?=base_url();?>">
    <meta property="og:url" content="<?= $url ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:description" content="<?=$metaDescriptionClean?>" />
    <meta property="og:image" content="<?=$image_thumb;?>" />
    <link href='<?php echo base_url(); ?>assets/img/favicon.png?ver=1.1' rel='shortcut icon' type='image/png'>
    <!--DATA STRUCTURE DYNAMIC-->
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "NewsArticle",
        "publisher": {
            "@type": "Organization",
            "name": "republikbobotoh.com",
            "logo": {
                "@type": "ImageObject",
                "url": "<?=base_url();?>/assets/images/logo-rb.png"
            }
        },
        "author": {
            "@type": "person",
            "name": "<?= $author ?>"
        },
        "headline": "<?= $title ?>",
        "datePublished": "<?= tglJamDate($read->post_date) ?>",
        "dateModified": "<?= tglJamDate($read->post_date) ?>",
        "image": {
            "@type": "ImageObject",
            "url": "<?= 
            ($image === null || $image === '') ? base_url() . 'assets/img/noimage.jpg' : $image ?>",
            "width": 696,
            "height": 400
        },
        "mainEntityOfPage": 1
    }
    </script>

    <!--TODO:: Change to original URL-->
    <link rel="canonical" href="<?= $url ?>">

    <!--EXTERNAL FONTS-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" />

    <!-- Load AMP -->
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <!-- Load amp-analytics -->
    <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
    <!-- Load auto-ads -->
    <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>
    <!-- Youtube -->
    <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>


    <!--BASE AMP SCRIPT ( DONT REMOVE THIS SCRIPT )-->
    <style amp-boilerplate>
    body {
        -webkit-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -moz-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        -ms-animation: -amp-start 8s steps(1, end) 0s 1 normal both;
        animation: -amp-start 8s steps(1, end) 0s 1 normal both
    }

    @-webkit-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-moz-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-ms-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @-o-keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }

    @keyframes -amp-start {
        from {
            visibility: hidden
        }

        to {
            visibility: visible
        }
    }
    </style><noscript>
        <style amp-boilerplate>
        body {
            -webkit-animation: none;
            -moz-animation: none;
            -ms-animation: none;
            animation: none
        }
        </style>
    </noscript>

    <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
    <script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js">
    </script>
    <style amp-custom>
        body{margin:0;padding:0}:not(.material-icons){font-family:Roboto,sans-serif}header{background:#013896;padding:10px 15px}.container{padding:0 10px}.article,.article-header{border-bottom:1px solid #dcdcdc}h1.article-title{font-size:1.5rem;word-break:break-word}h3{font-size:1rem;margin-bottom:0;word-break:break-word}.article-meta{color:#969696;display:block}.category{background-color:#f70d28;font-weight:700;font-size:12px;text-transform:uppercase;padding:5px 10px;display:inline-block;text-decoration:none;color:#fff}.date-time{font-size:calc(1rem - 2px)}.amp-icon{height:14px;width:14px;fill:#969696;position:relative;top:2px}.author::before{content:'\2014';display:inline-block;margin:auto 3px}.author{display:inline-block}.author-time{margin-top:5px;margin-bottom:15px}.social-media{margin-bottom:15px}.article-image{display:block;position:relative;margin-top:20px}.article-image p{width:calc(100% - 20px);position:absolute;bottom:0;margin:0;padding:10px;word-break:break-word;color:#fff;font-size:13px;background:#111}.article-body{font-size:1rem;line-height:25px;padding-top:15px}.ver-line::after{content:'';height:12px;position:relative;top:1px;background:#969696;width:.05rem;display:inline-block;margin:0 1px}.header-section{font-size:1.25rem}ul.list{list-style:none;padding:0}.list-item{display:flex;width:100%;margin:10px auto}.thumbnail{width:126px;display:block}a.recent-news-title{width:auto;text-decoration:none;color:#000;font-weight:700;font-size:.9rem;font-weight:400;vertical-align:top;margin:0 0 0 15px}footer{margin-top:45px;font-size:.875rem}footer .bold{font-weight:700}a{color:#000;text-decoration:none}h3{margin-top:5px}.article-sub-heading{padding-bottom:10px;font-weight:400}a.round-active{border-radius:50%;width:15px;height:20px;padding:6px 10px;display:inline-block;background:#000;color:#fff;text-align:center}.thumbnail{width:126px;display:block}a.recent-news-title{width:auto;text-decoration:none;color:#000;font-weight:700;font-size:.9rem;font-weight:400;vertical-align:top;margin:0 0 0 15px}footer{margin-top:45px;font-size:.875rem}footer .bold{font-weight:700}a{color:#000;text-decoration:none}h3{margin-top:5px}.article-sub-heading{padding-bottom:10px;font-weight:400}a.round-active{border-radius:50%;width:15px;height:20px;padding:6px 10px;display:inline-block;background:#000;color:#fff;text-align:center}a.page-next{font-size:16px;text-transform:uppercase;font-weight:700;margin:0;padding:10px 10px;word-break:break-word}a.article-next{font-size:16px;text-transform:uppercase;font-weight:700;margin:0;padding:10px 3px;line-height:26px;word-break:break-word;color:#000}pre.content{font-size:1rem;background:0 0;border:none;margin:0;padding:0;color:#000;line-height:1.5em;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-o-pre-wrap;word-break:break-word;word-wrap:break-word;overflow:hidden;padding-bottom:15px}.box-shadow-menu{position:relative;padding-left:2em}.box-shadow-menu:before{content:"";position:absolute;left:0;top:0;width:1.5em;height:.15em;background:#fff;box-shadow:0 .25em 0 0 #fff,0 .5em 0 0 #fff}li.menu{padding:10px 15px;font-weight:700;text-transform:uppercase}.arrow{border:solid #000;border-width:0 3px 3px 0;display:inline-block;padding:3px}.right{transform:rotate(-45deg);-webkit-transform:rotate(-45deg)}.left{transform:rotate(135deg);-webkit-transform:rotate(135deg)}footer ul{margin:0;list-style-type:none;padding:1em;column-count:2;border-top:1px solid rgba(0,0,0,.15);border-bottom:1px solid rgba(0,0,0,.15)}footer ul li{margin-bottom:.5em}.badge-secondary{color:#fff;background-color:#6c757d}.badge{display:inline-block;padding:.25em .4em;margin:2px 0;font-size:15px;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25rem;font-weight:400}.awhite,.awhite:visited{color:#fff}.banner{padding:5px}.banner img{max-width:100%;height:auto}
    </style>
</head>

<body>
    <amp-auto-ads type="adsense" data-ad-client="ca-pub-5477080546673808">
    </amp-auto-ads>
    <amp-analytics type="gtag" data-credentials="include">
   <script type="application/json"> 
      {
      "vars" : { 
          "gtag_id": "G-CQTKKGRM79", 
          "config": { 
              "G-CQTKKGRM79": { 
                    "groups": "default" 
                    }
                                    }
            }
        } 
   </script> 
</amp-analytics>


    <header> <a on="tap:sidebar1" class="box-shadow-menu"> &nbsp;</a> <a href="<?=base_url();?>">
            <amp-img src="<?=base_url();?>/assets/img/logo-rb.png" height="30" width="145"
                style="vertical-align: bottom"></amp-img>
        </a> </header>
    <amp-sidebar id="sidebar1" layout="nodisplay" style="width:300px">
        <amp-nested-menu layout="fill">
            <ul>
                <li class="menu"><a href="<?=base_url();?>/" class="active">Home</a></li>
                <li class="menu"><a href="<?=base_url();?>category/persib">Persib </a></li>
                <li class="menu"><a href="<?=base_url();?>category/bobotoh">Bobotoh</a> </li>
                <li class="menu"><a href="<?=base_url();?>category/bolnas">Bolnas </a></li>
                <li class="menu"><a href="<?=base_url();?>category/gegerowok-bobotoh">Gorowok Bobotoh </a></li>
                <li class="menu"><a href="<?=base_url();?>category/bisnis-bobotoh">Bisnis Bobotoh</a></li>
                <li class="menu"><a href="<?=base_url();?>category/video">Video </a></li>
                <li class="menu"><a href="<?=base_url();?>category/ragam">Ragam </i></a></li>
            </ul>
        </amp-nested-menu>
    </amp-sidebar>
    <div class="container">
        <div class="article">
            <div class="article-header">
                <h1 class="article-title"><?= $title ?></h1>
                <h3 class="article-sub-heading"><em><?= $read->sub_heading ?></em></h3>
                <div class="article-meta">
                    <a class="category"
                        href="<?=base_url();?>/<?= $read->cat_name ?>"><?= $read->cat_name ?></a>
                    <!--date('Y-m-d\TH:i:sP')-->
                    <!--2018-03-19T00:00:00+07:00-->
                    <div class="author-time">
                        <svg class="amp-icon" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.5 0C2.9 0 0 2.9 0 6.5S2.9 13 6.5 13 13 10.1 13 6.5 10.1 0 6.5 
                                0zm0 11.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5z">
                            </path>
                            <path d="M7 3.5H6v3.2l3.2 1.9.4-.6L7 6.1z"></path>
                        </svg> <time class="date-time" data-time="<?= $read->post_date ?>"> <?=$read->post_date?> <span
                                class="ver-line"></span> <?= $read->post_date ?>
                        </time>
                        <div class="author"><?= $author ?></div>
                    </div>
                    <div class="social-media">
                        <amp-social-share type="facebook" data-param-href="<?= $url ?>"></amp-social-share>
                        <amp-social-share type="twitter" data-param-url="<?= base_url() .'amp/'. $id?>">
                        </amp-social-share>
                        <amp-social-share type="whatsapp"></amp-social-share>
                    </div>
                </div>
            </div>
            <div class="article-image"> <?php //var_dump( $image)?> <amp-img src="<?= !empty($image) ? $image : base_url() . 
                    'assets/img/noimage.jpg' ?>" layout="responsive" width="266" height="150"
                    alt="<?= $read->img_caption ?>"></amp-img>
            </div>
            <div itemprop="articleBody">
                <p><?= $read->img_caption ?></p>
                <div class="article-body"> 
                <?php echo readAMP($read->post_content); ?> 
                </div>
                

            </div>
        </div>
        <div class="article-keyword">
            <h5>Tags: <?php foreach ($keywords as $tag) { ?><span class="badge badge-secondary"> <a class="awhite"
                        href="<?php echo base_url().'tag/'.str_slug($tag->keyword); ?>"><?php echo $tag->keyword; ?></a></span>
                <?php
                } ?></h5>
        </div>
        <amp-ad width=360 height=300
            type="doubleclick"
            data-slot="/121764058,22579540800/republikbobotoh.com/republikbobotoh.com_o3b_display_amp_o3b_s2"
            data-multi-size="336x280,300x250">
        </amp-ad>
    </div>
    <?php if (!empty($latest)) : ?> 
        <div id="berita-terikini">
        <h2 class="header-section">Berita Terkini</h2>
        <ul class="list"> 
            <?php foreach ($latest as $item): ?> <li>
                <div class="list-item">
                    <div class="thumbnail">
                        <amp-img
                            src="<?= !empty($item->img_thumb) ? imgBasePathUrl($item->img_thumb) : base_url() . 'assets/img/noimage.jpg'?>"
                            layout="flex-item" width="126" height="63" alt="<?= $item->post_title ?>"></amp-img>
                    </div> <a href="<?= readAmpUrl($item->post_date, $item->post_title) ?>" class="recent-news-title"><?= $item->post_title ?></a>
                </div>
            </li> 
            <?php endforeach ?> </ul>
        </div> 
    <?php endif ?>
    <amp-ad width=360 height=300
        type="doubleclick"
        data-slot="/121764058,22579540800/republikbobotoh.com/republikbobotoh.com_o3b_display_amp_o3b_s3"
        data-multi-size="336x280,300x250">
    </amp-ad>
    <?php if (!empty($populars)) : ?> 
        <div id="berita-popular">
        <h2 class="header-section">Berita Popular</h2>
        <ul class="list"> 
            <?php foreach ($populars as $popular): ?> <li>
                <div class="list-item">
                    <div class="thumbnail">
                        <amp-img
                            src="<?= !empty($popular->img_thumb) ? imgBasePathUrl($popular->img_thumb) : base_url() . 'assets/img/noimage.jpg'?>"
                            layout="flex-item" width="126" height="63" alt="<?= $popular->post_title ?>"></amp-img>
                    </div> <a href="<?= readAmpUrl($popular->post_date, $popular->post_title) ?>" class="recent-news-title"><?= $popular->post_title ?></a>
                </div>
            </li> 
            <?php endforeach ?> </ul>
        </div> 
    <?php endif ?>
    <footer>
        <ul class="footer-nav-list">
            <li class="footer-nav-list-item"><a class="footer-link" href="<?=base_url();?>">Home</a></li>
            <li class="footer-nav-list-item"><a class="footer-link" href="<?=base_url();?>/persib">Persib</a>
        </ul>
        <ul>
            <li><a href="<?=base_url();?>/page/redaksi">Redaksi</a></li>
        </ul>
        <p>Copyright &copy; <?=date("Y");?> republikbobotoh.com All Rights Reserved</p>
    </footer>
    </div>
</body>

</html>