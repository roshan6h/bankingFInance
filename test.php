<?php
$conn=mysqli_connect("localhost","root","","dv");
if(!$conn){
    die("connection failed !");
}
$test=mysqli_query($conn,"SELECT * FROM lava");
while($haha=mysqli_fetch_array($test)){
print_r($haha);
echo "<br>";
echo $haha['Name'] . $haha['Roll'] . $haha['Address'] . $haha['DOV'];
echo "<br><br>";
}

?>