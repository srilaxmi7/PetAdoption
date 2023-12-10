<!-- Add the rest of your HTML code here -->
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body.login-page {
            background-image: url('dogimg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            color: #000000; 
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        </style>
</head>
<body></body>
</html>

<?php
// Start the session
session_start();
$db = mysqli_connect("localhost", "root", "", "adoptionfinal");

// Define the valid username and password (replace with your actual user data)
// $validUser = 'user@example.com';
// $validPassword = 'password123';

// Function to generate a simple CAPTCHA
 function generateCaptcha() {
     $_SESSION['captcha'] = rand(1000, 9999);
     return $_SESSION['captcha'];
 }


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $enteredUser = isset($_POST['Email']) ? $_POST['Email'] : '';
    $enteredPassword = isset($_POST['Password']) ? $_POST['Password'] : '';
    $enteredCaptcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
    // $password = password_hash($enteredPassword, PASSWORD_BCRYPT);
    $stmt = $db->prepare("SELECT * FROM registration WHERE Email = ?"); //as Email is set to UNIQUE
    // Bind the email as a parameter
    $stmt->bind_param("s",$enteredUser);
    // Execute the statement
    $stmt->execute();
    // Get the result set
    $rows = $stmt->get_result();
    // Fetch the data (assuming you want to retrieve user information)
    //$user = mysqli_fetch_assoc($result);
    $user = $rows->fetch_assoc();
    $storedPassword=$user['Password'];
    $storedEmail=$user['Email'];

    //echo password_hash("rayan", PASSWORD_BCRYPT);
    // Validate CAPTCHA
    if ($enteredCaptcha != $_SESSION['captcha']) {
        header('Location: login.html?error=captcha');
        exit();
    }

    ///Validate username and password (replace with database query)
    if (password_verify($enteredPassword, $user['Password'])) {
        // Successful login
        // You can set more session variables or redirect to the dashboard
        header('Location: dashboard.php?success=1');
        exit();
    } else {
        // Invalid username or password
        echo "<script>
        alert('wrong password');
        setTimeout(() => {
            window.location.href = 'login.html';
        }, 100);
    </script>";
    
        //header('Location: login.html?error=invalid');
        exit();
    }
}

// Generate a new CAPTCHA on initial load
   generateCaptcha();
?>

