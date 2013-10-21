<?php
function vieData($gpxtiedosto)
{
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
				//vienti tietokantaan puuttuu viela
			}
		}
	}
}


echo "\n";	
vieData('Move_testi.gpx');
echo "\n\n";


?>