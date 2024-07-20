<?php
include 'components/_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='GET'){
    $thesis_id =$_GET['thesis_id'];
    // echo $thesis_id;
    // exit();
    $sql="DELETE FROM `thesis` WHERE `thesis`.`thesis_id` = '$thesis_id'";
    $result=mysqli_query($conn,$sql);
    if($result){
       echo '<div class="alert alert-success alert-dismissible fade show mt-0" role="alert">
            <strong>Success!</strong> Thesis Hasbeen Deleted Successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
          header("Location:main.php");
          exit;
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show mt-0" role="alert">
        <strong>Sorry!</strong> Thesis didn\'t Deleted Successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      header("Location:main.php");
      exit;
    }
}

?>