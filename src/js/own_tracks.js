jQuery(function() {
    var $ = jQuery;
    var lat,lon,zoom,map;
    lon = 26;
    lat = 62;
    zoom = 6;
    var wgs84 = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
    var spher   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection

        map = new OpenLayers.Map( 'map',{           
            numZoomLevels: 20,
            projection: new OpenLayers.Projection("EPSG:900913"),
            displayProjection: new OpenLayers.Projection("EPSG: 4326")
        });
        var osmlayer = new OpenLayers.Layer.OSM( "OSM");
        map.addLayer(osmlayer);
        var tracklayer = new OpenLayers.Layer.WMS( "Tracks",
                    "./mapproxy.php", {layers: 'trailmap:tracks',transparent:true},{isBaseLayer:false} );
        map.addLayer(tracklayer);

        map.setCenter(new OpenLayers.LonLat(lon, lat).transform(wgs84,spher), zoom);
        map.addControl( new OpenLayers.Control.LayerSwitcher() );
});