<HTML>
	<link href="style.css" rel="stylesheet">
<?php
$c=0;
$array = parse_ini_file("db.conf");

foreach ($array as &$value) {
            $in[$c]=$value;
            $c++;

}

$dbhost= $in[0];
$username=$in[1];
$password=$in[2];
$dbname=$in[3];
$dbtable=$in[5];
$out=$in[6];
$mailid=$in[9];

$connection=mysqli_connect("localhost","root","anmlab2015","project");
  
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function update_clients()
{
    mysql_query( "UPDATE DEVICES SET ID = ID + 1 LIMIT 1" );
}

$result = mysqli_query($connection,"SELECT * FROM DEVICES");
?>

<table border='1'>
<thead class='header_row'>

<th>IP </th>
<th>Username</th>
<th>VMname</th>
<th>cpu</th>
<th>memory</th>
<th>networkinput</th>
<th>networkoutput</th>
<th>disk</th>
</thead>



<?php
while($row = mysqli_fetch_array($result))
{
if(count($_POST)>0)
{
$threscpu1 = preg_replace('#(^A-Za-z)#i','',$_POST["cpu_min"]);
$threscpu2 = preg_replace('#(^A-Za-z)#i','',$_POST["cpu_max"]);
$thresmem1 = preg_replace('#(^A-Za-z)#i','',$_POST["memory_min"]);
$thresmem2 = preg_replace('#(^A-Za-z)#i','',$_POST["memory_max"]);
$thresnin1 = preg_replace('#(^A-Za-z)#i','',$_POST["networkinput_min"]);
$thresnin2 = preg_replace('#(^A-Za-z)#i','',$_POST["networkinput_max"]);
$thresnou1 = preg_replace('#(^A-Za-z)#i','',$_POST["networkouput_min"]);
$thresnou2 = preg_replace('#(^A-Za-z)#i','',$_POST["networkouput_max"]);
$thresd1 = preg_replace('#(^A-Za-z)#i','',$_POST["disk_min"]);
$thresd2 = preg_replace('#(^A-Za-z)#i','',$_POST["disk_max"]);




    if (($row['cpu'] <= $threscpu1) )
    {
     $color_class = 'green';
     //echo "green";
    }
    elseif (($threscpu1 < $row['cpu'] and $threscpu2 >= $row['cpu']) || ($thresmem1 < $row['memory'] and $thresmem2 >= $row['memory']) || ($thresnin1 < $row['networkinput'] and $thresnin2 >= $row['networkinput']) || ($thresnou1 < $row['networkoutput'] and $thresnou2 >= $row['networkoutput']) || ($thresd1 < $row['disk'] and $thresd2 >= $row['disk']))
     {
      $color_class = 'orange';
       //echo "orange";
      }
     else
     {
         $color_class = 'red';
         
         shell_exec('perl /var/www/html/shield/email.pl "'.$mailid.'" ');
         	
          //echo "red";
     }
    echo "<tr class={$color_class}>";
    
    echo "<td>" . $row['IP'] . "</td>";
    echo "<td>" . $row['Username'] . "</td>";
    echo "<td>" . $row['VMname'] . "</td>";
    echo "<td>" . $row['cpu'] . "</td>";
    echo "<td>" . $row['memory'] . "</td>";
    echo "<td>" . $row['networkinput'] . "</td>";
    echo "<td>" . $row['networkoutput'] . "</td>";
    echo "<td>" . $row['disk'] . "</td>";
    echo "</tr>";

//echo "</table>"; 
?>
<link rel='stylesheet' type='text/css' href='stylesheet.css'/> 
<?php
}
else
{
$threscpu1 = 4;
$threscpu2 = 5;
$thresmem1 = 0.92;
$thresmem2 = 0.98;
$thresnin1 = 2711000;
$thresnin2 = 2711700;
$thresnou1 = 798900;
$thresnou2 = 799000;
$thresd1 = 4.22;
$thresd2 = 4.27;
   
 if (($row['cpu'] <= $threscpu1) && ($row['memory'] <= $thresmem1) && ($row['networkinput'] <= $thresnin1) && ($row['networkoutput'] <= $thresnou1 ) && ($row['disk'] <= $thresd1 ))
    {
     $color_class = 'green';
     // echo "green";
    }
    elseif (($threscpu1 < $row['cpu'] and $threscpu2 >= $row['cpu']) || ($thresmem1 < $row['memory'] and $thresmem2 >= $row['memory']) || ($thresnin1 < $row['networkinput'] and $thresnin2 >= $row['networkinput']) || ($thresnou1 < $row['networkoutput'] and $thresnou2 >= $row['networkoutput']) || ($thresd1 < $row['disk'] and $thresd2 >= $row['disk']))
     {
      $color_class = 'orange';
       //echo "orange";
      }
     else
     {
         $color_class = 'red';
         shell_exec('perl /var/www/html/shield/email.pl "'.$mailid.'" ');
          //echo "red";
     }
    echo "<tr class={$color_class}>";
    
    echo "<td>" . $row['IP'] . "</td>";
    echo "<td>" . $row['Username'] . "</td>";
    echo "<td>" . $row['VMname'] . "</td>";
    echo "<td>" . $row['cpu'] . "</td>";
    echo "<td>" . $row['memory'] . "</td>";
    echo "<td>" . $row['networkinput'] . "</td>";
    echo "<td>" . $row['networkoutput'] . "</td>";
    echo "<td>" . $row['disk'] . "</td>";
    echo "</tr>";

 
}

}

echo "</table>"; 
?>
<link rel='stylesheet' type='text/css' href='stylesheet.css'/>

<form method ="POST" ACTION="">
<p>cpu</p>
<input type="text" placeholder="upper limit" name="cpu_min"><br>
<input type="text" placeholder="lower limit" name="cpu_max"><br>
<p>memory</p>
<input type="text" placeholder="upper limit" name="memory_min"><br>
<input type="text" placeholder="lower limit" name="memory_max"><br>
<p>network input</p>
<input type="text" placeholder="upper limit" name="networkinput_min"><br>
<input type="text" placeholder="lower limit" name="networkinput_max"><br>
<p>network output</p>
<input type="text" placeholder="upper limit" name="networkoutput_min"><br>
<input type="text" placeholder="lower limit" name="networkoutput_max"><br>
<p>disk</p>
<input type="text" placeholder="upper limit" name="disk_min"><br>
<input type="text" placeholder="lower limit" name="disk_max"><br>

<td colspan="2"><input type="submit" value="Update"></td>
</form>

</html>
