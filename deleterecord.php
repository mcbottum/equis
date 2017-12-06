<?session_start();
include("function_file.php");
$db = get_db();
$conn=get_conn($db);
$record_key= $_GET['record_key'];
$table= $_GET['table'];
//print $table;
//print $record_key;
//if($record_key!=''&&$table!=''){
// TODO !!!!!!
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
		$sql1=mysqli_query($conn, $delete_sql1) or die(mysqli_error());
		$sql2=mysqli_query($conn, $delete_sql2) or die(mysqli_error());
		$sql3=mysqli_query($conn, $delete_sql3) or die(mysqli_error());
		$sql4=mysqli_query($conn, $delete_sql4) or die(mysqli_error());
		$sql5=mysqli_query($conn, $delete_sql5) or die(mysqli_error());
		$sql6=mysqli_query($conn, $delete_sql6) or die(mysqli_error());
		$sql7=mysqli_query($conn, $delete_sql7) or die(mysqli_error());
		$sql8=mysqli_query($conn, $delete_sql8) or die(mysqli_error());
		$sql9=mysqli_query($conn, $delete_sql9) or die(mysqli_error());			
	}
		
$sql=mysqli_query($conn, $delete_sql) or die(mysqli_error());
mysqli_close($conn);
print " deleted  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info btn-mini' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
//header("Location:index.php");
?>