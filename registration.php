<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $username = $_POST["Username"];
    $mobile = $_POST["Mobile"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["Password"], PASSWORD_BCRYPT); // Hash the password
    
    $db = new PDO("mysql:host=localhost;dbname=adoptionfinal", "root", "");

    $checkSql = "SELECT COUNT(*) FROM registration WHERE Email = ?";
    $checkStmt = $db->prepare($checkSql);
    $checkStmt->execute([$email]);
    $count = $checkStmt->fetchColumn();

    if ($count > 0) {
        echo "Error: This email is already registered. Please choose another.";
    } else {
        $sql = "INSERT INTO registration (Name, Username, Mobile, Email, Password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $username, $mobile, $email, $password]);
        header("Location: login.html");

        exit();
    }
}
?>
