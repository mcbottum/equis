<?session_start();
include("function_file.php");?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.weekcalendar.css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/layout-default-latest.css"/>
  <!--<script src="ajax_functions_save.php" language="javascript"></script>-->
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
  <script src="http://layout.jquery-dev.net/lib/js/jquery.layout-latest.js"></script>
  
  <!--have the above code on-site here 
  <script src="js/jquery-1.8.2.js"></script>
  <script src="js/1.9.1/jquery-ui.js"></script>
  <script src="js/jquery.layout-latest.js"></script>-->
  
  <script src="js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <link rel = "stylesheet" type = "text/css" href = "equis.css">
  	<!-- CUSTOMIZE/OVERRIDE THE DEFAULT CSS -->
	<style type="text/css">

	/* remove padding and scrolling from elements that contain an Accordion OR a content-div */
	.ui-layout-center ,	/* has content-div */
	.ui-layout-west ,	/* has Accordion */
	.ui-layout-east ,	/* has content-div ... */
	.ui-layout-east .ui-layout-content { /* content-div has Accordion */
		padding: 0;
		overflow: hidden;
	}
	.ui-layout-center P.ui-layout-content {
		line-height:	1.4em;
		margin:			5; /* remove top/bottom margins from <P> used as content-div */
	}
	h3, h4 { /* Headers & Footer in Center & East panes */
		font-size:		1.1em;
		background:		#EEF;
		border:			1px solid #BBB;
		border-width:	0 0 1px;
		padding:		7px 10px;
		margin:			0;
	}
	.ui-layout-east h4 { /* Footer in East-pane */
		font-size:		0.9em;
		font-weight:	normal;
		border-width:	1px 0 0;
	}

	</style> 
  <script>

  //datepicker function for date inputs
    $(function() {
        $( ".datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true
        });
    });
    $(function() {
        $( ".datepicker1" ).datepicker({
            showButtonPanel: true
        });
    });
  //initialize tabs and effects
  var myLayout;
  $(document).ready(function() {
  	
  $('#myModal').on('shown', function () {
    $('#horse_name').focus();
});

  	//myLayout = $('body').layout();
    $("#tabs").tabs({ event: "click"},{ fx:{opacity:"toggle"}});
  	var icons = {header: "ui-icon-circle-arrow-e",
           activeHeader: "ui-icon-circle-arrow-s"
        };
    $( ".accordion" ).accordion({heightStyle: "content",icons: icons, collapsible: "true"});
    
    myLayout = $('body').layout({
			west__size:230, east__size:300, north__size:55
			// RESIZE Accordion widget when panes resize
		,	west__onresize:		$.layout.callbacks.resizePaneAccordions
		,	east__onresize:		$.layout.callbacks.resizePaneAccordions
		});

		// ACCORDION - in the West pane
	$("#accordion1").accordion({ fillSpace:	true });
		
		// ACCORDION - in the East pane - in a 'content-div'
	$("#accordion2").accordion({
			fillSpace:	true
		,	active:		1
		});	
	/*$('#calendar').weekCalendar({
    events:[{"id":10182,
      "start":"2009-05-03T12:15:00.000+10:00",
      "end":"2009-05-03T13:15:00.000+10:00",
      "title":"Lunch with Mike"
    }, {
      "id":10182,
      "start":"2009-05-03T14:00:00.000+10:00",
      "end":"2009-05-03T15:00:00.000+10:00",
      "title":"Dev Meeting"
    }]
  });*/

  
  });
//all of this garbage from the ajax function file since it would (*&&%^&^% work  
function createObject() {
var request_type;
var browser = navigator.appName;
if(browser == "Microsoft Internet Explorer"){
request_type = new ActiveXObject("Microsoft.XMLHTTP");
}else{
request_type = new XMLHttpRequest();
}
return request_type;
}

var http = createObject();

//check for new horse or new owner
function check(value)
{
 if(value == "new_horse"){
 	$('#myModal_horse').modal();	
 }else if(value == "new_owner"){
 	$('#myModal_owner').modal();
 }else if(value == "Login"){
 	$('#myModal_login').modal();
 }else if(value == "Logout"){
 	$.get('logout.php');
 	return false;
 	//logout();
 }else{
 	return;
 }
}
//end check function

