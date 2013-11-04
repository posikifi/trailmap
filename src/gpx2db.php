<?php
function vieData($gpxtiedosto, $user)
{
	$con = pg_connect("host=localhost dbname=trailmap_gis user=trailmap password=luoto") or die ("Could not connect to server\n");
	$query = "INSERT INTO trkpt (time,z,track_id,geom) VALUES($1, $2, $3, ST_SetSRID(ST_Point($4,$5),4326))";
	pg_prepare($con, "valmistelu", $query) or die ("Cannot prepare statement\n");
	pg_query('SELECT nextval('tracks.id') FROM raw.tracks');
	$trackID = pg_fetch_row()[0];
	//yhteys aina luodaan uudestaan, vai tuleeko yhteys parametrina?
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
				pg_execute($con, "valmistelu", array($time, $ele, $trackID,$lon,$lat)) or die ("Cannot execute statement\n");				
			}
		}
	}
}



?>
