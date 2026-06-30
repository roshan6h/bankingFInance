<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "banking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $branch=trim($_POST['branch'] ?? '');
    $password = trim($_POST['pass'] ?? '');

    if ($username === '' || $password === '') {
        die("Please enter both username and password.");
    }

  
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['Passw'])) {

          
            session_regenerate_id(true);
             
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['AccountNum'];
            $_SESSION['branch']=$branch;

            header("Location: sendOTP.html");
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

        .oki {
            text-align: center;
        }

        a {
            text-decoration: none;
            color: inherit;
        }


        .form {
            display: inline-block;
            background-color: rgba(240, 248, 255, 0.185);
            padding: 40px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.488);
            height: 57vh;
            margin-top: 15vh;
            margin-left: 551px;
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
            border: none;
            stroke-width: 0px;
            background: transparent;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.141);
            border-radius: 5px;
            cursor: pointer;
            transition: 0.4s all;
            width: 90%;
           color: rgba(255, 255, 255, 0.296);
            outline: none;
            animation: fadeIn 0.8s ease-in-out;

        }

        .inp::placeholder {
            color: rgba(255, 255, 255, 0.296);
        }


        .inp:hover {
            background-color: rgba(255, 255, 255, 0.475);
            transform: scale(1.03);
            box-shadow: 0px 0px 3px white;
            color:black;
        }

        .button {
            padding: 10px;
            border: none;
            text-align: center;
            background-color: white;
            border-radius: 10px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .button:hover {
            background-color: black;
        }

        .b {
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.456);
            color: rgba(240, 248, 255, 0.647);
            transition: 0.4s all;
            animation: fadeIn 0.8s ease-in-out;

        }

        .b:hover {
            transform: scale(1.03);
            background-color: aliceblue;
            color: black;
            box-shadow: 0px 0px 3px white;
        }

        .container {
            background-image: url(wp13577569-ghibli-night-wallpapers.png);
            background-size: cover;
        }

        .align {
            vertical-align: middle;
            color: rgba(255, 255, 255, 0.432);
            animation: fadeIn 0.8s ease-in-out;
        }

        .select-branch {
            border: none;
            background-color: rgba(255, 255, 255, 0.141);
            padding: 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.4s all;
            width: 100%;
            color: rgba(255, 255, 255, 0.296);
            outline: none;
            animation: fadeIn 0.8s ease-in-out;
        }

        .select-branch option {
            background-color: rgba(30, 30, 30, 0.95);
            color: white;
        }

        .select-branch:hover {
            background-color: rgba(255, 255, 255, 0.475);
            transform: scale(1.03);
            box-shadow: 0px 0px 3px white;
            
        }
    </style>
</head>

<body class="container">
    <div class="form">
        <form method="POST">
            <img src="img2.png" class="logo2">
            <img src="img1.png" class="logo"><br><br><br>
            <input type="text" class="inp" placeholder="Username" name="username" id="username" autocomplete="off"
                required><br><br><br>
            <input type="password" class="inp" placeholder="Password" name="pass" id="pass" required><br><br><br>
            <select class="select-branch" name="branch" required>
                <option value="" disabled selected>Select a Branch</option>
                <option value="Damauli">Damauli</option>
                <option value="Pokhara">Pokhara</option>
            </select><br><br>
            <input type="checkbox" class="align" onclick="showpass()"><label class="align"> Show Password</label>
            <br><br><br>


            <button class="b" type="submit">Login</button>

            <br><br>
            <p style="text-align: center;">Don't have an account? <a href="Register.php"><span
                        style="color:rgba(254, 252, 252, 0.455);"><b>Sign
                            up</b></span></a></p>
        </form>
    </div>

    <script src="Login&Register.js"></script>
</body>

</html>