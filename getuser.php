<?php
$q=$_GET["q"];
$div=$_GET['div'];

$dbname = 'equis';
$conn=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db($dbname);
/**/


mysql_select_db($dbname, $conn);

$sql_physical="SELECT * FROM physical WHERE horse_key = '$q'";
/*$sql_coggins="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_vaccinations="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_parasites="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_lineage="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_medical_history="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_dental="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_farrier="SELECT * FROM physical WHERE horse_key = '$q'";
$sql_nutrition="SELECT * FROM physical WHERE horse_key = '$q'";
*/
$result = mysql_query($sql_physical);

while($row = mysql_fetch_array($result))
  {
  	  
  	   print "<h3>".$row['date']."</h3>";
  	   print "<div>";
  	   print "<p>";
  	   print " hi there";
  	   print "</p>";
  	   print "</div>";
  }
mysql_close($conn);
?>