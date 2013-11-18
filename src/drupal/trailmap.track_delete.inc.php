<?php

function trailmap_track_delete($track_id) {
    global $user;
    $track_id = intval($track_id);

    $db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');
    $dbs = $db->query("SELECT id,user_id FROM raw.tracks WHERE user_id::integer = " . intval($user->uid) . ' AND id = ' . $track_id);

    $track = $dbs->fetch();
    if (intval($track['user_id']) !== intval($user->uid) && !user_access('administer')) {
        drupal_set_message(t('Et omista tätä jälkeä'),'error');
        return False;
    }

    $db->query('DELETE FROM raw.tracks WHERE id = ' . $track_id);
    $db->query('DELETE FROM raw.trkpt WHERE track_id = ' . $track_id);



    drupal_exit('http://trailmap.hylly.org/trailmap/?q=trailmap/me');
}