<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$conn = mysqli_connect("localhost", "root", "", "banking");

if (!$conn) {
    die("Connection Error!");
}
$username = $_SESSION['username'];
$sql = "SELECT transaction_id, transaction_type, t_amount, transaction_date 
        FROM transactions 
        WHERE username = '$username' ORDER BY transaction_date DESC";
$result = mysqli_query($conn, $sql);
$transactionCount = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0f1419;
            color: #ffffff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #1a1f2eb0;
            padding:40px;
            border-radius:5px;
            margin-top:40px;
        }

        .back-button {
            background-color: #252d3d;
            color: #ffffffae;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top:20px;
            font-size: 14px;
            margin-bottom: 20px;
            transition: 0.5s;
             animation: fadeIn 0.8s ease-in-out;
        }

        .back-button:hover {
            background-color: #e2e7ef;
            color: black;
        }

        .logo {
            width: 40px;
        }

        .logo2 {
            width: 200px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
             animation: fadeIn 0.8s ease-in-out;
        }
        h2 {
            font-size: 15px;
            margin-bottom: 10px;
             animation: fadeIn 0.8s ease-in-out;
                color: #b0b8c8;
        }

        p {
            color: #b0b8c8;
               font-weight: bold;
            margin-bottom: 20px;
             animation: fadeIn 0.8s ease-in-out;
             text-transform:uppercase;
             font-size:24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1f2e;
            border-radius: 5px;
            overflow: hidden;
            font-size: 15px;
            color: #afb1b4;
             animation: fadeIn 0.8s ease-in-out;
        }

        th {
            background-color: #252d3d;
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border-bottom: 1px solid #3a4556;
             animation: fadeIn 0.8s ease-in-out;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #3a4556;
             animation: fadeIn 0.8s ease-in-out;
        }

        tr:hover {
            background-color: #252d3d;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #b0b8c8;
             animation: fadeIn 0.8s ease-in-out;
        }

        .moon {
            position: absolute;
            top: 80px;
            right: 120px;
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

        .star1 {
            position: fixed;
            width: 2px;
            height: 2px;
            background: #ffffffa5;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 1s ease-in-out infinite;
        }

        h1 {
            color: rgba(255, 255, 255, 0.692);
              text-transform: uppercase;
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
        .okina{
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</head>

<body>

    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <p>Transaction History</p>
                <h2>Total Transactions: <?php echo $transactionCount; ?></h2>
            </div>
            <div>
                <img src="img2.png" width="50px" class="okina">
                <img src="img1.png" width="200px" class="okina">
            </div>
        </div>
        <div class="info-divider"></div>
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
        <table>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>

            <?php
            if ($transactionCount > 0) {
               
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['transaction_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['transaction_type']) . "</td>";
                    echo "<td>Rs. " . number_format($row['t_amount'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['transaction_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' class='no-data'>No transactions found</td></tr>";
            }
            ?>

        </table>
       <a href="dashboard.php">
            <button class="back-button">← Back to Dashboard</button>
        </a>
    </div>

    <?php
    mysqli_close($conn);
    ?>

</body>

</html>