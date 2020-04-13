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
    // $data = json_decode(file_get_contents("php://input"));
    // var_dump($_POST);die();
    // var_dump($_FILES); die();
    
    $form->id = $_POST['id'];
    $form->name = $_POST['name'];
    $form->email = $_POST['email'];
    $form->number = $_POST['number'];
    $form->address = $_POST['address'];
    $form->password = $_POST['password'];
    
    if($_FILES["image"]["name"] != "") {
        $fileName = time() . '_'. $_FILES["image"]["name"];
        $form->image = $fileName;
    } else { 
        $form->image = "";
    }
    
    print_r($form);
    print_r($_FILES["image"]);

    // Create form
    if($form->create()) {
        echo json_encode(
        array('message' => 'Form Created')
        );
    } else {
        echo json_encode(
        array('message' => 'Form Not Created')
        );
    }
?>