<?session_start();
function get_db(){
	$db='equis'; //home
	//$db=abaits5_equis;//server
	return $db;
}
function get_conn(){
	$conn=mysql_connect("localhost","root","") or die(mysql_error());//home
	//$conn=mysql_connect("localhost","abaits5_mcbottum","annakai1") or die(mysql_error());//server
	return $conn;
}
function GetMysqlFieldNames($Table, $db){
	$conn=get_conn();
	mysql_select_db($db);
	$field_names="SHOW COLUMNS FROM $Table";
	$fields=mysql_query($field_names,$conn);
	while($columns = mysql_fetch_array($fields)){ 
			$field_labels[]=$columns[0];
	}
return $field_labels;
mysql_close($conn);
}
function GetProductTableData($field,$ID,$Table,$db){
	$conn=get_conn();
	mysql_select_db($db);
	$sql="SELECT * FROM $Table ";
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	mysql_close($conn);	
}
function GetTableDataFacility($field,$ID,$Table,$db, $facility){
	$conn=get_conn();
	mysql_select_db($db);
	if($ID=="ALL"){
		if($_SESSION[facility]=='ALL'){
			$sql="SELECT * FROM $Table ";
		}else{
			$sql="SELECT * FROM $Table WHERE `facility_key`='$facility'";
		}
	}elseif($field=="key"&&$ID!='ALL'){
		if($_SESSION[facility]=='ALL'){
			$sql="SELECT * FROM $Table WHERE `key` ='$ID'";
		}else{
			$sql="SELECT * FROM $Table WHERE `key` ='$ID' AND `facility_key`='$facility'";
		}
	}elseif($field=="horse_key"){
		$sql="SELECT * FROM $Table WHERE horse_key ='$ID' AND `facility_key`='$facility'";
	}elseif($field=='infection'){
		$sql="SELECT * FROM $Table WHERE infection ='$ID' AND `facility_key`='$facility'";
	}elseif($field=='data_key'){//choose image file
		$sql="SELECT * FROM $Table WHERE data_key ='$ID' AND `facility_key`='$facility'";
	}elseif($field=='vet_key'){//choose image file
		$sql="SELECT * FROM login WHERE `key` ='$ID' AND `facility_key`='$facility'";
	}elseif($field=='vet'||$field=='farrier'||$field=='owner'){//choose image file
		$sql="SELECT * FROM login WHERE `role` ='$field' AND `facility_key`='$facility'";
	}
	
	$result = mysql_query($sql, $conn);
	if($result){
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	}
	return $tableResults;
	mysql_close($conn);
}

function GetTableData($field,$ID,$Table,$db){
	$conn=get_conn();
	mysql_select_db($db);
if($field=="horse_key"){
		$sql="SELECT * FROM $Table WHERE horse_key ='$ID' ";
	}elseif($field=='infection'){
		$sql="SELECT * FROM $Table WHERE infection ='$ID' ";
	}elseif($field=='data_key'){//choose image file
		$sql="SELECT * FROM $Table WHERE data_key ='$ID' ";
	}elseif($field=='vet_key'){//choose image file
		$sql="SELECT * FROM login WHERE `key` ='$ID' ";
	}
	
	$result = mysql_query($sql, $conn);
	if($result){
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	}
	return $tableResults;
	mysql_close($conn);
}

function GetRoleTableData($field,$ID,$Table,$facillity,$db){
	$conn=get_conn();
	mysql_select_db($db);
	if($ID=='ALL'){
	$sql="SELECT * FROM $Table WHERE `facility_key`='$_SESSION[facility]' ORDER BY `horse_name` ";		
	}else{
	$sql="SELECT * FROM $Table WHERE `facility_key`='$_SESSION[facility]' AND (`owner_key` = '$ID' or `farrier_key` = '$ID' or `vet_key` = '$ID') ORDER BY `horse_name` ";
	}
	$result = mysql_query($sql, $conn);
	if($result){
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	}else{return;
	}
	mysql_close($conn);	
}
function GetOwnerKeyData($ID,$Table,$db){
	$conn=get_conn();
	mysql_select_db($db);
	$sql="SELECT * FROM $Table WHERE owner_key='$ID'";
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	mysql_close($conn);
}

