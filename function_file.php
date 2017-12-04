<?
function get_db(){
    $db='equis'; //home
    //this will also be where the db pwd is located
    return $db;
}


//mysqli
function get_conn($db){
    // ##### local #####
    $user='root';
    $pwd='';
    $host='localhost';
    // ##### Dreamnost #####
    // $user='equis';
    // $pwd='equis_user_1!';
    // $host='mysql.cavalconnect.com';
    $conn=mysqli_connect($host,$user,$pwd,$db); //home
    //$conn=mysql_connect("localhost","abaits5_mcbottum","annakai1") or die(mysql_error());server
    return $conn;
}


//mysqli
function GetMysqlFieldNames($Table, $db){
    $conn=get_conn($db);
    $field_names="SHOW COLUMNS FROM $Table";
    $fields=mysqli_query($conn, $field_names);
    while($columns = mysqli_fetch_array($fields, MYSQLI_ASSOC)){ 
            $field_labels[]=$columns['Field'];
    }
mysqli_free_result($fields);
mysqli_close($conn);
return $field_labels;
}

//mysqli
function GetProductTableData($field,$ID,$Table,$db){
    $conn=get_conn($db);
    $sql="SELECT * FROM $Table ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $tableResults[]=$row;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $tableResults;
        
}

//mysqli
function GetTableDataFacility($field,$ID,$Table,$db, $facility){

    $conn=get_conn($db);
    if($ID=="ALL"){
        if($_SESSION['facility']=='ALL'){
            $sql="SELECT * FROM $Table ";
        }else{
            $sql="SELECT * FROM $Table WHERE `facility_key`='$facility'";
        }
    }elseif($field=="key"&&$ID!='ALL'){
        if($_SESSION[facility]=='ALL'){
            $sql="SELECT * FROM $Table WHERE `key` ='$ID'";
        }else{
            $sql="SELECT * FROM $Table WHERE `key` ='$ID' AND `facility_key`='$facility'";
        }
    }elseif($field=="horse_key"){
        $sql="SELECT * FROM $Table WHERE horse_key ='$ID' AND `facility_key`='$facility'";
    }elseif($field=='infection'){
        $sql="SELECT * FROM $Table WHERE infection ='$ID' AND `facility_key`='$facility'";
    }elseif($field=='data_key'){//choose image file
        $sql="SELECT * FROM $Table WHERE data_key ='$ID' AND `facility_key`='$facility'";
    }elseif($field=='vet_key'){//choose image file
        $sql="SELECT * FROM login WHERE `key` ='$ID' AND `facility_key`='$facility'";
    }elseif($field=='vet'||$field=='farrier'||$field=='owner'){//choose image file
        $sql="SELECT * FROM login WHERE `role` ='$field' AND `facility_key`='$facility'";
    }
    
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $tableResults;
    
}

//mysqli
function GetTableData($field,$ID,$Table,$db){
    $conn=get_conn($db);

    if($field=="horse_key"){
        $sql="SELECT * FROM $Table WHERE horse_key ='$ID' ";
    }elseif($field=='infection'){
        $sql="SELECT * FROM $Table WHERE infection ='$ID' ";
    }elseif($field=='data_key'){//choose image file
        $sql="SELECT * FROM $Table WHERE data_key ='$ID' ";
    }elseif($field=='vet_key'){//choose image file
        $sql="SELECT * FROM login WHERE `key` ='$ID' ";
    }elseif($field=='student_key'){
        $sql="SELECT * FROM $Table WHERE `key` ='$ID' ";
    }
    
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }
    }
    mysqli_free_result($result);
    mysql_close($conn);
    return $tableResults;
}


//mysqli
function GetRoleTableData($field,$ID,$Table,$facillity,$db){
    $conn=get_conn($db);

    if($ID=='ALL'){
        $sql="SELECT * FROM $Table WHERE `facility_key`='$_SESSION[facility]' ORDER BY `horse_name` ";      
    }else{
        $sql="SELECT * FROM $Table WHERE `facility_key`='$_SESSION[facility]' AND (`owner_key` = '$ID' or `farrier_key` = '$ID' or `vet_key` = '$ID') ORDER BY `horse_name` ";
    }
    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }
        mysqli_free_result($result);
        mysqli_close($conn);    
        return $tableResults;
    }else{
        mysqli_close($conn);    
        return;
    }
    
}

//mysqli
function GetOwnerKeyData($ID,$Table,$db){
    $conn=get_conn($db);
    $sql="SELECT * FROM $Table WHERE owner_key='$ID'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $tableResults[]=$row;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $tableResults;
    
}


//mysqli
function GetFilterData($field,$Table,$facility,$db){
    $conn=get_conn($db);
    
    $sql="SELECT * FROM $Table WHERE `facility_key`='$facility'  ORDER BY `last_name` ";        

    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }
        mysqli_free_result($result);
        mysqli_close($conn);    
        return $tableResults;
    }else{
        mysqli_close($conn);    
        return;
    }
}


