<?php
function vieData($gpxtiedosto, $user)
{

	$db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');
	$db->beginTransaction();
	$dbs = $db->query("SELECT max(id)+1 FROM raw.tracks");

	if ($db->errorCode() != 0) {
					debug($db->errorInfo());
					debug($db->errorCode());
	    drupal_set_message(t('Virhe lisättäessä pisteitä ja luotaessa jälkeä tietokantaan.'),'error');
	    $db->rollBack();
	    return False;
	}
	
	$trackID = $dbs->fetch();
	$trackID = $trackID[0];
	if ($trackID ===NULL) {
		$trackID = 0;
	}
	
	$sth = $db->prepare("INSERT INTO raw.trkpt (time,z,track_id,geom) VALUES(?, ?, ?, ST_SetSRID(ST_Point(?,?),4326))");

	$tiedosto = simplexml_load_file($gpxtiedosto);
	
	foreach ($tiedosto->trk as $trk)
	{
		foreach ($trk->trkseg as $trkseg)
		{
			foreach ($trkseg->trkpt as $trkpt)
			{
				$tiedot = $trkpt->attributes();
				$lat = floatval($tiedot["lat"]);
				$lon = floatval($tiedot["lon"]);
				$time = $trkpt->time;
				$ele = floatval($trkpt->ele);
				//vienti tietokantaan
				if (empty($time)) continue;

				$sth->execute(array($time, $ele, $trackID,$lon,$lat));

				if ($db->errorCode() != 0) {
					debug($db->errorInfo());
					debug($db->errorCode());
				    drupal_set_message(t('Virhe lisättäessä pisteitä ja luotaessa jälkeä tietokantaan.'),'error');
				    $db->rollBack();
				    return False;
				}

			}
		}
	}

	$db->query('INSERT INTO raw.tracks VALUES (' . intval($trackID) . ',ST_Transform((SELECT ST_MakeLine(geom ORDER BY time) FROM raw.trkpt WHERE track_id = ' . intval($trackID) . ' GROUP BY track_id),3067),' . intval($user) . ')');
	if ($db->errorCode() != 0) {
					debug($db->errorInfo());
					debug($db->errorCode());
	    drupal_set_message(t('Virhe lisättäessä pisteitä ja luotaessa jälkeä tietokantaan.'),'error');
	    $db->rollBack();
	    return False;
	}
	$db->commit();

	
}

//vieData('Move_testi.gpx',124);


?>
