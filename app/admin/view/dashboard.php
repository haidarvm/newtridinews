<?php 
$css  = '<link rel="stylesheet" href="'. base_url ().'assets/min/css/daterangepicker.css">';
include 'template/header.php';?>
<div class="content-wrapper" style="padding:2rem 0;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <h4>Traffic Mingguan (7 Hari terakhir)</h4>
                        <table class="table table-striped stylish-table table-responsive mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tgl</th>
                                    <th>Redaktur</th>
                                    <th> Viewer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i = 1;
                        foreach ($traffic_news_weekly as $news_week) {?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><a href="<?php echo readUrl($news_week->post_date, $news_week->post_title);?>"
                                            target="_blank"><?=$news_week->title?></a></td>
                                    <td><?=$news_week->date?></td>
                                    <td><?=$news_week->display_name?></td>
                                    <td><?=nums($news_week->total_pageviews)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <!-- all long table -->
                        <h4>Trending Hari ini</h4>
                        <table class="table table-striped stylish-table table-responsive mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tgl</th>
                                    <th>Redaktur</th>
                                    <th> Viewer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i = 1;
                        foreach ($trending as $trend) {?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><a href="<?php echo readUrl($trend->post_date, $trend->post_title);?>"
                                            target="_blank"><?=$trend->title?></a></td>
                                    <td><?=$trend->date?></td>
                                    <td><?=$trend->display_name?></td>
                                    <td><?=nums($trend->total_pageviews)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h4>Traffic Bulan <?=date("F")?></h4>
                        <table class="table table-striped stylish-table table-responsive mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Tgl</th>
                                    <th>Redaktur</th>
                                    <th> Viewer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $i = 1;
                        foreach ($traffic_news_montly as $news_month) {?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><a href="<?php echo readUrl($news_month->post_date, $news_month->post_title);?>"
                                            target="_blank"><?=$news_month->title?></a></td>
                                    <td><?=$news_month->date?></td>
                                    <td><?=$news_month->display_name?></td>
                                    <td><?=nums($news_month->total_pageviews)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4 ">
                        <h4>Traffic Redaktur Bulan <?=date("F")?></h4>
                        <table class="table table-striped stylish-table mb-4 ">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tgl Terakhir</th>
                                    <th>Total Viewer</th>
                                    <th>Total Berita</th>
                                    <th>Avg</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        foreach ($traffic_author as $author) {?>
                                <tr>
                                    <td><?=$author->display_name?></td>
                                    <td><?=$author->date?></td>
                                    <td><?=nums($author->total)?></td>
                                    <td><?=$author->total_news?></td>
                                    <td><?=$author->avg?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h4>Traffic Wartawan Bulan <?=date("F")?></h4>
                        <table class="table table-striped stylish-table mb-3">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Tgl Terakhir</th>
                                    <th>Total Viewer</th>
                                    <th>Total Berita</th>
                                    <th>Avg</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        foreach ($traffic_reporter as $reporter) {?>
                                <tr>
                                    <td><?=$reporter->name?></td>
                                    <td><?=$reporter->date?></td>
                                    <td><?=nums($reporter->total)?></td>
                                    <td><?=$reporter->total_news?></td>
                                    <td><?=$reporter->avg?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                        <h4>Traffic Harian Bulan <?=date("F")?></h4>
                        <table class="table table-striped stylish-table mb-3">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Total Viewer</th>
                                    <!-- <th>Total Berita</th> -->
                                    <!-- <th>Avg</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        foreach ($daily_traffic as $traffic) {?>
                                <tr>
                                    <td><?=$traffic->date?></td>
                                    <td><?=nums($traffic->total_views)?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <h4>Traffic Keyword 7 Hari terakhir </h4>
                        <table class="table table-striped stylish-table table-responsive mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keyword</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                foreach ($traffic_keyword as $keyword) { ?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><?=$keyword->keyword;?></td>
                                    <td><?=$keyword->date;?></td>
                                    <td><?=nums($keyword->total_pageviews);?></td>
                                </tr>
                                <?php  }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$javascript = '
<!-- JS-->

<script src="'.base_url().'assets/min/js/jquery.dataTables.min.js"></script>
<script src="'.base_url().'assets/min/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="'.base_url(). 'assets/min/js/moment.min.js"></script>
<script type="text/javascript" src="'.base_url(). 'assets/min/js/daterangepicker.js"></script>
<script>
</script>';
include 'template/footer.php';?>