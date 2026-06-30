<?php
$conn = mysqli_connect("localhost", "root", "", "banking");

$username = $_GET['Username'];

$query = mysqli_query($conn,
    "SELECT * FROM transactions
     WHERE username='$username'
     ORDER BY transaction_date DESC");
     $transactionCount = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Transactions</title>
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
            padding:50px;
            border-radius:5px;
            margin-top:70px;
        }

        .back-button {
            background-color: #252d3d;
            color: #ffffffae;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 20px;
            transition: 0.5s;
            animation: fadeIn 0.8s ease-in-out;
            margin-top:20px;
        }

        .back-button:hover {
            background-color: #e2e7ef;
            color: black;
        }

        h2 {
            font-size: 16px;
           
            text-transform: uppercase;
            animation: fadeIn 0.8s ease-in-out;
        }

        p {
            color: #b0b8c8;
            margin-bottom: 20px;
            animation: fadeIn 0.8s ease-in-out;
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
            text-align:center;
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
            text-align:left;
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

        h2 {
            color: rgba(255, 255, 255, 0.7);
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
          .back-button:hover {
            background-color: #e2e7ef;
            color: black;
        }
        
        .okina{
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</head>

<body>
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
    <div class="container">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                 <h2>Transactions of Account : <?php echo $username; ?></h2>
                 
            </div>
            <div>
                <img src="img2.png" class="okina" width="50px">
                <img src="img1.png" class="okina" width="200px">
            </div>
        </div>
     <div class="info-divider"></div>

    <table>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Sender_acc</th>
            <th>Receiver_acc</th>
        </tr>

        <?php
         if ($transactionCount > 0) {
    while($row = mysqli_fetch_assoc($query))
    {
     echo "<tr>";
                    echo "<td>" . $row['transaction_id']. "</td>";
                    echo "<td>" . $row['transaction_type'] . "</td>";
                    echo "<td>Rs. " .$row['t_amount'] . "</td>";
                    echo "<td>" . $row['transaction_date'] . "</td>";
                    echo "<td>" . $row['Sender_acc'] . "</td>";
                    echo "<td>" . $row['Receiver_acc'] . "</td>";
    echo "</tr>";
    }
         }else{
             echo "<tr><td colspan='4' class='no-data'>No transactions found</td></tr>";
         }
    ?>
  
    </table>
    <a href="adminDashboard.php">
            <button class="back-button">← Back to Dashboard</button>
        </a>
</div>
</body>

</html>