<!DOCTYPE html>
<html>
<head>
  <meta charset=”utf-8″>
  <title>Posisi GPS</title>
</head>
<body>
    <script src=”geo-min.js” type=”text/javascript” charset=”utf-8″></script>
    <script>
        if(geo_position_js.init()){
            geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});
        }
        else{
            div_isi=document.getElementById(“div_isi”);
            div_isi.innerHTML =”Tidak ada fungsi geolocation”;
        }

        function success_callback(p)
        {
            latitude=p.coords.latitude ;
            longitude=p.coords.longitude;
            pesan=’posisi:’+latitude+’,’+longitude;
            pesan = pesan + “<br/>”;
            pesan = pesan + ‘<img src=”https://maps.googleapis.com/maps/api/staticmap?size=400×400&amp;zoom=13&amp;markers=color:red%7Clabel:C%7C’+latitude +’,’+longitude+'”/>’;
            div_isi=document.getElementById(“div_isi”);
            //alert(pesan);
            div_isi.innerHTML =pesan;
        }
        
        function error_callback(p)
        {
            div_isi=document.getElementById(“div_isi”);
            div_isi.innerHTML =’error=’+p.message;
        }        
    </script>
    <div id=”div_isi”>
    </div>
</body>
</html>

