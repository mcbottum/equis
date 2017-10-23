<?session_start();
include("function_file.php");
$horse_key=$_REQUEST['horse_key'];
$image_key=$_REQUEST['image_key'];
$description=$_REQUEST['description'];
$data_type=$_REQUEST['data_type'];
$folder="img";
if($data_type=='xray'){
	$description=$_REQUEST['xdescription'];
}elseif($data_type=='dimage'){
	$description=$_REQUEST['ddescription'];
}elseif($data_type=='blood_panel'){
	$description=$_REQUEST['bdescription'];
}
$submit_file=$_REQUEST['submit_xray'];
$submit_file=$_REQUEST['submit_coggins'];
$xray=$_REQUEST['submit_xray'];
$table=$_REQUEST['table'];
$image=$_REQUEST['image_type'];

if($table=="physical"){
	$folder="img/physicalimg";
}elseif($table=="coggins"){
	$date=$_REQUEST['cyear']."-".$_REQUEST['cmonth']."-".$_REQUEST['cday'];
	$image_key=$_REQUEST['cimage_key'];
	$folder="img/cogginsimg";
}elseif($table=="lineage"){
	$date=$_REQUEST['lyear']."-".$_REQUEST['lmonth']."-".$_REQUEST['lday'];
	$image_key=$_REQUEST['limage_key'];
	$folder="img/lineageimg";
}elseif($table=="dental"){
	$folder="img/dentalimg";
}	
$allowedExts = array("jpg", "jpeg", "gif", "png", "pdf");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    //print $expiration;
    //print $horse_key;
    //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    //echo "Type: " . $_FILES["file"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
    //print $table;
    //print $image_key;	
    
      $img="img/".$_FILES["file"]["name"];
      $img=str_replace(' ','_',$img);
      $dbname = get_db();
	  $conn=get_conn();
	  mysql_select_db($dbname);
	  if($table=="information"){
	  	$img="img/".$_FILES["file"]["name"];
      	$img=str_replace(' ','_',$img);
	  	$sql = ("UPDATE $table SET `horse_image` = '$img' WHERE `key` = '$horse_key'");
	  }elseif($table=="physical"){
	  	$img=$folder."/".$_FILES["file"]["name"];
      	$img=str_replace(' ','_',$img);
	  	$sql = ("INSERT INTO image VALUES (NULL,'$img','$description','$data_type','$image_key','$horse_key')");
	  }elseif($table=="dental"){
	  	$img=$folder."/".$_FILES["file"]["name"];
      	$img=str_replace(' ','_',$img);
	  	$sql = ("INSERT INTO image VALUES (NULL,'$img','$description','$data_type','$image_key','$horse_key')");
	  }elseif($table=="coggins"){
	  	$img=$folder."/".$_FILES["file"]["name"];
      	$img=str_replace(' ','_',$img);
	  	if($image_key>0){
	  		//print $img;
	  		$sql=("UPDATE `coggins` SET  `image` =  '$img', `date` =  '$date' WHERE `key` ='$image_key' LIMIT 1") ;
	  		//$sql = ("UPDATE $table SET image = '$img' AND date = '$date' WHERE `key` = '$image_key'");
	  	}elseif($image_key==0){
	  		$sql = ("INSERT INTO $table VALUES (NULL,'$horse_key','$img','$date')");	  	
	  	}
	  }elseif($table=="lineage"){
	  	$img=$folder."/".$_FILES["file"]["name"];
      	$img=str_replace(' ','_',$img);
	  	if($image_key>0){
	  		//print $img;
	  		$sql=("UPDATE `lineage` SET  `image` =  '$img', `date` =  '$date' WHERE `key` ='$image_key' LIMIT 1") ;
	  		//$sql = ("UPDATE $table SET image = '$img' AND date = '$date' WHERE `key` = '$image_key'");
	  	}elseif($image_key==0){
	  		$sql = ("INSERT INTO $table VALUES (NULL,'$horse_key','$img','$date')");	  	
	  	}
	  }
	  $insert=mysql_query($sql,$conn) or die(mysql_error());
	  //print $image_key;
    if (file_exists($folder."/" . $_FILES["file"]["name"]))
      {
      //echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      $target_path = dirname(__FILE__).'/'.$folder.'/'.$_FILES["file"]["name"];
      //move_uploaded_file($_FILES["file"]["tmp_name"],"img/" . $_FILES["file"]["name"]);
      //print $target_path;
      move_uploaded_file($_FILES["file"]["tmp_name"],$target_path);
      //echo "Stored in: " . "img/" . $_FILES["file"]["name"];

      }
    }
  }
else
  {
  //echo "Invalid file";
  }
  header("Location:index.php");
?>