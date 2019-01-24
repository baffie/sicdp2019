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

<script type="text/javascript">
    $('#tahun').datetimepicker({
        format: 'YYYY',
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
        initialPreview: ["<img src='"+BASE+"thumbs/"+IMAGES+"' class='file-preview-image' />"],
        //initialPreview: ["<embed src='"+BASE+"thumbs/"+IMAGES+"' type="aplication/pdf" class='file-preview-image' />"],
        //<embed src="" type="application/pdf" width="500" height="700"/>
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
            { "data": "nama_kel" },
            { "data": "nama_poktan" },
            { "data": "bulan" },
            { "data": "tahun" },
            {
                "data": "stok_awal",
                className:"sum",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            {
                "data": "penambahan",
                className:"sum",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            {
                "data": "penyaluran",
                className:"sum",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            {
                "class": "text-center",
                "data": "akhir",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' )
            },
            { "data": "status" },
            { "data": "action" },
            { "data": "lokasi" }
        ],
        /*"footerCallback": function(row, data, start, end, display) {
                    var api = this.api();

                    api.columns('.sum', { page: 'current' }).every(function () {
                        var sum = api
                            .cells( null, this.index(), { page: 'current'} )
                            .render('display')
                            .reduce(function (a, b) {
                                var x = parseFloat(a) || 0;
                                var y = parseFloat(b) || 0;
                                return x + y;
                            }, 0);
                        console.log(this.index() +' '+ sum); //alert(sum);
                        $(this.footer()).html(sum);
                        });
                    }*/
        columnDefs: [
            {
                "render": function(data, type, row) {
                    if (row.status == '1') {
                        return '<span class="label label-success">Tervalidasi</span>';
                    }
                    else {
                        return '<span class="label label-default">Belum Validasi</span>';
                    }
                }, "targets": [9]
            }
        ]            
                     
    });
    $("#form_filter").submit(function(){
        var post_data=$(this).serialize();
        table.fnReloadAjax('<?php echo site_url()?>auth/lpm/grid_filter?'+post_data);
        return false;
    });
    
</script>
<script>
function getStokAwal(){
        var id=document.getElementById('id_poktan').value;
       // alert (id);
        
    //var txt = $("input").val();
    $.post("<?php echo site_url()?>/ajax/get_stok_awal", {id_poktan: id}, function(result){
        //alert (result);
        document.getElementById('stok_awal').value = result ;
        
    });
        
}
</script>