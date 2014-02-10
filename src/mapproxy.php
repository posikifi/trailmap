<?php
define('DRUPAL_ROOT', '/var/www/trailmap/');
define('GEOSERVER_URL', 'http://trailmap.hylly.org:8080/geoserver');
$base_url = 'http://' . $_SERVER['HTTP_HOST'] . '/trailmap';
include_once DRUPAL_ROOT . 'includes/bootstrap.inc';

drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

if ($user->uid == 0) {
  die('User not logged in');
}

$qs = $_SERVER['QUERY_STRING'];
parse_str($qs, $urlparams);

if ($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_GET['wfstest'])) {
  if (!isset($urlparams['SERVICE']) || !isset($urlparams['SERVICE'])) {
    die('Invalid query string');
  }

  if ($urlparams['SERVICE'] == 'WMS' && $urlparams['REQUEST'] == 'GetMap') {
    if ($urlparams['LAYERS'] == 'trailmap:tracks') {
      $qs.= '&CQL_FILTER=' . urlencode('user_id=' . intval($user->uid));
    }

    $url = GEOSERVER_URL . '/wms';
  }
}
else {

  // var_dump($_POST);

  if (isset($_GET['wfstest'])) {
    $postbody = '<wfs:Transaction xmlns:wfs="http://www.opengis.net/wfs" service="WFS" version="1.1.0" xsi:schemaLocation="http://www.opengis.net/wfs http://schemas.opengis.net/wfs/1.1.0/wfs.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><wfs:Update typeName="feature:segment" xmlns:feature="trailmap"><wfs:Property><wfs:Name>geom</wfs:Name><wfs:Value><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2804730.9233842692 8471456.243765933 2803136.4947477 8470541.3760631 2802066.3763519 8471305.7463459</gml:posList></gml:LineString></wfs:Value></wfs:Property><wfs:Property><wfs:Name>alusta</wfs:Name><wfs:Value>1</wfs:Value></wfs:Property><wfs:Property><wfs:Name>selkeys</wfs:Name><wfs:Value>2</wfs:Value></wfs:Property><wfs:Property><wfs:Name>epatas</wfs:Name><wfs:Value>2</wfs:Value></wfs:Property><ogc:Filter xmlns:ogc="http://www.opengis.net/ogc"><ogc:FeatureId fid="segment.68"/></ogc:Filter></wfs:Update><wfs:Delete typeName="feature:segment" xmlns:feature="trailmap"><ogc:Filter xmlns:ogc="http://www.opengis.net/ogc"><ogc:FeatureId fid="segment.69"/></ogc:Filter></wfs:Delete><wfs:Delete typeName="feature:segment" xmlns:feature="trailmap"><ogc:Filter xmlns:ogc="http://www.opengis.net/ogc"><ogc:FeatureId fid="segment.74"/></ogc:Filter></wfs:Delete><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801081.055284167 8471054.94936813 2801850.592130324 8470483.746761603</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2802142.8133801 8469777.0057804 2802934.653219769 8469679.082861468</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801850.592130324 8470483.746761603 2802028.1578377 8470713.3593767 2802934.653219769 8469679.082861468</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801081.055284167 8471054.94936813 2799945.2488172 8470216.5186929 2801176.6015694677 8469612.200461837 2801601.669598155 8470161.861672346</gml:posList></gml:LineString></feature:geom><feature:alusta>3</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801601.669598155 8470161.861672346 2801850.592130324 8470483.746761603</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801081.055284167 8471054.94936813 2801601.669598155 8470161.861672346</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert><wfs:Insert><feature:segment xmlns:feature="trailmap"><feature:geom><gml:LineString xmlns:gml="http://www.opengis.net/gml" srsName="EPSG:900913"><gml:posList>2801601.669598155 8470161.861672346 2801970.8300665 8469528.5854385</gml:posList></gml:LineString></feature:geom><feature:alusta>1</feature:alusta><feature:selkeys>2</feature:selkeys><feature:epatas>2</feature:epatas></feature:segment></wfs:Insert></wfs:Transaction>';
  }
  else {
    $postbody = file_get_contents('php://input');
  }

  //var_dump($postbody);
  libxml_use_internal_errors(true);
  $wfs_request = new DOMDocument();
  $wfs_request->loadXML($postbody);
  $wfs_request->formatOutput = true;
  $wfsr = $wfs_request->childNodes->item(0);
  $request_type = strtolower($wfsr->tagName);
  if ($request_type == 'wfs:getfeature') {
  }
  elseif ($request_type == 'wfs:transaction') {
    foreach($wfsr->childNodes as $child) {
      $ctn = strtolower($child->tagName);
      //var_dump($ctn);
      if ($ctn == 'wfs:delete') {
        continue;
      } elseif ($ctn == 'wfs:update') {
        $userid_found = False;
        $timestamp_found = False;
        foreach($child->childNodes as $property) {
          if ($property->tagName != 'wfs:Property') continue;
          $name = $property->getElementsByTagNameNS('http://www.opengis.net/wfs', 'Name')->item(0);
          if ($name->nodeValue == 'last_mod_user') {
            $userid_found = True;
            $value = $property->getElementsByTagNameNS('http://www.opengis.net/wfs', 'Value')->item(0);
            $value->nodeValue = $user->uid;
          }

          if ($name->nodeValue == 'last_mod_timestamp') {
            $timestamp_found = True;
            $value = $property->getElementsByTagNameNS('http://www.opengis.net/wfs', 'Value')->item(0);
            $value->nodeValue = date('Y-m-d H:i:s.u');
          }
        }

        if (!$userid_found) {
          $uelem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Property');
          $nelem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Name');
          $nelem->nodeValue = 'last_mod_user';
          $velem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Value');
          $velem->nodeValue = $user->uid;
          $uelem->appendChild($nelem);
          $uelem->appendChild($velem);
          $child->appendChild($uelem);
        }

        if (!$timestamp_found) {
          $telem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Property');
          $nelem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Name');
          $nelem->nodeValue = 'last_mod_timestamp';
          $velem = $child->ownerDocument->createElementNS('http://www.opengis.net/wfs', 'Value');
          $velem->nodeValue = date('Y-m-d\TH:i:s');
          $telem->appendChild($nelem);
          $telem->appendChild($velem);
          $child->appendChild($telem);
        }
      } elseif ($ctn == 'wfs:insert') {
        $feature = $child->getElementsByTagNameNS('trailmap','segment')->item(0);

        if (is_null($feature->getElementsByTagNameNS('trailmap','last_mod_user')->item(0))) {
          $uelem = $child->ownerDocument->createElementNS('trailmap', 'last_mod_user');
          $uelem->nodeValue = $user->uid;
          $feature->appendChild($uelem);
        }

        if (is_null($feature->getElementsByTagNameNS('trailmap','last_mod_timestamp')->item(0))) {
          $uelem = $child->ownerDocument->createElementNS('trailmap', 'last_mod_timestamp');
          $uelem->nodeValue = date('Y-m-d\TH:i:s');
          $feature->appendChild($uelem);
        }
      }
    }

    $postbody = $wfs_request->saveXML();
  }
  else {
    die('Unknown request type: ' . $request_type);
  }

  //var_dump($postbody);
  $url = GEOSERVER_URL . '/trailmap/wfs';
  $qs = $postbody;
}

