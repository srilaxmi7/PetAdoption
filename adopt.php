<?php
  session_start();
  $db = mysqli_connect("localhost", "root", "", "adoptionfinal");   
$id = $_GET['id'];

$updatequery = "UPDATE addpets SET adopted = 1 WHERE id = $id";
if($db->query($updatequery)) {
    echo "Adopted succesfuly";
} else {
    echo "Failed to adopt";
}



?>