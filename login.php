<?session_start();
include("function_file.php");
$_SESSION['passwordcheck']='fail';
if(!isset($_SESSION['attempt'])){
	$_SESSION['attempt']=1;
}
	if($_REQUEST['passcheck']!=''){
		$password=$_REQUEST["passcheck"];
		if($password){	
			$db=get_db();
			$conn=get_conn($db);
			$password=mysqli_real_escape_string($conn, $password);
			$sql1="SELECT * FROM login WHERE password='$password'";	
			// mysql_select_db($db);
			$session1=mysqli_query($conn, $sql1);
				if($row1=mysqli_fetch_assoc($session1)){
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
			mysqli_free_result($session1);
			mysqli_close($conn);
		}else{
	}
	}//if password
	header("Location:index.php");
	
	?>