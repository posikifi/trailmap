<!doctype html>
<html lang="fi">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">


	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
    <style>
        #map {
            height: 600px;
        }
        body {
            padding-top: 70px;
        }
    </style>
    <script>

    <?php 
    $bboxes = Array();
    foreach ($variables['']['routes'] as $r) {
    	$bboxes[$r['id']] = json_decode($r['bbox']);
    }
    echo 'var bboxes = ' . json_encode($bboxes) . ';';
    ?>
    </script>
    <script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    <title>Trailmap</title>
</head>

<body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Trailmap</a>
            </div>
            <p class="navbar-text navbar-right">
                <?php if (user_is_logged_in()): ?>
                <a href="http://trailmap.hylly.org/trailmap/?q=trailmap/edit">Muokkaa polkuja</a>
<?php echo t('Kirjautunut sisään käyttäjänä: ') . '<a href="http://trailmap.hylly.org/trailmap/?q=trailmap/me">' . $user->name . '</a> - <a href="http://trailmap.hylly.org/trailmap/?q=user/logout">' . t('Kirjaudu ulos') . '</a>';?>
<?php else: ?>
	<form class="form-inline navbar-right" role="form" action="/trailmap/?q=node&amp;destination=node" method="post" id="user-login-form" accept-charset="UTF-8">
	  <div class="form-group">
	    <label class="sr-only" for="edit-name">K&auml;tt&auml;j&auml;tunnus</label>
	    <input type="text" class="form-control" id="edit-name" placeholder="Tunnus">
	  </div>
	  <div class="form-group">
	    <label class="sr-only" for="edit-pass">Password</label>
	    <input type="password" class="form-control" id="edit-pass" placeholder="Salasana">
	  </div>
		<input type="hidden" name="form_id" value="user_login_block" />
	  <button type="submit" class="btn btn-default form-submit" id="edit-submit" name="op" value="Log in" >Kirjaudu</button>
	</form>


<?php endif;?>

</p>
<!--/.nav-collapse -->
</div>
</div>
</div>

<div class="container">
<div class="row">
<div class="col-md-3">
<div class="list-group">
<?php
foreach ($variables['']['routes'] as $r):
?>
<a href="#" id="r<?php echo $r['id'];?>" class="routeitem list-group-item">
<h4 class="list-group-item-heading"><?php echo $r['nimi'];?></h4>
<p class="list-group-item-text"><?php echo $r['kuvaus'];?></p>
<p class="list-group-item-text">Pituus: <?php echo round($r['pituus']/1000,1);?>km</p>
<p class="list-group-item-text">Tekij&auml;: <?php echo $r['user']->name;?></p>
</a>

<?php
endforeach;
?>
</div>
<div id="info">
</div>
</div>
<div id="map" class="col-md-9"></div>
</div>
</div>

<script type="text/javascript">
var map = L.map('map').setView([60.23, 24.8], 13);
var kapsi = L.tileLayer('http://tiles.kartat.kapsi.fi/peruskartta/{z}/{x}/{y}.png',{attribution:'Kapsi, MML avoimet aineistot'}).addTo(map);
var pulla = L.tileLayer('http://raspi.nopsa.dy.fi/tiili/{z}/{x}/{y}.png', {minZoom:14, maxZoom:16, attribution: 'MML avoimet aineisto'});

var segments = L.tileLayer.wms("/geoserver/trailmap/wms?", {
    layers: 'trailmap:segment',
    format: 'image/png',
    transparent: true,
    attribution: "trailmap"
}).addTo(map);

var taustat = {
	'Kapsi Peruskartta': kapsi,
	'Pullauttelua': pulla
};

var overlays = {
	'Polut': segments
};

L.control.layers(taustat, overlays).addTo(map);

map.on('click', function(e) {
	var size = map.getSize();
	var point = map.latLngToContainerPoint(e.latlng,map.getZoom());
   	var kysely = '/geoserver/trailmap/wms?request=GetFeatureInfo&&service=WMS&version=1.1.1&layers=trailmap:segment&srs=EPSG:4326&&INFO_FORMAT=application/json&&query_layers=trailmap:segment&feature_count=50';
    	kysely += '&bbox='+map.getBounds().toBBoxString()+'&width='+size.x+'&height='+size.y;
	kysely += '&x='+point.x+'&y='+point.y;
	console.log(kysely);
	console.log(e);
	loadXMLDoc(kysely, e.latlng);
});

function loadXMLDoc(url, p) {
    var xmlhttp;

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var data = JSON.parse(xmlhttp.responseText);
	    //console.log(data);
	    if (data.features.length > 0){
		var html ='<table class="table">';
		html += '<tr><td>Alusta</td><td>'+data.features[0].properties.alusta+'</td></tr>';
		html += '<tr><td>Selkeys</td><td>'+data.features[0].properties.selkeys+'</td></tr>';
		html += '<tr><td>Ep&auml;tasaisuus</td><td>'+data.features[0].properties.epatas+'</td></tr>';
		html += '</table>';
		L.popup().setLatLng(p).setContent(html).openOn(map);
	}
        }
    }

    xmlhttp.open("GET",url, true);
    xmlhttp.send();
}

$('.routeitem').click(function (e) {
	var routeid = this.id.substr(1);
	var bbox = bboxes[routeid];
	var ll = bbox.coordinates[0][0];
	var ur = bbox.coordinates[0][2];
	console.log(ll,ur);
	map.fitBounds([[ll[1],ll[0]],[ur[1],ur[0]]]);
	e.preventDefault();
});

</script>
</body>

</html>
