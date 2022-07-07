 <!-- jQuery -->
 <script src="<?=templates()?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="<?=templates()?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?=templates()?>vendors/fastclick/lib/fastclick.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>    <!-- NProgress -->
    <script src="<?=templates()?>vendors/nprogress/nprogress.js"></script>
   <!-- Custom Theme Scripts -->
    <script src="<?=templates()?>build/js/custom.min.js"></script>

    <!-- fancybox -->
   <script type="text/javascript" src="assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
    <script type="text/javascript">
		$(document).ready(function() {
      /*
			 *  Different effects
			 */

			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				padding: 5,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});
    });
</script>
   <script>
  $(document).ready( function () {
    $('#table_id').DataTable();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
$('#maks_nik').keyup(function() {
var batas_nik = this.value.length;
if (batas_nik >= 17) {
	alert("No NIK/NISN Maksimal 16 Angka!");
    this.value = "";
};
});
$('#maks_nohp').keyup(function() {
var batas_nohp = this.value.length;
if (batas_nohp >= 14) {
	alert("No HP Maksimal 13 Angka!");
    this.value = "";
};
});
$('#area').keyup(function() {
var batas_karakter = this.value.length;
if (batas_karakter >= 250) {
	alert("Karakter yang diinput harus kurang dari 250 karakter!");
    this.value = "";
};
});
});
</script>
