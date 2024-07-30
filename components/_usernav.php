<?php
$user=$_SESSION['user_name'];
$sql="SELECT * FROM `userregistration` WHERE `user_name`='$user'";
$result = mysqli_query($conn, $sql);
$num= mysqli_num_rows($result);
if($num==1){
$row=mysqli_fetch_assoc($result);
$pic = $row['photo'];
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
     <a class="navbar-brand text-primary" onclick="openNav()">&#9776; BOOK VAULT</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="book.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Resourses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="book.php">Books</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="thesis.php">Thesis</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="newspaper.php">Newspaper</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            More
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Feaures</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Reviews</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Guide</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex my-0" role="search" method="get" action="search.php">
      <span class="my-0 py-0" style="font-size:30px;">&#128269;</span>
        <input class="form-control me-2 " name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
        <ul class="navbar-nav me-auto ml-5 mb-2 mb-lg-0">
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <img src="'.$pic.'" alt="profile" srcset=""> <small>'.$_SESSION['user_name'].'</small>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      </form>
    </div>
  </div>
</nav>';}
else{
  echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> There is Some Error in _navbar.php
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
?>