<?php 
$css  = '<link rel="stylesheet" href="'. base_url ().'assets/min/css/daterangepicker.css">
<style>
.table th img, .table td img {
    width: 150px;
    height: auto;
    border-radius: 100%;
  }
  .table-image {
    td, th {
      vertical-align: middle;
    }
  }
</style>';
include 'template/header.php';?>
<div class="content-wrapper" style="padding:2rem 0;">
    <div class="col grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped stylish-table table-responsive" >
                    <thead>
                        <tr>
                            <th> No</th>
                            <th> Img</th>
                            <th> Position</th>
                            <th> Filename</th>
                            <th> Title</th>
                            <th> Url</th>
                            <th> Date</th>
                            <th> Pageviews</th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        foreach ($ads as $row) {  
                            ?>
                        <tr>
                            <td><?php echo $row->ads_id; ?></td>
                            <td><img  width="150" src="<?php echo imgBasePathUrl($row->path); ?>" /></td>
                            <td><?php echo $row->position; ?></td>
                            <td><?php echo $row->filename; ?></td>
                            <td>
                                <h6><a href="<?php echo imgBasePathUrl($row->path); ?>" target="_blank"><?php echo $row->title; ?></a></h6>
                            </td>
                            <td><?php echo $row->url; ?></td>
                            <td><?php echo $row->updated_at; ?></td>
                            <td><?php echo $row->total_pageviews; ?></td>
                            <td><?php echo $row->status =='1' ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Disabled</span>';?> </td>
                            <td><a class="btn btn-primary btn-sm" href="<?php echo base_url() . 'admin/ads/edit/' . $row->ads_id; ?>">
                            <i class="mdi mdi-pencil"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <img src="<?php echo base_url(). 'assets/images/adsposition.jpeg'; ?>" />
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
                        // $(".rubrik-select").change(function(e){
                        //     window.location.href ="'.base_url().'admin/posts/" + $(this).val() + "/1";
                        // });
                    });
                  
                </script>';
include 'template/footer.php';?>