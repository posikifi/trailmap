<?php

require 'gpx2db.php';

function trailmap_upload_view() {
  if (user_access('upload gpx')) {
    return drupal_get_form('upload_form');
  } else {
    return t('Et saa lähettää GPX trackejä');
  }
}

function upload_form($form_state) {
  $form['file'] = array(
    '#type' => 'file',
    '#title' => t('GPX jälki')
  );


  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Lähetä',
  );
  return $form;
}

function upload_form_validate($form, &$form_state) {
  if (!user_access('upload gpx')) {
    drupal_set_message(t('Et saa lähettää GPX trackejä'),'error');
    return False;
  }
    $file = file_save_upload('file', array(
    'file_validate_extensions' => array('gpx'),),NULL,FILE_EXISTS_REPLACE);
  if ($file) {
    $form_state['storage']['file'] = $file;
  }
  else {
    form_set_error('file', t('No file was uploaded.'));
  } 
}


function upload_form_submit($form, &$form_state) {
  if (!user_access('upload gpx')) {
    drupal_set_message(t('Et saa lähettää GPX trackejä'),'error');
    return False;
  }

  global $user;
  $file = $form_state['storage']['file'];

  $path = drupal_realpath($file->destination);

  vieData($path,$user->uid);
  drupal_set_message(t('Tracking @filename lähetys onnistui!', array('@filename' => $file->filename)));
  file_delete($file);
}