/*
License: LGPL as per: http://www.gnu.org/copyleft/lesser.html
$Id: proxy.php 3650 2007-11-28 00:26:06Z rdewit $
$Name$
*/

// //////////////////////////////////////////////////////////////////////////////
// Description:
// Script to redirect the request http://host/proxy.php?url=http://someUrl
// to http://someUrl .
//
// This script can be used to circumvent javascript's security requirements
// which prevent a URL from an external web site being called.
//
// Author: Nedjo Rogers
// //////////////////////////////////////////////////////////////////////////////
// read in the variables

function geoserver_fetch($url, $post)
{
  $query_url = $url;
  /*
  $post = '';
  if( !empty( $args ) ) {
  foreach ($args as $arg =>
  $val) {
  if (strtolower($arg) == 'wms_path') {
  $query_url .= $val;
  }
  else {
  $post .= '&'.$arg.'='.$val;
  }
  }
  }

  */
  if ($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_GET['wfstest'])) {
    $query_url.= '?' . $post;
  }

  // create a new cURL resource

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query_url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: ' . $_SERVER['CONTENT_TYPE']
  ));
  if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['wfstest'])) {
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  }

  $result = curl_exec($ch);
  if (!$result) {
    var_dump(curl_error($ch));
  }

  $header = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  if (!empty($header)) {

    // Hack for geoserver stupidity.

    if (strstr($header, 'xml')) {
      header('Content-Type: application/xml');
    }
    else {
      header('Content-Type: ' . $header);
    }
  }

  curl_close($ch);

  // Trick out any URLs in the result

  $result = str_replace('http://localhost:8080/geoserver/', '/geoserver/', $result);
  echo $result;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $args = $_POST;
}
else {
  $args = $_GET;
}

geoserver_fetch($url, $qs);
?>