//mysqli
function GetHorsesFromAppt($Table,$time,$facility,$db){
    $facility=1;
    $conn=get_conn($db);
    $today=date('Y-m-d');
    $future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$today")) . " +2 days"));   
    $sql="SELECT `horse_key`, `vet_key` FROM $Table WHERE  `next_date` BETWEEN '$today' AND '$future' AND `facility_key`='$facility' ";     

    $result = mysqli_query($conn, $sql);
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }


        if($tableResults){
            foreach($tableResults as $horse_key){
                $horse_key_array[]=$horse_key['horse_key'];
            }
        $sql1="SELECT * FROM `information` WHERE `key` IN('".join("','", $horse_key_array)."')"; 
        $result1 = mysqli_query($comm, $sql1);
        if($result1){
            while($row1 = mysqli_fetch_assoc($result1)){
                $tableResults1[]=$row1;
            }
            mysqli_free_result($result);
            mysqli_free_result($result1);
            mysqli_close($conn);    
            return $tableResults1;
        }
        }
    }else{
        mysqli_close($conn);
        return;
    }
    
}


//mysqli
function getRoles($facility, $db){
    $conn=get_conn($db);

    $sql2="SELECT `key`,`first_name`,`last_name`,`role` FROM `login` WHERE `facility_key`='$facility' AND (`role`='owner' OR `role`='vet' OR `role`='farrier' OR `role`='manager')  ORDER BY role, last_name";
    $result = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $tableResults[]=$row;
        }
        mysqli_free_result($result);
        mysqli_close($conn);
        return $tableResults;
    }else{
        return;
    }
    mysqli_close($conn);    
}

//mysqli
function getReminders($table,$horse,$db, $facility){//get reminders for the next 4 days
    $conn=get_conn($db);

    $today=date('Y-m-d');
    $future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$today")) . " +4 days"));
    $sql_p="SELECT * FROM `$table` WHERE `next_date` BETWEEN '$today' AND '$future' AND `facility_key`='$facility' ";
    $p_result=mysqli_query($conn, $sql_p) or die(mysql_error());
    while($row = mysqli_fetch_assoc($p_result)){
        $p_table[]=$row;
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $p_table;
}

function getHorseName($horse_key,$horse_data){
    foreach($horse_data as $h){
        if($h[key]==$horse_key){
            $horse=$h[horse_name];
        }
    }
    return $horse;
}


//mysqli
function getName($key, $table, $db){
    $conn=get_conn($db);

    $sql="SELECT * FROM $table WHERE `key`='$key'";
    
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $results[]=$row;
    }
    if($results[0]['first_name']){
        $name=$results[0]['first_name']." ".$results[0]['last_name'];
    }elseif($results[0]['name']){
        $name=$results[0]['name'];
    }

    mysqli_free_result($result);
    mysqli_close($conn);
    return $name;
}

//old
// function checkRole($key, $table){
//  $conn=get_conn();
//  mysql_select_db($db);
//  $sql="SELECT role FROM `$table` WHERE `key`='$key'";
    
//  $result = mysql_query($sql, $conn);
//  while($row = mysql_fetch_array($result)){
//      $results[]=$row;
        
//  }
//  if($results[0]['role']){
//      $role=$results[0]['role'];
//  }
//  return $role;
//  mysql_close($conn);
// }

//mysqli
function checkRole($key, $table){
    $conn=get_conn($db);

    $sql="SELECT role FROM `$table` WHERE `key`='$key'";
    
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $results[]=$row;
        
    }
    if($results[0]['role']){
        $role=$results[0]['role'];
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    return $role;
}

//old
// function deleteRecord($recordKey,$table){
//  $conn=get_conn();
//  mysql_select_db($db,$conn);
//  mysql_query("DELETE * FROM $table WHERE `key` = '$recordKey'") or die(mysql_error());
//  mysql_close($conn);
//  return "Data Successfully Deleted";
//  //<input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
// }

//mysqli
function deleteRecord($recordKey,$table){
    $conn=get_conn($db);
    mysqli_query("DELETE * FROM $table WHERE `key` = '$recordKey'") or die(mysqli_error($conn));
    mysqli_close($conn);
    return "Data Successfully Deleted";
    //<input id='reload_physical' type ='submit' name ='reload_physical' class= 'btn btn-info' value = 'Reload Form' onclick='parent.location=&quot;index.php&quot;'>";
}

function build_footer(){
ini_set('session.bug_compat_42',0);
ini_set('session.bug_compat_warn',0);
    ?><div class= "footer"><p>&nbsp;Copyright &copy; 2015 Caval-Connect<br><a href='mailto:questions@caval-connect.com?subject=Contact Caval-Connect'>Contact Caval-Connect</a></br><a href='Caval-Connect_Privacy_Policy.html' target="_blank">Privacy Policy</a></p></div>
    <?}
?>
