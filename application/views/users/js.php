<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $("#id_desa").select2();
        $("#table").DataTable({
            responsive: true,
            "language": {
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
            }
        });
    });
    
    //$.fn.dataTableExt.sErrMode = 'throw'

</script>