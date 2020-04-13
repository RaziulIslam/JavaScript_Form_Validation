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

    // form data query
    $result = $form->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any form data
    if($num > 0) {
        // form data array
        $form_arr = array();
        $form_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $form_item = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'number' => $number,
            'address' => html_entity_decode($address),
            'password' => $password,
            'image' => $image
        );
        // Push to "data"
        array_push($form_arr['data'], $form_item);
        }

        // Turn to JSON & output
        echo json_encode($form_arr);
    }
    else {
        // No form data found
        echo json_encode(
          array('message' => 'No Form Data Found')
        );
      }
?>