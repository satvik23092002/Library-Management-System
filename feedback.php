<?php
include 'components/_dbconnect.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}
elseif(isset($_SESSION['admin_name'])){

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $Feedback = $_POST['msg'];
    $sender_name=$_SESSION['admin_name'];
    $email=$_SESSION['email'];
  $sql="INSERT INTO `feedback` ( `sender_name`, `sender_email`, `feedback`,`timestamp`) VALUES ( '$sender_name','$email', '$Feedback', current_timestamp());";
  $result=mysqli_query($conn,$sql);
  if($result){
    
    header("location:javascript://history.go(-1)");
    exit;
  
  }
  else{
      echo '<div class="alert alert-danger alert-dismissible fade show mt-0" role="alert">
      <strong>Sorry!</strong> Feedback didn\'t Added Successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
     }
  }
}
else{
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $Feedback = $_POST['msg'];
    $sender_name=$_SESSION['user_name'];
    $email=$_SESSION['email'];
  $sql="INSERT INTO `feedback` ( `sender_name`, `sender_email`, `feedback`,`timestamp`) VALUES ( '$sender_name','$email', '$Feedback', current_timestamp());";
  $result=mysqli_query($conn,$sql);
  if($result){
    
    header("location:javascript://history.go(-1)");
    exit;
  
  }
  else{
      echo '<div class="alert alert-danger alert-dismissible fade show mt-0" role="alert">
      <strong>Sorry!</strong> Feedback didn\'t Added Successfully.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>';
     }
  }
  
}
?>