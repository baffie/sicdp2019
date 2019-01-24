<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/moment-with-locales.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>

<script type="text/javascript">
    $('#tahun').datetimepicker({
        format: 'YYYY',
        locale: 'id'
    });

</script>
<script type="text/javascript">
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

    $("#form_filter").submit(function(){
        var post_data=$(this).serialize();
        table.fnReloadAjax('<?php echo site_url()?>cms/rdkk/grid_filter?'+post_data);
        return false;
    });
</script>