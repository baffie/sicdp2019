<script type="text/javascript">
    $('#table').dataTable({
        "processing": true,
        "ajax": {
            "url": '<?php echo $source; ?>'
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
            { "data": "nama_petani" },
            { "data": "nama_poktan" },
            {
                "class": "text-center",
                "data": "luas_tanam"
            },
            {
                "class": "text-center",
                "data": "urea"
            },
            {
                "class": "text-center",
                "data": "sp"
            },
            {
                "class": "text-center",
                "data": "za"
            },
            {
                "class": "text-center",
                "data": "npk"
            },
            {
                "class": "text-center",
                "data": "organik"
            },
            { "data": "action" }
        ]
    });
</script>