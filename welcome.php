<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOK VAULT</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .container {
            text-align: center;
        }

        .logo {
            width: auto;
            height: auto;
            transition: opacity 5s ease;
            opacity: 0;
        }

        .fade-in {
            opacity: 1;
        }
    </style>
</head>
<body>
    <?php
    echo '<div class="container">
        <img src="logo.png" alt="Library Logo" class="logo" id="logo">
    </div>';
    
    ?>
    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            const logo = document.getElementById("logo");
            logo.classList.add("fade-in");

            setTimeout(function() {
                window.location.href = "login.php"; 
            }, 5000);
        });
    </script>
</body>
</html>
