<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/moment-with-locales.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script type="text/javascript">
    $('#bulan').datetimepicker({
        format: 'MMMM',
        locale: 'id'
    });
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
            { "data": "bulan" },
            { "data": "stok_awal",  render: $.fn.dataTable.render.number( '\.', ',', 2, '' ) },
            { "data": "action" }
        ]
    });

</script>