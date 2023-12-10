<?php 
   session_start();
   $db = mysqli_connect("localhost", "root", "", "adoptionfinal");   
    $selectquery = "SELECT * FROM addpets WHERE adopted = 0 ORDER BY id DESC LIMIT 2";
    $results = $db->query($selectquery);
    //$rows = $result->fetch_all(MYSQLI_ASSOC);

    //var_dump($rows);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <style>
        /* Reset default margin and padding */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            background-image: url("pet paw.jpg"); /* Add your background image path */
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header styling */
        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        /* Navigation styling */
        nav {
            display: flex;
            justify-content: center;
            background-color: #555;
            padding: 0.5rem;
        }

        nav a {
            margin: 0 1rem;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        nav a:hover {
            color: #ffcc00;
        }

        /* Glassmorphic section styling for dashboard */
        .dashboard-section {
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
            color: #333;
            text-align: center;
        }

        /* Content section styling */
        .dashboard-content {
            display: flex;
            justify-content: space-around;
            margin: 2rem auto;
        }

        /* Individual box styling */
        .dashboard-box {
            flex: 1;
            margin: 1rem;
            padding: 1.5rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
            color: #333;
            text-align: center;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            pointer-events: none;
        }

        .dashboard-box:hover {
            transform: scale(1.02);
        }

        .dashboard-box:hover::before {
            opacity: 1;
        }

        /* Dropdown content styling */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* New styles for extended dashboard components */
        .pet-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            margin: 15px;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .pet-card img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .comment {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .image-gallery {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .image-gallery img {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-box h3 {
            color: #555;
        }

        .dashboard-box p {
            margin: 0 0 15px;
        }

        .dashboard-box ul {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-box li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease-in-out;
        }

        .dashboard-box li:hover {
            background-color: #f4f4f4;
        }

        .image-gallery {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .image-gallery img {
            max-width: 200px;
        }
    </style>
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get the dropdown and dropdown content
            var dropdown = document.querySelector('.dropdown');
            var dropdownContent = document.querySelector('.dropdown-content');
    
            // Add an event listener to the dropdown to prevent the default action
            // (which is navigating to the link) when the dropdown is displayed
            dropdown.addEventListener('click', function (event) {
                event.preventDefault();
            });
    
            // Add an event listener to the document to hide the dropdown when clicking outside of it
            document.addEventListener('click', function (event) {
                if (!event.target.matches('.dropdown') && !event.target.matches('.dropdown-content')) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script> -->
</head>
<body>

<!-- Header -->
<header>
    <h1>Pet Adoption</h1>
</header>

<!-- Navigation -->
<nav>
    <a href="index.html">Home</a>
    <a href="about.html">About</a>
    <a href="gallery.php">Gallery</a>
    <a href="addpet.html">Add Pet</a>
    <!-- <a href="#messages">Messages</a>
    <a href="#settings">Settings</a> -->
</nav>

<!-- Dashboard Components -->
<section class="dashboard-section" id="dashboard">
    <h2>Paws, Whiskers, Feathers - Find Your Perfect Companion Today!</h2>
</section>

<!-- About Section -->
<section class="dashboard-box" id="about-box" style="display: none;">
    <h3>About</h3>
    <!-- Content for About section -->
    <p>This is the about section. Add your content here.</p>
</section>

<!-- Featured Pets, Recent Comments, and Recent Images Sections -->
<section class="dashboard-content">


    <!-- <div class="dashboard-box">
        <h3>Recent Comments</h3>
         Content for Recent Comments -->
        <!-- <div class="comment">
            <p><strong>User123:</strong> "I love the work you're doing for these animals!"</p>
        </div>
        <div class="comment">
            <p><strong>PetLover22:</strong> "The recent adoption event was fantastic."</p>
        </div>
    </div> --> 
    <?php 
    $images = [];
    while ($row = $results->fetch_assoc()) { 
        $images[] = $row['imagePath'];
    }
    ?>
    
    <div class="dashboard-box" id="gallery">
        <h3>Recently added pets</h3>
        <!-- Content for Recent Images -->
        <div class="image-gallery">
            <img src="<?php echo $images[0];?>" alt="Happy Dog">
            <img src="<?php echo $images[1];?>" alt="Cute Bunny">
            <!-- <img src="/images/parrot.jpg" alt="Colorful Parrot"> -->
        </div>
    </div>
    <!-- Additional Section for Adoption Tips -->
    <div class="dashboard-box">
        <h3>Adoption Tips</h3>
        <p>Thinking about adopting a pet? Here are some tips to make the process smoother:</p>
        <ul>
            <li>Visit the shelter and spend time with different animals.</li>
            <li>Consider the pet's age, size, and energy level.</li>
            <li>Ensure your living space is pet-friendly.</li>
            <li>Be prepared for the responsibilities of pet ownership.</li>
        </ul>
    </div>
</section>

</body>
</html>
