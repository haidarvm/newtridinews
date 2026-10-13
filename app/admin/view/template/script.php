<script src="<?=base_url();?>assets/js/datatables.min.js"></script>
<script>
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).ready(function() {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        select: true,
        colReorder: true,
        paging: false,
        responsive: true,
        buttons: [
            <?php if(!empty($page)) { ?>
                {
                    text: 'Tambah',
                    action: function(e, dt, button, config) {
                        window.location = '<?=base_url().'admin/'.$page;?>/insert';
                    }
                },
            <?php } ?>
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    });
});
</script>