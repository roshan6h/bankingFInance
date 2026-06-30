<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "banking");
$username=$_SESSION['username'];
if(!$conn){
    die("DB Connection Failed");
}
$entered_otp = $_POST['otp'] ?? '';
$otp_id =  $_POST['otp_id'];


if($otp_id == 0){
    die("Invalid OTP request");
}


$result = mysqli_query($conn, "SELECT * FROM otp_verification WHERE id=$otp_id");
$row = mysqli_fetch_assoc($result);

if ($row) {

    if (time() > $row['expiry_time']) {
        echo "<script>
                alert('OTP Expired! Send Again!');
                window.location='sendOTP.html';
              </script>";
        exit();
    }

    elseif ($entered_otp == $row['otp']) {

        mysqli_query($conn, "DELETE FROM otp_verification WHERE id='$otp_id'");

        echo "<script>
                alert('OTP Verified!');
                window.location='dashboard.php';
              </script>";
        exit();
    }

    else {
        echo "<script>
                alert('Invalid OTP! Send Again!');
                window.location='sendOTP.html';
              </script>";
        exit();
    }
}
else{
     echo "<script>alert('otp not found ')</script>";
}
?>
