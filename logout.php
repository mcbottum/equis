<?session_start();
session_unset();
//session_destroy();
//$_SESSION = array();
$_SESSION['passwordcheck']='';
//print "hi";
//header(“Pragma: no-cache”);
header("Location:index.php");
?>