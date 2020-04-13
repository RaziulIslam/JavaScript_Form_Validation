<?php
	include __DIR__."/site/header.php";
	include __DIR__."/config/Database.php";
	include __DIR__."/model/form_value.php";

	// Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate form object
    $form = new formData($db);

	// form data query
    $result = $form->read();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    extract($data);
    /* echo"<pre>"; 
    print_r($data);
    echo"</pre>"; //die(); */
?>

<div class="container">
     <br>
     <p>
        <a class="btn btn-success" href="form.php">Create new User</a>
    </p>

	<table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
			
        <?php foreach ($data as $value): ?>
            <tr>
                <td><?php echo $value['name'] ?></td>
                <td><?php echo $value['email'] ?></td>
                <td><?php echo $value['number'] ?></td>
                <td><?php echo $value['address'] ?></td>
				<td>
                <?php if (isset($value['image'])): ?>
                    <img style="width: 60px" src="<?php echo "./uploads/${value['image']}" ?>" alt="">
                <?php endif; ?>
                
                </td>
				<td>
					<a href="./site/view.php?id=<?php echo $value['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
					<a href="./api/update.php?id=<?php echo $value['id'] ?>" class="btn btn-sm btn-outline-secondary">Update</a>
					<a href="./api/delete.php?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
				</td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>
<?php
	include "site/footer.php";
?>