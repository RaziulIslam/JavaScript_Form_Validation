<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: *');
    
    include "../config/Database.php";
	include "../model/form_value.php";

	// Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate form object
    $form = new formData($db);

	// form data query
    $result = $form->read();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
?>