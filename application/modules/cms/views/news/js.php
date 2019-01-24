<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<script>
    $(".wysihtml5").wysihtml5();
</script>
<script>
    var IMAGES = "<?php echo (empty($images_content))? '' : $images_content; ?>";
    var BASE   = "<?php echo 'uploads/';?>";

    $("#file-3").fileinput({
        <?php if (!empty($images_content)): ?>
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
            { "data": "images_content",
                "render": function ( data, type, row ) {
                    return '<img src="<?php echo base_url('uploads/thumbs/')?>'+data+'" class="img-thumbnail" style="width:100px;" />';
                }
            },
            { "data": "title" },
            { "data": "channel" },
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
                }, "targets": [4]
            }
        ]
    });

</script>