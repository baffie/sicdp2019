<script type="text/javascript">
    $('#table').dataTable({
        "processing": true,
        "ajax": {
            "url": '<?php if (!empty($source)) echo $source; ?>'
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
            { "data": "subsektor" },
            { "data": "name" },
            { "data": "action" }
        ]
    });

</script>