<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "banking");

if(!isset($_SESSION['username'])){
    die("User not logged in");
}

$username = $_SESSION['username'];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $amount = $_POST['amount'];

    if($amount <= 0){
        echo "<script>alert('Enter a valid amount!')</script>";
    } else {


        $sql = "SELECT balance,AccountNum FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if(!$row){
            die("User not found");
        }

        $current_balance = $row['balance'];
        $accountNum=$row['AccountNum'];

       
        if($amount > $current_balance){
            echo "<script>alert('Insufficient Balance!')</script>";
        } else {

            $new_balance = $current_balance - $amount;

            $update = "UPDATE users 
                       SET balance='$new_balance'
                       WHERE username='$username'";

            mysqli_query($conn, $update);
            date_default_timezone_set('Asia/Kathmandu');   
            $date = date("Y-m-d H:i:s");

            $transaction = "INSERT INTO transactions(transaction_type, transaction_date, t_amount, username,Sender_acc,Receiver_acc) VALUES('Withdrawal', '$date', '$amount', '$username','$accountNum','$accountNum')";

            if(mysqli_query($conn, $transaction)){
               echo "<script>alert('Withdraw Successful')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back" />
</head>
<style>
    span {
        display: inline-block;
        background-color: transparent;
        color: white;
        margin-top: 250px;
        margin-left: 10px;
        color: rgba(230, 222, 222, 0.807);
        cursor: pointer;
        transition: 0.3s;
        border-radius: 5px;
         animation: fadeIn 0.8s ease-in-out;
    }

    span:hover {
        transform: scale(1.03);
        padding: 5px;
        background-color: white;
        color: black;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }

    .roshan {
        background-color: rgba(12, 12, 12, 0.271);
        display: inline-block;
        padding: 40px;
        border-radius: 15px;
        margin-top: 23vh;
        margin-left: 600px;
        box-shadow: 0px 0px 3px rgba(223, 224, 231, 0.208);
         animation: fadeIn 0.8s ease-in-out;
    }

    .butt {
        border: none;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.43);
        color: rgba(255, 255, 255, 0.334);
        transition: 0.5s all;
        cursor: pointer;
         animation: fadeIn 0.8s ease-in-out;
    }

    .butt:hover {
        background-color: rgb(247, 247, 247);
        color: rgb(25, 22, 22);
        transform: scale(1.03);
        box-shadow: 0px 0px 3px rgba(255, 255, 255, 0.326);
    }

    .logo2 {
        width: 50px;
         animation: fadeIn 0.8s ease-in-out;
    }

    .logo {
        width: 200px;
         animation: fadeIn 0.8s ease-in-out;
    }

    .input {
        padding: 15px;
        border: none;
        border-radius: 5px;
        width: 89%;
        outline: none;
        background-color: rgba(0, 0, 0, 0.43);
        cursor: pointer;
        color: rgba(233, 238, 238, 0.804);
         animation: fadeIn 0.8s ease-in-out;
    }

    .input:hover {
        background-color: rgb(255, 255, 255);
        transition: 0.5s;
        color: rgb(56, 53, 53);
        box-shadow: 0px 0px 5px white;
    }

    p {
        font-size: 10px;
        text-align: center;
        height: 0.5vh;
        color: rgba(255, 255, 255, 0.423);
    }

    .container {
        background-image: url(wp13577534-ghibli-night-wallpapers.jpg);
        background-size: cover;
    }

    .back-button {
        background-color: #252d3d5a;
        color: #ffffff87;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        margin-bottom: 20px;
        margin-top: 250px;
        transition: 0.5s;
        margin-left: 5px;
         animation: fadeIn 0.8s ease-in-out;
    }

    .back-button:hover {
        background-color: #e2e7ef;
        color: black;
    }
       .moon {
            position: absolute;
            top: 80px;
            margin-left:50px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle at 35% 35%, #ffffff, #dcd9d9 50%, #e8e8e8 100%);
            border-radius: 50%;
            opacity: 1;
            filter: blur(1px);
            box-shadow: 0px 0px 3px rgba(255, 255, 255, 0.595);
            animation: moonGlow 4s ease-in-out infinite;
           }
        .moon {
         animation: moonGlow 4s ease-in-out infinite;
         filter: drop-shadow(0 0 15px #fff9b0);
          }

@keyframes moonGlow {
    0%, 100% {
        filter:
            drop-shadow(0 0 10px #fff9b0)
            drop-shadow(0 0 20px #fff4a3)
            drop-shadow(0 0 40px #ffe97a);
    }

    50% {
        filter:
            drop-shadow(0 0 20px #fff9b0)
            drop-shadow(0 0 40px #fff4a3)
            drop-shadow(0 0 80px #ffe97a)
            drop-shadow(0 0 120px rgba(255,255,180,0.5));
    }
}

    .star1 {
        position: fixed;
        width: 2px;
        height: 2px;
        background: #ffffffa5;
        border-radius: 50%;
        opacity: 0.7;
        animation: twinkle 1s ease-in-out infinite;
    }

    @keyframes twinkle {

        0%,
        100% {
            opacity: 0.3;
        }

        50% {
            opacity: 1;
        }
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

<body class="container">
    <div class="moon-container">
        <div class="moon"></div>
    </div>
    <div class="star1" style="top: 22%; left: 95%; width: 5px; height: 5px;"></div>
    <div class="star1" style="top: 28%; left: 45%; width: 2px; height: 2px;"></div>
    <div class="star1" style="top: 35%; left: 18%; width: 6px; height: 6px;"></div>
    <div class="star1" style="top: 40%; left: 75%; width: 3px; height: 3px;"></div>
    <div class="star1" style="top: 48%; left: 55%; width: 4px; height: 4px;"></div>
    <div class="star1" style="top: 52%; left:  3%; width: 2px; height: 2px;"></div>
    <div class="star1" style="top: 20%; left: 90%; width: 5px; height: 5px;"></div>
    <div class="star1" style="top: 10%; left: 28%; width: 3px; height: 3px;"></div>
    <div class="star1" style="top: 15%; left: 68%; width: 2px; height: 2px;"></div>
    <div class="star1" style="top: 10%; left: 12%; width: 4px; height: 4px;"></div>
    <div class="star1" style="top:  9%; left: 92%; width: 6px; height: 6px;"></div>
    <div class="star1" style="top: 10%; right: 90%; width: 3px; height: 3px;"></div>
    <div class="star1" style="top: 10%; left: 50%; width: 5px; height: 5px;"></div>
    <div class="star1" style="top: 10%; left:  8%; width: 2px; height: 2px;"></div>
    <div class="star1" style="top: 60%; right: 80%; width: 4px; height: 4px;"></div>
    <div class="star1" style="top: 50%; left: 90%; width: 3px; height: 3px;"></div>
    <div class="star1" style="top: 45%; left: 97%; width: 5px; height: 5px;"></div>
    <form class="roshan" method="POST">
        <div style="text-align: center;">
            <img src="img2.png" class="logo2">
            <img src="img1.png" class="logo"><br><br>
        </div>
        <input class="input" type="number" name="amount" id="amount" placeholder="Enter Amount" required><br><br>

        <button class="butt" type="submit">
            Withdraw
        </button><br><br>
        <p>© Blue Moon Finance. All Rights Reserved 2026.</p>
    </form><br>
    <a href="dashboard.php">
        <button class="back-button">← Back to Dashboard</button>
    </a>
</body>

</html>
