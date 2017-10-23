<?php
    // get the callback function name
    $callback = '';
    $q='';
    if (isset($_GET['callback']))
    {
        $callback = filter_var($_GET['callback'], FILTER_SANITIZE_STRING);
    }
    if (isset($_GET['q']))
    {
       // $q = filter_var($_GET['q'], FILTER_SANITIZE_STRING);
        $q=$_GET['q'];
    }    
   //if($q){
    $dbname = 'equis';
	$conn=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db($dbname);

	mysql_select_db($dbname, $conn);

	$sql_physical="SELECT * FROM physical WHERE horse_key = '$q'";
	$result = mysql_query($sql_physical);
	
	$result_array=array();
	//$result_array['data']=array();
	
	while($row = mysql_fetch_array($result))
  	{
  		//$label_choice_array[$label]=array('choice'=>$_REQUEST[$label],'weight'=>'');
  		$result_array[]=$row['date'];
  		//$result_array['date']=$row['date'];
  		//$result_array['data']=$row['key'];
  		/*
  	   //print "<h3>".$row['date']."</h3>";
  	  // print "<div>";
  	   //print "<p>";
  	   //print " hi there";
  	   ///print "</p>";
  	   //print "</div>";
  	   */
 	 }
 	 
	mysql_close($conn);
	
   
   
	echo $callback . '('.json_encode($result_array).');';
    //print_r($result); 
   /*
    // make an array with some random values.. so you would see that the results are fetched each time you call this script
    $array = array(
                    'item_id' => rand(1,13),
                    'price' => rand(14,17),
                    'quantity' => rand(18,30)
                     
    );
    // output this array json encoded.. the callback function being the padding (a function available in the web page)
    //this was orignal code
    echo $callback . '('.json_encode($q).');';
   */
    ?>