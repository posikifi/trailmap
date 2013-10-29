<?php

function trailmap_upload_view() {
  return drupal_get_form('upload_form');
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
    $file = file_save_upload('file', array(
    'file_validate_extensions' => array('gpx'), // Validate extensions.
  ),NULL,FILE_EXISTS_REPLACE);
  // If the file passed validation:
  if ($file) {
    // Move the file, into the Drupal file system
    $form_state['storage']['file'] = $file;
    /*
    if ($file = file_move($file, 'public://gpx_tracks')) {
      // Save the file for use in the submit handler.
      
    }

    else {
      form_set_error('file', t('Failed to write the uploaded file to the site\'s file folder.'));
    }
    */
  }
  else {
    form_set_error('file', t('No file was uploaded.'));
  } 
}

// Adds a submit handler/function to our form to send a successful 
// completion message to the screen.


function upload_form_submit($form, &$form_state) {
  $file = $form_state['storage']['file'];
    debug($file);  
  // Set a response to the user.
  drupal_set_message(t('The form has been submitted and the image has been saved, filename: @filename.', array('@filename' => $file->filename)));
  $path = drupal_realpath($file->destination);
  debug($path);
  debug(file_get_contents($path));
  debug(file_get_contents($file->destination));
  file_delete($file);
}
