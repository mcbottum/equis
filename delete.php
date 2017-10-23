<?session_start();
include("function_file.php");
$db = get_db();
$conn=get_conn();
mysql_select_db(get_db(), get_conn());
	$record_key= $_GET['record_key'];
	$table= $_GET['table'];
	print $table;
	print $record_key;
	//if($record_key!=''&&$table!=''){
		$delete_sql=("DELETE FROM $table WHERE `key` = '$record_key' LIMIT 1");
		$sql=mysql_query($delete_sql) or die(mysql_error());
		header("Location:index.php");
		

mysql_close($conn);
?>