<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/moment-with-locales.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<script type="text/javascript">
    var IMAGES = "<?php echo (empty($foto))? '' : $foto; ?>";
    var BASE   = "<?php echo 'uploads/users/';?>";

    $("#file-3").fileinput({
        <?php if (!empty($foto)): ?>
        initialPreview: ["<img src='"+BASE+"thumbs/"+IMAGES+"' class='file-preview-image' />"],
        <?php endif; ?>

        showCaption: false,
        allowedFileExtensions: ["jpg", "jpeg","png"],
        previewFileType: "image",
        browseClass: "btn btn-sm btn-warning",
        browseLabel: "Pick Image",
        browseIcon: '<i class="fa fa-fw fa-folder-open-o"></i>',
        removeClass: "btn btn-sm btn-danger",
        removeLabel: "Hapus",
        removeIcon: '<i class="fa fa-fw fa-trash-o"></i>',
    });

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