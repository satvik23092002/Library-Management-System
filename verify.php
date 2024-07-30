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
if($_SERVER['REQUEST_METHOD']=='GET'){
    $ongc_regno =$_GET['ongc'];
    $sql = "SELECT `otp` FROM `registration` WHERE `ongc_regno`='$ongc_regno'";
    $result = mysqli_query($conn, $sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $row=mysqli_fetch_assoc($result);
        $otp = $row['otp'];
}}

if($_SERVER['REQUEST_METHOD']=='POST'){
    $OTP=$_POST['OTP'];
    $otp=$_POST['otp'];
    echo $otp;
    echo $OTP;
    if($otp==$OTP){
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>congrats!</strong> your regitration completed successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
header("location: login.php");
       exit;
       
}
else{
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>sorry!</strong> otp did\'t match please register again.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $sql = "DELETE FROM `registration` WHERE `registration`.`otp` = '$otp'";
    $result = mysqli_query($conn, $sql);
    header("location: adminsignup.php");
       exit;
    
}
    }


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
  
    <div class="container">
        <form action="/projects/Library-management-System/verify.php" method="post">

            <label for="OTP">Enter OTP</label>
            <input type="number" name="OTP" id="OTP" placeholder="OTP" required>
            <input type="hidden" name="otp" value= <?php echo $otp ?>>
            <button type="submit">verify</button>
            <h3>Back To Login</h3>
            <h3><a href="/projects/Library-management-System/login.php">Login</a></h3>

        </form>
    </div>
</body>

</html>