/* -------------------------- */
/* INSERT */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
var nocache = 0;

function insert_login() {	
	$("#myModal_login").modal("hide");
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var passcheck= encodeURI(document.getElementById('passcheck').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','login.php?passcheck='+passcheck+'&nocache='+nocache);
http.onreadystatechange = insertReply;
http.send(null);
}

function logout() {	
	
// Optional: Show a waiting message in the layer with ID login_response
//document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var logout= encodeURI(document.getElementById('logout').value);
// Set te random number to add to URL request
nocache = Math.random();

// Pass the login variables like URL variable
http.open('get','logout.php?nocache='+nocache);
//http.onreadystatechange = insertReply;
http.send(null);
}

function insert_image() {	
var data = new FormData();
jQuery.each($('#file')[0].files, function(i, file) {
data.append('file-'+i, file);
});
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
//var file= encodeURI(document.getElementById('file').value);
var horse_key= encodeURI(document.getElementById('horse_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&data='+data+'&nocache='+nocache);
http.onreadystatechange = insertImageReply;
http.send(null);
}
//insert physical datavar 

function insert_physical() {
// Optional: Show a waiting message in the layer with ID login_response
//document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var horse_key= encodeURI(document.getElementById('horse_key').value);
var date1= encodeURI(document.getElementById('date').value);
var vet= encodeURI(document.getElementById('vet').value);
var blood_work= encodeURI(document.getElementById('blood_work').value);
var next_date= encodeURI(document.getElementById('next_date').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date1+'&vet='+vet+'&blood_work='+blood_work+'&next_date='+next_date+'&nocache='+nocache);
http.onreadystatechange = insertPhysicalReply;
//http.onreadystatechange = insertReply;
http.send(null);
}

function insert_vaccination() {	
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var horse_key= encodeURI(document.getElementById('horse_key').value);
var date1= encodeURI(document.getElementById('v_date').value);
var next_date= encodeURI(document.getElementById('v_next_date').value);
var vac_type= encodeURI(document.getElementById('type').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date1+'&next_date='+next_date+'&vac_type='+vac_type+'&nocache='+nocache);
var responseDiv='vaccination_response';
http.onreadystatechange = insertVaccinationReply;
http.send(null);
}

//insert new horse
function insert_horse() {
//hide modal on submit
$("#myModal_horse").modal("hide"); 
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
var horse_name= encodeURI(document.getElementById('horse_name').value);
//var horse_image= encodeURI(document.getElementById('horse_image').value);
var horse_height= encodeURI(document.getElementById('horse_height').value);
var weight= encodeURI(document.getElementById('weight').value);
var birth= encodeURI(document.getElementById('birth').value);
var breed= encodeURI(document.getElementById('breed').value);
var stall= encodeURI(document.getElementById('stall').value);
var contact= encodeURI(document.getElementById('contact').value);
var owner_key= encodeURI(document.getElementById('owner_key').value);
var vet_key= encodeURI(document.getElementById('vet_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_name='+horse_name+'&horse_height='+horse_height+'&weight='+weight+'&birth='+birth+'&breed='+breed+'&stall='+stall+'&contact='+contact+'&owner_key='+owner_key+'&vet_key='+vet_key+'&nocache='+nocache);
http.onreadystatechange = insertReply;
http.send(null);
}


//insert new owner
function insert_owner() {
//hide modal on submit
$("#myModal_owner").modal("hide"); 
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
var first_name= encodeURI(document.getElementById('first_name').value);
var last_name= encodeURI(document.getElementById('last_name').value);
var street_address= encodeURI(document.getElementById('street_address').value);
var city= encodeURI(document.getElementById('city').value);
var state= encodeURI(document.getElementById('state').value);
var zip= encodeURI(document.getElementById('zip').value);
var horse_key= encodeURI(document.getElementById('horse_key').value);
var vet_key= encodeURI(document.getElementById('vet_key').value);
var phone= encodeURI(document.getElementById('phone').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?first_name='+first_name+'&last_name='+last_name+'&street_address='+street_address+'&city='+city+'&state='+state+'&zip='+zip+'&phone='+phone+'&horse_key='+horse_key+'&vet_key='+vet_key+'&nocache='+nocache);
http.onreadystatechange = insertReply;
http.send(null);
}

function insert_admin() {	
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
// Required: verify that all fileds is not empty. Use encodeURI() to solve some issues about character encoding.
var a_first_name= encodeURI(document.getElementById('login_first_name').value);
var a_last_name= encodeURI(document.getElementById('login_last_name').value);
var access= "global";//encodeURI(document.getElementById('access').value);
var password= encodeURI(document.getElementById('password').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?a_first_name='+a_first_name+'&a_last_name='+a_last_name+'&access='+access+'&password='+password+'&nocache='+nocache);
http.onreadystatechange = insertReply;
http.send(null);
}

function insertPhysicalReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('physical_response').innerHTML = response;
}
}
function insertVaccinationReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('vaccination_response').innerHTML = response;
}
}
function insertDentalReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('dental_response').innerHTML = response;
}
}
function insertReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('insert_response').innerHTML = response;
}
}
function insertImageReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('insert_image_response').innerHTML = 'Image upload:'+response;
}
}
function insertmyModalOwnerreply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('myModal_owner').innerHTML = '-->'+response;
}
}  
</script>
</head>
<?
/* for inhosting */
/*
$dbname = 'abaits5_HawkeyeTest';
$dbTable='AptSearch6';
$conn=mysql_connect("localhost","abaits5_mcbottum","annakai1") or die(mysql_error());
$sql="SELECT * FROM $dbTable";	
mysql_select_db("abaits5_agitation");
*/

