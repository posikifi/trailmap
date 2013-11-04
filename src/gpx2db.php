<?php
function vieData($gpxtiedosto, $user)
{
	$db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');
	
	$db->exec("SELECT nextval('tracks.id') FROM raw.tracks");
	$trackID = $db->fetch();
	$trackID = $trackID[0];
	
	$sth = $db->prepare("INSERT INTO trkpt (time,z,track_id,geom) VALUES(?, ?, ?, ST_SetSRID(ST_Point(?,?),4326))");
	
	
	
	
	$tiedosto = simplexml_load_file($gpxtiedosto);
	foreach ($tiedosto->trk as $trk)
	{
		foreach ($trk->trkseg as $trkseg)
		{
			foreach ($trkseg->trkpt as $trkpt)
			{
				$tiedot = $trkpt->attributes();
				$lat = $tiedot["lat"];
				$lon = $tiedot["lon"];
				$time = $trkpt->time;
				$ele = $trkpt->ele;
				//vienti tietokantaan
				
				$sth->execute(array($time, $ele, $trackID,$lon,$lat));				
			}
		}
	}
}



?>
