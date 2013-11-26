<?php

function trailmap_me_view() {
    global $user;
    if (!user_is_logged_in()) {

        return t('Et ole kirjautunut sisään');
    }
    drupal_add_js('OpenLayers.js');
    //drupal_add_js('jquery.min.js');
    drupal_add_js('own_tracks.js');

    $db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');
    $dbs = $db->query("SELECT id,(SELECT MAX(time) - MIN(time) FROM raw.trkpt WHERE trkpt.track_id = tracks.id) as kesto,ST_Length(geom) as pituus FROM raw.tracks WHERE user_id::integer = " . intval($user->uid));

    $tracks = $dbs->fetchAll();

    //return '<h1>asd</h1>';
    $out = '<h1>Jäljet</h1>';

    $out.= '<table><tr><th>ID</th><th>Kesto</th><th>Pituus</th><th>&nbsp;</th></tr>';
    foreach ($tracks as $track) {
        $out .= '<tr><td>' . $track['id'] . '</td><td>' . $track['kesto'] . '</td><td>' . round($track['pituus']/1000,2) . ' ' . t('kilometriä') . '</td><td><a href="?q=trailmap/tracks/' . $track['id'] . '/delete">Poista</a></td></tr>';
    }

    $out .= '</table><div id="map" style="width:100%;height:600px;"></div>';


    return $out;
}