<?php


define('DRUPAL_ROOT', '/var/www/trailmap/');
define('GEOSERVER_URL','http://trailmap.hylly.org:8080/geoserver');

$base_url = 'http://'.$_SERVER['HTTP_HOST'] . '/trailmap';
include_once DRUPAL_ROOT . 'includes/bootstrap.inc';

drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);


if ($user->uid == 0) {
    die('User not logged in');
}

$qs = $_SERVER['QUERY_STRING'];
parse_str($qs,$urlparams);

if (!isset($urlparams['SERVICE']) || !isset($urlparams['SERVICE'])) {
    die('Invalid query string');
}

if ($urlparams['SERVICE'] == 'WMS' && $urlparams['REQUEST'] == 'GetMap') {

    if ($urlparams['LAYERS'] == 'trailmap:tracks') {
        $qs .= '&CQL_FILTER=' . urlencode('user_id=' . intval($user->uid));

    }
    $url = GEOSERVER_URL . '/wms';
}



/*
License: LGPL as per: http://www.gnu.org/copyleft/lesser.html
$Id: proxy.php 3650 2007-11-28 00:26:06Z rdewit $
$Name$
*/

////////////////////////////////////////////////////////////////////////////////
// Description:
// Script to redirect the request http://host/proxy.php?url=http://someUrl
// to http://someUrl .
//
// This script can be used to circumvent javascript's security requirements
// which prevent a URL from an external web site being called.
//
// Author: Nedjo Rogers
////////////////////////////////////////////////////////////////////////////////

// read in the variables



function geoserver_fetch($url, $post) {
  $query_url = $url;
  /*
  $post = '';
  if( !empty( $args ) ) {
    foreach ($args as $arg => $val) {
      if (strtolower($arg) == 'wms_path') {
        $query_url .= $val;
      }
      else {
        $post .= '&'.$arg.'='.$val;
      }
    }
  }
    */
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $query_url .= '?'.$post;
  }
  
  // create a new cURL resource
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }
  $result = curl_exec($ch);

  if( !$result ) {
    geoserver_exception(curl_error($ch));
  }

  $header = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  if( !empty($header) ) {
    // Hack for geoserver stupidity.
    if (strstr($header, 'xml')) {
        header('Content-Type: application/xml');
    } else {
      header('Content-Type: ' . $header);
    }
  }

  curl_close($ch);

  // Trick out any URLs in the result
  $result = str_replace('http://localhost:8080/geoserver/', '/geoserver/', $result);

  echo $result;
}

$url = 'http://localhost:8080/geoserver/wms';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $args = $_POST;
} else {
    $args = $_GET;
}

geoserver_fetch($url, $qs);
?> 
