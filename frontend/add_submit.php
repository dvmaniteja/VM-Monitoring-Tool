<?php
$c=0;
$ini_array = parse_ini_file("db.conf");
session_start();
foreach ($ini_array as &$value) {
            $ini[$c]=$value;
            $c++;

}
if (isset($_SESSION['NAME'])){
$_SESSION['IP']=$_POST['IP'];
echo $_SESSION['IP'];
}
$host= $ini[0];
$user=$ini[1];
$password=$ini[2];
$dbname=$ini[3];
$dbtable=$ini[5];

$con=mysqli_connect($host,$user,$password,$dbname);
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else{
echo"successfully connected";
}

$sql="CREATE TABLE IF NOT EXISTS DEVICES(
ID INT NOT NULL AUTO_INCREMENT, 
IP VARCHAR(20) NOT NULL,
Username VARCHAR(20) NOT NULL,
Password VARCHAR(20) NOT NULL,
VMname VARCHAR(20) NOT NULL,

PRIMARY KEY(ID)
)";
if ($con->query($sql) === TRUE) {
    echo "Table  created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql1="INSERT INTO $dbtable (IP,Username,Password)
VALUES ('$_POST[IP]','$_POST[username]','$_POST[password]')"; 
$con->query($sql1);
$con->close();


header('Location: AD.php');

?>
