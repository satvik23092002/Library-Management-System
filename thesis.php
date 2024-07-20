<?php
include 'components/_dbconnect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .nav-link img {
        width: 35px;
    }
    </style>
    <style>
    body {
        font-family: "Lato", sans-serif;

    }

    .nav-link img {
        width: 35px;
    }

    .logo {
        height: 318px;
        /* background-color:rgb(205, 167, 140); */
        border-radius: 50%;
        margin-left: -151px;
        margin-top: -60px;
        margin-bottom: -35px;
        /* margin-right:200px; */
        /* weight:40px; */
    }

    .sidenav {
        margin-top: 56px;
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #111;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
    }

    .sidenav a {
        padding: 1px 0px 10px 72px;
        text-decoration: none;
        font-size: 25px;
        color: #818181;
        display: block;
        transition: 0.3s;
    }

    .sidenav a:hover {
        color: #f1f1f1;
    }

    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
        margin-left: 50px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {
            margin-top: 50px;
            padding-top: 15px;
        }

        .sidenav a {
            font-size: 18px;
        }
    }
    </style>

    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;

    }

    * {
        box-sizing: border-box;
    }

    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 150px;
        z-index:2;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 10px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
    }

    /* Full-width textarea */
    .form-container textarea {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
    }

    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/send button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
    }

    body {
        background-image: url(libraryBG.jpg);
        background-size: cover;
        margin-top:70px;
    }
    .container{
        background-color:white;
        min-height:800px;
        opacity:50%;
        padding:20px;
        padding-bottom:100px;
    }
    .card-img-top{
        height:150px;
    }
    .thesis{
        background-color:red;
        margin:auto;
        padding-top:50px;
        padding-left:20px;
        height:30vh;
        width:60vw;
        opacity:1;
        color:white;
        padding-bottom:20px;

    }
    .desc{
        background-color:red;
        margin:auto;
        padding-top:50px;
        padding-left:20px;
        min-height:600px;
        width:60vw;
        opacity:1;
        color:white;
        font-size:30px;
    }
    .navbar{
        position:fixed;
        top:0px;
        left:0px;
        width:100%;
        opacity:0.9;
        z-index:2;
    }
    .footer{
      color:white;
      height:50px;
      width:100vw;
      background-color:black;
      text-align:center;
      padding:10px;
      opacity:0.9;
    }
    .footer:hover {
        opacity: 1;
    }
    </style>
</head>

<body>

    <?php
   include 'components/_navbar.php';
   ?>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img class="logo" src="logo.png" alt="Webiste Logo" srcset="">
        <a href="main.php">Thesis</a>
        <a href="book.php">Books</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>
    <div class="container">
          <?php
          if($_SERVER['REQUEST_METHOD']=='GET'){
            $thesis_id=$_GET['thesis_id'];
            $sql="SELECT * FROM `thesis` WHERE `thesis_id`='$thesis_id'";
            $result=mysqli_query($conn,$sql);
            $num=mysqli_num_rows($result);
            if($num==1){
                $row=mysqli_fetch_assoc($result);
                $thesis_title=$row['thesis_name'];
                $thesis_author_name=$row['thesis_author_name'];
                $desc=$row['thesis_desc'];

                echo '<div class="thesis">
                     <h1><b>'. $thesis_title.'</b></h1>
                      <br>
                      <h4>by-'.$thesis_author_name.' </h4>
                        </div>; <br>
                    <div class="desc">
                     '.$desc.'</div>';
            }
          }
          ?>
            </div>
    <button class="open-button" onclick="openForm()">Feedback..</button>

    <div class="chat-popup" id="myForm">
        <form action="/action_page.php" class="form-container">
            <h2>Feedback Form</h2>

            <label for="msg"><b> Message</b></label>
            <textarea placeholder="Type Feedback.." name="msg" required></textarea>

            <button type="submit" class="btn" onclick="closeForm(); showalert();">Send</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>
    <div class="footer">
       <h5>copyright &#169; 2024 All Rights Reserved  </h5>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
    </script>
    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    function showalert(){
        alert("ThankYou For Your Valuable Feedback");
    }
    </script>


</body>

</html>