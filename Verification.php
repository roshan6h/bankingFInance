<?php
$conn = mysqli_connect("localhost", "root", "", "banking");
$email = $_POST['email'];
$otp = rand(100000, 999999);
$expiry = time() + 120;
mysqli_query($conn, "INSERT INTO otp_verification (email, otp, expiry_time) 
VALUES ('$email', '$otp', '$expiry')");

$otp_id = $conn->insert_id;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
              
    $mail->isSMTP();                                         
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'ilovejuice131@gmail.com';                     
    $mail->Password   = 'kjbw befc qfff fulp';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                   


    $mail->setFrom('ilovejuice131@gmail.com', 'BlueMoon Finance');
    $mail->addAddress($email, 'xxxx');    

  
    $mail->isHTML(true);                                 
    $mail->Subject = 'Blue Moon Finance';
    $message = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #1a1f2eec;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            width: 100%;
            padding: 40px 20px;
        }
        .card {
            background-color: #1a1f2efa;
            padding: 40px;
            max-width: 480px;
            margin: auto;
            border-radius: 12px;
        }
        .header {
            text-align: center;
            padding-bottom: 24px;
        }
        .header h2 {
            color: #ffffffa9;
            font-size: 22px;
            margin: 16px 0 0;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .otp-box {
            background-color: #ffffffa9;
            border: 1px dashed #ffffff;
            border-radius: 10px;
            padding: 28px 20px;
            text-align: center;
            margin-bottom: 24px;
        }
        .otp-box p {
            color: #100e0ea9;
            font-size: 13px;
            margin: 0 0 12px;
            font-style: italic;
        }
        .otp-code {
            font-size: 38px;
            font-weight: bold;
            letter-spacing: 12px;
            color: #131212;
            font-family: "Courier New", monospace;
        }
        .info {
            text-align: center;
            margin-bottom: 28px;
        }
        .info p {
            color: #ffffffa9;
            font-size: 13px;
            margin: 0 0 8px;
        }
        .footer {
            text-align: center;
            border-top: 1px solid #c9b99a;
            padding-top: 16px;
        }
        .footer p {
            color: #ffffffa9;
            font-size: 11px;
            margin: 0;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">

            <div class="header">
                <img src="https://i.ibb.co/gZxXjhsj/img2.png" width="50">
                <img src="https://i.ibb.co/6V73FBH/img1.png" width="200">
                <h2>Your Verification Code</h2>
            </div>

            <div class="otp-box">
                <p>Your one-time code</p>
                <div class="otp-code">' . $otp . '</div>
            </div>

            <div class="info">
                <p>Expires in <b>2 minutes</b></p>
                <p>Do not share this code with anyone</p>
            </div>

            <div class="footer">
                <p>© Blue Moon Finance. All Rights Reserved 2026.</p>
            </div>

        </div>
    </div>
</body>
</html>';
    $mail->Body    = $message;
    $mail->send();
     echo "<script>alert('A verification code has been sent to your email with OTP id $otp_id . Simply enter your code and click on verify . The OTP expires in 2 minutes.')</script>";
} catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&family=Cormorant+Unicase:wght@300;400;500;600;700&family=Dosis:wght@200..800&family=Iosevka+Charon:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&family=Reenie+Beanie&family=Smooch+Sans:wght@100..900&family=Zeyada&display=swap"
        rel="stylesheet">
    <style>
        .lucid {
            font-family: "Reenie Beanie", cursive;
            font-weight: 550;
            font-style: normal;
            color: rgba(230, 222, 222, 0.807);
            text-shadow: 0px 0px 3px rgba(0, 0, 0, 0.697);
            font-size: 30px;
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .okina {
            background-color: rgba(240, 248, 255, 0.185);
            padding: 25px;
            display: inline-block;
            border-radius: 10px;
            margin-top: 27.5vh;
            animation: fadeIn 0.8s ease-in-out;
        }

        .inp {
            border: none;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.141);
            border-radius: 5px;
            width: 97%;
            outline: none;
            transition: 0.4s all;
            color: rgba(0, 0, 0, 0.579);
            animation: fadeIn 0.8s ease-in-out;
        }

        .inp::placeholder {
            color: rgba(255, 255, 255, 0.407);
        }

        .butt {
            border: none;
            padding: 15px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.416);
            color: rgba(193, 198, 208, 0.419);
            cursor: pointer;
            transition: 0.4s all;
            width: 97%;
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

        body {
            text-align: center;
        }

        .butt:hover {
            color: black;
            background-color: rgba(255, 255, 255, 0.808);
            transform: scale(1.03);
            box-shadow: 0px 0px 3px white;
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
            background-image: url(wp13577569-ghibli-night-wallpapers.png);
            background-size: cover;
        }

        .inp:hover {
            background-color: rgba(255, 255, 255, 0.475);
            transform: scale(1.03);
            box-shadow: 0px 0px 3px white;
        }

        p {
            color: rgba(254, 252, 252, 0.455);
            font-size: 12px;
            animation: fadeIn 0.8s ease-in-out;
        }

        span {
            color: rgba(254, 252, 252, 0.418);
            animation: fadeIn 0.8s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="okina">
        <img src="img2.png" class="logo2">
        <img src="img1.png" class="logo"><br><br>
        <p class="lucid">Verify its you !</p><br>
        <form action="otpVerification.php" method="POST">
            <input class="inp" type="text" placeholder="Enter OTP" name="otp" required><br><br>
            <button class="butt" type="submit">Verify</button>
            <input type="hidden" name="otp_id" value="<?php echo $otp_id; ?>">
            <br><br>
            <p><span><b>Note</b></span> : Please do not share the code with anyone !</p>
        </form>
</body>

</html>