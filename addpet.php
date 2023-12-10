<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $petName = $_POST["petName"];
    $petType = $_POST["petType"];
    $petDescription = $_POST["petDescription"];
    $donorName = $_POST["donorName"];
    $donorEmail = $_POST["donorEmail"];
    $donorPhone = $_POST["donorPhone"];

    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["petImage"]["name"]);

    if (move_uploaded_file($_FILES["petImage"]["tmp_name"], $targetFile)) {
        // File upload successful, insert data into the database
        $imagePath = $targetFile;

        // Perform database insertion (replace with your database connection code)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "adoptionfinal";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert data into the pets table
        $sql = "INSERT INTO addpets (petName, petType, petDescription, donorName, donorEmail, donorPhone, imagePath)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $petName, $petType, $petDescription, $donorName, $donorEmail, $donorPhone, $imagePath);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo "Pet added successfully!";
        header("Location: dashboard.php");
    } else {
        echo "Error uploading file.";
        echo("<a href='dashboard.php'>Back to dashboard</>");
        //header("Location: dashboard.php");
    }
}
?>

