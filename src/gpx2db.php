<?php
function vieData($gpxtiedosto, $trackID)
{
	$con = pg_connect("host=localhost dbname=trailmap_gis user=KAYTTAJA password=SALASANA") or die ("Could not connect to server\n");
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
				$query = "INSERT INTO trkpt (time,z,track_id,geom) VALUES($1, $2, $3, ST_Point($4,$5))";
				pg_prepare($con, "valmistelu", $query) or die ("Cannot prepare statement\n");
				pg_execute($con, "valmistelu", array($time, $ele, $trackID,$lon,$lat)) or die ("Cannot execute statement\n");
				//piste varmaan viety
			}
		}
	}
	pg_close($con);
}


echo "\n";	
vieData('Move_testi.gpx', 12);
echo "\n\n";


?>