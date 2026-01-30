<?php
$servername="localhost";
$username="root";
$password="";
$conn=mysqli_connect($servername,$username,$password);
if($conn){
    echo"Connected successfull";
}
else{
    echo"Not connected".mysqli_connect_error();
}
$sql="CREATE DATABASE IF NOT EXISTS prototype";
if(mysqli_query($conn,$sql)){
    echo"Database created";
}else{
    echo"Failed to connect".mysqli_error($conn);
}
mysqli_select_db($conn,"prototype");
$createTable="CREATE TABLE IF NOT EXISTS cityy(
weather varchar(255),
temp varchar(255),
humidity varchar(255),
pressure varchar(255),
windspeed varchar(255),
main_weather varchar(255)
)";
if(mysqli_query($conn,$createTable)){
    echo"Table created successfully";
}
else{
    echo"Table not created";
}
if(isset($_GET['q'])){
    $cityname=$_GET['q'];
    echo $cityname;
}else{
    $cityname="Biratnagar";
}
$selectAlldata="SELECT * FROM cityy where weather='$cityname'";
$result = mysqli_query($conn, $selectAlldata);
if(mysqli_num_rows( $result ) == 0){
    $url= "https://api.openweathermap.org/data/2.5/weather?q=$cityname&units=metric&APPID=afce25ec9cbca94dc81f34edc16fd77c";
    $response=file_get_contents($url);
    $data=json_decode($response,true);
    $temperature=$data["main"]["temp"];
    $humidity=$data["main"]["humidity"];
    $pressure=$data["main"]["pressure"];
    $windspeed=$data["wind"]["speed"];
}
$insertdata="INSERT INTO cityy(temperature,humidity,pressure,windspeed)
VALUES ('$temperature','$humidity','$pressure','$windspeed')";
if(mysqli_query($conn,$insertdata)){
    echo"Data inserted";
}
else{
    echo"Failed to insert data".mysqli_error($conn);
}
$result=mysqli_query($conn,$selectAlldata);
$rows=array();
while($row=mysqli_fetch_assoc($result)){
    $rows[]=$row;
}
$json_data=json_encode($rows);
header('Content-Type:application/json');
echo $json_data;