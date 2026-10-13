<?php
$css  = '
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/trumbowyg.min.css">
    	<link rel="stylesheet" href="' . base_url() . 'assets/min/css/jquery.fileupload.css">
        <link href="' . base_url() . 'assets/min/css/daterangepicker.css" rel="stylesheet">
		<link href="' . base_url() . 'assets/min/css/bootstrap-clockpicker.min.css" rel="stylesheet">';
include 'template/header.php';?>
<div class="content-wrapper" style="padding:2rem 1rem;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            <a href="<?=base_url();?>admin/posts/add_page" class="btn btn-info btn-sm"><i class="mdi mdi-plus"></i> Tambah Page</a>

                <table class="table table-striped stylish-table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th> Tgl Terbit</th>
                            <th> Title</th>
                            <th> Status</th>
                            <th> Redaktur</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($latest as $row) {  ?>
                        <tr>
                            <td><?php echo indoDate($row->post_date); ?></td>
                            <td><h6><a href="<?php echo base_url().'read/'. $row->ID;?>" target="_blank"><?php echo $row->post_title; ?></a><h6></td>
                            <td><span class="text-info"><?php echo $row->post_status =='publish' ? '<span class="badge badge-success">'.$row->post_status.'</span>' : '<span class="badge badge-danger">'.$row->post_status.'</span>';?></span></td>
                            <td><span class="text-info"><?php echo $row->display_name; ?></span></td>
                            <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() . 'admin/posts/edit_page/' . $row->ID; ?>"><i class="mdi mdi-pencil"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                  
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
                    $(\'input[name="post_date"]\').daterangepicker({
                        singleDatePicker: true,
                        autoUpdateInput: true,
                        showDropdowns: true,
                        locale: {
                            format: \'YYYY-MM-DD\'
                        }
                    });
                    $(\'input[name="post_date"]\').val(\'\');
                    $(\'.pagination li\').addClass(\'page-item\');
                    $(\'.pagination li a\').addClass(\'page-link\');
                </script>';
include 'template/footer.php';?>