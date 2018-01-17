<?session_start();
include("function_file.php");
$horse_key=$_REQUEST['horse_key'];
$image_key=$_REQUEST['image_key'];
$description=$_REQUEST['description'];
$tab_name = $_REQUEST['tab_name'];
$_REQUEST['record_key'];
if(isset($_REQUEST['date'])){
	$date=$_REQUEST['date'];
}else{
	$date = date("Y-m-d H:i:s");
}
if(isset($_REQUEST['content'])){
	$content=$_REQUEST['content'];
}else{
	$content = "";
}
if(isset($_REQUEST['record_key'])){
	$record_key=$_REQUEST['record_key'];
}else{
	$record_key = 0;
}
$target_dir = "img/".$tab_name."/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$allowedExts = array("jpg", "jpeg", "gif", "png", "pdf");
$extension = end(explode(".", $_FILES["file"]["name"]));

if ($_FILES["file"]["size"] < 20000000 && in_array($extension, $allowedExts)){
  if ($_FILES["file"]["error"] > 0){
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }else{
      $img="img/".$_FILES["file"]["name"];
      $img=str_replace(' ','_',$img);
      $dbname = get_db();
	  $conn=get_conn($dbname);
	  $img=str_replace(' ','_',$target_file);
	  if($tab_name=='coggins' || $tab_name=='lineage'){
	  	if($image_key>0){
	  		//print $img;
	  		$sql = ("UPDATE $tab_name SET  `image` =  '$img', `date` =  '$date' WHERE `key` ='$image_key' LIMIT 1") ;
	  	}elseif($image_key==0){
	  		$sql = ("INSERT INTO $tab_name VALUES (NULL,'$horse_key','$img','$date')");	  	
	  	}
	  }elseif($tab_name=='information'){
	  	$sql = ("UPDATE $tab_name SET  `image` =  '$target_file' WHERE `key` ='$horse_key' LIMIT 1") ;
	  }else{

		$sql = ("INSERT INTO image VALUES (NULL,'$img','$description','$tab_name', '$content','$record_key','$horse_key')");
	  	
	  }
	  $insert=mysqli_query($conn,$sql) or die(mysqli_error());
      move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);
    }
  }else{
  	echo "Invalid file";
  }
  header("Location:index.php");
?>