<?php

function trailmap_edit_view($ghi = 0, $jkl = '') {
	global $user;
	$db = new PDO('pgsql:host=localhost;dbname=trailmap_gis', 'trailmap', 'luoto');
	if (isset($_POST['saveroute'])) {

		$edit = trim($_POST['edt']);

		$db->beginTransaction();
		$dbs = $db->query("SELECT max(id)+1 FROM trail.route");

		if ($db->errorCode() != 0) {
						debug($db->errorInfo());
						debug($db->errorCode());
		    drupal_set_message(t('Virhe lisättäessä reittiä tietokantaan.'),'error');
		    $db->rollBack();
		    return False;
		}

		if ($edit == 'f') {
			$routeid = $dbs->fetch();
			$routeid = $routeid[0];
			if ($routeid ===NULL) {
				$routeid = 0;
			}
		} else {
			$routeid = intval($edit);
			$db->query('DELETE FROM trail.routesegment WHERE route_id = ' . $routeid);
		}

		$sth = $db->prepare('INSERT INTO trail.routesegment (route_id,segment_id,"order") VALUES(?, ?, ?)');
		$x = 0;
		foreach (explode(',',trim($_POST['tra'])) as $rs) {
			$rs = intval(trim($rs));
			$sth->execute(array($routeid,$rs,$x));
			$x++;

		}
		if ($edit == 'f') {
			$sth = $db->prepare('INSERT INTO trail.route (kuvaus,nimi,userid,id) VALUES (?,?,?,?)');
		} else {
			$sth = $db->prepare('UPDATE trail.route SET kuvaus=?,nimi=?,userid=? WHERE id = ?');
		}
		$sth->execute(array( trim($_POST['des']),trim($_POST['nam']),$user->uid,intval($routeid)));
		if ($db->errorCode() != 0) {
						debug($db->errorInfo());
						debug($db->errorCode());
		    drupal_set_message(t('Virhe lisättäessä pisteitä ja luotaessa jälkeä tietokantaan.'),'error');
		    $db->rollBack();
		    return False;
		}
		$db->commit();


		drupal_set_message(t('Reitti luotu onnistuneesti!'),'status');

	}

	$userroutes = Array();
	foreach ($db->query('SELECT * FROM trail.route WHERE userid = ' . intval($user->uid)) as $route) {
		$segments = Array();
		foreach ($db->query('SELECT segment_id FROM trail.routesegment WHERE route_id = ' . intval($route['id'])) as $segment) {
			$segments[] = $segment['segment_id'];
		}

		$route['segments'] = $segments;
		unset($route[0]);
		unset($route[1]);
		unset($route[2]);
		unset($route[3]);
		$userroutes['s' . strval($route['id'])] = $route;
	}

	//echo theme('edit',array('userroutes' => json_decode($userroutes)));
	$a = Array(
		'edit' => Array(
			'#theme' => 'edit',
			'userroutes' => $userroutes
			));
	echo drupal_render($a);
}
