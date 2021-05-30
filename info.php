<?php
 
$con = mysqli_connect("localhost","root","admin","testsite");
mysqli_set_charset($con, "utf8");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL:" . mysqli_connect_errno();
}


$query = "SELECT * FROM news;";
$result = mysqli_query($con, $query);
$count = mysqli_num_rows($result);


$row1=mysqli_fetch_array($result);
echo '<pre>';
print_r($row1);