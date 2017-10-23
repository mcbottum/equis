<?session_start();
include("function_file.php");
$db = get_db();
$conn=get_conn();
mysql_select_db(get_db(), get_conn());
	$record_key= $_GET['record_key'];
	$table= $_GET['table'];
	//print $table;
	//print $record_key;
	//if($record_key!=''&&$table!=''){
		$delete_sql=("DELETE FROM $table WHERE `key` = '$record_key' LIMIT 1");
		if (table=="information"){
			$delete_sql1=("DELETE FROM coggins WHERE `horse_key` = '$record_key' LIMIT 1");
			$delete_sql2=("DELETE FROM dental WHERE `horse_key` = '$record_key'");
			$delete_sql3=("DELETE FROM farrier WHERE `horse_key` = '$record_key'");
			$delete_sql4=("DELETE FROM image WHERE `horse_key` = '$record_key'");
			$delete_sql5=("DELETE FROM lineage WHERE `horse_key` = '$record_key' LIMIT 1");
			$delete_sql6=("DELETE FROM medical_history WHERE `horse_key` = '$record_key'");
			$delete_sql7=("DELETE FROM parasite WHERE `horse_key` = '$record_key'");
			$delete_sql8=("DELETE FROM physical WHERE `horse_key` = '$record_key'");
			$delete_sql9=("DELETE FROM vaccination WHERE `horse_key` = '$record_key'");
			$sql1=mysql_query($delete_sql1) or die(mysql_error());
			$sql2=mysql_query($delete_sql2) or die(mysql_error());
			$sql3=mysql_query($delete_sql3) or die(mysql_error());
			$sql4=mysql_query($delete_sql4) or die(mysql_error());
			$sql5=mysql_query($delete_sql5) or die(mysql_error());
			$sql6=mysql_query($delete_sql6) or die(mysql_error());
			$sql7=mysql_query($delete_sql7) or die(mysql_error());
			$sql8=mysql_query($delete_sql8) or die(mysql_error());
			$sql9=mysql_query($delete_sql9) or die(mysql_error());			
		}
			
		$sql=mysql_query($delete_sql) or die(mysql_error());
		mysql_close($conn);
		print " deleted  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info btn-mini' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
//header("Location:index.php");
?>