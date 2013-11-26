<!doctype html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="http://ol3js.org/en/master/build/ol.css" type="text/css">
    <style>
        #map {
            height: 600px;
        }
        body {
            padding-top: 70px;
        }
    </style>
    <script src="http://ol3js.org/en/master/build/ol.js" type="text/javascript"></script>
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
                <?php echo t('Kirjautunut sisään käyttäjänä: ') . '<a href="http://trailmap.hylly.org/trailmap/?q=trailmap/me">' . $user->name . '</a> - <a href="http://trailmap.hylly.org/trailmap/?q=user/logout">' . t('Kirjaudu ulos') . '</a>';?>
                <?php else: ?>
                <form action="/trailmap/?q=node&amp;destination=node" method="post" id="user-login-form" accept-charset="UTF-8"><div><div class="form-item form-type-textfield form-item-name">
  <label for="edit-name">Username <span class="form-required" title="This field is required.">*</span></label>
 <input type="text" id="edit-name" name="name" value="" size="15" maxlength="60" class="form-text required" />
</div>
<div class="form-item form-type-password form-item-pass">
  <label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
 <input type="password" id="edit-pass" name="pass" size="15" maxlength="128" class="form-text required" />
<input type="hidden" name="form_id" value="user_login_block" />
<div class="form-actions form-wrapper" id="edit-actions"><input type="submit" id="edit-submit" name="op" value="Log in" class="form-submit" /></div></div></form>
                <?php endif;?>
                    

            </p>
            <!--/.nav-collapse -->
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div>
                    <b>Otaniemen kiemura on tosi kauhean pitk&auml; nimi</b>
                    <p>Pituus: 2.3km
                        <br>Tekij&auml;: Teekkari@minullaonkauheanimimerkki</p>
                </div>
                <div id="info">
                </div>
            </div>
            <div id="map" class="col-md-10"></div>
        </div>
    </div>

    <script type="text/javascript">
        var layers = [
            new ol.layer.Tile({
                source: new ol.source.TileWMS({
                    attributions: [new ol.Attribution({
                        html: 'EI kukaan'
                    })],
                    queryable:false,
                    crossOrigin: 'anonymous',
                    params: {
                        'LAYERS': 'peruskartta',
                        'FORMAT': 'image/png',
                        'queryable':false,
                    },
                    url: 'http://tiles.kartat.kapsi.fi/peruskartta?'
                })
            }),
             new ol.layer.Tile({
			    source: new ol.source.TileWMS({
			      url: '/geoserver/wms',
			      params: {'LAYERS': 'trailmap:tracks', 'TILED': true}
			    })
			  })
        ];


        var projection = new ol.proj.Projection({
            code: 'EPSG:3067',
            units: ol.proj.Units.METERS
        });

        var map = new ol.Map({
            layers: layers,
            renderers: ol.RendererHints.createFromQueryData(),
            target: 'map',
            view: new ol.View2D({
                center: [450000.00, 7000000.0],
                projection: projection,
                zoom: 7
            })
        });
        map.on('singleclick', function(evt) {

  map.getFeatureInfo({
    pixel: evt.getPixel(),
    success: function(featureInfoByLayer) {
      document.getElementById('info').innerHTML = featureInfoByLayer.join('');
    }
  });
});
    </script>
</body>

</html>