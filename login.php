<?session_start();
include("function_file.php");
$_SESSION['passwordcheck']='fail';
if(!isset($_SESSION['attempt'])){
	$_SESSION['attempt']=1;
}
	if($_REQUEST['passcheck']!=''){
		$password=$_REQUEST["passcheck"];
		if($password){	
			$conn=get_conn();
			$db=get_db();
			$password=mysql_real_escape_string($password,$conn);
			$sql1="SELECT * FROM login WHERE password='$password'";	
			mysql_select_db($db);
			$session1=mysql_query($sql1,$conn);
				if($row1=mysql_fetch_assoc($session1)){
							$_SESSION['first']=$row1['first_name'];
							$_SESSION['last']=$row1['last_name'];
							$_SESSION['passwordcheck']='pass';
							$_SESSION['access']=$row1['access'];
							$_SESSION['facility']=$row1['facility_key'];
							$_SESSION['attempt']=0;
				}else{
					$_SESSION['passwordcheck']='fail';
					$_SESSION['attempt']++;
				
				}
			mysql_close($conn);
		}else{
	}
	}//if password
	header("Location:index.php");
	
	?>