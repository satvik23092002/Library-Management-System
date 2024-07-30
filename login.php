<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK VAULT-Login</title>

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
    display: inline;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #000;
}

.box h1 {
    font-size: 5rem;
    font-family: Arial, sans-serif;
    color: transparent;
    border: 2px solid #fff;
    position: relative;
    overflow: hidden;
}

.box h1::before {
    content: 'BOOK VAULT';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, #fff 50%, transparent 50%);
    background-size: 200% 100%;
    background-position: 0 0;
    animation: stroke 5s linear infinite alternate;
    -webkit-background-clip: text;
    color: transparent;
    -webkit-text-fill-color: transparent;
}

@keyframes stroke {
    0% {
        background-position: 0 0;
        -webkit-text-fill-color: transparent;
    }
    25% {
        background-position: 100% 0;
        -webkit-text-fill-color: #fff;
    }
    50% {
        background-position: 200% 0;
        -webkit-text-fill-color: transparent;
    }
    75% {
        background-position: 100% 0;
        -webkit-text-fill-color: #fff;
    }
    100% {
        background-position: 0 0;
        -webkit-text-fill-color: transparent;
    }
}

.box h1::after {
    content: 'BOOK VAULT';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: #fff;
    clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
    animation: reveal 5s linear infinite;
}

@keyframes reveal {
    0% {
        clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
    }
    25% {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }
    50% {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }
    75% {
        clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
    }
    100% {
        clip-path: polygon(0 0, 0 0, 0 100%, 0 100%);
    }
}
</style>
</head>

<body>
    <?php
$login=false;
$showError=false;
include 'components/_dbconnect.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `registration` WHERE `email`= '$email'";
    $result = mysqli_query($conn, $sql);
    $num= mysqli_num_rows($result);
    if($num==1){
       $row=mysqli_fetch_assoc($result);
       if(password_verify($password,$row['password'])){
               $Adminname=$row['admin_name'];
               $login= true;
               session_start();
               $_SESSION['loggedin']=true;
               $_SESSION['admin_name']=$Adminname;
               $_SESSION['email']=$email;
               header("location: book.php");
            }
            else{
                echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>congrats!</strong>Invalid Credentials
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
    } 
    else{  
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>sorry!</strong>Invalid Credentials
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
        
    }
    

}

?>
     <div class="box">
        <h1>BOOK VAULT</h1>
    </div>
    <div class="container">
        <form action="/projects/Library-management-System/login.php" method="post">
            <label for="email">Enter ONGC Email ID</label>
            <input type="email" name="email" id="email" placeholder="username@ongc.co.in" required>

            <label for="password">Enter Pssword</label>
            <input type="text" name="password" id="password" placeholder="password" required>

            <button type="submit">LOG IN</button>
            <h3>New User?</h3>
            <h3><a href="/projects/Library-management-System/adminsignup.php">Sign Up</a></h3>

        </form>
    </div>

</body>

</html>