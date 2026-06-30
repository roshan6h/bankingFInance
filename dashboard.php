<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "banking");
$username=$_SESSION['username'];
if(!$conn){
    die("DB Connection Failed");
}
 $sql = "SELECT balance,AccountNum FROM users WHERE Username='$username'";
       $result = mysqli_query($conn, $sql);
       $row = mysqli_fetch_assoc($result);
       $balance = $row['balance'];
       $acNum=$row['AccountNum'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Moon Finance - Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            zoom: 0.8;
        }

        p {
            font-size: 13px;
            color: rgba(230, 222, 222, 0.7);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0px;
            font-weight: 400;
        }

        body {
            background-color: #0a0a0a;
            color: rgba(230, 222, 222, 0.9);
        }

        .container {
            background-image: url(wp15833089-studio-ghibli-night-wallpapers.jpg);
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
        }

        .logo2 {
            width: 200px;
            animation: fadeIn 3s ease-in-out;
            
        }

        .logo {
            width: 50px;
            animation: fadeIn 3s ease-in-out;

        }

        .back {
            background-color: rgba(0, 0, 0, 0);
            padding: 10px;
            cursor: pointer;
        }

        .back:hover {
            backdrop-filter: blur(10px);
            background-color: rgba(0, 0, 0, 0.345);
            transition: 0.4s ease-out;
        }

        nav ul {
            list-style: none;
            width: 100%;
            text-align: right;
            padding-right: 20px;
            animation: fadeIn 3s ease-in-out;
        }

        nav ul li {
            display: inline-block;
            margin: 10px 20px;
            animation: fadeIn 3s ease-in-out;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        a:hover {
            text-decoration: underline;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
        }

        .button {
            border: none;
            padding: 8px;
            border-radius: 5px;
            transition: 0.4s;
            background: transparent;
            color: rgba(230, 222, 222, 0.807);
            font-size: 15px;
            cursor: pointer;
            animation: fadeIn 3s ease-in-out;
        }

        .button:hover {
            background-color: white;
            color: black;
            transform: scale(1.03);
        }

        .main-content {
            display: flex;
            align-items: flex-start;
            padding: 40px;
            gap: 40px;
            max-width: 1400px;
            margin: 0 auto;
            margin-left:325px;
        }

         .moon {
            position: fixed;
            top: 80px;
            margin-left:50px;
            width: 150px;
            height: 150px;
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

        .stars {
            position: fixed;
            width: 200px;
            height: 200px;
            margin: 0 auto;
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

        .welcome-section {
            flex: 1;
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .welcome-header {
            margin-bottom: 30px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: 700;
            color: rgba(230, 222, 222, 0.95);
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .welcome-subtitle {
            font-size: 14px;
            color: rgba(230, 222, 222, 0.7);
            font-weight: 400;
        }

        .info-divider {
            height: 1px;
            background-color: rgba(230, 222, 222, 0.15);
            margin: 20px 0;
        }

        .user-info {
            margin-bottom: 20px;
        }

        .info-label {
            font-size: 13px;
            color: rgba(230, 222, 222, 0.6);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            font-weight: 500;
            animation: fadeIn 0.8s ease-in-out;
        }

        .info-value {
            font-size: 22px;
            font-weight: 700;
            color: rgba(230, 222, 222, 0.95);
            letter-spacing: 0.3px;
            animation: fadeIn 0.8s ease-in-out;
        }

        .dashboard-title {
            font-size: 16px;
            color: rgba(230, 222, 222, 0.7);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0px;
            font-weight: 600;
            animation: fadeIn 0.8s ease-in-out;
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

        .footer {
            text-align: center;
            color: rgba(200, 190, 190, 0.6);
            font-size: 12px;
            padding: 30px 20px;
            border-top: 1px solid rgba(230, 222, 222, 0.08);
            margin-top: 60px;
            background-color: rgba(0, 0, 0, 0.2);
        }

        .footer span {
            letter-spacing: 0.3px;
        }

        .dashboard {
            display: flex;
            justify-content: left;
            gap: 94px;
            flex-wrap: wrap;
            margin-top: 20px;
            animation: fadeIn 3s ease-in-out;
        }

        .card {
            background-color: rgba(18, 6, 6, 0.373);
            width: 200px;
            height: 210px;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: 0.4s all;
        }

        .card:hover {
            transform: scale(1.03);
            background-color: rgba(245, 127, 37, 0.159);
            color: white;
        }

        .star1 {
            position: fixed;
            width: 2px;
            height: 2px;
            background: #ffffffa5;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 3s ease-in-out infinite;
        }

        .calsi {
            text-align: right;
            position: relative;
            animation: bounce 5s infinite;
            

        }

        @keyframes bounce {

            0%,
            100% {
                top: 0;
            }

            50% {
                top: 300px;
            }
        }
    </style>
</head>

<body class="container">

    <div class="back">
        <nav>
            <img src="img2.png" class="logo">
            <img src="img1.png" class="logo2">
            <ul style="color:rgba(230, 222, 222, 0.807)">
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contacts1.html">Contacts</a></li>
            </ul>
            <button class="button" onclick="window.location.href='Userlogout.php'">Logout</button>
        </nav>
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

    <div class="moon-container">
        <div class="moon"></div>
    </div>

    <div class="main-content">
        <div class="welcome-section">

            <div class="welcome-header">
                <h1 class="welcome-title">Welcome! 🌙</h1>
                <p class="welcome-subtitle">Blue Moon Finance <?php echo $_SESSION['branch']; ?> Branch</p>
            </div>

            <div class="info-divider"></div>

            <div class="user-info">
                <p class="info-label">Account Holder</p>
                <p class="info-value">
                    <?php echo $_SESSION['username']; ?>
                </p>
            </div>

            <div class="user-info">
                <p class="info-label">Account NO :</p>
                <p class="info-value">
                    <?php echo $acNum ?>
                </p>
            </div>

            <div class="user-info">
                <p class="info-label">Available Balance</p>
                <p class="info-value">Rs
                    <?php echo $balance ?>
                </p>
            </div>

            <p class="dashboard-title">Transact</p>

            <div class="dashboard">
                <div class="card">
                    <a href="deposit.php"><img src="depositImage.png" width="100px"><br><br></a>
                    <p>Deposit</p>
                </div>
                <div class="card">
                    <a href="withdraw.php"><img src="withdrawImage.png" width="100px"><br><br></a>
                    <p>Withdraw</p>
                </div>
                <div class="card">
                    <a href="transfer.php"><img src="transferImage.png" width="100px"><br><br></a>
                    <p>Transfer</p>
                </div>
                <div class="card">
                    <a href="transactionHistory.php"><img src="viewTransaction22.png" width="100px"><br><br></a>
                    <p>Transactions</p>
                </div>
            </div>

        </div>
        <img src="haha.gif" width="100px" class="calsi">
    </div>
    <footer class="footer">
        <span>&copy; 2024 Blue Moon Finance. All rights reserved.</span>
    </footer>
</body>

</html>