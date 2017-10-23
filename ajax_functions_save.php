<?session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type"content="text/html;
charset=utf-8"/>
<head>
<!--<script src="http://code.jquery.com/jquery-1.8.2.js"></script>-->
<!--<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>-->
<!--<script src="http://layout.jquery-dev.net/lib/js/jquery.layout-latest.js"></script>-->
<!--<script src="js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
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
var login_password= encodeURI(document.getElementById('password').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','login.php?password='+login_password+'&nocache='+nocache);
http.onreadystatechange = insertReply;
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
var file= encodeURI(document.getElementById('file').value);
var horse_key= encodeURI(document.getElementById('horse_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&data='+data+'&nocache='+nocache);
http.onreadystatechange = insertimageReply;
http.send(null);
}
//insert physical datavar 

function insert_physical() {
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
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
http.onreadystatechange = insertReply;
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

function insertPhysicalReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('physical_response').innerHTML = response;
}
}
function insertReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('insert_response').innerHTML = response;
}
}
function insertimageReply() {
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
<body>
</body>
</html>