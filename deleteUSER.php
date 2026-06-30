<?php
$conn = mysqli_connect("localhost","root","","banking");

if(!$conn){
    die("Connection failed");
}

if(isset($_GET['AccountNum']))
{
    $accountNum = $_GET['AccountNum'];

    $sql = "DELETE FROM users WHERE AccountNum='$accountNum'";

    if(mysqli_query($conn,$sql))
    {
        echo "<script>
                alert('User deleted successfully');
                window.location.href='adminDashboard.php';
              </script>";
    }
    else
    {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}
else
{
    echo "Invalid request";
}
?>