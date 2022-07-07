

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>
 <link rel="stylesheet" href="assets/js/leaflet-locatecontrol-gh-pages/dist/L.Control.Locate.min.css" />
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
<script src="assets/js/leaflet-locatecontrol-gh-pages/dist/L.Control.Locate.min.js" charset="utf-8"></script>

   <script type="text/javascript">

// var map = L.map('mapid').setView([5.556003, 95.3264293], 13);
	   
//  var layerBasemap=L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
// 	maxZoom: 18,
	

var mbAttr	= 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
	mbUrl 	= 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
	osmattr	= '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>',
	osmurl	='https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
	
	var layerBasemap =  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'}),
	
		streets  	 = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr}),
		satelite	 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
});
	var normal = L.layerGroup();
	var sedang_diperbaiki = L.layerGroup();
	var rusak = L.layerGroup();

	<?php if (isset($_GET['lokasilampu'])) { 

		$lat=$_GET['lati'];
	    $lng=$_GET['longi']; 
	?>
		var map = L.map('mapid', {
		center: [<?=$lat ?>, <?=$lng ?>],
		zoom: 16,
		layers: [layerBasemap, normal, rusak, sedang_diperbaiki]
	});
	var circle = L.circle([<?=$lat ?>, <?=$lng ?>], {
          color: "green",
          fillColor: "#8AE48F",
          fillOpacity: 0.5,
          radius: 50.0
      }).addTo(map); 

	<?php } ?>
	  

	<?php
// marker normal

$id_statusnormal=1;
$id_statusrusak=6;
$id_statusperbaikan=2;
$db->join('status_lampu b','a.id_status=b.id_status','LEFT');
$db->where('a.id_status', $id_statusnormal);
$getdata=$db->ObjectBuilder()->get('daftar_lampu a');
foreach ($getdata as $row) {
	?>
var myIcon = L.icon({
	    iconUrl: '<?=assets('unggah/marker/'.$row->marker)?>',
	    iconSize: [26, 30],
	});
		var tombol = 'Lokasi : <?=$row->alamat?><br>Kondisi: <?=$row->nama_status?>'
		var marker2 = L.marker([<?=$row->latitude?>,<?=$row->longitude?>],{icon: myIcon}).addTo(normal)
				.bindPopup(tombol);
		<?php	
	}
	?>
<?php
$db->join('status_lampu b','a.id_status=b.id_status','LEFT');
$db->where('a.id_status', $id_statusrusak);
$getdatarusak=$db->ObjectBuilder()->get('daftar_lampu a');
foreach ($getdatarusak as $row) {
	?>
var myIcons = L.icon({
	    iconUrl: '<?=assets('unggah/marker/'.$row->marker)?>',
	    iconSize: [26, 30],
	});
		var tombols = 'Lokasi : <?=$row->alamat?><br>Kondisi: <?=$row->nama_status?>'
		var marker = L.marker([<?=$row->latitude?>,<?=$row->longitude?>],{icon: myIcons}).addTo(rusak)
				.bindPopup(tombols);
		<?php
		
	}

	?>
<?php
$db->join('status_lampu b','a.id_status=b.id_status','LEFT');
$db->where('a.id_status', $id_statusperbaikan);
$getdataperbaikan=$db->ObjectBuilder()->get('daftar_lampu a');
foreach ($getdataperbaikan as $row) {
	?>
var myIconss = L.icon({
	    iconUrl: '<?=assets('unggah/marker/'.$row->marker)?>',
	    iconSize: [26, 30],
	});
		var tombolss = 'Lokasi : <?=$row->alamat?><br>Kondisi: <?=$row->nama_status?>'
		var marker3 = L.marker([<?=$row->latitude?>,<?=$row->longitude?>],{icon: myIconss}).addTo(sedang_diperbaiki)
				.bindPopup(tombolss);
		<?php
		
	}

	?>

	var baseLayers = {
		"Openstreet Map": layerBasemap,
		"Satelit": satelite,
		"Streets": streets
	};

	var overlays = {
		<?php
		$db->where('id_status', $id_statusnormal);
		$getdatastatus1=$db->ObjectBuilder()->get('status_lampu');
		foreach ($getdatastatus1 as $roww) {
		?>
		'&nbsp<i class="fancybox-effects-c" href="<?=assets('unggah/marker/'.$roww->marker);?>" title="<?=$roww->nama_status?>" alt="gambar"><?=('<img src="'.assets('unggah/marker/'.$roww->marker).'" width=20px">')?></i>&nbsp<?=$roww->nama_status?>' : normal,	

		<?php }
		$db->where('id_status', $id_statusrusak);
		$getdatastatus2=$db->ObjectBuilder()->get('status_lampu');
		foreach ($getdatastatus2 as $rowe) {
		?>
		'&nbsp<i class="fancybox-effects-c" href="<?=assets('unggah/marker/'.$rowe->marker);?>" title="<?=$rowe->nama_status?>" alt="gambar"><?=('<img src="'.assets('unggah/marker/'.$rowe->marker).'" width=20px">')?></i>&nbsp<?=$rowe->nama_status?>' : rusak,

		<?php }
		$db->where('id_status', $id_statusperbaikan);
		$getdatastatus3=$db->ObjectBuilder()->get('status_lampu');
		foreach ($getdatastatus3 as $rowt) {
		?>
		'&nbsp<i class="fancybox-effects-c" href="<?=assets('unggah/marker/'.$rowt->marker);?>" title="<?=$rowt->nama_status?>" alt="gambar"><?=('<img src="'.assets('unggah/marker/'.$rowt->marker).'" width=20px">')?></i>&nbsp<?=$rowt->nama_status?>' : sedang_diperbaiki,
		<?php } ?>
	};

	L.control.layers(baseLayers, overlays).addTo(map);

   </script>	