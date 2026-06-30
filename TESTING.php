<?php
session_start();

if (!isset($_SESSION['username2'])) {
    header("Location: adminLogin.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "banking");

if (!$conn) {
    die("Connection Error!");
}

$sql = "SELECT Fullname, Username, Email, DOB, Gender, balance, AccountNum 
        FROM users 
        ORDER BY AccountNum DESC";

$result = mysqli_query($conn, $sql);
$userCount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Blue Moon Finance</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0f1419;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
            font-size: 14px;
        }


        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #1a1f2e;
            padding: 15px 30px;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }



        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            flex: 1;
            justify-content: center;
        }

        .navbar-menu a {
            text-decoration: none;
            color: #b0b8c8;
            font-size: 14px;
            transition: color 0.3s;
        }

        .navbar-menu a:hover {
            color: #ffffff;
        }

        .logout-btn {
            text-decoration: none;
            background-color: #ffffff;
            color: #0f1419;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 13px;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #e8e8e8;
        }


        .main-content {
            margin-top: 100px;
            padding: 30px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            border-radius:5px;
           background-color: #1a1f2e;
        }

        .welcome-section {
            margin-bottom: 15px;
        }

        .welcome-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #b0b8c8;
            text-transform: uppercase;
        }

        .user-count {
            font-size: 16px;
            color: #b0b8c8;
            
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1f2e;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        }

        .users-table thead {
            background-color: #252d3d;
        }

        .users-table th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #ffffffab;
            border-bottom: 2px solid #3a4556;
            font-size: 14px;
        }

        .users-table td {
            padding: 14px 15px;
            border-bottom: 1px solid #3a4556;
            color: #b0b8c8;
        }

        .users-table tr:hover {
            background-color: #252d3d;
        }

        .users-table tbody tr:last-child td {
            border-bottom: none;
        }


        .table-account {
            font-weight: bold;
            color: #ffffff;
        }

        .table-balance {
            color: #4ade80;
            font-weight: bold;
        }


        .delete-button {
            background-color: #dc3545;
            color: #ffffff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
            
            transition: background-color 0.3s;
            display: inline-block;
        }

        .delete-button:hover {
            background-color: #b02a37;
        }


        .no-users-message {
            text-align: center;
            padding: 40px 20px;
            color: #b0b8c8;
            font-size: 16px;
        }


        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }

            .navbar-menu {
                flex-direction: column;
                gap: 10px;
                justify-content: flex-start;
            }

            .main-content {
                padding: 15px;
            }

            .users-table {
                font-size: 12px;
            }

            .users-table th,
            .users-table td {
                padding: 10px;
            }

            .delete-button {
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        .logo {
            width: 50px;
        }

        .logo2 {
            width: 200px;
        }

        .moon {
            position: absolute;
            top: 80px;
            right: 120px;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle at 35% 35%, #ffffff, #dcd9d9 50%, #e8e8e8 100%);
            border-radius: 50%;
            opacity: 0.75;
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
        

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: #ffffff;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 3s ease-in-out infinite;
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
        }

        .button:hover {
            background-color: white;
            color: black;
            transform: scale(1.03);
        }

        .button2{
            border: none;
            padding:8px;
            border-radius: 5px;
            transition: 0.6s;
            background: transparent;
            color: #b0b8c8;
            font-size: 14px;
            cursor: pointer;
        }
        .button2:hover{
            background-color: white;
            color: black;
            
        }

        a{
            text-decoration:none;s
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

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.3;
            }

            50% {
                opacity: 1;
            }
        }
         .info-divider {
            height: 1px;
            background-color: rgba(230, 222, 222, 0.15);
            margin: 20px 0;
        }
    </style>
</head>

<body>


    <nav class="navbar">
        <div class="navbar-logo">
            <img class="logo" src="img2.png">
            <img class="logo2" src="img1.png">
        </div>

        
        <a href="logout.php" class="button">Logout</a>
    </nav>
    <div class="main-content">
        <div class="moon"></div>
        <div class="star" style="top: 5%; left: 5%; width: 2px; height: 2px;"></div>
        <div class="star" style="top: 12%; left: 30%; width: 4px; height: 4px;"></div>
        <div class="star" style="top: 18%; left: 70%; width: 3px; height: 3px;"></div>
        <div class="star" style="top: 22%; left: 95%; width: 5px; height: 5px;"></div>
        <div class="star" style="top: 28%; left: 45%; width: 2px; height: 2px;"></div>
        <div class="star" style="top: 35%; left: 18%; width: 6px; height: 6px;"></div>
        <div class="star" style="top: 40%; left: 75%; width: 3px; height: 3px;"></div>
        <div class="star" style="top: 48%; left: 55%; width: 4px; height: 4px;"></div>
        <div class="star" style="top: 52%; left: 3%; width: 2px; height: 2px;"></div>
        <div class="star" style="top: 58%; left: 82%; width: 5px; height: 5px;"></div>
        <div class="star" style="top: 63%; left: 28%; width: 3px; height: 3px;"></div>
        <div class="star" style="top: 67%; left: 68%; width: 2px; height: 2px;"></div>
        <div class="star" style="top: 72%; left: 12%; width: 4px; height: 4px;"></div>
        <div class="star" style="top: 78%; left: 92%; width: 6px; height: 6px;"></div>
        <div class="star" style="top: 81%; left: 40%; width: 3px; height: 3px;"></div>
        <div class="star" style="top: 88%; left: 58%; width: 5px; height: 5px;"></div>
        <div class="star" style="top: 93%; left: 8%; width: 2px; height: 2px;"></div>
        <div class="star" style="top: 96%; left: 35%; width: 4px; height: 4px;"></div>
        <div class="star" style="top: 15%; left: 60%; width: 3px; height: 3px;"></div>
        <div class="star" style="top: 55%; left: 97%; width: 5px; height: 5px;"></div>

        <div class="welcome-section">
            <h1 class="welcome-title">
                Welcome,
                <?php echo $_SESSION['username2']; ?>
            </h1>
            <p class="user-count">
                Total Registered Users: <strong>
                    <?php echo $userCount; ?>
                </strong>
            </p>
        </div>
        <div class="info-divider"></div>
        <table class="users-table">
            <thead>
                <tr>
                    <th>Account No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if ($userCount > 0) {

                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='table-account'>" . htmlspecialchars($row['AccountNum']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Fullname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td class='table-balance'>Rs. " . number_format($row['balance'], 2) . "</td>";
                        echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
                        echo "<td>";
                        echo "<a class='button2' href='TESTINGtrans.php?Username=" .$row['Username'] . "'> Transactions </a>"; 
                        echo "<a class='button2' href='deleteUSER.php?AccountNum=" . urlencode($row['AccountNum']) . "'onclick=\"return confirm('Are you sure you want to delete this user?');\">
                        Delete </a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                } else {
                 
                    echo "<tr>";
                    echo "<td colspan='8' class='no-users-message'>";
                    echo "No users found in the system.";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <?php
    mysqli_close($conn);
    ?>

</body>

</html>