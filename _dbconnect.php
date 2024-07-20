<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";
$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
die("sorry! connection not enstiblished" . mysqli_connect_error());
 }
// else{
//     echo "congrats!, connection created successfully <br>";
// }
?>