<!-- cats.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adoptionfinal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cat data from the database
$sql = "SELECT * FROM cats";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cats for Adoption</title>
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
        }

        main {
            padding: 2rem;
            max-width: 800px; /* Set your desired maximum width */
            margin: 0 auto; /* Center the container */
        }

        .pet {
            border: 1px solid #ddd;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center the content */
        }

        .pet img {
            max-width: 100%; /* Ensure the image takes 100% of the container width */
            height: auto; /* Maintain the aspect ratio */
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        p {
            color: #666;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cats for Adoption</h1>
    </header>

    <main>
        <?php
        // Loop through the fetched data and output HTML structure for each cat
        while ($row = $result->fetch_assoc()) {
            echo "<div class='pet'>";
            echo "<img src='{$row['image_path']}' alt='{$row['name']}'>";
            echo "<h2>{$row['name']}</h2>";
            echo "<p>{$row['description']}</p>";
            echo "</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>
</body>
</html>