/* for home */


function GetMysqlFieldNames($Table){
	$conn=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db(get_db());
	$field_names="SHOW COLUMNS FROM $Table";
	$fields=mysql_query($field_names,$conn);
	while($columns = mysql_fetch_array($fields)){ 
			$field_labels[]=$columns[0];
	}
return $field_labels;
mysql_close($conn);
}

function GetTableData($ID, $Table){
	$conn=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db(get_db());
	if($ID=="ALL"){
		$sql="SELECT * FROM $Table";
	}else{
		$sql="SELECT * FROM $Table WHERE horse_key='$ID'";
	}
	//$s_horse="SELECT * FROM horse WHERE key='$horse_key'";
	//$horse = mysql_query($s_horse,$conn);
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	mysql_close($conn);
}
function GetOwnerKeyData($ID,$Table){
	$conn=mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db(get_db());
	$sql="SELECT * FROM $Table WHERE owner_key='$ID'";
	$result = mysql_query($sql, $conn);
	while($row = mysql_fetch_array($result)){
		$tableResults[]=$row;
	}
	return $tableResults;
	mysql_close($conn);
}

function getReminders($horse,$admin){//get reminders for the next 3 days
	$conn=mysql_connect('localhost','root','') or die(mysql_error());
	$today=date('Y-m-d');
	$today=strtotime($today);
	$future=strtotime("+3",$today);
	$future=date('Y-m-d',$future);
	$sql_p="SELECT * FROM physical WHERE next_date BETWEEN NOW() AND '$future'";
	$p_result=mysql_query($sql_p, $conn);
	while($row = mysql_fetch_array($p_result)){
		$p_table[]=$row;
	}
	return $reminders;
	mysql_close($conn);
}
	 
$dbname = get_db();

$conn=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db(get_db());

