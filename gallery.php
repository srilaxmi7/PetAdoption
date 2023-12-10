<?php 
   session_start();
   $db = mysqli_connect("localhost", "root", "", "adoptionfinal");   
    $selectquery = "SELECT * FROM addpets WHERE adopted = 0";
    $results = $db->query($selectquery);
    //$rows = $result->fetch_all(MYSQLI_ASSOC);

    //var_dump($rows);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Gallery</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery-item {
            max-width: 300px;
            margin: 10px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            margin: 0 auto;
        }

        .image-description {
            text-align: center;
            padding: 10px;
        }

        .pet-details {
            margin-top: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .person-details {
            margin-top: 5px;
            font-size: 14px;
        }

        .adopt-button {
            display: block;
            margin: 10px auto 0;
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        .adopt-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Adoption Gallery</h1>

<div class="gallery">
    <!-- <div class="gallery-item">
        <img src="https://placekitten.com/300/200" alt="Image 1">
        <div class="image-description">
            <p>Pet Name: Fluffy</p>
            <p>Description: Cute kitten with fluffy fur.</p>
            <div class="person-details">
                <p>Owner: John Doe</p>
                <p>Email: john.doe@example.com</p>
                <p>Contact: +1 123-456-7890</p>
            </div>
            <a href="#" class="adopt-button">Adopt</a>
        </div>
    </div> -->
    <?php 

    while ($row = $results->fetch_assoc()) { ?>
       <div class="gallery-item">
        <img src="<?php echo $row['imagePath'];?>" alt="Image 1">
        <div class="image-description">
            <p>Pet Name: <?php echo $row['petName'];?></p>
            <p>Description: <?php echo $row['petDescription'];?></p>
            <div class="person-details">
                <p>Owner: <?php echo $row['donorName'];?></p>
                <p>Email: <?php echo $row['donorEmail'];?></p>
                <p>Contact: <?php $row['donorPhone'];?></p>
            </div>
            <a href="adopt.php?id=<?php echo $row['id'];?>" class="adopt-button">Adopt</a>
        </div>
    </div> 

   <?php } ?>

</div>
</body>
</html>
