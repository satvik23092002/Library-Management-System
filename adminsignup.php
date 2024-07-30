<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK VAULT-signup</title>

    <style>
    body {
        background-image: url(libraryBG.jpg);
        background-size: cover;
    }

    .container {
        display: flex;
        margin-top: 30px;
        display: block;
        opacity: 70%;
        max-width: 25vw;
        background-color: aliceblue;
        padding: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    h1 {
        text-align: center;
    }

    .container form {
        display: flex;
        flex-direction: column;
    }

    .container>form>input {
        max-width: 25vw;
        padding: 10px 0px;
        padding-left: 5px;
        margin: 10px 0px;
    }

    .container>form>button {
        max-width: 25vw;
        padding: 10px 0px;
        margin: 10px 0px;
    }

    .container>form>h3 {
        text-align: center;

    }
    </style>
    <style>
    body {
        background-color: rgba(32, 31, 31, 0.728);
    }

    .logo {
        font-size: 40px;
    }

    .nav {
        display: flex;
        justify-content: space-between;
        /* flex-direction: row; */
        color: white;
        margin: 0px 20px;
    }

    .nav ul li a {
        text-decoration: none;
        color: white;
    }

    .nav ul li {
        margin: 0px 20px;

    }

    .nav ul {
        list-style: none;
        font-size: 18px;
        display: flex;

    }

    .nav ul li a:hover {
        color: #c2a6a1;
    }

    .nav .login {
        border: 1px solid white;
        padding: 10px;
        border-radius: 10px;
        margin-top: -9px;
    }
    </style>
</head>

<body>
    <?php
include 'components/_dbconnect.php';
// $otp=rand(000000,999999);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $admin_name =$_POST['AdminName'];
    $ongc_regno = $_POST['registrationNo'];
    $email = $_POST['email'];
    $contact_no = $_POST['number'];
    $password =$_POST['password'];
    $confirmpassword = $_POST['cpassword'];
    $file = $_FILES['pic'];
    $filename=$file['name'];
    $filepath=$file['tmp_name'];
    $fileerror=$file['error'];
     
   $file_exp =explode('.',$filename);
   $file_ext= strtolower(end($file_exp));
   $valid_file_ext=array('png','jpg','jpeg'); 
    if($fileerror==0){
        if(in_array($file_ext,$valid_file_ext)){
        $dest_file = 'photo/'.$filename;
        move_uploaded_file($filepath,$dest_file);
        // $pattern = '/^[a-zA-Z0-9._%+-]+@ongc\.co\.in$/';
        // if (preg_match($pattern, $email)) {
            if($password==$confirmpassword){
    //             $to =$email;
    //             $subject="OTP Verification";
    //             $message="your BOOK VAULT OTP is:".$otp;
    //             $header="from:satvikagrawal200@gmailcom";
    //    $mail=mail($to,$subject,$message,$header);
        $mail=true;
       if($mail){
           $hashpassword = password_hash($password,PASSWORD_DEFAULT);
           $sql = "INSERT INTO `registration` (`ongc_regno`, `admin_name`, `email`, `password`, `contact_no`,`photo`,`otp`, `timestap`) VALUES ('$ongc_regno', '$admin_name', '$email', '$hashpassword', '$contact_no','$dest_file','$otp', current_timestamp())";
           $result = mysqli_query($conn, $sql);
           if($result){
               echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>congrats!</strong> your Registration no.'. $ongc_regno .' email '. $email .' And password '. $password .'has been submitted successfully.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
               header("location: login.php?ongc=".$ongc_regno);
               exit;
               
            }
            else{
                echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>sorry!</strong> the data  did not inserted successfully because of this error-->'. mysqli_error($conn).'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                
            }
            header("LOCATION:adminsignup.php?email=$email");
        }
        
    }
    else{
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Error!</strong> both password and confirm password should be same
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        
    }}
    else{
       ?>
       <script type="text/javascript">
        alert("Uploaded Photo Must be in the format of jpeg/jpg/png");
        </script>
       <?php
    }
}
else{
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Signup Button not pressed successfully Please Try Again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}


// else {
//         echo "Invalid email address. Please use the format example@ongc.co.in.";
//     }
    


?>
    <div class="nav">
        <div class="logo">BOOK VAULT</div>
        <div class="options">
            <ul>
                <li><a href="usersignup.php">User SignUp</a></li>
                <li><a href="adminsignup.php">Admin SignUp</a></li>
                <li class="login"><a href="login.php">Login</a></li>
            </ul>
        </div>
    </div>
    <!-- <h1>BOOK VAULT- SIGNUP</h1> -->
    <div class="container">
        <form action="/projects/Library-management-System/adminsignup.php" method="post" enctype="multipart/form-data" >
            <label for="AdminName">Admin Name</label>
            <input type="text" name="AdminName" id="AdminName" placeholder="Admin Name" required>

            <label for="registrationNo">Enter Reg. No.</label>
            <input type="text" name="registrationNo" id="registrationNo" placeholder="ONGC Registration No." required>

            <label for="email">Enter ONGC Email ID</label>
            <input type="email" name="email" id="email" placeholder="username@ongc.co.in" required>

            <label for="number">Enter Contact No.</label>
            <input type="number" name="number" id="number" placeholder="Contact No." required>

            <label for="password">Enter Pssword</label>
            <input type="password" name="password" id="password" placeholder="password" required>

            <label for="cpassword">Confirm Password</label>
            <input type="password" name="cpassword" id="cpassword" placeholder=" confirm password" required>

            <label for="photo">Upload Your photo</label>
            <input type="file" name="pic" id="pic" required>

            <button type="submit">Sign Up</button>
            <h3>Back To Login</h3>
            <h3><a href="/projects/Library-management-System/login.php">Login</a></h3>

        </form>
    </div>
   
</body>

</html>