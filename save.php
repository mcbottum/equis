<?
$db = new PDO("mysql:host=localhost;dbname=equis", root);  

if ($_POST["submit3"]) {

   $q = $db->prepare("INSERT INTO physical (key,horse_key,date, vet,blood_work,next_date) VALUES (?,?,?,?)";
   $q->execute(array(null,$horse_key, $_POST["date"],$_POST["vet"], $_POST["blood_work"], $_POST["next_date"])); 
} 
?>