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
        width: 25px;
        height:30px;
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
        text-decoration:none;
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
    
    #Books {
        background-color: white;
        /* background-image: url(liberary1.png); */
        /* background-size:cover;
        background-repeat:no-repeat; */
    }

    #AddBooks {
        background-color: white;
        /* background-image: url(libraryBG.jpg); */
        background-size: cover;
        height: 100%;
        min-height:100vh;
    }

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
        z-index: 10;
    }

     .footer {
        color: white;
        height: 50px;
        width: 98.8vw;
        background-color: black;
        text-align: center;
        padding: 10px;
        opacity: 0.9;
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
        z-index:2;
        bottom:20px;
        left:20px;
    }
    .carousel-item img{
        height:400px;
        object-fit:cover;
        object-position:center center;

    }
    .carousel-item2 img{
        height:400px;
        object-fit:cover;
        object-position:center top;

    }
    .carousel-item7 img{
        height:400px;
        object-fit:cover;
        object-position:right top;

    }
    </style>
<link  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet"/>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  display: grid;
}

.container {
  width: 100%;
  display: flex;
  justify-content: center;
  height: 200px;
  gap: 20px;

  > div {
    flex: 0 0 120px;
    border-radius: 0.5rem;
    transition: 0.5s ease-in-out;
    cursor: pointer;
    box-shadow: 1px 5px 15px #1e0e3e;
    position: relative;
    overflow: hidden;

    .content {
      font-size: 1.5rem;
      color: #fff;
      display: flex;
      align-items: center;
      padding: 15px;
      opacity: 0;
      flex-direction: column;
      height: 100%;
      justify-content: flex-end;
      background: rgb(2, 2, 46);
      background: linear-gradient(
        0deg,
        rgba(2, 2, 46, 0.6755077030812324) 0%,
        rgba(255, 255, 255, 0) 100%
      );
      transform: translatey(100%);
      transition: opacity 0.5s ease-in-out, transform 0.5s 0.2s;
      visibility: hidden;

      span {
        display: block;
        margin-top: 5px;
        font-size: 1.2rem;
      }
    }

    &:hover {
      flex: 0 0 250px;
      box-shadow: 1px 3px 15px #7645d8;
      /* transform: translatey(-30px); */
    }

    &:hover .content {
      opacity: 1;
      transform: translatey(0%);
      visibility: visible;
    }
  }
}
</style>
<style>
   
    #Books h3{
        margin:30px 0px;
    }
    /* #Books button{
        background-color:blue;
        padding:10px;
        font-size:20px;
        color:white;
        border-radius:10px;
        margin-top:50px;
        margin-bottom:0px;
    } */
    #Books button{
      background-color: #04AA6D; /* Green */
  border: none;
  padding: 15px 32px;
  text-align: center;
  /* text-decoration: none;
  display: inline-block; */
  font-size: 16px;
  margin: 4px 2px;
  margin-top:50px;
  cursor: pointer;
  /* -webkit-transition-duration: 0.4s; 
  transition-duration: 0.4s; */
    }
    #Books button a{
      text-decoration:none;
      color: white;
    }

    #Books button:hover{
      background-color:  rgb(152, 152, 235);
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
    }
    #Books{
        padding-bottom:30px;
        box-shadow: 10px;
    }
</style>

</head>

<body>
    <div class="box">

        <?php
    include 'components/_navbar.php';
    ?>
        <button class="tablink" onclick="openPage('Books', this, 'green')" id="defaultOpen">Books</button>
        <button class="tablink" onclick="openPage('AddBooks', this, 'orange')">Add Books</button>
    </div>

    <div id="Books" class="tabcontent">
    <div class="wrapper">
  <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-slider" data-slide-to="1"></li>
        <li data-target="#carousel-slider" data-slide-to="3"></li>
        <li data-target="#carousel-slider" data-slide-to="4"></li>
        <li data-target="#carousel-slider" data-slide-to="5"></li>
        <li data-target="#carousel-slider" data-slide-to="6"></li>
        <li data-target="#carousel-slider" data-slide-to="7"></li>
      </ol>
      <!--Indicators-->
      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <!--First slide-->
        <div class="carousel-item active carousel-item1 ">
          <img class="d-block w-100" src="photo/bookimg12.jpg" alt="First slide">
        </div>
      
        <div class="carousel-item carousel-item2">
          <img class="d-block w-100" src="photo/bookimg1.jpg" alt="Second slide">
        </div>
        <div class="carousel-item carousel-item3">
          <img class="d-block w-100" src="photo/bookimg3.jpg" alt="Third slide">
        </div>
        <div class="carousel-item carousel-item4">
          <img class="d-block w-100" src="photo/bookimg7.jpg" alt="Forth slide">
        </div>
        <div class="carousel-item carousel-item5">
          <img class="d-block w-100" src="photo/bookimg2.jpg" alt=" Fifth slide">
        </div>
        <div class="carousel-item carousel-item6">
          <img class="d-block w-100" src="photo/bookimg6.jpg" alt="Sixth slide">
        </div>
        <div class="carousel-item carousel-item7">
          <img class="d-block w-100" src="photo/bookimg8.jpg" alt="Seventh slide">
        </div>
       
      </div>
    </div>
</div>


<!-- card crousel  -->
<h3>Books Recommended for You</h3>
<div class="container">
<?php
    $sql="SELECT * FROM `book` ORDER BY `ratings` DESC LIMIT 10";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    $no=0;
    if($num>0){
    while($row=mysqli_fetch_assoc($result)){
      $pic = $row['book_image'];
      $author_name = $row['author_name'];
      $book = $row['book_name'];
      $rating = $row['ratings'];
     echo
        '<div style="background-image: url(photo/'.$pic.'); background-repeat: no-repeat; background-size:cover;">
            <div class="content">
              <h4>'.$book.'</h4>
              <span>'.$author_name.'</span>
              <span>'.$rating.'</span>
              </div>
            </div>';

}}
?>
</div>
<br>

<h3>Books Recently Readed</h3>
<div class="container">
<?php
    $sql="SELECT * FROM `book` LIMIT 10";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    $no=0;
    if($num>0){
    while($row=mysqli_fetch_assoc($result)){
      $pic = $row['book_image'];
      $author_name = $row['author_name'];
      $book = $row['book_name'];
      $rating = $row['ratings'];
     echo
        '<div style="background-image: url(photo/'.$pic.'); background-repeat: no-repeat; background-size:cover;">
            <div class="content">
              <h4>'.$book.'</h4>
              <span>'.$author_name.'</span>
              <span>'.$rating.'</span>
              </div>
            </div>';

}}
?>
</div>
<center>
      <button type="button"><a href="morebooks.php" >Explore More</a></button>
     </div>
    </center>

    <div id="AddBooks" class="tabcontent">
       
    </div>
    
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <img class="logo" src="logo.png" alt="Webiste Logo" srcset="">
        <a href="book.php">Books</a>
        <a href="main.php">Thesis</a>
        <a href="book.php">Newspapers</a>
        <a href="#">Services</a>
        <a href="users.php">Users</a>
        <a href="showFeedback.php">Feedbacks</a>
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
    <footer>
            <div class="footer">
                <h5>copyright &#169; 2024 All Rights Reserved </h5>
            </div>
            </footer>
    
    
    
    
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
    const refreshBtn = document.getElementById("btnRefresh");

    function handleClick() {
    window.location.reload();
    }


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</body>

</html>