$horse_key=$_SESSION['horse_key'];
//$horse_key=$_REQUEST['horse_choice'];
if(isset($_REQUEST['horse_choice'])){
	$horse_key=$_REQUEST['horse_choice'];
	$_SESSION['horse_key']=$horse_key;
}
/*elseif(isset($_SESSION['horse_key'])){
	$horse_key=($_SESSION['horse_key']);
}
	
*/
$owner_key=$_REQUEST['owner_choice'];
if($_SESSION['passwordcheck']=='pass'){
//set and get initial values for site
	$dbTable1='information';
	$dbTable2='owner';
	$sql_horse="SELECT * FROM $dbTable1";
	$sql2="SELECT * FROM $dbTable2";
	$horse_result = mysql_query($sql_horse,$conn) or die(mysql_error());;
	$owner_result = mysql_query($sql2,$conn) or die(mysql_error());;
	$physical_field_labels=GetMysqlFieldNames("physical");
	mysql_close($conn);
	$info_field_labels=GetMysqlFieldNames("information");
	$owner_field_labels=GetMysqlFieldNames("owner");
	$login_field_labels=GetMysqlFieldNames("login");
	$login_data=GetTableData("ALL", "login");
	$owner_data=GetTableData("ALL", "owner");
	$vet_data=GetTableData("ALL", "vet");
	$horse_data=GetTableData("ALL", "information");
}
if ($horse_key){// use this to load horse data for page
		$infoResult=GetOwnerKeyData($horse_key, "information");
		$vet_key=$infoResult[0]['vet_key'];
		$owner_key=$infoResult[0]['owner_key'];
		$vet=GetTableData($vet_key, "vet");
		$owner=GetTableData($owner_key, "owner");
		$owner_name=$owner[0]['first_name']." ".$owner[0]['last_name'];
		$vet_name=$vet[0]['first_name']." ".$vet[0]['last_name'];
		$horse_name=$infoResult[0]['horse_name'];
	}
if ($owner_key&&!$horse_key){// use this to load horse data for page if owner selected
	$owner_horse=GetTableData($owner_key, "information");
	$horse_key=$owner_horse[0]['horse_key'];
	$infoResult=GetTableData($horse_key, "information");
	$vet_key=$infoResult[0]['vet_key'];
	$owner=GetTableData($owner_key, "owner");
	$owner_name=$owner[0]['first_name']." ".$owner[0]['last_name'];
}

?>
<body style="font-size:62.5%;">

<!--<div id="north_container" class="ui-layout-north">-->
<div id="north_container" class="ui-layout-north ui-widget-content" style="display: none;">
<?
/*
if($horse_name){
	print $horse_name." Caval-Connected";
}elseif($owner_key){
	print $owner_name." Caval-Connected";
}else{
	print"Caval-Connect";
}
*/
if($_SESSION['passwordcheck']!='pass'){
	print "Caval-Connect <span><input id='login' type = 'submit' name = 'login' class= 'btn btn-success' value = 'Login' onclick='check(this.value)'/></span>";
}elseif($_SESSION['passwordcheck']=='pass'){
	//print "Caval-Connected <span><form action='logout.php' method='post'><input id='logout' type = 'submit' name = 'logout' class= 'btn-small btn-danger' value = 'Logout' onclick='logout.php'/></form></span>";
	print "Caval-Connect <span><input id='logout' type ='submit' name ='logout' class= 'btn btn-danger' value = 'Logout' onclick='check(this.value)'/></span>";
}

	
?>
</div><!--end north_-->
<div id="north_spacer">
</div><!--end north_spacer-->

