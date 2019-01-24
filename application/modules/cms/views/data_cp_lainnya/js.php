<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/moment-with-locales.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
<script type="text/javascript">
    $('#tanggal').datetimepicker({
        format: 'DD MMMM YYYY',
        locale: 'id'
    });
</script>
<script>
    $(".wysihtml5").wysihtml5();
</script>
<script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}
</script>
<script type="text/javascript">
    var IMAGES = "<?php echo (empty($attach_file))? '' : $attach_file; ?>";
    var BASE   = "<?php echo 'uploads/';?>";

    $("#file-3").fileinput({
        <?php if (!empty($attach_file)): ?>
        initialPreview: ["<iframe src='"+BASE+"file/"+IMAGES+"' class='file-preview-image' />"],
        <?php endif; ?>

        showCaption: false,
        allowedFileExtensions: ["pdf"],
        previewFileType: "pdf",
        browseClass: "btn btn-sm btn-warning",
        browseLabel: "Pilih File",
        browseIcon: '<i class="fa fa-fw fa-folder-open-o"></i>',
        removeClass: "btn btn-sm btn-danger",
        removeLabel: "Hapus",
        removeIcon: '<i class="fa fa-fw fa-trash-o"></i>',
    });


    var table="";
    jQuery.fn.dataTableExt.oApi.fnReloadAjax = function ( oSettings, sNewSource, fnCallback, bStandingRedraw )
    {
        // DataTables 1.10 compatibility - if 1.10 then `versionCheck` exists.
        // 1.10's API has ajax reloading built in, so we use those abilities
        // directly.
        if ( jQuery.fn.dataTable.versionCheck ) {
            var api = new jQuery.fn.dataTable.Api( oSettings );

            if ( sNewSource ) {
                api.ajax.url( sNewSource ).load( fnCallback, !bStandingRedraw );
            }
            else {
                api.ajax.reload( fnCallback, !bStandingRedraw );
            }
            return;
        }

        if ( sNewSource !== undefined && sNewSource !== null ) {
            oSettings.sAjaxSource = sNewSource;
        }

        // Server-side processing should just call fnDraw
        if ( oSettings.oFeatures.bServerSide ) {
            this.fnDraw();
            return;
        }

        this.oApi._fnProcessingDisplay( oSettings, true );
        var that = this;
        var iStart = oSettings._iDisplayStart;
        var aData = [];

        this.oApi._fnServerParams( oSettings, aData );

        oSettings.fnServerData.call( oSettings.oInstance, oSettings.sAjaxSource, aData, function(json) {
            /* Clear the old information from the table */
            that.oApi._fnClearTable( oSettings );

            /* Got the data - add it to the table */
            var aData =  (oSettings.sAjaxDataProp !== "") ?
                that.oApi._fnGetObjectDataFn( oSettings.sAjaxDataProp )( json ) : json;

            for ( var i=0 ; i<aData.length ; i++ )
            {
                that.oApi._fnAddData( oSettings, aData[i] );
            }

            oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();

            that.fnDraw();

            if ( bStandingRedraw === true )
            {
                oSettings._iDisplayStart = iStart;
                that.oApi._fnCalculateEnd( oSettings );
                that.fnDraw( false );
            }

            that.oApi._fnProcessingDisplay( oSettings, false );

            /* Callback user function - for event handlers etc */
            if ( typeof fnCallback == 'function' && fnCallback !== null )
            {
                fnCallback( oSettings );
            }
        }, oSettings );
    };
    var table = $('#table').dataTable({
        "processing": true,
        "ajax": {
            "url": '<?php echo $source; ?>'
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
            { "data": "bulan" },
            { "data": "tahun" },
            { "data": "stok_awal",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' ) },
            {
                "class": "text-center",
                "data": "penambahan",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            {
                "class": "text-center",
                "data": "penyaluran",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            {
                "class": "text-center",
                "data": "penyusutan",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
              {
                "class": "text-center",
                "data": "akhir",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
             /*{ "data": "attach_file",
                "render": function ( data, type, row ) {
                    return '<img src="<?php echo base_url('uploads/file/')?>'+data+'" class="img-thumbnail" style="width:100px;" />';
                }
            },
            {"data": "attach_file"},*/
            { "data": "action" },
            { "data": "lokasi" }
        ]
    });
    /*var table = $('#table').DataTable({
    'initComplete': function (settings, json){
        this.api().columns('.sum').every(function(){
            var column = this;

            var sum = column
                .data()
                .reduce(function (a, b) { 
                   a = parseInt(a, 10);
                   if(isNaN(a)){ a = 0; }                   

                   b = parseInt(b, 10);
                   if(isNaN(b)){ b = 0; }

                   return a + b;
                });

            $(column.footer()).html('Sum: ' + sum);
        });
    }
});*/

    $("#form_filter").submit(function(){
        var post_data=$(this).serialize();
        table.fnReloadAjax('<?php echo site_url()?>auth/data_cp_lainnya/grid_filter?'+post_data);
        return false;
    });
    

</script>
<script>
function getStokAwal(){
        var id=document.getElementById('id_kabupaten').value;
       // alert (id);
        
    //var txt = $("input").val();
    $.post("<?php echo site_url()?>/ajax/get_stok_cp_lainnya", {id_kabupaten: id}, function(result){
        //alert (result);
        document.getElementById('stok_awal').value = result ;
        
    });
        
}
</script>