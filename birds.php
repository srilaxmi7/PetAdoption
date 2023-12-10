<!-- birds.php -->
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

// Fetch parrot data from the database
$sql = "SELECT * FROM birds";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birds for Adoption</title>
   <!-- Add this style section in parrots.php -->
<!-- Add this style section in parrots.php -->
<!-- Add this style section in parrots.php -->
<!-- Add this style section in parrots.php -->
<style>
    body {
        font-family: Arial, sans-serif;
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
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 2rem;
    }

    .pet {
        text-align: center;
        border: 1px solid #ddd;
        padding: 1rem;
        margin: 1rem;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 200px; /* Set a fixed width for consistency */
    }

    .pet img {
        max-width: 100%;
        height: auto;
        margin-bottom: 1rem; /* Add margin for spacing between image and text */
        border-radius: 5px; /* Add border-radius to images */
    }

    h2, h3 {
        color: #333;
    }

    p {
        color: #666;
    }
</style>

</head>
<body>
    <header>
        <h1>Birds for Adoption</h1>
    </header>

    <main>
        <?php
        // Loop through the fetched data and output HTML structure for each parrot
        while ($row = $result->fetch_assoc()) {
            echo "<div class='pet'>";
            echo "<img src='{$row['image_path']}' alt='{$row['name']}'>";
            echo "<h2>{$row['name']}</h2>";
            echo "<h3>{$row['species']}</h3>";
            echo "<p>{$row['description']}</p>";
            echo "</div>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </main>
</body>
</html>
