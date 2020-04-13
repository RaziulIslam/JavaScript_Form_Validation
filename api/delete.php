<?php 
  // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    // header('Access-Control-Allow-Methods: *');
    include_once '../config/Database.php';
    include_once '../model/form_value.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate form object
    $form = new formData($db);

    // Get raw form data
    $data = json_decode(file_get_contents("php://input"));
    //var_dump($data); die();
    
    // Set ID to Delete
    $form->id = $data->id;

    // Delete form data
    if($form->delete()) {
        echo json_encode(
        array('message' => 'Form Deleted')
        );
    } else {
        echo json_encode(
        array('message' => 'Form Not Deleted')
        );
    }
?>