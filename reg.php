<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        input {
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>
        <label> Email:</label>
        <input type="text" id="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label>Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br>

        <label>Age:</label>
        <input type="number" id="age" name="age" required><br>

        <label>Phone Number:</label>
        <input type="number" id="phone" name="phone" required><br>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="Male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female">
        <label for="female">Female</label><br>

        <label>Select File:</label>
        <input type="file" id="file" name="file" required><br>

        <input type="submit" value="Register">
    </form>

    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db_name = "task";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $conn->real_escape_string($_POST['fullname']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $dob = $conn->real_escape_string($_POST['dob']);
        $age = $conn->real_escape_string($_POST['age']);
        $phone =$conn->real_escape_string($_POST['phone']);
        $gender = $conn->real_escape_string($_POST['gender']);
       

        // Handle file upload
        $target_dir = "uploads/";
        $file_name = basename($_FILES["file"]["name"]);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $file_path = $conn->real_escape_string($target_file);

            // Insert data into the database
            $query = "INSERT INTO registration (fullname, email, password, dob, age, phone , gender, file) 
                      VALUES ('$fullname', '$email', '$password', '$dob', '$age', '$phone', '$gender' , '$file_name')";

            if ($conn->query($query) === TRUE) {
                echo "Registration successful!";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        } else {
            echo "File upload failed.";
        }
    }
    $conn->close();
    ?>
</body>
</html>