function GetFilterData($field,$Table,$facility,$db){
	$conn=get_conn();
	mysql_select_db($db);
	
	$sql="SELECT * FROM $Table WHERE `facility_key`='$facility'  ORDER BY `last_name` ";		

	$result = mysql_query($sql, $conn);
	if($result){
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	}else{return;
	}
	mysql_close($conn);	
}


function GetHorsesFromAppt($Table,$time,$facility,$db){
	$facility=1;
	$conn=get_conn();
	mysql_select_db($db);
    $today=date('Y-m-d');
	$future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$today")) . " +2 days"));	
	$sql="SELECT `horse_key`, `vet_key` FROM $Table WHERE  `next_date` BETWEEN '$today' AND '$future' AND `facility_key`='$facility' ";		

	$result = mysql_query($sql, $conn);
	if($result){
		while($row = mysql_fetch_array($result)){
			$tableResults[]=$row;
		}


		if($tableResults){
		foreach($tableResults as $horse_key){
			$horse_key_array[]=$horse_key['horse_key'];
		}
		$sql1="SELECT * FROM `information` WHERE `key` IN('".join("','", $horse_key_array)."')"; 
		$result1 = mysql_query($sql1, $conn);
		if($result1){
			while($row1 = mysql_fetch_array($result1)){
				$tableResults1[]=$row1;
			}

			return $tableResults1;
		}
		}
	}else{
		return;
	}
	
}


function getRoles($facility){
	$conn=get_conn();
	mysql_select_db($db);
$sql2="SELECT `key`,`first_name`,`last_name`,`role` FROM `login` WHERE `facility_key`='$facility' AND (`role`='owner' OR `role`='vet' OR `role`='farrier' OR `role`='manager')  ORDER BY role, last_name";
	$result = mysql_query($sql2,$conn) or die(mysql_error());
	if($result){
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	
	return $tableResults;
	}else{return;
	}
	mysql_close($conn);	
}

function getReminders($table,$horse,$db, $facility){//get reminders for the next 4 days
	$conn=get_conn();
	mysql_select_db($db);
	$today=date('Y-m-d');
	$future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$today")) . " +4 days"));
	$sql_p="SELECT * FROM `$table` WHERE `next_date` BETWEEN '$today' AND '$future' AND `facility_key`='$facility' ";
	$p_result=mysql_query($sql_p, $conn) or die(mysql_error());
	while($row = mysql_fetch_array($p_result)){
		$p_table[]=$row;
	}
	return $p_table;
	mysql_close($conn);
}
function getHorseName($horse_key,$horse_data){
	foreach($horse_data as $h){
		if($h[key]==$horse_key){
			$horse=$h[horse_name];
		}
	}
	return $horse;
}
function getName($key, $table){
	$conn=get_conn();
	mysql_select_db($db);
	$sql="SELECT * FROM `$table` WHERE `key`='$key'";
	
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$results[]=$row;
	}
	if($results[0]['first_name']){
		$name=$results[0]['first_name']." ".$results[0]['last_name'];
	}elseif($results[0]['name']){
		$name=$results[0]['name'];
	}
	return $name;
	mysql_close($conn);
}

function checkRole($key, $table){
	$conn=get_conn();
	mysql_select_db($db);
	$sql="SELECT role FROM `$table` WHERE `key`='$key'";
	
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$results[]=$row;
		
	}
	if($results[0]['role']){
		$role=$results[0]['role'];
	}
	return $role;
	mysql_close($conn);
}

function deleteRecord($recordKey,$table){
	$conn=get_conn();
	mysql_select_db($db,$conn);
	mysql_query("DELETE * FROM $table WHERE `key` = '$recordKey'") or die(mysql_error());
	mysql_close($conn);
	return "Data Successfully Deleted";
	//<input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
}

function build_footer(){
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);
	?><div class= "footer"><p>&nbsp;Copyright &copy; 2012 Caval-Connect<br><a href='mailto:questions@caval-connect.com?subject=Contact Caval-Connect'>Contact Caval-Connect</a></br><a href='Caval-Connect_Privacy_Policy.html' target="_blank">Privacy Policy</a></p></div>
	<?}
	
?>