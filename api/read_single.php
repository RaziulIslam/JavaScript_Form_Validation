<?php
    // Headers (HTTP Access)
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../config/Database.php';
    include_once '../model/form_value.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate form object
    $form = new formData($db);

    // Get ID
    $form->id = isset($_GET['id']) ? $_GET['id'] : die();

    // form data query
    $form->read_single();

    // Create array
    $form_arr = array(
    'id' => $form->id,
    'name' => $form->name,
    'email' => $form->email,
    'number' => $form->number,
    'address' => $form->address,
    'password' => $form->password,
    'image' => $form->image,
  );

  // Make JSON
  print_r(json_encode($form_arr));

?>
