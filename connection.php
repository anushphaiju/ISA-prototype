 <?php
 header("Access-Control-Allow-Origin:*");
 header('content-Type:application/json');
 $servername="";
 $username="";
 $password= "";
 $dbname="";
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 if(!$conn){
    die(json_encode(["error"=>"Connection failed"]));
 }
 $createTable="CREATE TABLE IF NOT EXISTS cityy(
weather varchar(255),
temp varchar(255),
humidity varchar(255),
pressure varchar(255),
windspeed varchar(255),
main_weather varchar(255)
)";
mysqli_query($conn,$createTable);
$cityname=isset($_GET['q'])? mysqli_real_escape_string($conn,$_GET['q']):"Biratnagar";
$selectAlldata="SELECT *FROM cityy WHERE weather='$cityname'";
$result=mysqli_query($conn,$selectAlldata);
$result = mysqli_query($conn, $selectAlldata);
if(mysqli_num_rows( $result ) == 0){
    $url= "";
    $response=file_get_contents($url);
    $data=json_decode($response,true);
    $temperature=$data["main"]["temp"];
    $humidity=$data["main"]["humidity"];
    $pressure=$data["main"]["pressure"];
    $windspeed=$data["wind"]["speed"];
}
$inserrt="INSERT INTO cityy(temperature,humidity,pressure,windspeed)
VALUES ('$temperature','$humidity','$pressure','$windspeed')";
mysqli_query($conn,$insertdata);
$result=mysqli_query($conn,$selectAlldata);
$rows=array();
while($row=mysqli_fetch_assoc($result)){
    $rows[]=$row;
}
$json_data=json_encode($rows);
echo $json_data;
?>