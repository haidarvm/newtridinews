<?php 
$css  = '<link rel="stylesheet" href="'. base_url ().'assets/min/css/daterangepicker.css">';
include 'template/header.php';?>
<div class="content-wrapper" style="padding:2rem 0;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="<?php echo base_url();?>admin/posts/filter_photos" method="POST">
                    <div class="form-group row">
                        <div class="col-3" >
                            <input type="text" class="input-sm form-control" name="daterange" autocomplete="off" id="postDate"
                                value="<?php echo $daterange == 'all' ? "" : $daterange;?>" placeholder="Tanggal"/>
                        </div>
                        <div class="col-2">
                            <select class="form-control rubrik-select" name="author_id" id="exampleFormControlSelect1">
                                <option value="all">Semua Redaktur</option>
                                <?php 
                                foreach($authors as $author) { 
                                // print_r($selected);?>
                                <option value="<?php echo $author->ID; ?>"
                                    <?php  echo $author->ID == $request->uri(6) ? "selected" : "" ; ?>>
                                    <?php echo $author->display_name; ?></option>
                                <?php  }?>
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Cari"
                                value="<?php echo $search == 'all' ? "" : cleanSearch($search);?>" />
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary btn-sm mr-2" type="submit"><i
                                    class="mdi mdi-magnify"></i></button>
                            <a href="<?=base_url();?>admin/posts/add_photo" class="btn btn-info btn-sm"><i
                                    class="mdi mdi-plus"></i> Tambah</a>
                        </div>
                    </div>
                </form>
                <table class="table table-striped stylish-table table-responsive">
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Img</th>
                            <th> Tgl Terbit</th>
                            <th> Title</th>
                            <th> Keyword</th>
                            <th> Redaktur</th>
                            <th> Viewer</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $paging = $page != 1 ? ($page - 1) * 20 + 1 : 1;
                        foreach ($latest as $row) {  
                            ?>
                        <tr>
                            <td><?php echo $paging++; ?></td>
                            <td><img width="150" src="<?php echo imgBasePathUrl($row->img_thumb); ?>" /></td>
                            <td><?php echo ($row->post_date); ?></td>
                            <td>
                                <h6><a href="<?php echo base_url().'read/'. $row->ID;?>" target="_blank"><?php echo $row->post_title; ?></a></h6>
                                <p class="small text-danger"> <?php echo $row->post_status =='publish' ? '<span class="badge badge-success">'.$row->post_status.'</span>' : '<span class="badge badge-danger">'.$row->post_status.'</span>';?> </p>
                            </td>
                            <td><?php echo $row->keyword; ?></td>
                            <td><?php echo $row->cat_name; ?></td>
                            <td><span class="text-primary"><?php echo $row->display_name; ?></span></td>
                            <td><span class="text-danger"><?php echo $row->reporter_name; ?></span></td>
                            <td><span class="text-danger"><?php echo $row->total_pageviews; ?></span></td>
                            <td><a class="btn btn-primary btn-sm"
                                    href="<?php echo base_url() . 'admin/posts/edit_photo/' . $row->ID; ?>"><i
                                        class="mdi mdi-pencil"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <nav aria-label="Page navigation example">
                    <?php echo $paginator;?>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php 
$javascript = '<!-- JS-->
                    <script src="'.base_url().'assets/min/js/jquery.dataTables.min.js"></script>
                    <script src="'.base_url().'assets/min/js/dataTables.responsive.min.js"></script>
                    <script type="text/javascript" src="'.base_url(). 'assets/min/js/moment.min.js"></script>
                    <script type="text/javascript" src="'.base_url(). 'assets/min/js/daterangepicker.js"></script>
                    <script>
                    $(document).ready(function () {
                        $(\'#datatable\').dataTable();
                        
                         $(\'#datatable3\').DataTable( {
                            "scrollY":        "400px",
                            "scrollCollapse": true,
                            "paging":         false
                        });
                        // $(".rubrik-select").change(function(e){
                        //     window.location.href ="'.base_url().'admin/posts/" + $(this).val() + "/1";
                        // });
                    });
                  
                    $(\'input[name="daterange"]\').daterangepicker({
                        opens: \'left\',
                        autoUpdateInput: true,
                        showDropdowns: true,
                        locale: {
                            format: \'YYYY-MM-DD\'
                        }
                      }, function(start, end, label) {
                        console.log("A new date selection was made: " + start.format(\'YYYY-MM-DD\') + \' to \' + end.format(\'YYYY-MM-DD\'));
                      });
                      $(\'input[name="daterange"]\').on(\'apply.daterangepicker\', function(ev, picker) {
                        $(this).val(picker.startDate.format(\'YYYY-MM-DD\') + \'_\' + picker.endDate.format(\'YYYY-MM-DD\'));
                    });
                    $(\'input[name="daterange"]\').val(\'\');
                    $(\'.pagination li\').addClass(\'page-item\');
                    $(\'.pagination li a\').addClass(\'page-link\');
                </script>';
include 'template/footer.php';?>