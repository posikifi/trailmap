<?php

function trailmap_front_view($ghi = 0, $jkl = '') {

	$routes = Array();

	$db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');

	$q = $db->query("SELECT *,(SELECT SUM(ST_Length(s.geom)) FROM trail.segment s WHERE s.id IN (SELECT segment_id FROM trail.routesegment WHERE route_id=r.id)) as pituus,(SELECT ST_AsGeoJson(ST_Transform(ST_Envelope(ST_Union(s.geom)),4326)) FROM trail.segment s WHERE s.id IN (SELECT segment_id FROM trail.routesegment WHERE route_id=r.id)) as bbox FROM trail.route r ORDER BY r.id DESC LIMIT 5;");
	foreach ($q as $route) {

		$route['user'] = user_load($route['userid']);
		$routes[] = $route;
	}





	$a = Array(
		'asd' => Array(
			'#theme' => 'front',
			'routes' => $routes
			));
	echo drupal_render($a);
    }
