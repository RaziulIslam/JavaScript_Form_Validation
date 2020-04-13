<?php 
    include_once '../config/Database.php';
    include_once '../model/form_value.php';
    include "../site/header.php";
    
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

?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View User: <b><?php echo $form_arr['name'] ?></b></h3>
            <img style="width: 60px" src="<?php echo "../uploads/${form_arr['image']}" ?>" alt="">
        </div>
        <div class="card-body">
            <a class="btn btn-secondary" href="update.php?id=<?php echo $form_arr['id'] ?>">Update</a>
            <form style="display: inline-block" method="POST" action="delete.php">
                <input type="hidden" name="id" value="<?php echo $form_arr['id'] ?>">
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th>Name:</th>
                <td><?php echo $form_arr['name'] ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $form_arr['email'] ?></td>
            </tr>
            <tr>
                <th>Mobile:</th>
                <td><?php echo $form_arr['number'] ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo $form_arr['address'] ?></td>
            </tr>

            <tr>
                <th>Image:</th>
                <td><?php echo $form_arr['image'] ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
	include "../site/footer.php";
?>