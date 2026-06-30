<?php
session_start();

$conn = mysqli_connect("localhost","root","","banking");

if (!$conn) {
    die("connection error !!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $num = "1000778";
    $rand = rand(0, 999);
    $accnum = $num . $rand;

    $dob = $_POST['dob'];
    $branch=$_POST['branch'];
    $gender = $_POST['gender'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query2 = "SELECT COUNT(*) FROM users WHERE Username='$username'";
    $haha = mysqli_query($conn, $query2);
    $row = mysqli_fetch_row($haha);
    $count = $row[0];

    if ($count > 0) {
        echo "<script>alert('Username already taken!');</script>";
    } else {

        $query = "INSERT INTO users
        (Fullname, Username, Email, Passw, DOB, Gender, AccountNum)
        VALUES
        ('$fullname','$username','$email','$pass','$dob','$gender','$accnum')";

        $exe = mysqli_query($conn, $query);

        if ($exe) {
            $_SESSION['username'] = $username;
            $_SESSION['branch']=$branch;
            header("Location: dashboard.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
        a {
            text-decoration: none;
            color: inherit;
        }

        body {
            background-color: rgba(21, 3, 45, 0.871);
        }

        .container {
            background-image: url(wp13577569-ghibli-night-wallpapers.png);
            background-size: cover;
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .form {
            margin-top:50px;
            background-color: rgba(240, 248, 255, 0.185);
            padding: 30px;
            border-radius: 20px;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
            width: 320px;
               animation: fadeIn 0.8s ease-in-out;

        }

        .logo2 {
            width: 50px;
               animation: fadeIn 0.8s ease-in-out;
        }

        .logo {
            width: 200px;
               animation: fadeIn 0.8s ease-in-out;
        }

        .inp {
            border: none;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.141);
            border-radius: 5px;
            width: 90%;
            color: rgba(255, 255, 255, 0.566);
            outline: none;
            transition: 0.4s;
            cursor: pointer;
            animation: fadeIn 0.8s ease-in-out;
        }

        .inp::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .inp:hover {
            background-color: rgba(255, 255, 255, 0.475);
            box-shadow: 0px 0px 3px white;
        }

        .inp1 {
            border: none;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.141);
            border-radius: 5px;
            width: 90%;
            color: rgba(255, 255, 255, 0.566);
            outline: none;
            transition: 0.4s;
            cursor: pointer;
               animation: fadeIn 0.8s ease-in-out;
        }

        .inp1::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .inp1:hover {
            background-color: rgba(255, 255, 255, 0.475);

            box-shadow: 0px 0px 3px white;
        }

        .b {
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            background-color: rgba(0, 0, 0, 0.456);
            color: rgba(240, 248, 255, 0.599);
            transition: 0.4s;
               animation: fadeIn 0.8s ease-in-out;
        }

        .b:hover {
            transform: scale(1.03);
            background-color: aliceblue;
            color: black;
            box-shadow: 0px 0px 3px white;
        }

        p {
            text-align: center;
        }

        .align {
            vertical-align: middle;
            color: rgba(255, 255, 255, 0.653);
               animation: fadeIn 0.8s ease-in-out;

        }

        .align1 {
            vertical-align: middle;
            color: rgba(255, 255, 255, 0.571);

        }

        input[type="date"] {
            color: rgba(255, 255, 255, 0.5);
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
        <form method="POST" onsubmit="return validateForm()">
            <div style="text-align: center;">
                <img src="img2.png" class="logo2">
                <img src="img1.png" class="logo"><br><br>
            </div>
            <input type="text" class="inp" name="fullname" id="fullname" placeholder="Full Name" required><br><br>

            <input type="text" class="inp" name="username" id="username" placeholder="Username" required><br><br>

            <input type="email" class="inp" name="email" id="email" placeholder="Email" required><br><br>
              <select class="select-branch" name="branch" required>
                <option value="" disabled selected>Select a Branch</option>
                <option value="Damauli">Damauli</option>
                <option value="Pokhara">Pokhara</option>
            </select><br><br>

            <input class="inp1" type="date" name="dob" id="dob">
            <br><br>

            <input class="align1" type="radio" name="gender" id="gender" value="Male"> <label
                class="align1">Male</label>
            <input class="align1" type="radio" name="gender" id="gender" value="Female"> <label
                class="align1">Female</label>
            <input class="align1" type="radio" name="gender" id="gender" value="Other"> <label
                class="align1">Other</label>
            <br><br>
            <input type="password" class="inp" name="password" id="pass" placeholder="Password" required><br><br>

            <input type="password" class="inp" name="confirm_password" id="cpass" placeholder="Confirm Password"
                required><br><br>


            <input type="checkbox" class="align" onclick="showpass()"> <label class="align">Show Password</label>

            <br><br>
            <button class="b" type="submit">Create Account</button>

            <br><br>
            <p>Already have an account?
                <a href="Login.php">
                    <span style="color:rgba(254, 252, 252, 0.7);"><b>Login</b></span>
                </a>
            </p>

        </form>
    </div>

    <script>

        function showpass() {
            let pass = document.getElementById("pass");
            let cpass = document.getElementById("cpass");

            if (pass.type === "password") {
                pass.type = "text";
                cpass.type = "text";
            } else {
                pass.type = "password";
                cpass.type = "password";
            }
        }

        function validateForm() {
            let pass = document.getElementById("pass").value;
            let cpass = document.getElementById("cpass").value;

            if (pass !== cpass) {
                alert("Passwords do not match!");
                return false;
            }
            if (pass.length < 6) {
                alert("Password must be at least 6 characters!");
                return false;
            }
            const fullname = document.getElementById('fullname').value.trim();
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const dob = document.getElementById('dob').value;
            const gender = document.getElementById('gender').value;


            if (!fullname || !username || !email || !pass || !dob || !gender || !cpass) {
                alert('All fields are required.');
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }


            const birthDate = new Date(dob);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 18) {
                alert('Sorry, you must be at least 18 years old.');
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
