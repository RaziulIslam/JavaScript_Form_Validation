<?php
class formData {
    // DB stuff
    private $conn;
    private $table = 'reg_form';
    // form Properties
    public $id;
    public $name;
    public $email;
    public $number;
    public $address;
    public $password;
    public $image;
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    // Get form Data
    public function read() {
        // Create query
        $query = 'SELECT * FROM reg_form';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Execute query
        $stmt->execute();
        return $stmt;
    }
    // Get Single Form Data
    public function read_single() {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->name = $row['name'];
        $this->email = $row['email'];
        $this->number = $row['number'];
        $this->address = $row['address'];
        $this->image = $row['image'];
    }
    // Insert Form Data
    public function create() {
        // File upload path
        $is_upload = true;
        if($this->image != "") {
            $temp_name = $_FILES["image"]["tmp_name"];
            $targetDir = "../uploads/" . $this->image;
            $is_upload = move_uploaded_file($temp_name, $targetDir);
        }
        
        if ($is_upload) {
            if($this->id == 0) {
                // Insert query
                $query = 'INSERT INTO ' . $this->table . ' 
            SET 
            name = :name,
            email = :email,
            number = :number,
            address = :address,
            password = :password,
            image = :image ';
                // Prepare statement
                $stmt = $this->conn->prepare($query);
                // Clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $this->email = htmlspecialchars(strip_tags($this->email));
                $this->number = htmlspecialchars(strip_tags($this->number));
                $this->address = htmlspecialchars(strip_tags($this->address));
                $this->password = htmlspecialchars(strip_tags($this->password));
                $this->image = htmlspecialchars(strip_tags($this->image));
                // Bind data
                // $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':number', $this->number);
                $stmt->bindParam(':address', $this->address);
                $stmt->bindParam(':password', $this->password);
                $stmt->bindParam(':image', $this->image);
                // Execute query
                if ($stmt->execute()) {
                    return true;
                } else {
                    unlink($targetDir);
                }
                //Print error if something goes wrong
                printf("Error: %s.\n" . $stmt->error);
                return false;
            }
        }
    }
    // Update Form Data
    public function update() {

        // File upload path
        $temp_name = $_FILES["image"]["tmp_name"];
        $fileName = time() . '_'. $_FILES["image"]["name"];
        $targetDir = "../uploads/" . $fileName;
        move_uploaded_file($temp_name, $targetDir);

            // Update query
            $query = 'UPDATE ' . $this->table . '
      SET 
        name = :name,
        email = :email,
        number = :number,
        address = :address,
        password = :password,
        image = :image
      WHERE
        id = :id ';
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->number = htmlspecialchars(strip_tags($this->number));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->password = htmlspecialchars(strip_tags($this->password));
            $this->image = htmlspecialchars(strip_tags($this->image));
            // $this->id = htmlspecialchars(strip_tags($this->id));
            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':number', $this->number);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':image', $this->image);
            $stmt->bindParam(':id', $this->id);
            // Execute query
            if ($stmt->execute()) {
                return true;
            } else {
              unlink($targetDir);
          }
            /* } else {
            return false;
        }   */
    }
    // Delete Form Data
    public function delete() {
        // Create query
        $getQuery = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';
        
        // Prepare statement
        $getImage = $this->conn->prepare($getQuery);
        
        // Bind ID
        $getImage->bindParam(':id', $this->id);
        
        // Execute query
        $getImage->execute();
        
        $selectImage = $getImage->fetch(PDO::FETCH_OBJ);
        $fImage = $selectImage->image;
        //echo $fImage; die();
        
        // Delete query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id ';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean dat
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind data
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if ($stmt->execute()) {
            $targetDir = "../uploads/" . $fImage;
            if (unlink($targetDir)) {
                return true;
            } else {
                $this->conn->rollback();
                return false;
            }
        } else {
            return false;
        }
    }
}
?>