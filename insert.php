<?session_start();
include("function_file.php");
function convertDate($d){//convert js date to mysql date format (yr-mo-day)
$timestamp = strtotime($d);
$date = date('Y-m-d', $timestamp);
return $date;
}

$dbname = get_db();
$conn=get_conn($dbname);

//check for training data
if(isset($_GET['video_url'])){
	$horse_key=$_GET['horse_key'];
	$facility_key=$_GET['facility_key'];
	$trainer_key=$_GET['trainer_key'];
	$student_key=$_GET['student_key'];
	$training_date=$_GET['training_date'];
	$goal=$_GET['goal'];
	$comment=$_GET['comment'];
	$video_url=$_GET['video_url'];
	if($training_date!=''){
		$insert_sql = ("INSERT INTO training VALUES (NULL,'$student_key','$horse_key','$trainer_key','$facility_key','$training_date','$goal',$comment','$video_url')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "Training Comments Logged   <input type='hidden' name='active_div' id='active_div' value='1' /><input id='reload_training' type ='submit' name ='reload_training' class= 'btn btn-info' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
	}
}
if(isset($_GET['blood'])&&isset($_GET['horse_key'])){
	$horse_key= $_GET['horse_key'];
	$date=convertDate($_GET['date']);
	/*
	if(isset($date)){
		$insert_sql1 = ("UPDATE  `information` SET `update` = $date WHERE `key` ='$horse_key' LIMIT 1");
		$ins1= mysql_query($insert_sql1) or die(mysql_error());
	}
	*/
	$vet_key= $_GET['vet_key'];
	$blood= $_GET['blood'];
	$next_date =convertDate($_GET['next_date']);
	$fecal= $_GET['fecal'];
	$sheath= $_GET['sheath'];
	
	$teeth= $_GET['teeth'];
	$vaccination= $_GET['vaccination'];
	$radiograph= $_GET['radiograph'];
	$temperature= $_GET['temperature'];
	if(isset($temperature)){
		$insert_sql2 = ("UPDATE  `information` SET `temperature` = '$temperature' WHERE `key` ='$horse_key' LIMIT 1");
		$ins2= mysqli_query($conn, $insert_sql2) or die(mysqli_error());
	}
	$pulse= $_GET['pulse'];
	if(isset($pulse)){
		$insert_sql3 = ("UPDATE  `information` SET `pulse` = '$pulse' WHERE `key` ='$horse_key' LIMIT 1");
		$ins3= mysqli_query($conn, $insert_sql3) or die(mysqli_error());
	}
	$respiration= $_GET['respiration'];
	if(isset($respiration)){
		$insert_sql4 = ("UPDATE  `information` SET `respiration` = '$respiration' WHERE `key` ='$horse_key' LIMIT 1");
		$ins4= mysqli_query($conn, $insert_sql4) or die(mysqli_error());
	}
	$right_eye= $_GET['right_eye'];
	$left_eye= $_GET['left_eye'];
	$fitness= $_GET['fitness'];
	$coat= $_GET['coat'];
	$gait= $_GET['gait'];
	$comments= $_GET['comments'];

	if($horse_key!=''&&$date!=''&&$vet_key!=''&&$next_date!=''){
		$insert_sql = ("INSERT INTO physical VALUES (NULL,'$horse_key','$date','$next_date','$vet_key','$blood','$fecal','$sheath','$teeth','$vaccination','$radiograph','$temperature','$pulse','$respiration','$right_eye','$left_eye','$fitness','$coat','$gait','$comments','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "Physical information entered   <input type='hidden' name='active_div' id='active_div' value='1' /><input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in at least Vet and Dates!!!  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}
//check for horse information or UPDATE horse info
}elseif(isset($_GET['horse_record'])){
	$horse_record= $_GET['horse_record'];
	$horse_key= $_GET['horse_key'];
	$horse_image=$_GET['horse_image'];
	$horse_name= $_GET['horse_name'];
	$owner_key= $_GET['owner_key'];
	$contact= $_GET['contact'];
	$vet_key= $_GET['vet_key'];
	$farrier_key= $_GET['farrier_key'];
	$breed= $_GET['breed'];
	$birth=$_GET['birth'];
	$height= $_GET['height'];
	$weight= $_GET['weight'];
	$temp= $_GET['temp'];
	$heart= $_GET['heart'];
	$resp= $_GET['resp'];
	$vices= $_GET['vices'];
	$considerations= $_GET['considerations'];
	$brand= $_GET['brand'];
	$markings= $_GET['markings'];
	$color= $_GET['color'];
	$sex= $_GET['sex'];
	$stall= $_GET['stall'];
	
	$vet_key= $_GET['vet_key'];
	if($horse_record=="new"){
		$insert_sql = ("INSERT INTO information VALUES (NULL,'$horse_name','$owner_key','$contact','$vet_key','$farrier_key','$horse_image','$breed','$birth','$height','$weight','$temp','$heart','$resp','$vices','$considerations','$brand','$markings','$color','$sex','$stall','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "Information for ".$horse_name." uploaded <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}elseif($horse_record=="update"||$horse_record=="role"){
		$insert_sql = ("UPDATE  `information` SET  `horse_name` =  '$horse_name',
			`owner_key` =  '$owner_key',
			`owner_phone_number` =  '$contact',
			`vet_key` =  '$vet_key',
			`farrier_key` =  '$farrier_key',
			`horse_image` =  '$horse_image',
			`breed` =  '$breed',
			`date_foaled` =  '$birth',
			`height` =  '$height',
			`weight` =  '$weight',
			`temperature` =  '$temp',
			`pulse` =  '$heart',
			`respiration` =  '$resp',
			`vices` =  '$vices',
			`special_medical_conditions` =  '$considerations',
			`tatoo_or_brand` =  '$brand',
			`markings` =  '$markings',
			`color` =  '$color',
			`sex` =  '$sex',
			`stall` =  '$stall' WHERE `key` ='$horse_key' LIMIT 1");
$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
print " information updated! <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}	
}elseif(isset($_GET['vac_type'])){//enter vaccination data
	$horse_key= $_GET['horse_key'];
	$vet_key= $_GET['vet_key'];
	$type= $_GET['vac_type'];
	$type2= $_GET['vac_type2'];
	$type3= $_GET['vac_type3'];
	$date=convertDate($_GET['date']);
	$next_date=convertDate($_GET['next_date']);
	if($horse_key!=''&&$type!=''&&$date!=''&&$next_date!=''){
		$insert_sql = ("INSERT INTO vaccination VALUES (NULL,'$horse_key','$date','$vet_key','$next_date','$type')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		if($type2!='none'){
			$insert_sql2 = ("INSERT INTO vaccination VALUES (NULL,'$horse_key','$date','$vet_key','$next_date','$type2')");
			$insert2= mysqli_query($conn, $insert_sql2) or die(mysqli_error());
		}
		if($type3!='none'){
			$insert_sql3 = ("INSERT INTO vaccination VALUES (NULL,'$horse_key','$date','$vet_key','$next_date','$type3')");
			$insert3= mysqli_query($conn, $insert_sql3) or die(mysqli_error());
		}
		print "     New Vaccination Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all vac. fields!";
	}
}
elseif(isset($_GET['fecal'])){//enter FECAL data
	$horse_key= $_GET['horse_key'];
	$key= $_GET['keu'];
	$fecal= $_GET['fecal'];

	if($horse_key!=''&&$type!=''&&$date!=''&&$next_date!=''){
		$insert_sql = ("UPDATE  `physical` SET  `fecal_sampled` =  '$fecal' WHERE `key` ='$key' LIMIT 1");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());	
		print "     New Fecal Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all vac. fields!";
	}
}elseif(isset($_GET['parasite'])){//enter PARASITE data
	$horse_key= $_GET['horse_key'];
	$vet_key= $_GET['vet_key'];
	$type= $_GET['type'];
	$date=convertDate($_GET['date']);
	$next_date=convertDate($_GET['next_date']);
	$comments= $_GET['comment'];
	if($horse_key!=''&&$type!=''&&$date!=''&&$next_date!=''){
		$insert_sql = ("INSERT INTO parasite VALUES (NULL,'$horse_key','$date','$vet_key','$next_date','$type','$comments')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());	
		print "     New Parasite Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all vac. fields!";
	}
}
elseif(isset($_GET['dental'])){//enter dental data
	$horse_key= $_GET['horse_key'];
	$procedure= $_GET['procedure'];
	$date=convertDate($_GET['date']);
	$next_date=convertDate($_GET['next_date']);
	$vet_key= $_GET['vet_key'];
	$comments= $_GET['comment'];
	if($horse_key!=''&&$procedure!=''&&$date!=''&&$next_date!=''){
		$insert_sql = ("INSERT INTO dental VALUES (NULL,'$horse_key','$date','$vet_key','$procedure','$next_date','$_SESSION[facility]','$comments')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());	
		print "     New Dental Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all vac. fields!";
	}
}elseif(isset($_GET['farrier'])){//enter farrier data
	$horse_key= $_GET['horse_key'];
	$procedure= $_GET['procedure'];
	$comments= $_GET['comments'];
	$date=convertDate($_GET['date']);
	$next_date=convertDate($_GET['next_date']);
	$vet_key= $_GET['vet_key'];
	if($horse_key!=''&&$procedure!=''&&$date!=''&&$next_date!=''){
		$insert_sql = ("INSERT INTO farrier VALUES (NULL,'$horse_key','$date','$next_date','$vet_key','$procedure','$comments','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());	
		print "     New Farrier Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Page' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all farrier. fields!";
	}
}elseif(isset($_GET['fecal_count'])){//update fecal count data data
	$horse_key= $_GET['phorse_key'];
	$key= $_GET['pfecal_key'];
	$count=$_GET['fecal_count'];
		$update_sql= ("UPDATE `physical` SET  `fecal_sampled` =  '$count' WHERE  `key` ='$key' LIMIT 1") ;
		$update= mysqli_query($conn, $update_sql) or die(mysqli_error());
	header("Location:index.php");	

}elseif(isset($_GET['history'])){//enter new medical history  data
	$horse_key= $_GET['horse_key'];
	$comment= $_GET['comment'];
	$date=convertDate($_GET['date']);
	if($comment!=''){
		$insert_sql = ("INSERT INTO medical_history VALUES (NULL,'$date','$comment','$horse_key')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());	
		print "     New Medical Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in event description!";
	}
}elseif(isset($_GET['new_owner'])){//enter new owner data
	$horse_key= $_GET['horse_key'];
	$vet_key= $_GET['vet_key'];
	$first_name= $_GET['first_name'];
	$last_name= $_GET['last_name'];
	$street_address= $_GET['street_address'];
	$city= $_GET['city'];
	$state= $_GET['state'];
	$zip= $_GET['zip'];
	$phone= $_GET['phone'];
	if($first_name!=''&&$last_name!=''&&$street_address!=''&&$city!=''&&$state!=''&&$zip!=''&&$phone!=''){
		$insert_sql = ("INSERT INTO owner VALUES (NULL,'$first_name','$last_name','$street_address','$city','$state','$zip','$phone','$horse_key','$vet_key','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "     New Owner Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all owner fields!";
	}
}elseif(isset($_GET['new_vet'])){//enter new vet data
	$horse_key= $_GET['horse_key'];
	$first_name= $_GET['first_name'];
	$last_name= $_GET['last_name'];
	$street_address= $_GET['street_address'];
	$city= $_GET['city'];
	$state= $_GET['state'];
	$zip= $_GET['zip'];
	$phone= $_GET['phone'];
	$email= $_GET['email'];
	$access= $_GET['access'];
	$password= $_GET['pass'];
	if($first_name!=''&&$last_name!=''&&$street_address!=''&&$city!=''&&$state!=''&&$zip!=''&&$phone!=''){
		$insert_sql = ("INSERT INTO vet VALUES (NULL,'$first_name','$last_name','$street_address','$city','$state','$zip','$phone','$horse_key','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		$insert_sql1 = ("INSERT INTO login VALUES (NULL,'$password','$first_name','$last_name','$access','$email','$_SESSION[facility]')");
		$insert1= mysqli_query($conn, $insert_sql1) or die(mysqli_error());
		print "     New Vet Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all owner fields!";
	}
}elseif(isset($_GET['new_farrier'])){//enter new vet data
	$horse_key= $_GET['horse_key'];
	$first_name= $_GET['first_name'];
	$last_name= $_GET['last_name'];
	$street_address= $_GET['street_address'];
	$city= $_GET['city'];
	$state= $_GET['state'];
	$zip= $_GET['zip'];
	$phone= $_GET['phone'];
	$email= $_GET['email'];
	$access= $_GET['access'];
	$password= $_GET['pass'];
	if($first_name!=''&&$last_name!=''&&$street_address!=''&&$city!=''&&$state!=''&&$zip!=''&&$phone!=''){
		$insert_sql = ("INSERT INTO farrierdata VALUES (NULL,'$first_name','$last_name','$street_address','$city','$state','$zip','$phone','$horse_key','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		$insert_sql1 = ("INSERT INTO login VALUES (NULL,'$password','$first_name','$last_name','$access','$email','$_SESSION[facility]')");
		$insert1= mysqli_query($conn, $insert_sql1) or die(mysqli_error());
		print "     New Farrier Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all owner fields!";
	}
}elseif(isset($_GET['access'])){//enter new admin data
	$password= $_GET['password'];
	$sql1="SELECT password FROM login ";
	$checksql=mysqli_query($conn, $sql1) or die (mysqli_error());
	$taken=0;
	while($row = mysqli_fetch_array($checksql)){
		if($row[password]==$password){
			$taken=1;
			break;
		}	
	}
	if($taken==1){
		print $password." Taken - please choose another password <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
	$first_name= $_GET['first_name'];
	$last_name= $_GET['last_name'];
	$access=$_GET['access'];
	$email=$_GET['email'];
	
	$address= $_GET['address'];
	$city= $_GET['city'];
	$state= $_GET['state'];
	$zip= $_GET['zip'];
	$phone= $_GET['phone'];
	$email= $_GET['email'];
	$role=$_GET['role'];
	if($first_name!=''&&$last_name!=''&&$access!=''&&$password!=''){
		$insert_sql = ("INSERT INTO login VALUES (NULL,'$password','$first_name','$last_name','$address','$city','$state','$zip','$phone','$email','$access','$role','$_SESSION[facility]')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "     New Admin Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all admin fields!";
	}
	}//end password check if	
}elseif(isset($_GET['facilityname'])){//enter new facility data
	$name= $_GET['facilityname'];
	$owner= $_GET['owner'];
	$address=$_GET['address'];
	$phone= $_GET['phone'];
	print "hi";
	if($name!=''&&$phone!=''){
		$insert_sql = ("INSERT INTO facility VALUES (NULL,'$name','$owner','$address','$phone')");
		$insert= mysqli_query($conn, $insert_sql) or die(mysqli_error());
		print "     New Facility Information Entered  <input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
	}else{
		print "Please fill in all admin fields!";
	}	
}

mysqli_close($conn);
?>