<?php
include("function_file.php");
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
$dbname = get_db();
$conn=get_conn($dbname);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {
    if ($_FILES["file"]["error"] > 0){
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }else{
      echo "Upload: " . $_FILES["file"]["name"] . "<br>";
      echo "Type: " . $_FILES["file"]["type"] . "<br>";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
      echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

      if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
          echo $_FILES["file"]["name"] . " already exists. ";
        }else{
          $target_path = dirname(__FILE__) . '/img/'.$_FILES["file"]["name"];
          move_uploaded_file($_FILES["file"]["tmp_name"],$target_path);
          echo "Stored in: " . "img/" . $_FILES["file"]["name"];
          $img="img/".$_FILES["file"]["name"];

      	  $sql = ("UPDATE information SET horse_image = '$img' WHERE horse_key = '$horse_key'");
      	  //$insert_sql = ("INSERT INTO physical VALUES (NULL,'$horse_key','$date','$vet','$blood_work','$next_date')");
      	  $insert=mysqli_query($conn, $sql) or die(mysqli_error());
          mysqli_close($conn);
        }
      }
  }else{
    echo "Invalid file";
  }	
?>