<?php
$q=$_GET["q"];

$dbname = 'equis';
$conn=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db($dbname);
/**/
$horse_key=$_REQUEST['horse'];
$owner_key=$_REQUEST['owner'];

mysql_select_db("equis", $con);

$sql="SELECT * FROM physical WHERE $horse_key = '".$q."'";

$result = mysql_query($sql);

echo "<table border='1'>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['date'] . "</td>";
  echo "</tr>";
  }
echo "</table>";

mysql_close($con);
?>