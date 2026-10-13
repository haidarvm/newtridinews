<?php 
$css  = '<link rel="stylesheet" href="'. base_url ().'assets/min/css/daterangepicker.css">
<style>
.table th img, .table td img {
    width: 200px;
    height: auto;
    border-radius: 100%;
  }
  .table-image {
    td, th {
      vertical-align: middle;
    }
  }
</style>';
include 'template/header.php';

?>
<div class="content-wrapper" style="padding:2rem 0;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="<?=base_url();?>admin/product/add" class="btn btn-info btn-sm"><i
                        class="mdi mdi-plus"></i> Tambah</a>
                <table class="table table-striped stylish-table table-responsive" >
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Img</th>
                            <th> Name</th>
                            <th> Price</th>
                            <th> Description</th>
                            <th> Date</th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($product as $row) {  
                            ?>
                        <tr>
                            <td><?php echo $row->product_id; ?></td>
                            <td  class="w-25"><img src="<?php echo imgBasePathUrl($row->path); ?>" class="img-fluid rounded mx-auto d-block" /></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->price; ?></td>
                            <td><?php echo $row->meta_description; ?></td>
                            <td><?php echo $row->created_at; ?></td>
                            <td><?php echo $row->status =='1' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Disabled</span>';?> </td>
                            <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() . 'admin/product/edit/' . $row->product_id; ?>">
                            <i class="mdi mdi-pencil"></i></a></td>
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
                    <script>
                    $(document).ready(function () {
                        $(\'#datatable\').dataTable();
                        
                         $(\'#datatable3\').DataTable( {
                            "scrollY":        "400px",
                            "scrollCollapse": true,
                            "paging":         false
                        });
                    });
                  
                </script>';
include 'template/footer.php';?>