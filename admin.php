<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "banking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['pass'] ?? '');

    if ($username === '' || $password === '') {
        die("Please enter both username and password.");
    }
    $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE Username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['passw'])) {

    
            session_regenerate_id(true);
             
            $_SESSION['username2'] = $username;

              echo "<script>
                alert('Login Success !');
                window.location='adminDashboard.php';
              </script>";
        exit();

        } else {
            echo "<script>alert('Incorrect Password')</script>";
        }

    } else {
        echo "<script>alert('User Name not found')</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .oki {
            text-align: center;
        }

        a {
            text-decoration: none;
            color: inherit;
             animation: fadeIn 0.8s ease-in-out;
        }

        p {
            text-align: center;
            color: rgba(255, 255, 255, 0.696);
             animation: fadeIn 0.8s ease-in-out;
        }


        .form {
            display: inline-block;
            background-color: rgba(35, 111, 123, 0.21);
            padding: 30px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.488);
            height: 46vh;
            margin-top: 19vh;
            margin-left: 551px;
            box-shadow: 0px 0px 3px rgba(255, 255, 255, 0.449);
             animation: fadeIn 0.8s ease-in-out;
        }

        .logo2 {
            width: 50px;
             animation: fadeIn 0.8s ease-in-out;
        }

        .logo {
            width: 250px;
             animation: fadeIn 0.8s ease-in-out;
        }

        body {
            background-color: rgba(255, 255, 255, 0.638);
        }

        .inp {
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 89%;
            outline: none;
            background-color: rgba(236, 223, 223, 0.441);
            cursor: pointer;
            color: rgba(31, 33, 33, 0.82);
             animation: fadeIn 0.8s ease-in-out;

        }

        .inp::placeholder {
            color: rgba(15, 12, 12, 0.516);
        }

        .inp:hover {
            background-color: rgb(255, 255, 255);
            transition: 0.5s;
            color: rgb(56, 53, 53);
            box-shadow: 0px 0px 5px white;
        }

        .button {
            padding: 15px;
            border: none;
            text-align: center;
            background-color: white;
            border-radius: 5px;
             animation: fadeIn 0.8s ease-in-out;
        }

        .button:hover {
            background-color: black;
        }

        .b {
            border: none;
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.566);
            color: rgba(240, 248, 255, 0.69);
            transition: 0.4s all;
            width: 100%;
             animation: fadeIn 0.8s ease-in-out;
        }


        .b:hover {
            transform: scale(1.03);
            background-color: rgb(223, 231, 12);
            color: black;
            box-shadow: 0px 0px 3px white;
        }

        .container {
            background-image: url(wp14798716-spirited-away-desktop-4k-wallpapers.webp);
            background-size: cover;
        }

        .align {
            vertical-align: middle;
            color: rgba(255, 255, 255, 0.696);

        }
          @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="container">
    <div class="form">
        <form method="POST">
            <img src="img2.png" class="logo2">
            <img src="img1.png" class="logo"><br><br><br>
            <input type="text" class="inp" placeholder="Admin Username" name="username" id="username" autocomplete="off"
                required><br><br><br>
            <input type="password" class="inp" placeholder="Password" name="pass" id="pass" required><br><br>
            <input type="checkbox" class="align" onclick="showpass()"><label class="align"> Show Password</label>
            <br><br><br>

            <button class="b" type="submit">Login</button>

            <br><br>
            <p>© Blue Moon Finance. All Rights Reserved 2026.</p>
        </form>
    </div>

    <script src="Login&Register.js"></script>
</body>

</html>
