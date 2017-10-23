<?session_start();
include("function_file.php");

function getReminders($table,$horse,$db){//get reminders for the next 4 days
	$conn=get_conn();
	mysql_select_db($db);
	$today=date('Y-m-d');
	$future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$today")) . " +4 days"));
	$sql_p="SELECT * FROM `$table` WHERE `next_date` BETWEEN '$today' AND '$future'";
	$p_result=mysql_query($sql_p, $conn) or die(mysql_error());
	while($row = mysql_fetch_array($p_result)){
		$p_table[]=$row;
	}
	return $p_table;
	mysql_close($conn);
}
$physicals=getReminders("physical",1,"equis");
$vaccinations=getReminders("vaccination",1,"equis");
$dental=getReminders("dental",1,"equis");
$horse_data=GetTableData("key","ALL", "information", $dbname);

function getHorseName($horse_key,$horse_data){
	foreach($horse_data as $h){
		if($h[key]==$horse_key){
			$horse=$h[horse_name];
		}
	}
	return $horse;
}
		
print "<table id='3days'>";
if($physicals){
	print"<tr><td>Physicals</td></tr>";
		foreach($physicals as $data){
			print "<tr>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".$data[next_date]."</td>";
			print "</tr>";
		}
}else{
	print"<tr><td>No Scheduled Physicals</td></tr>";
}
if($vaccinations){
	print"<tr><td>vaccinations</td></tr>";
		foreach($vaccinations as $data){
			print "<tr>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".$data[next_date]."</td>";
			print "</tr>";
		}
}else{
	print"<tr><td>No Scheduled Vaccinations</td></tr>";
}
if($dental){
	print"<tr><td>Dental</td></tr>";
		foreach($dental as $data){
			print "<tr>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".$data[next_date]."</td>";
			print "</tr>";
		}
}else{
	print"<tr><td>No Scheduled Dental</td></tr>";
}
print "</table>";
?>