<?php 
  // Headers
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // header('Access-Control-Allow-Methods: PUT');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
    // header('Access-Control-Allow-Methods: *');
    
    include_once '../config/Database.php';
    include_once '../model/form_value.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate form object
    $form = new formData($db);
    // var_dump($_FILES);die();
    $fileName = time() . '_'. $_FILES['image']['name'];
    $fileContent = file_get_contents($_FILES['image']['tmp_name']);
    $json = json_encode(array(
        'name' => $fileName,
      ));
      
      echo $json;

    // Get raw form data
    $data = json_decode(file_get_contents("php://input"));
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    // Set ID to update
    $form->id = $data->id;
    $form->name = $data->name;
    $form->email = $data->email;
    $form->number = $data->number;
    $form->address = $data->address;
    $form->password = $data->password;
    $form->image = $data->image;
   /*  $fileName = time() . '_'. $_FILES["image"]["name"];
    $form->image = $fileName; */

    // echo json_encode($this->form);die();

    // Update form
    if($form->update()) {
        echo json_encode(
        array('message' => 'Form Updated')
        );
    } else {
        echo json_encode(
        array('message' => 'Form Not Updated')
        );
    }
?>
<?php include '../form.php' ?>
