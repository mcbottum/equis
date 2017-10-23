<?session_start();
include("function_file.php");
$_SESSION['passwordcheck']='fail';

	if($_GET['sendemailfirst']!=''){
		$sendemailfirst=$_GET['sendemailfirst'];
		$sendemaillast=$_GET['sendemaillast'];
		if($sendemailfirst&&$sendemaillast){	
			$conn=get_conn();
			$db=get_db();
			$sendemailfirst=mysql_real_escape_string($sendemailfirst,$conn);
			$sendemaillast=mysql_real_escape_string($sendemaillast,$conn);
			$sql1="SELECT * FROM login WHERE `first_name` = '$sendemailfirst' AND `last_name` = '$sendemaillast'";	
			mysql_select_db($db);
			$session1=mysql_query($sql1,$conn);
			if($session1){
				if($row1=mysql_fetch_assoc($session1)){
					$to = $row1['email'];
					$subject = "Password for Caval-Connect";
					$message = "Your password for Caval-Connect login is ".$row1[password]." You must reset your browser to log in";
					$from = "caval-connect.com";
					$headers = "From:" . $from;
					mail($to,$subject,$message,$headers);
					$_SESSION['attempt']=0;
					print "Mail Sent";
				}

			}else{
				print ", sorry, no password on file";
				
				
			}

			mysql_close($conn);
		}else{

	}

	}

	
	?>