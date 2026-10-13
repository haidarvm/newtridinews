<?php include 'template/header.php';?>
<link rel="stylesheet" href="<?=base_url();?>assets/css/datatables.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/css/jquery.dataTables.min.css">
<div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Data Anggota</h2>
                <table id="datatable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No Anggota</th>
                            <th>No Hp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($member as $row) { ?>
                        <tr>
                            <td><?=$row->fullname;?></td>
                            <td><?=$row->account_no;?></td>
                            <td><?=$row->phone;?></td>
                            <td> <a class="btn-sm btn-primary" href="<?=base_url();?>member/edit/"><i class="mdi mdi mdi-pencil "></i> Edit</a> |  <a class="btn-sm btn-danger" href="<?=base_url();?>member/delete/"><i class="mdi mdi mdi-delete "></i> Delete</a> </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'template/footer.php';?>
