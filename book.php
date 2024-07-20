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
    <title>Book Vault</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        font-family: "Lato", sans-serif;
    }

    .nav-link img {
        width: 35px;
    }

    #Thesis .container {
        padding-left: 80px;
        /* margin-left:100px;? */
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        margin-bottom:100px;
        /* min-height:80vh; */
        margin:auto;
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
        margin-top: 90px;
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
    /* Set height of body and the document to 100% to enable "full page tabs" */
    #Thesis .heading {
        margin-top: 20px;
        text-align: center;
        color:white;
        background-color:red;
        opacity:50%;
        
    }

    body,
    html {
        height: 100%;
        margin: 0;
        font-family: Arial;
    }

    /* Style tab links */
    .tablink {
        background-color: #555;
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 4px 10px;
        font-size: 15px;
        width: 50%;
    }

    .tablink:hover {
        background-color: #777;
    }

    /* Style the tab content (and add height:100% for full page content) */
    .tabcontent {
        /* color: white; */
        display: none;
        padding: 100px 20px;
        padding-top: 100px;
        height: 100%;
    }

    #Thesis {
        background-color: white;
        background-image: url(liberary1.png);
        background-size:cover;
        background-repeat:no-repeat;
    }

    #AddThesis {
        background-color: white;
        background-image: url(libraryBG.jpg);
        background-size: cover;
        height: 100%;
    }

    #AddThesis .container {
        max-width: 46%;
        margin: auto;
        margin-top: 50px;
        /* margin-bottom:0px; */
        /* justify-content:center; */
        background-color: rgb(223, 218, 214);
        opacity: 90%;
        border-radius: 10px;
        padding: 15px 30px;
        margin-bottom:40px;

    }

    #AddThesis .container form {
        display: flex;
        flex-direction: column;
        margin: 20px 10px;
        opacity: 100%;
    }

    #AddThesis .container form input {
        padding-left: 10px;
    }

    #AddThesis .container form textarea {
        padding-left: 10px;
    }

    .add {
        background-color: green;
        color: black;
    }

    #reset {
        background-color: rgb(155, 235, 240);
        color: black;
    }

    .button {
        display: flex;
        justify-content: center;

    }

    #explore,
    #delete {
        margin: 5px 15px;
        /* padding:5px; */
    }

    #explore {
        background-color: rgb(128, 209, 113);
        border-radius: 10px;
    }

    #delete {
        background-color: rgb(214, 107, 107);
        border-radius: 10px;

    }

    #explore a,
    #delete a {
        text-decoration: none;
        color: black;
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

     #Thesis .footer {
        color: white;
        height: 50px;
        width: 98.9vw;
        background-color: black;
        text-align: center;
        padding: 10px;
        opacity: 0.9;
        margin-left:-20px;
    }
    #AddThesis .footer {
        color: white;
        height: 50px;
        width: 98.9vw;
        background-color: black;
        text-align: center;
        padding: 10px;
        opacity: 0.9;
        margin-left:-20px;
        /* margin-top:40px; */
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
    </style>
</head>

<body>
    <div class="box">

        <?php
    include 'components/_navbar.php';
    ?>
        <button class="tablink" onclick="openPage('Thesis', this, 'green')" id="defaultOpen">Available Thesis</button>
        <button class="tablink" onclick="openPage('AddThesis', this, 'orange')">Add Another Thesis</button>
    </div>

    <div id="Thesis" class="tabcontent">
       <button type="button"><a href="example.pdf" target="_blank">E-Book</a></button>
       <button type="button"><a href="example.pdf" >Book</a></button>
    </div>

    <div id="AddThesis" class="tabcontent">
       
    </div>
    
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img class="logo" src="logo.png" alt="Webiste Logo" srcset="">
        <a href="main.php">Thesis</a>
        <a href="book.php">Books</a>
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
    function openPage(pageName, elmnt, color) {
        // Hide all elements with class="tabcontent" by default */
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Remove the background color of all tablinks/buttons
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }

        // Show the specific tab content
        document.getElementById(pageName).style.display = "block";

        // Add the specific color to the button used to open the tab content
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
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