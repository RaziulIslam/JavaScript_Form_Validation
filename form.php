<?php 
	include "site/header.php";
?>
<h1 class="text-center"> Form Validation In JavaScript</h1>

	<div class="container">
		<div class="row">
			<div class="col-lg-4 m-auto d-block">
				
				<form name="myform" class="form" onSubmit="saveData(event)" enctype="multipart/form-data" class="bg-light">
					<input type="hidden" id="row_id" name="id" value="0">
					<div class="form-group">
						<label for="user" class="font-weight-bold"> Name: </label>
						<input type="text" id="name" name="name" class="my_form form-control" placeholder="Enter name">
						<div id="name_error"></div>
					</div>

					<div class="form-group">
						<label class="font-weight-bold"> Email: </label>
						<input type="text" id="email" name="email" class="my_form form-control" placeholder="Enter email" autocomplete="off">
						<div id="email_error"></div>
					</div>

					<div class="form-group">
						<label class="font-weight-bold"> Mobile: </label>
						<input type="text" id="number" name="number" class="my_form form-control" placeholder="Enter mobile number">
						<div id="number_error"></div>
					</div>

					<div class="form-group">
						<label class="font-weight-bold"> Address: </label>
						<textarea type="text" id="address" name="address" class="my_form form-control" placeholder="Enter address"></textarea>
						<div id="address_error"></div>
					</div>

					<div class="form-group">
						<label class="font-weight-bold"> Password: </label>
						<input type="password" id="password" name="password" class="my_form form-control" placeholder="Enter password" autocomplete="off">
						<div id="password_error"></div>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"> Image: </label>
						<div id="image_box"></div>
						<input type='file' id="image" name='image' class="form-control" onchange='getImage(event)'>
						<div id='image_error' class='image_error'></div>
					</div>
					
					<div class="form-group">
						<label class="font-weight-bold"> Remember Me </label>
						<input id="rememberChkBox" type="checkbox">
						<div id="chekbox_error"></div>
					</div>

					<button type="submit" id="submit_btn" class="btn btn-success" value="Submit" disabled>Submit</button>
					<button type="submit" id="update_btn" class="btn btn-success" value="Submit" disabled>Update</button>
				</form>

			</div>
			<div class="col-lg-8 m-auto d-block">
				<table id="table" class="table">
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
						<tbody id="table_body">
						</tbody>
				</table>
			</div>
		</div>
	</div>

	<script src="main.js"type="text/javascript"> </script>
<?php
	include "site/footer.php";
?>