<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
 
</head>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $database = "task";

        // Fetching input
        $user1 = $_POST['username'];
        $password = $_POST['password'];

        // MySQL Connection
        $conn = new mysqli($host, $user, $pass, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate login credentials
        $sql = "INSERT INTO login (name, password) VALUES (?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user1, $password);
        $stmt->execute();

        // Check if the insert was successful
        if ($stmt->affected_rows > 0) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the connection
        $stmt->close();
        $conn->close();
    }
?>
<body>
    <form action="index.php" method="POST">
        <h1>LOGIN</h1>
        <label>NAME</label>
        <input type="text" name="username" id="user1" required>
        <br>
        <label>Password</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" name="login" id="Submit" value="Submit">
        <a href="/phplogin/reg.php">new register</a>
    </form>
</body>
</html>
