<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "banking");

$username = $_SESSION['username'];

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $receiver_ac = $_POST['receiver_ac'];
    $amount = $_POST['amount'];

    if($amount <= 0){
        die("Enter a valid amount");
    }

    $senderQuery = mysqli_query($conn,
"SELECT AccountNum, balance FROM users WHERE username='$username'");

    $sender = mysqli_fetch_assoc($senderQuery);

    $sender_ac = $sender['AccountNum'];
    $sender_balance = $sender['balance'];

    
    if($sender_ac == $receiver_ac){
        die("Cannot transfer to your own account");
    }

    $receiverQuery = mysqli_query($conn,"SELECT balance FROM users WHERE AccountNum='$receiver_ac'");

    if(mysqli_num_rows($receiverQuery) == 0){
        die("Receiver account not found");
    }

    $receiver = mysqli_fetch_assoc($receiverQuery);
    $receiver_balance = $receiver['balance'];

   
    if($amount > $sender_balance){
        die("Insufficient balance");
    }

    $new_sender_balance = $sender_balance - $amount;
    $new_receiver_balance = $receiver_balance + $amount;

    
    mysqli_query($conn,"UPDATE users SET balance='$new_sender_balance' WHERE AccountNum='$sender_ac'");

  
    mysqli_query($conn,"UPDATE users SET balance='$new_receiver_balance' WHERE AccountNum='$receiver_ac'");

    date_default_timezone_set('Asia/Kathmandu');   
    $date = date("Y-m-d H:i:s");
        $query="INSERT INTO transactions (transaction_type, transaction_date, t_amount, username,Sender_acc,Receiver_acc) VALUES ('Transfer', '$date', '$amount', '$username','$sender_ac',$receiver_ac)";
     if(mysqli_query($conn, $query)){
               echo "<script>alert('Transfer Successful')</script>";
            } else {
                echo "Error: " . mysqli_error($conn);
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
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    span {
        display: inline-block;
        background-color: transparent;
        color: white;
        margin-top: 190px;
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

    * {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }
    .moon {
            position: absolute;
            top: 5px;
            right: 250px;
            width: 80px;
            height: 80px;
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
        background-color: rgba(255, 255, 255, 0.834);
        color: rgb(0, 0, 0);
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
            animation: fadeIn 0.8s ease-in-out;
    }

    .container {
        background-image: url(wp14715486-studio-ghibli-4k-desktop-wallpapers.jpg);
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
        margin-top: 187px;
        transition: 0.5s;
        margin-left: 5px;
            animation: fadeIn 0.8s ease-in-out;
    }

    .back-button:hover {
        background-color: #e2e7ef;
        color: black;
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
           .star1 {
            position: fixed;
            width: 2px;
            height: 2px;
            background: #f4f021a5;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 1s ease-in-out infinite;
        }
</style>

<body class="container">
    <div class="star1" style="top: 4%; left: 95%; width: 5px; height: 5px;"></div>
    <div class="star1" style="top: 5%; left: 80%; width: 5px; height: 5px;"></div>
        <div class="star1" style="top: 5%; left: 60%; width: 2px; height: 2px;"></div>
         <div class="star1" style="top: 5%; left: 75%; width: 2px; height: 2px;"></div>
        <div class="star1" style="top: 6%; left: 70%; width: 6px; height: 6px;"></div>
        <div class="star1" style="top: 6%; left: 75%; width: 3px; height: 3px;"></div>
    <div class="moon"></div>
    <form class="roshan" method="POST">
        <div style="text-align: center;">
            <img src="img2.png" class="logo2">
            <img src="img1.png" class="logo"><br><br>
        </div>
        <input class="input" type="number" name="receiver_ac" placeholder="Receiver Account Number" required><br><br>

        <input class="input" type="number" name="amount" id="amount" placeholder="Enter Amount" required><br><br>
        <button type="submit" disabled style="display:none;"></button>
        <button class="butt" type="submit">
            Transfer
        </button><br><br>
        <p>© Blue Moon Finance. All Rights Reserved 2026.</p>
    </form><br>
    <a href="dashboard.php">
        <button class="back-button">← Back to Dashboard</button>
    </a>
</body>

</html>