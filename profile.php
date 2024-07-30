<?php
include 'components/_dbconnect.php';
session_start();

// Check if user is logged in
if (isset($_SESSION['user_name'])&& isset($_SESSION['loggedin'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM `userregistration` WHERE `email`= '$email'";
    $result = mysqli_query($conn, $sql);
    $num= mysqli_num_rows($result);
    if($num==1){
       $row=mysqli_fetch_assoc($result);
       $pic=$row['photo'];
        $regno=$row['regno'];   
        $name=$row['user_name'];     
        $contact_no=$row['contact_no'];        
        $datetime=$row['timestamp'];        
    }
}
else if (isset($_SESSION['admin_name'])&& isset($_SESSION['loggedin'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM `registration` WHERE `email`= '$email'";
    $result = mysqli_query($conn, $sql);
    $num= mysqli_num_rows($result);
    if($num==1){
       $row=mysqli_fetch_assoc($result);
       $pic=$row['photo'];
        $regno=$row['ongc_regno'];   
        $name=$row['admin_name'];     
        $contact_no=$row['contact_no'];        
        $datetime=$row['timestap'];        
    }
}
else {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Vault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        font-family: "Lato", sans-serif;
    }
    
    .nav-link img {    
    width: 25px;

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
        margin-top: 67px;
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

    .card {
        background-color: rgb(238, 213, 168);
        margin: 30px;
        padding: 5px;
        /* Add shadows to create the "card" effect */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        height: 200px;
        width: 230px;
    }
    
    /* On mouse-over, add a deeper shadow */
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }
    
    /* Add some padding inside the card container */
    .detail {
        padding: 10px 16px;
        font-size: 12px;
        
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
            background-image: url(liberary2.png);
        background-size: cover;
            min-height:100vh;
            display:flex;
            flex-direction:column;
    }


    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        padding-right:93px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 15px;
        width: 100px;
        z-index: 2;
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

    .box {
        position: fixed;
        width: 100%;
        z-index: 3;
    }

    .footer:hover {
        opacity: 1;
    }
    .arrow a img{
        height:35px;
        align-items:center;
        padding-top:10px;
        padding-left:10px;
    }
    .arrow{
        height:50px;
        width:50px;
        background-color:orange;
        border-radius:10px;
        position:fixed;
        bottom:20px;
        left:20px;
    }
    h1{
        text-align:center;
        margin-top:60px;
    }
    .footer {
        color: white;
        height: 50px;
        width: 100vw;
        background-color: black;
        text-align: center;
        padding: 10px;
        opacity: 0.9;
    }
    .container{
        padding-left: 80px;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        min-height:82.5vh;
        margin-top:120px;
    }
    </style>
    <style>
        .profile{
            height:700px;
            width:1150px;
            background-color:skyblue;
            margin-bottom:40px;

        }
        .profile h1{
            text-align:center;
            font-size:80px;
            margin-top:5px;
            background-color:rgb(165, 226, 165);
        }
        .profile input{
            margin-left:500px;
        }
        .name{
            text-align:center;
        }
        .info{
            padding:15px 20px;
            height:300px;
            width:1100px;
            background-color:rgb(178, 204, 214);
            margin:auto;
            margin-top:20px;
        }
        .info div{
            display:flex;
            flex-direction:row;
            gap:200px;
            border-radius:5px solid black;
        }
        .info .left{
            width:200px;
        }
        .info .right{
            width:500px;
        }
        .information{
            margin:15px 10px;
           background-color:rgb(228, 228, 124);
           padding:10px 30px;
           
            margin-left:20px;
        }
        .information span{
            margin-right:300px;
            padding-left:30px;
        }
        .profile .info button a{
            text-decoration:none;
            color:black;
        }
        .profile .info button {
            margin-left:470px;
            margin-top:-5px;
            background-color:green;
        }
        .left{
            border-radius:5px solid red;
        }
    </style>
    
</head>

<body>
    <div class="box">
     <?php
    include 'components/_navbar.php';
    ?>
       </div>
       
       <div class="container">
        <div class="profile">
            <h1>Profile</h1>
            <input type="image" src="<?php echo"$pic" ?>" alt="User Profile Photo" height="200px">
            <div class="name"><h2>Welcome <b><?php echo "$name";?></b></h2></div>
            <div class="info">
                <div class="ongc_regno information">
                    <b><div class="left">Reg No.</div></b><div class="right">-<?php echo "$regno"; ?></div></div>
                <div class="email information">
                    <b><div class="left">Email Id</div></b><div class="right">-<?php echo "$email"; ?></div></div>
                <div class="contact information">
                    <b><div class="left">Contact No.</div></b><div class="right">-<?php echo "$contact_no"; ?></div></div>
                <div class="datetime information">
                    <b><div class="left">Created At</div></b><div class="right">-<?php echo "$datetime"; ?></div></div>
                    <button type="button" class="button"><a href="edit_profile.php">Edit Profile</a></button>
            </div>
        </div>
           
        </div>
            <footer>
            <div class="footer">
                <h5>copyright &#169; 2024 All Rights Reserved </h5>
            </div>
            </footer>
    
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img class="logo" src="logo.png" alt="Webiste Logo" srcset="">
        <a href="book.php">BOOKS</a>
        <a href="main.php">Thesis</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>

    <button class="open-button" onclick="openForm()">Feedback..</button>
    
    <div class="chat-popup" id="myForm">
        <form action="feedback.php" method="post" class="form-container">
            <h2>Feedback Form</h2>
            
            <label for="msg"><b> Message</b></label>
            <textarea placeholder="Type Feedback.." name="msg" required></textarea>
            
            <button type="submit" class="btn" onclick="closeForm(); showalert();">Send</button>
            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
    </div>


    <div class="arrow">
    <a href="#"><img src="uparrow.png" alt="go to top" ></a>
    </div>
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
    </script>

    <script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
    function showalert(){
        alert("ThankYou For Your Valuable Feedback");
    }
    </script>
</body>

</html>