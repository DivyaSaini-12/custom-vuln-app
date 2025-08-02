<?php
$conn = new mysqli("localhost", "root", "", "vulnapp");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerable query (NO protection!)
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $msg = "Welcome, $username!";
    } else {
        $msg = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable Login</title>
</head>
<body>
    <h2> Vulnerable Login Page</h2>
    <form method="POST">
        Username: <input type="text" name="username" /><br><br>
        Password: <input type="text" name="password" /><br><br>
        <button type="submit">Login</button>
    </form>

    <p><?php echo $msg; ?></p>
</body>
</html>
