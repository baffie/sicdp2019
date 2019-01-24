<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<script>
    $(".wysihtml5").wysihtml5();

    $('#table').dataTable({
        "processing": true,
        "ajax": {
            "url": '<?php if (!empty($source)) echo $source; ?>'
        },
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
       var index = iDisplayIndexFull +1;
       $('td:eq(0)',nRow).html(index);
       return nRow;
        },
        "language": {
            "processing": "Pemrosesan...",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "search":         "Pencarian:",
            "zeroRecords":    "Data tidak ditemukan",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
            "info": "Halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data belum tersedia",
            "infoFiltered": "(filtered from _MAX_ total records)"
        },
        "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "slug" },
            { "data": "status" },
            { "data": "created" },
            { "data": "action" }
        ],
        columnDefs: [
            {
                "render": function(data, type, row) {
                    if (row.status == '1') {
                        return '<span class="label label-success">Publish</span>';
                    }
                    else {
                        return '<span class="label label-default">Draft</span>';
                    }
                }, "targets": [3]
            }
        ]
    });

</script>