<div id="west_container" class="ui-layout-west" style="display: none;">
	<table id="west_data" width="100%" align="center">
	<form
		name='horse'
		id='horse'
		action='index.php'
		method = "post">
		<tr>

		</tr>
		<tr><td><br>
		</td></tr>
			<td>
				<select name="horse_choice" id="horse_choice" onchange="check(this.value);">
					<option value=""> Select Horse </option>
					<?
						if($_SESSION['passwordcheck']=='pass'){
							while($row = mysql_fetch_array($horse_result)){
							print"<option value=$row[horse_key]>$row[horse_name]</option>";
							}//end while
						?>
					<option value="new_horse"><span class="red">New Horse</span></select>
					<?}//end passcheck
					?>		
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input 	id="submit_horse" type = "submit" name = "submit_horse" class= "btn btn-warning" value = "Submit Horse Selection"/>
			</td>
		</tr>
		<tr>
			<td>
				<br>
			</td>
		</tr>
		</form><!--end horse form-->
		<form
		name='owner'
		id='owner'
		action='index.php'
		method = "post">
		<tr>
			<td>
				<select name="owner_choice" id="owner_choice" onchange="check(this.value);">
					<option value=""> Select Owner </option>
						<?
						if($_SESSION['passwordcheck']=='pass'){
							while($row = mysql_fetch_array($owner_result)){
							print"<option value=$row[key]>$row[first_name] $row[last_name]</option>";
							}//end while
						?>
					<option value="new_owner">New Owner</select>
						<?}//end passwordcheck if
						?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input 	id="submit_onwer" type = "submit" name = "submit_owner" class= "btn btn-warning" value = "Submit Owner Selection"/>
			</td>
		</tr>
		</form><!--end owner form-->
		<tr>
			<td>
				<p><div id = "greyline""></div></p>
			</td>
		</tr>	
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td>Reminders</td>
		</tr>
		<tr width='100'>
			<td width='100'><h6 id='insert_response'>
			<?if($_SESSION['passwordcheck']=='pass'){
				print "Welcome ".($_SESSION['first']);
			}elseif($_SESSION['passwordcheck']=='fail'){
				print "Sorry, your entry did not match our passwords.";
			}
			print "</h6></td></tr>";
			$reminders=getReminders(1,1,'equis');
			foreach($reminders as $event){
				print "<td width='100'><td>".$event['next_date']."</td></tr>";
			
			
			
		?>
	</table>

	<div id="accordion1" class="basic">
		
	</div><!--end accordion1-->
</div><!--end west_sidebar-->
<div id="west_spacer">
</div><!--end spacer div-->
<div id="main_container" class="ui-layout-center"> 
<div id="tabs">

    <ul>
    	<li><a href="#fragment-A"><span>Information</span></a></li>
        <li><a href="#fragment-1"><span>Physicals</span></a></li>
        <li><a href="#fragment-2"><span>Vaccinations</span></a></li>
        <li><a href="#fragment-3"><span>Dental</span></a></li>
        <li><a href="#fragment-4"><span>Parasites</span></a></li>
        <li><a href="#fragment-5"><span>Lineage</span></a></li>
        <li><a href="#fragment-6"><span>Medical History</span></a></li>
        <li><a href="#fragment-7"><span>Coggins</span></a></li>
        <li><a href="#fragment-8"><span>Farier</span></a></li>
        <li><a href="#fragment-9"><span>Nutrition</span></a></li>
        <li><a href="#fragment-10"><span>Admin</span></a></li>
    </ul>
    <div id="fragment-A" class="active">
        
        <?
        
        if($horse_key&&$_SESSION['passwordcheck']==pass){
        	print "<div class='accordion'>";
        	if($infoResult)
        	{
        	foreach($infoResult as $row)
 			 {
  	  	 		print "<h3 id='insert_image_response'>".$row['horse_name']."'s information</h3>";
  	  	 		
  	  	 		print "<div>";
  	  	 		print "<table>";//big table
  	  	 			print "<tr><td width='260'><IMG STYLE='border:2px solid black; border-radius:5px; width:250px;' SRC='".$row[horse_image]."' ALT='Home'></td>";
				print "<td><table>";//small table
		//		if($_SESSION['passwordcheck']==pass){
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="horse_image"){
  	  	 				print "<tr>";
  	  	 					if($label=="owner_key"){
  	  	 							print "<td width='150'>owner</td><td>".$owner_name."</td>";
  	  	 						}elseif($label=="vet_key"){
  	  	 							print "<td width='150'>vet</td><td>".$vet_name."</td>";
  	  	 						}else{  	  	 				
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 							}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}//end foreach
 			 //}//end if
  	  	 		print "</table>";
  	  	 	print "</td></tr>";
  	  	 	print "<tr><td><br></td></tr>";
  		print "</table>";//end big table
  	  	 		?><div id='insert_image_response'>
  	  	 		<!--<form action='imageupload.php' enctype="multipart/form-data" method='get'>-->
  	  	 		<form action="image_upload.php" method="post" enctype="multipart/form-data">
				<label for="file">Choose New Image:</label>
				<? print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";?>
				<input type="file" name="file" id="file" value=><br>
				<!--<input type="submit" name="submit" value="Submit Image" class= "btn btn-warning">-->
				<input 	id="submit_image" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit Image"/>
				</form>
				</div><!--image response div-->
				<?
  	     		print "</div>";
 			 }
        }else{
 		 	print "No Information has been recorded for". $horse;
 		 }
        
        print "<h3>Update ".$horse_name." Information Data</h3>";
     	print "<div id='info_response'>";
     	print "<form id='information'>";
			print "<table>";
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&label!="horse_image"&&$label!="vet_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="birth"||$label=="date"||$label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' id=".$label."_update></td>";
  	  	 					}else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td width='150'>owner</td>";
  	  	 					print "<td>";
  	  	 					print "<select name='owner_key' id='owner_key'>";
								print "<option value=''> Select Owner </option>";
									foreach($owner_data as $data){
										print"<option value=$data[key]>$data[first_name]  $data[last_name]</option>";
									}//end while
								print "<option value='0'>New Owner</select>";
							print "</select>";
  	  	 				print "</td></tr>";	
  	  	 				print "<tr><td width='150'>veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vet_key' id='vet_key'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}//end foreach
									print "<option value='0'>New Vet</select>";
								print "</select>";
  	  	 					print "</td>";
  	  	 				print "</tr>";			
			print "</table>";
				?>
				<input 	id="submit_information" type = "submit" name = "submit_information" class= "btn btn-warning" value = "Submit Horse Information"/></form>
				<?

		print "</div>";
	print "</div>";//end accordion
        }else{//if no horse is selected
       //
     // print "<h3>".$row['name']."</h3>";
     	print "<h2 style='text-align:center'>Welcome to Caval-Connect</h2>";
        print "<div align='center'><IMG STYLE='border:2px solid black; border-radius:5px; width:250px; horizontal-align:center' SRC='img/zague.jpg' ALT='Home'></div>";
        }
        	 
 		 ?>
		  
	</div> <!--end fragment-A-->
    <div id="fragment-1">
        <div class="accordion">
        <?
        $physical_field_labels=GetMysqlFieldNames("physical", $dbname);
        if($horse_key){
        	$physicalResult=GetTableData($horse_key, "physical", $dbname);
        	if($physicalResult)
        	{
        	foreach($physicalResult as $row)
 			 {
  	  	 		print "<h3>".$row['date']./*"<input 	id='submit_physical' type = 'submit' name = 'submit_physical' class= 'btn btn-mini btn-danger' value = 'Delete Physical'/>*/"</h3>";
  	  	 		
  	  	 		print "<div>";
  	  	 		print "<table>";
  	  	 		foreach($physical_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 		print "</table>";
  	     		print "</div>";
 			 }
        }else{
 		 	print "No Physical Information has been recorded for". $horse;
 		 }
        }
        print "<h3>Enter New Physical Data</h3>";
  	  	 print "<div id='physical_response'>";
  	  	 if($horse_key!=''){
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
			

  	  	 <form action='javascript:insert_physical()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($physical_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker1' id=".$label."></td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' id=".$label."></td>";
  	  	 					}elseif($label!="vet"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vet_key' id='vet_key'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}//end foreach
									print "<option value='0'>New Vet</select>";
								print "</select>";
  	  	 					print "</td>";
  	  	 				print "</tr>";
			print "</table>";
				?>
				<input 	id="submit_physical" type = "submit" name = "submit_physical" class= "btn btn-warning" value = "Submit Physical Information"/>
				</form>
				<?
  	  	 }//end if($horse_key!='')
  	     print "</div>";		 
 		 ?>

		</div> <!--end accordion-->  
	</div> <!--end fragment-1-->
    <div id="fragment-2">
        <div class='accordion'>
        <?
        $vaccination_field_labels=GetMysqlFieldNames("vaccination", $dbname);
        if($horse_key){
        	$vaccinationResult=GetTableData($horse_key, "vaccination", $dbname);
        	if($vaccinationResult)
        	{
        	foreach($vaccinationResult as $row)
 			 {
  	  	 		print "<h3>".$row['v_date']."</h3>";
  	  	 		
  	  	 		print "<div>";
  	  	 		print "<table>";
  	  	 		foreach($vaccination_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 		print "</table>";
  	     		print "</div>";
 			 }
        }else{
 		 	print "No Vaccination Information has been recorded for". $horse_name;
 		 }
        }
      print "<h3>Enter New Vaccination Data</h3>";
  	  print "<div id='vaccination_response'>";
  	  if($horse_key!=''){
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
  	  <form action='javascript:insert_vaccination()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($vaccination_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="v_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker1' id=".$label."></td>";
  	  	 					}elseif($label=="v_next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' id=".$label."></td>";
  	  	 					}elseif($label!="vet_key"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vet_key' id='vet_key'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}//end foreach
									print "<option value='0'>New Vet</select>";
								print "</select>";
  	  	 					print "</td>";
  	  	 				print "</tr>";
			print "</table>";
				?>
				<input 	id="submit_vaccination" type = "submit" name = "submit_vaccination" class= "btn btn-warning" value = "Submit Vaccination Information"/></form>
				<?
  	  }//end if($horse_key!=''){		
  	     print "</div>";		 
 		 ?>

		</div> <!--end accordion-->  
	</div> <!--end fragment-2-->
    <div id="fragment-3">
        <div class='accordion'>
        <?
        $dental_field_labels=GetMysqlFieldNames("dental", $dbname);
        if($horse_key){
        	$dentalResult=GetTableData($horse_key, "dental", $dbname);
        	if($dentalResult)
        	{
        	foreach($dentalResult as $row)
 			 {
  	  	 		print "<h3>".$row['date']."</h3>";
  	  	 		
  	  	 		print "<div>";
  	  	 		print "<table>";
  	  	 		foreach($dental_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 		print "</table>";
  	     		print "</div>";
 			 }
        }else{
 		 	print "No Dental Information has been recorded for". $horse;
 		 }
        }
        print "<h3>Enter New Dental Data</h3>";
  	  	 print "<div id='dental_response'>";
  	  	 if($horse_key!=''){
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
  	  <form action='javascript:insert_dental()' method='post'>
  	  	 <?
			print "<table>";
  	  	 		foreach($dental_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker1' name=".$label."></td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' name=".$label."></td>";
  	  	 					}elseif($label!="vet"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vet_key' id='vet_key'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}//end foreach
									print "<option value='0'>New Vet</select>";
								print "</select>";
  	  	 					print "</td>";
  	  	 				print "</tr>";
			print "</table>";
				?>
				<input 	id="submit_dental" type = "submit" name = "submit_dental" class= "btn btn-warning" value = "Submit Dental Information"/></form>
				<?
  	  	 }//end if($horse_key!=''){
  	     print "</div>";		 
 		 ?>

		</div> <!--end accordion-->  
	</div> <!--end fragment-3-->
    <div id="fragment-4">
    	<div class='accordion'>
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        </div>
    </div><!--end fragment-4 div-->
    <div id="fragment-10">
        <div class='accordion'>
<?
        if($login_data){
        	foreach($login_data as $row){
  	  	 		print "<h3>".$row['login_first_name']."  ".$row['login_last_name']."</h3>";
  	  	 		print "<div>";//inner accordion div
  	  	 		print "<table>";
  	  	 		foreach($login_field_labels as $label){
  	  	 			if($label!="key"&&$label!="password"){
  	  	 				print "<tr>";
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 		print "</table>";
  	     		print "</div>";
 			 }
?>
         <h3>Enter New Administrator Data</h3>
         <div><!--end inner accordion div-->
  	  	<form action='javascript:insert_admin()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($login_field_labels as $label){
  	  	 			if($label!="key"&&$label!="access"){
  	  	 				print "<tr>";
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 	  ?>
  	  	 				<tr><td>Caval-Connect Access</td>
  	  	 					<td>
  	  	 				  	 <select name='access' id='access'>
								<option value=''> Select Access Level </option>";
								<option value='global'>Global</option>
								<option value='local'>Local</option>
								<option value='owner'>Owner</option>
								<option value='vet'>Vet</option>
								<option value='farrier'>Farrier</option>
								<option value='trainer'>Trainer</option>
							</select>
  	  	 				</td></tr>
  	  	 	
			</table>
				
				<input 	id="submit_admin" type = "submit" name = "submit_admin" class= "btn btn-warning" value = "Submit New Admin Information"/></form>
				
  	    	</div><!--end inner accordion data-->
  	    	<?
        }//end if login_data
        ?>		 
		</div> <!--end accordion-->  
	</div> <!--end fragment-10-->
</div><!--end tabs div-->
</div><!--end main_container div-->
<!-- Modals -->
<div id="myModal_horse" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  action='javascript:insert_horse()' method='post'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">New Horse Entry</h3>
  </div>
  <div class="modal-body"><!--MODAL for New Horse-->
  <?
			print "<table>";
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="owner_key"&&$label!="vet_key"&&$label!="horse_image"){
  	  	 				print "<tr>";
  	  	 					if($label=="birth"||$label=="date"||$label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' id=".$label."></td>";
  	  	 					}else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td>";
  	  	 					print "<select name='vet_key' id='vet_key'>";
								print "<option value=''> Select Vet </option>";
									foreach($vet_data as $data){
										print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
									}//end while
								print "<option value='0'>New Vet</select>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td>";
  	  	 					print "<select name='owner_key' id='owner_key'>";
								print "<option value=''> Select Owner </option>";
									foreach($owner_data as $data){
										print"<option value=$data[key]>$data[first_name]  $data[last_name]</option>";
									}//end while
								print "<option value='new'>New Owner</select>";
							print "</select>";
  	  	 				print "</td></tr>";			
			print "</table>";
			?>  
			
			 <input id="submit_horse"  type = "submit" class="btn btn-warning" aria-hidden="true"  value = "Submit New Horse"/>
			 <br></br>
  </div>
</form>
</div><!--end modal div-->

<div id="myModal_owner" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  action='javascript:insert_owner()' method='post'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">New Owner Entry</h3>
  </div>
  <div class="modal-body">
  <?
			print "<table>";
  	  	 		foreach($owner_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="owner_key"&&$label!="vet_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="birth"||$label=="date"||$label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' class='datepicker' id=".$label."></td>";
  	  	 					}else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id=".$label."></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td>";
  	  	 					print "<select name='vet_key' id='vet_key'>";
								print "<option value=''> Select Vet </option>";
									foreach($vet_data as $data){
										print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
									}//end while
								print "<option value='0'>New Vet</select>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td>";
  	  	 					print "<select name='vet' id='horse_key'>";
								print "<option value=''> Select Horse </option>";
									foreach($horse_data as $data){
										print"<option value=$data[horse_key]>$data[horse_name]</option>";
									}//end while
								print "<option value='new'>New Horse</select>";
							print "</select>";
  	  	 				print "</td></tr>";			
			print "</table>";
			?>  
			
			 <input id="submit_owner"  type = "submit" class="btn btn-warning" aria-hidden="true"  value = "Submit New Owner"/>
			 <br></br>
  </div>
</form>
</div><!--end modal div-->

<!--begin login modal-->
<div id="myModal_login" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  action='login.php' method='post'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">Caval Connect Login</h3>
  </div>
  <div class="modal-body">
  <?
			print "<table>";
  	  	 		print "<tr>";
					print "<td width='150'><input type='text' id='passcheck' name='passcheck'></td>";
  	  	 		print "</tr>";			
			print "</table>";
			?>  
			
			 <input id="submit_login"  type = "submit" class="btn btn-warning" aria-hidden="true"  value = "Login"/>
			 <br></br>
  </div>
</form>
</div><!--end modal div-->
<div id='logout'><!-- form for logout div-->
	<form  action='logout.php' method='post'>
	</form>
</div>

</body>
</html>