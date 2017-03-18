  <?php

#header ( "Content-Type:application/json");




function shield($DEVICES)

{

global $i,$find;
$c=0;
$array = parse_ini_file("db.conf");

foreach ($array as &$value) 
{
            $in[$c]=$value;
            $c++;

}

$dbhost= $in[0];
$username=$in[1];
$password=$in[2];
$dbname=$in[3];
$dbtable=$in[5];
$out=$in[6];

print "$dbhost
$username
$password
$dbname
$dbtable" ;

$con=mysql_connect($dbhost,$username,$password);
mysql_select_db($dbname, $con) or die ("Cannot select DB");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	
}


        $result = mysql_query("SELECT * FROM DEVICES",$con);

$i=0;

while($row = mysql_fetch_array($result)) 

	{

	 	$find[$i]['cpu']		 = $row['5'];

		$find[$i]['memory']		 = $row['6'];

		$find[$i]['networkinput']	 = $row['7'];

    		$find[$i]['networkoutput']	 = $row['8'];

		$find[$i]['disk']		 = $row['9'];

		$i++;

	}


return($i);

}	


