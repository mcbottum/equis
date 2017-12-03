<?session_start();
include("function_file.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="equine, horse, barn, manager">
<meta name="description" content="Web based equine data barn manager">
<meta name="author" content="Michael Bottum">
<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.weekcalendar.css"/>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/layout-default-latest.css"/>
<!-- <script src="ajax_functions_save.php" language="javascript"></script> -->
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
  <script src="http://layout.jquery-dev.net/lib/js/jquery.layout-latest.js"></script>
  
  <!--have the above code on-site here -->
<!--   <script src="js/jquery-1.8.2.js"></script>
  <script src="js/1.9.1/jquery-ui.js"></script>
  <script src="js/jquery.layout-latest.js"></script> -->
  
  <script src="js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <link rel = "stylesheet" type = "text/css" href = "css/equis.css">
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
  //to print external files
function printTrigger(elementId) {
    var getMyFrame = document.getElementById(elementId);
    getMyFrame.focus();
    getMyFrame.contentWindow.print();
}
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
  	//myLayout = $('body').layout();
    $("#tabs").tabs({ event: "click"},{ fx:{opacity:"toggle"}});
    $("#divWithScroll").tabs({ event: "click"},{ fx:{opacity:"toggle"}});
  	var icons = {header: "ui-icon-circle-arrow-e",
           activeHeader: "ui-icon-circle-arrow-s"
        };
    $( ".accordion" ).accordion({heightStyle: "content",icons: icons, collapsible: "true"});
    $(".roleaccordion").accordion({heightStyle: "content",icons: icons, active: false, collapsible: true });
    
    myLayout = $('body').layout({
			west__size:230, east__size:300, north__size:55
			// RESIZE Accordion widget when panes resize
		,	west__onresize:		$.layout.callbacks.resizePaneAccordions
		,	east__onresize:		$.layout.callbacks.resizePaneAccordions
		});

		// ACCORDION - in the West pane
	$("#accordion1").accordion({ 
			heightStyle: "content",
			collapsible: "true",
			fillSpace:	true,
			active:		1
	
	 });
		
		// ACCORDION - in the East pane - in a 'content-div'
	$("#accordion2").accordion({
			heightStyle: "content",
			collapsible: "true",
			fillSpace:	true,
			active:		1
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

function showOther(value) {
var obj1 = document.getElementById("dprocedure_other");
var obj = document.getElementById("dprocedureother");
	if (value == "other" ) {
		obj1.style.display = "block";
		obj.style.display = "block";
	}
}
function showOtherf(value) {
var obj1 = document.getElementById("fprocedure_other");
var obj = document.getElementById("fprocedureother");
	if (value == "other" ) {
		obj1.style.display = "block";
		obj.style.display = "block";
	}
}

function showOtherText(value, ID) {
var obj1 = document.getElementById(ID);
	if (value=="other") {
		obj1.style.display = "block";
		if(obj1.style.display =="block"){
			obj1.focus();
		}
	}
}
 
function showTextArea(counter,ID) {
var obj1 = document.getElementsByName(ID);
		obj1[counter].style.display = "block";
		if(obj1[counter].style.display =="block"){
			obj1[counter].focus();
		}
} 

function showSelect(IDtd,IDselect,value) {
	//alert(value);
var obj1 = document.getElementById(IDtd);
var obj2 = document.getElementById(IDselect);
		obj1.style.display = "block";
		obj2.style.display = "block";
		if(IDtd=='filter2'&&obj1.style.display =="block"){
			obj1.focus();
		}else if(IDtd!='filter2'&&obj2.style.display =="block"){
			obj2.focus();
		}
}

function showSelectFilter(IDtd,IDselect,value) {
	//alert(value);
if (value=='vet'||value=='owner'||value=='farrier'){
	var obj1 = document.getElementById(value+IDtd);
	obj1.style.display = "block";
}
var obj2 = document.getElementById(IDselect);

		obj2.style.display = "block";
		if(obj1.style.display =="block"){
			obj1.focus();
		}
}

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

//var for reloading elements from innerHTML
//var markupCache = {};
//function restoreElement(id) {

  // Only restore markup if have cached some for this element
  //if (id in markupCache) {
   // document.getElementById(id).innerHTML = markupCache[id];
  //}
//}

//check for new horse or new owner
function check(value){
var attempt=<?php echo json_encode($_SESSION['attempt']); ?>;
 
 if(value == "new_horse"){
 	$('#myModal_horse').modal();
  	$('#myModal_horse').on('shown', function () {
    $('#nhorse_name').focus();
});	
 }else if(value == "Login"&& attempt<7){
 	$('#myModal_login').modal();
 	$('#myModal_login').on('shown', function () {
    $('#passcheck').focus();
});
 }else if(value == "Login"&& attempt>3){
 	$('#myModal_sendemail').modal();
 	$('#myModal_sendemail').on('shown', function () {
    $('#sendemailfirst').focus();
});	
 }else if(value == "facility"){
 	$('#myModal_facility').modal();
 	$('#myModal_facility').on('shown', function () {
    $('#selectfacility').focus();
});	
 }else if(value == "Logout"){
 	$.get('logout.php');
 	return false;
 	//logout();
 }else{
 	return;
 }
}
function getCarousel(){
	$('#myCarousel').carousel();
}
function getCarousel(){
	$('#mydCarousel').carousel();
}


//reload div
function reloadDiv(){
	//var frame = document.getElementById("physical_response");
	//frameDoc = frame.contentDocument || frame.contentWindow.document;
	//frameDoc.documentElement.innerHTML = "";
	document.getElementById('physical_response').innerHTML = "";
	$('#physical_response', window.parent.document).load('index.html',function(){
    alert("Portion of page loaded");
});
}

	
//end check function

/* -------------------------- */
/* INSERT */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
var nocache = 0;

function sendemail() {
	//hide modal on submit
$("#myModal_sendemail").modal("hide");	
var sendemailfirst= encodeURI(document.getElementById('sendemailfirst').value);
var sendemaillast= encodeURI(document.getElementById('sendemaillast').value);

nocache = Math.random();
http.open('get','sendemail.php?sendemailfirst='+sendemailfirst+'&sendemaillast='+sendemaillast+'&nocache='+nocache);
http.onreadystatechange=function () {
        callResponse('insert_response', '-');
 };
http.send(null);
}

function logout() {	

var logout= encodeURI(document.getElementById('logout').value);

nocache = Math.random();
http.open('get','logout.php?nocache='+nocache);
http.send(null);
}


function insert_physical() {
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('pday').value);
var month= encodeURI(document.getElementById('pmonth').value);
var year= encodeURI(document.getElementById('pyear').value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('pnday').value);
var month= encodeURI(document.getElementById('pnmonth').value);
var year= encodeURI(document.getElementById('pnyear').value);
var next_date= year+"-"+month+"-"+day;

var radios = document.getElementsByName('pblood_drawn');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var blood=radios[i].value;
    }
}
var radios = document.getElementsByName('pfecal_sampled');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var fecal=radios[i].value;
    }
}

var radios = document.getElementsByName('psheath_cleaned');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var sheath=radios[i].value;
    }
}

var radios = document.getElementsByName('pteeth_floated');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var teeth=radios[i].value;
    }
}

var radios = document.getElementsByName('pvaccination_given');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var vaccination=radios[i].value;
    }
}

var radios = document.getElementsByName('pradiograph_taken');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var radiograph=radios[i].value;
    }
}

var temperature= encodeURI(document.getElementById('ptemperature').value);
var pulse= encodeURI(document.getElementById('ppulse').value);
var respiration= encodeURI(document.getElementById('prespiration').value);
var right_eye= encodeURI(document.getElementById('pright_eye_exam').value);
if (right_eye=="other"){
	var right_eye= encodeURI(document.getElementById('pright_eye_exam_other').value);
}
var left_eye= encodeURI(document.getElementById('pleft_eye_exam').value);
if (left_eye=="other"){
	var left_eye= encodeURI(document.getElementById('pleft_eye_exam_other').value);
}
var fitness= encodeURI(document.getElementById('pfitness_evaluation').value);
if (fitness=="other"){
	var fitness= encodeURI(document.getElementById('pfitness_evaluation_other').value);
}
var coat= encodeURI(document.getElementById('pcoat_appearance').value);
if (coat=="other"){
	var coat= encodeURI(document.getElementById('pcoat_appearance_other').value);
}
var gait= encodeURI(document.getElementById('pgait_symmetry').value);
if (gait=="other"){
	var gait= encodeURI(document.getElementById('pgait_symmetry_other').value);
}
var comments= encodeURI(document.getElementById('pcomments').value);
var vet_key= encodeURI(document.getElementById('pvet_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&vet_key='+vet_key+'&next_date='+next_date+'&blood='+blood+'&fecal='+fecal+'&sheath='+sheath+'&teeth='+teeth+'&vaccination='+vaccination+'&radiograph='+radiograph+'&temperature='+temperature+'&pulse='+pulse+'&respiration='+respiration+'&right_eye='+right_eye+'&left_eye='+left_eye+'&fitness='+fitness+'&coat='+coat+'&gait='+gait+'&comments='+comments+'&nocache='+nocache);
http.onreadystatechange = insertPhysicalReply;

http.send(null);
}

function insert_role_physical(ele,horse) {
var horse_key=horse;
	
var horse_key= encodeURI(document.getElementById('phorse_key'+horse).value);

var day= encodeURI(document.getElementById('pday'+horse).value);
var month= encodeURI(document.getElementById('pmonth'+horse).value);
var year= encodeURI(document.getElementById('pyear'+horse).value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('pnday'+horse).value);
var month= encodeURI(document.getElementById('pnmonth'+horse).value);
var year= encodeURI(document.getElementById('pnyear'+horse).value);
var next_date= year+"-"+month+"-"+day;

var radios = document.getElementsByName('pblood_drawn'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var blood=radios[i].value;
    }
}
var radios = document.getElementsByName('pfecal_sampled'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var fecal=radios[i].value;
    }
}

var radios = document.getElementsByName('psheath_cleaned'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var sheath=radios[i].value;
    }
}

var radios = document.getElementsByName('pteeth_floated'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var teeth=radios[i].value;
    }
}

var radios = document.getElementsByName('pvaccination_given'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var vaccination=radios[i].value;
    }
}

var radios = document.getElementsByName('pradiograph_taken'+horse);
for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
        var radiograph=radios[i].value;
    }
}

var temperature= encodeURI(document.getElementById('ptemperature'+horse).value);
var pulse= encodeURI(document.getElementById('ppulse'+horse).value);
var respiration= encodeURI(document.getElementById('prespiration'+horse).value);
var right_eye= encodeURI(document.getElementById('pright_eye_exam'+horse).value);
if (right_eye=="other"){
	var right_eye= encodeURI(document.getElementById('pright_eye_exam_other'+horse).value);
}
var left_eye= encodeURI(document.getElementById('pleft_eye_exam'+horse).value);
if (left_eye=="other"){
	var left_eye= encodeURI(document.getElementById('pleft_eye_exam_other'+horse).value);
}
var fitness= encodeURI(document.getElementById('pfitness_evaluation'+horse).value);
if (fitness=="other"){
	var fitness= encodeURI(document.getElementById('pfitness_evaluation_other'+horse).value);
}
var coat= encodeURI(document.getElementById('pcoat_appearance'+horse).value);
if (coat=="other"){
	var coat= encodeURI(document.getElementById('pcoat_appearance_other'+horse).value);
}
var gait= encodeURI(document.getElementById('pgait_symmetry'+horse).value);
if (gait=="other"){
	var gait= encodeURI(document.getElementById('pgait_symmetry_other'+horse).value);
}
var comments= encodeURI(document.getElementById('pcomments'+horse).value);
var vet_key= encodeURI(document.getElementById('pvet_key'+horse).value);

nocache = Math.random();
http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&vet_key='+vet_key+'&next_date='+next_date+'&blood='+blood+'&fecal='+fecal+'&sheath='+sheath+'&teeth='+teeth+'&vaccination='+vaccination+'&radiograph='+radiograph+'&temperature='+temperature+'&pulse='+pulse+'&respiration='+respiration+'&right_eye='+right_eye+'&left_eye='+left_eye+'&fitness='+fitness+'&coat='+coat+'&gait='+gait+'&comments='+comments+'&nocache='+nocache);
 http.onreadystatechange=function () {
        callResponse(ele, horse);
 }; 	

http.send(null);
}

function insert_vaccination() {	
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('vday').value);
var month= encodeURI(document.getElementById('vmonth').value);
var year= encodeURI(document.getElementById('vyear').value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('vnday').value);
var month= encodeURI(document.getElementById('vnmonth').value);
var year= encodeURI(document.getElementById('vnyear').value);
var next_date= year+"-"+month+"-"+day;
var vac_type= encodeURI(document.getElementById('vtype').value);
var vac_type2= encodeURI(document.getElementById('vtype2').value);
var vac_type3= encodeURI(document.getElementById('vtype3').value);
var vet_key= encodeURI(document.getElementById('vvet_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&next_date='+next_date+'&vac_type='+vac_type+'&vac_type2='+vac_type2+'&vac_type3='+vac_type3+'&vet_key='+vet_key+'&nocache='+nocache);
var responseDiv='vaccination_response';
http.onreadystatechange = insertVaccinationReply;
http.send(null);
}

function insert_role_vaccination(ele,horse) {

var horse_key= horse;

var day= encodeURI(document.getElementById('vday'+horse).value);
var month= encodeURI(document.getElementById('vmonth'+horse).value);
var year= encodeURI(document.getElementById('vyear'+horse).value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('vnday'+horse).value);
var month= encodeURI(document.getElementById('vnmonth'+horse).value);
var year= encodeURI(document.getElementById('vnyear'+horse).value);
var next_date= year+"-"+month+"-"+day;
var vac_type= encodeURI(document.getElementById('vtype'+horse).value);
var vac_type2= encodeURI(document.getElementById('vtype2'+horse).value);
var vac_type3= encodeURI(document.getElementById('vtype3'+horse).value);
var vet_key= encodeURI(document.getElementById('vvet_key'+horse).value);
nocache = Math.random();

http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&next_date='+next_date+'&vac_type='+vac_type+'&vac_type2='+vac_type2+'&vac_type3='+vac_type3+'&vet_key='+vet_key+'&nocache='+nocache);

 http.onreadystatechange=function () {
        callResponse(ele, horse);
 }; 
http.send(null);
}

function insert_parasite() {	
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('paday').value);
var month= encodeURI(document.getElementById('pamonth').value);
var year= encodeURI(document.getElementById('payear').value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('panday').value);
var month= encodeURI(document.getElementById('panmonth').value);
var year= encodeURI(document.getElementById('panyear').value);
var next_date= year+"-"+month+"-"+day;
var type= encodeURI(document.getElementById('patype').value);
var vet_key= encodeURI(document.getElementById('pavet_key').value);
var parasite=1;

nocache = Math.random();
http.open('get','insert.php?horse_key='+horse_key+'&parasite='+parasite+'&date='+date+'&next_date='+next_date+'&type='+type+'&vet_key='+vet_key+'&nocache='+nocache);
var responseDiv='parasite_response';
http.onreadystatechange = insertParasiteReply;
http.send(null);
}

function insert_role_parasite(ele,horse) {	

var horse_key= horse;
var day= encodeURI(document.getElementById('paday'+horse).value);
var month= encodeURI(document.getElementById('pamonth'+horse).value);
var year= encodeURI(document.getElementById('payear'+horse).value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('panday'+horse).value);
var month= encodeURI(document.getElementById('panmonth'+horse).value);
var year= encodeURI(document.getElementById('panyear'+horse).value);
var next_date= year+"-"+month+"-"+day;
var type= encodeURI(document.getElementById('patype'+horse).value);
var vet_key= encodeURI(document.getElementById('pavet_key'+horse).value);
var parasite=1;
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&parasite='+parasite+'&date='+date+'&next_date='+next_date+'&type='+type+'&vet_key='+vet_key+'&nocache='+nocache);
var responseDiv='parasite_response';
 http.onreadystatechange=function () {
        callResponse(ele, horse);
 };
http.send(null);
}

function insert_dental() {	
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('dday').value);
var month= encodeURI(document.getElementById('dmonth').value);
var year= encodeURI(document.getElementById('dyear').value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('dnday').value);
var month= encodeURI(document.getElementById('dnmonth').value);
var year= encodeURI(document.getElementById('dnyear').value);
var next_date= year+"-"+month+"-"+day;
var procedure= encodeURI(document.getElementById('dprocedure').value);
var procedure_other= encodeURI(document.getElementById('dprocedureother').value);
if(procedure=="other"){
	procedure=procedure_other;
}
var dental="1";
var vet_key= encodeURI(document.getElementById('dvet_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&dental='+dental+'&date='+date+'&next_date='+next_date+'&procedure='+procedure+'&vet_key='+vet_key+'&nochache='+nocache);
http.onreadystatechange = insertDentalReply;
http.send(null);
}


function insert_role_dental(ele,horse) {	
var horse_key= horse;
var day= encodeURI(document.getElementById('dday'+horse).value);
var month= encodeURI(document.getElementById('dmonth'+horse).value);
var year= encodeURI(document.getElementById('dyear'+horse).value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('dnday'+horse).value);
var month= encodeURI(document.getElementById('dnmonth'+horse).value);
var year= encodeURI(document.getElementById('dnyear'+horse).value);
var next_date= year+"-"+month+"-"+day;
var procedure= encodeURI(document.getElementById('dprocedure'+horse).value);
var procedure_other= encodeURI(document.getElementById('dprocedureother'+horse).value);
if(procedure=="other"){
	procedure=procedure_other;
}
var dental="1";
var vet_key= encodeURI(document.getElementById('dvet_key'+horse).value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&dental='+dental+'&date='+date+'&next_date='+next_date+'&procedure='+procedure+'&vet_key='+vet_key+'&nochache='+nocache);
 http.onreadystatechange=function () {
        callResponse(ele, horse);
 };
http.send(null);
}

function insert_farrier() {	
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('fday').value);
var month= encodeURI(document.getElementById('fmonth').value);
var year= encodeURI(document.getElementById('fyear').value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('fnday').value);
var month= encodeURI(document.getElementById('fnmonth').value);
var year= encodeURI(document.getElementById('fnyear').value);
var next_date= year+"-"+month+"-"+day;
var comments= encodeURI(document.getElementById('fcomments').value);
var procedure= encodeURI(document.getElementById('fprocedure').value);
var procedure_other= encodeURI(document.getElementById('fprocedureother').value);
if(procedure=="other"){
	procedure=procedure_other;
}
var farrier="1";
var vet_key= encodeURI(document.getElementById('fvet_key').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&farrier='+farrier+'&date='+date+'&next_date='+next_date+'&procedure='+procedure+'&comments='+comments+'&vet_key='+vet_key+'&nocache='+nocache);
http.onreadystatechange = insertFarrierReply;
http.send(null);
}

function insert_role_farrier(ele,horse) {	
var horse_key= horse;
var day= encodeURI(document.getElementById('fday'+horse).value);
var month= encodeURI(document.getElementById('fmonth'+horse).value);
var year= encodeURI(document.getElementById('fyear'+horse).value);
var date= year+"-"+month+"-"+day;
var day= encodeURI(document.getElementById('fnday'+horse).value);
var month= encodeURI(document.getElementById('fnmonth'+horse).value);
var year= encodeURI(document.getElementById('fnyear'+horse).value);
var next_date= year+"-"+month+"-"+day;
var comments= encodeURI(document.getElementById('fcomments'+horse).value);
var procedure= encodeURI(document.getElementById('fprocedure'+horse).value);
var procedure_other= encodeURI(document.getElementById('fprocedureother'+horse).value);
if(procedure=="other"){
	procedure=procedure_other;
}
var farrier="1";
var vet_key= encodeURI(document.getElementById('fvet_key'+horse).value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&farrier='+farrier+'&date='+date+'&next_date='+next_date+'&procedure='+procedure+'&comments='+comments+'&vet_key='+vet_key+'&nocache='+nocache);
 http.onreadystatechange=function () {
        callResponse(ele, horse);
 };
http.send(null);
}

function insert_history() {	
var horse_key= encodeURI(document.getElementById('horse_key').value);
var day= encodeURI(document.getElementById('hday').value);
var month= encodeURI(document.getElementById('hmonth').value);
var year= encodeURI(document.getElementById('hyear').value);
var date= year+"-"+month+"-"+day;
var comment= encodeURI(document.getElementById('hcomment').value);
var history="1";
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&comment='+comment+'&history='+history+'&nocache='+nocache);
http.onreadystatechange = insertHistoryReply;
http.send(null);
}

function insert_role_history(ele,horse) {	
var horse_key= horse;
var day= encodeURI(document.getElementById('hday'+horse).value);
var month= encodeURI(document.getElementById('hmonth'+horse).value);
var year= encodeURI(document.getElementById('hyear'+horse).value);
var date= year+"-"+month+"-"+day;
var comment= encodeURI(document.getElementById('hcomment'+horse).value);
var history="1";
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_key='+horse_key+'&date='+date+'&comment='+comment+'&history='+history+'&nocache='+nocache);
 http.onreadystatechange=function () {
        callResponse(ele, horse);
 };
http.send(null);
}

//insert new horse
function insert_horse() {
//hide modal on submit
$("#myModal_horse").modal("hide"); 

var horse_record= encodeURI(document.getElementById('nhorse_record').value);
var horse_key= encodeURI(document.getElementById('nhorse_key').value);
var horse_image= encodeURI(document.getElementById('nhorse_image').value);
var horse_name= encodeURI(document.getElementById('nhorse_name').value);
var owner_key= encodeURI(document.getElementById('nowner_key').value);
var vet_key= encodeURI(document.getElementById('nvet_key').value);
var contact= encodeURI(document.getElementById('nowner_phone_number').value);
var breed= encodeURI(document.getElementById('nbreed').value);
var day= encodeURI(document.getElementById('nday').value);
var month= encodeURI(document.getElementById('nmonth').value);
var year= encodeURI(document.getElementById('nyear').value);
var birth= year+"-"+month+"-"+day;
var height= encodeURI(document.getElementById('nheight').value);
var weight= encodeURI(document.getElementById('nweight').value);
var temp= encodeURI(document.getElementById('ntemperature').value);
var heart= encodeURI(document.getElementById('npulse').value);
var resp= encodeURI(document.getElementById('nrespiration').value);
var vices= encodeURI(document.getElementById('nvices').value);
var considerations= encodeURI(document.getElementById('nspecial_medical_conditions').value);
var brand= encodeURI(document.getElementById('ntatoo_or_brand').value);
var markings= encodeURI(document.getElementById('nmarkings').value);
var color= encodeURI(document.getElementById('ncolor').value);
var sex= encodeURI(document.getElementById('nsex').value);
var stall= encodeURI(document.getElementById('nstall').value);

// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_name='+horse_name+'&horse_key='+horse_key+'&horse_record='+horse_record+'&horse_image='+horse_image+'&owner_key='+owner_key+'&vet_key='+vet_key+'&contact='+contact+'&breed='+breed+'&birth='+birth+'&height='+height+'&weight='+weight+'&temp='+temp+'&heart='+heart+'&resp='+resp+'&vices='+vices+'&considerations='+considerations+'&brand='+brand+'&markings='+markings+'&color='+color+'&sex='+sex+'&stall='+stall+'&nocache='+nocache);
if(horse_record=="new"){
http.onreadystatechange = insertReply;
}else{
http.onreadystatechange = insertHorseUpdateReply;
}	
http.send(null);
}
//update horse
function update_horse() {

var horse_record= encodeURI(document.getElementById('uhorse_record').value);
var horse_key= encodeURI(document.getElementById('uhorse_key').value);
var horse_image= encodeURI(document.getElementById('uhorse_image').value);
var horse_name= encodeURI(document.getElementById('uhorse_name').value);
var owner_key= encodeURI(document.getElementById('uowner_key').value);
var vet_key= encodeURI(document.getElementById('uvet_key').value);
var farrier_key= encodeURI(document.getElementById('ufarrier_key').value);
var contact= encodeURI(document.getElementById('uowner_phone_number').value);
var breed= encodeURI(document.getElementById('ubreed').value);
var day= encodeURI(document.getElementById('uday').value);
var month= encodeURI(document.getElementById('umonth').value);
var year= encodeURI(document.getElementById('uyear').value);
var birth= year+"-"+month+"-"+day;
var height= encodeURI(document.getElementById('uheight').value);
var weight= encodeURI(document.getElementById('uweight').value);
var temp= encodeURI(document.getElementById('utemperature').value);
var heart= encodeURI(document.getElementById('upulse').value);
var resp= encodeURI(document.getElementById('urespiration').value);
var vices= encodeURI(document.getElementById('uvices').value);
var considerations= encodeURI(document.getElementById('uspecial_medical_conditions').value);
var brand= encodeURI(document.getElementById('utatoo_or_brand').value);
var markings= encodeURI(document.getElementById('umarkings').value);
var color= encodeURI(document.getElementById('ucolor').value);
var sex= encodeURI(document.getElementById('usex').value);
var stall= encodeURI(document.getElementById('ustall').value);


// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_name='+horse_name+'&horse_key='+horse_key+'&horse_record='+horse_record+'&horse_image='+horse_image+'&owner_key='+owner_key+'&vet_key='+vet_key+'&farrier_key='+farrier_key+'&contact='+contact+'&breed='+breed+'&birth='+birth+'&height='+height+'&weight='+weight+'&temp='+temp+'&heart='+heart+'&resp='+resp+'&vices='+vices+'&considerations='+considerations+'&brand='+brand+'&markings='+markings+'&color='+color+'&sex='+sex+'&stall='+stall+'&nocache='+nocache);
if(horse_record=="new"){
http.onreadystatechange = insertReply;
}else{
http.onreadystatechange = insertHorseUpdateReply;
}	
http.send(null);
}

//role update horse
function role_update_horse(ele,horse) {

var horse_record='role';
var horse_key=horse;
var horse_image= encodeURI(document.getElementById('uhorse_image'+horse).value);
var horse_name= encodeURI(document.getElementById('uhorse_name'+horse).value);
var owner_key= encodeURI(document.getElementById('uowner_key'+horse).value);
var vet_key= encodeURI(document.getElementById('uvet_key'+horse).value);
var farrier_key= encodeURI(document.getElementById('ufarrier_key'+horse).value);
var contact= encodeURI(document.getElementById('uowner_phone_number'+horse).value);
var breed= encodeURI(document.getElementById('ubreed'+horse).value);
var day= encodeURI(document.getElementById('uday'+horse).value);
var month= encodeURI(document.getElementById('umonth'+horse).value);
var year= encodeURI(document.getElementById('uyear'+horse).value);
var birth= year+"-"+month+"-"+day;
var height= encodeURI(document.getElementById('uheight'+horse).value);
var weight= encodeURI(document.getElementById('uweight'+horse).value);
var temp= encodeURI(document.getElementById('utemperature'+horse).value);
var heart= encodeURI(document.getElementById('upulse'+horse).value);
var resp= encodeURI(document.getElementById('urespiration'+horse).value);
var vices= encodeURI(document.getElementById('uvices'+horse).value);
var considerations= encodeURI(document.getElementById('uspecial_medical_conditions'+horse).value);
var brand= encodeURI(document.getElementById('utatoo_or_brand'+horse).value);
var markings= encodeURI(document.getElementById('umarkings'+horse).value);
var color= encodeURI(document.getElementById('ucolor'+horse).value);
var sex= encodeURI(document.getElementById('usex'+horse).value);
var stall= encodeURI(document.getElementById('ustall'+horse).value);


// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?horse_name='+horse_name+'&horse_key='+horse_key+'&horse_record='+horse_record+'&horse_image='+horse_image+'&owner_key='+owner_key+'&vet_key='+vet_key+'&farrier_key='+farrier_key+'&contact='+contact+'&breed='+breed+'&birth='+birth+'&height='+height+'&weight='+weight+'&temp='+temp+'&heart='+heart+'&resp='+resp+'&vices='+vices+'&considerations='+considerations+'&brand='+brand+'&markings='+markings+'&color='+color+'&sex='+sex+'&stall='+stall+'&nocache='+nocache);
 http.onreadystatechange=function () {
        callResponse(ele, horse_name);
 }; 	
http.send(null);
}

//insert new owner
function insert_owner() {
//hide modal on submit
$("#myModal_owner").modal("hide"); 
// Optional: Show a waiting message in the layer with ID login_response
document.getElementById('insert_response').innerHTML = "     Uploading Information..."
var new_owner=1;
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
http.open('get','insert.php?first_name='+first_name+'&new_vet'+new_vet+'&last_name='+last_name+'&street_address='+street_address+'&city='+city+'&state='+state+'&zip='+zip+'&phone='+phone+'&horse_key='+horse_key+'&vet_key='+vet_key+'&nocache='+nocache);
http.onreadystatechange = insertReply;
http.send(null);
}

//insert new vet
function insert_vet() {
var new_vet=1;
var first_name= encodeURI(document.getElementById('vetfirst_name').value);
var last_name= encodeURI(document.getElementById('vetlast_name').value);
var street_address= encodeURI(document.getElementById('vetstreet_address').value);
var city= encodeURI(document.getElementById('vetcity').value);
var state= encodeURI(document.getElementById('vetstate').value);
var zip= encodeURI(document.getElementById('vetzip').value);
var phone= encodeURI(document.getElementById('vetphone').value);
var horse_key= encodeURI(document.getElementById('vethorse_key').value);
var email= encodeURI(document.getElementById('vetemail').value);
var access= encodeURI(document.getElementById('vetaccess').value);
var pass= encodeURI(document.getElementById('vetpass').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?first_name='+first_name+'&new_vet='+new_vet+'&last_name='+last_name+'&street_address='+street_address+'&city='+city+'&state='+state+'&zip='+zip+'&phone='+phone+'&horse_key='+horse_key+'&email='+email+'&access='+access+'&pass='+pass+'&nocache='+nocache);
http.onreadystatechange = insertVetReply;
http.send(null);
}

//insert new admin
function insert_admin() {	
var first_name= encodeURI(document.getElementById('login_first_name').value);
var last_name= encodeURI(document.getElementById('login_last_name').value);
var access= encodeURI(document.getElementById('login_access').value);
var password= encodeURI(document.getElementById('login_password').value);
var address= encodeURI(document.getElementById('login_address').value);
var city= encodeURI(document.getElementById('login_city').value);
var state= encodeURI(document.getElementById('login_state').value);
var zip= encodeURI(document.getElementById('login_zip').value);
var phone= encodeURI(document.getElementById('login_phone').value);
var email= encodeURI(document.getElementById('login_email').value);
var role= encodeURI(document.getElementById('login_role').value);

// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?first_name='+first_name+'&last_name='+last_name+'&access='+access+'&password='+password+'&address='+address+'&city='+city+'&state='+state+'&zip='+zip+'&phone='+phone+'&email='+email+'&role='+role+'&nocache='+nocache);
http.onreadystatechange = insertAdminReply;
http.send(null);
}

function insert_facility() {	
var name= encodeURI(document.getElementById('facilityname').value);
var owner= encodeURI(document.getElementById('facilityowner').value);
var address= encodeURI(document.getElementById('facilityaddress').value);
var phone= encodeURI(document.getElementById('facilityphone').value);
// Set te random number to add to URL request
nocache = Math.random();
// Pass the login variables like URL variable
http.open('get','insert.php?facilityname='+name+'&owner='+owner+'&address='+address+'&phone='+phone+'&nocache='+nocache);
http.onreadystatechange = insertFacilityReply;
http.send(null);
}

function delete_precord(key){
	var record_key= encodeURI(document.getElementById(key).value);
	var table_name= encodeURI(document.getElementById('ptable_name').value);
	var delete_date= encodeURI(document.getElementById('pdate').value);
	nocache = Math.random();
	http.open('get','insert.php?record_key='+record_key+'&table_name='+table_name+'&delete_date='+delete_date+'&nocache='+nocache);
	http.onreadystatechange = insertPhysicalDeleteReply;
	http.send(null);
}
function reloadPage(){
	location.reload(true);
}
function deleteFunction(record_key, table_name){
	nocache = Math.random();
	http.open('get','delete.php?record_key='+record_key+'&table_name='+table_name+'&nocache='+nocache);

}

function delete_record(record_key, table, ele, name){
	if(!confirm('Absolutely, Definitely, Delete '+name+' Data?')){
		return false;
		}else{
			//alert(record_key+' '+table+' '+ele+' '+name);
	nocache = Math.random();
	var table=table;
	var record_key=record_key;
	var ele=ele;
        http.open('get', 'deleterecord.php?record_key='+record_key+'&table='+table+'&nocache='+nocache);
    	http.onreadystatechange=function () {
            callResponse(ele, name);
        };  
        http.send(null);
		}
    }
 	
function callResponse(ele, name) {
	if(http.readyState == 4){ 
		var response = http.responseText;
		document.getElementById(ele).innerHTML = name + response;
	}
}

function delete_drecord(){
	var record_key= encodeURI(document.getElementById('drecord_key').value);
	var table_name= encodeURI(document.getElementById('dtable_name').value);
	var delete_date= encodeURI(document.getElementById('ddate').value);
	nocache = Math.random();
	http.open('get','insert.php?record_key='+record_key+'&table_name='+table_name+'&delete_date='+delete_date+'&nocache='+nocache);
	http.onreadystatechange = insertDentalDeleteReply;
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
function insertFarrierReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('farrier_response').innerHTML = response;
}
}
function insertFacilityReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('facility_response').innerHTML = response;
}
}
function insertHistoryReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('history_response').innerHTML = response;
}
}

function insertParasiteReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('parasite_response').innerHTML = response;
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
function insertAdminReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('insert_admin_response').innerHTML=response;
}
}
function insertVetReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('insert_vet_response').innerHTML=response;
}
}

function insertmyModalOwnerreply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('myModal_owner').innerHTML = '-->'+response;
}
} 
function insertHorseUpdateReply() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
document.getElementById('horseUpdateResponse').innerHTML = response;
}
} 
 
function insertPhysicalDeleteReply() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	document.getElementById('physical').innerHTML=response;
	}
}
function insertVaccinationDeleteReply() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	document.getElementById('vaccination').innerHTML=response;
	}
}
function insertDentalDeleteReply() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	document.getElementById('dental').innerHTML=response;
	}
}
function insertFarrierDeleteReply() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	document.getElementById('farrier').innerHTML=response;
	}
}
function adminDeleteResponse() {
if(http.readyState == 4){ 
var response = http.responseText;
// else if login is ok show a message: "Site added+ site URL".
alert(response);
}
}
</script>
</head>
<?	 
$dbname = get_db();
$conn=get_conn($dbname);

if(isset($_REQUEST['horse_choice'])){
	$horse_key=$_REQUEST['horse_choice'];
	$_SESSION['horse_key']=$horse_key;
	$_SESSION['role_mode']=0;
}

if(isset($_REQUEST['filter'])){
	$_SESSION['role_mode']=1;
	$filter=$_REQUEST['filter'];
	if($filter=='vet'||$filter=='owner'||$filter=='farrier'){
		$filter_key=$filter.'filter';
		$role_key=$_REQUEST[$filter_key];
		$role_name=getName($role_key,'login',$dbname);
		$_SESSION['role']=$filter;
		$message="  Selected, filtered by ".$filter.": <em>".$role_name."</em>";
		$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$dbname);
	}else{
		$role_key=10;//set to appt mode
		
		$filtera=explode('_',$filter);
		$filter=$filtera[0];
		$message="Scheduled for <em>".$filter."</em> appt";
		$_SESSION['appt']=$appt;		
		$horses=GetHorsesFromAppt($filter,2,$_SESSION['facility'],$dbname);	
	}
	$_SESSION['role_key']=$role_key;
}

if(isset($_SESSION['role_key'])){
	$role_key=$_SESSION['role_key'];//key of the user selected
	$role=$_SESSION['role'];//role of the user selected
	$role_mode=$_SESSION['role_mode'];//role mode 0=horse, 1=user
	$horse_key=$_SESSION['horse_key'];
	$appt=$_SESSION['appt'];
}

if($_SESSION['passwordcheck']=='pass'){
//set and get initial values for site
	$dbTable1='information';
	$dbTable2='login';
	if($_SESSION['facility']=='ALL'){
		$sql_horse="SELECT * FROM $dbTable1 ";
	}else{
		$sql_horse="SELECT * FROM $dbTable1 WHERE `facility_key`='$_SESSION[facility]' ORDER BY horse_name";
		}
	//$sql2="SELECT `key`,`first_name`,`last_name`,`role` FROM $dbTable2 WHERE `facility_key`='$_SESSION[facility]' AND (`role`='owner' OR `role`='vet' OR `role`='farrier' OR `role`='manager')  ORDER BY role, last_name";
	$filter_sql="SELECT * FROM filter_options ";
	$horse_result = mysqli_query($conn, $sql_horse) or die(mysqli_error());
	$filters=mysqli_query($conn, $filter_sql) or die(mysqli_error());
	//$horse_result = getTableData("key","ALL", "information", $dbname);
	//$role_result = mysql_query($sql2,$conn) or die(mysql_error());	
	$info_field_labels=GetMysqlFieldNames("information", $dbname);
	$owner_field_labels=GetMysqlFieldNames("owner", $dbname);
	$login_field_labels=GetMysqlFieldNames("login", $dbname);

	$login_data=GetTableDataFacility("key","ALL", "login", $dbname ,$_SESSION['facility']);
	$owner_data=GetTableDataFacility("owner","owner_key", "login", $dbname ,$_SESSION['facility']);
	$vet_data=GetTableDataFacility("vet","vet_key", "login", $dbname ,$_SESSION['facility']);
	$farrier_data=GetTableDataFacility("farrier","farrier_key", "login", $dbname ,$_SESSION['facility']);
	$vacc_products=GetMysqlFieldNames("vacc_products", $dbname);
	$deworm_products=GetMysqlFieldNames("dewormer_products", $dbname);
	$vacc_product_data=GetProductTableData("key","ALL", "vacc_products", $dbname);
	$deworm_product_data=GetProductTableData("key","ALL", "dewormer_products", $dbname);
	$vacc_product_expiration=GetProductTableData("infection","frequency", "vacc_products", $dbname);
	$vacc_product_labels=GetMysqlFieldNames("vacc_products", $dbname);
	$vacc_data=GetTableDataFacility("key","ALL", "vaccination", $dbname ,$_SESSION['facility']);//delete this when done

	$horse_data=GetTableDataFacility("key","ALL", "information", $dbname ,$_SESSION['facility']);
	$physicals=getReminders("physical",1, $dbname ,$_SESSION['facility']);
	//$vaccinations=getReminders("vaccination",1,$dbname ,$_SESSION[facility]);
	$dental=getReminders("dental",1,$dbname ,$_SESSION['facility']);
	$farrier=getReminders("farrier",1,$dbname ,$_SESSION['facility']);
	$role_results=getRoles($_SESSION['facility'], $dbname);

}
if (isset($horse_key)&&$horse_key){// use this to load horse data for page
		$infoResult=GetTableDataFacility("key",$horse_key,"information", $dbname ,$_SESSION['facility']);
		$vet_key=$infoResult[0]['vet_key'];
		$owner_key=$infoResult[0]['owner_key'];
		$vet=GetTableDataFacility("vet_key",$vet_key, "login", $dbname ,$_SESSION['facility']);
		$owner=GetTableDataFacility("horse_key",$owner_key, "owner", $dbname ,$_SESSION['facility']);
		$owner_name=$owner[0]['first_name']." ".$owner[0]['last_name'];
		$vet_name=$vet[0]['first_name']." ".$vet[0]['last_name'];
		$horse_name=$infoResult[0]['horse_name'];

	}
if (isset($owner_key)&&$owner_key&&!$horse_key){// use this to load horse data for page if owner selected
	$owner_horse=GetTableDataFacility("horse_key",$owner_key, "information", $dbname ,$_SESSION['facility']);
	$horse_key=$owner_horse[0]['horse_key'];
	$infoResult=GetTableDataFacility("horse_key",$owner_key, "information", $dbname ,$_SESSION['facility']);
	$vet_key=$infoResult[0]['vet_key'];
	$owner=GetTableDataFacility("horse_key",$owner_key, "owner", $dbname ,$_SESSION['facility']);
	$owner_name=$owner[0]['first_name']." ".$owner[0]['last_name'];
}

?>
<body style="font-size:62.5%;">

<!--<div id="north_container" class="ui-layout-north">-->
<div id="north_container" class="ui-layout-north ui-widget-content" style="display: none;">
<?
if($_SESSION['passwordcheck']!='pass'){
	print "<span id='title'>Caval-Connect </span><span><input id='login' type = 'submit' name = 'login' class= 'btn btn-success' value = 'Login' onclick='check(this.value)'></span>";
}elseif($_SESSION['passwordcheck']=='pass'){
	
	if(isset($horse_name)&&$horse_name&&$role_mode==0){
		print "<span id='title'>".$horse_name." Caval-Connected </span><span><input id='logout' type ='submit' name ='logout' class= 'btn btn-danger' value = 'Logout $_SESSION[first]' onclick='parent.location=&quot;logout.php&quot;'></span>";
	}elseif($role_mode==1){
		print "<span id='title'> Caval-Connected as ".$filter.": ".$role_name." </span><span><input id='logout' type ='submit' name ='logout' class= 'btn btn-danger' value = 'Logout $_SESSION[first]' onclick='parent.location=&quot;logout.php&quot;'></span>";
	}
	else{
	print "<span id='title'>Caval-Connect </span><span><input id='logout' type ='submit' name ='logout' class= 'btn btn-danger' value = 'Logout $_SESSION[first]' onclick='parent.location=&quot;logout.php&quot;'></span>";
	}
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
		<?

foreach ($yearArray as $year)
		print "<tr><td><br>";
		print "</td></tr>";
			print "<td>";
				print "<select name='horse_choice' id='horse_choice' onchange='check(this.value);'>";
					print "<option value=''> Select Horse </option>";
					
						if($_SESSION['passwordcheck']=='pass'){
							while($row = mysqli_fetch_assoc($horse_result)){
								$selected = ((isset($_POST['horse_choice']) && $_POST['horse_choice'] == $row[key]) || ($row[key] == 'Select Horse')) ? 'selected' : '';
								echo '<option name="year" '.$selected.'  value="'.$row[key].'">'.$row[horse_name].'</option>';
							}//end while
						if($_SESSION['access']=='1'){//allow to update information
							print "<option value='new_horse'><span class='red'>New Horse</span></option>"; //Only allow if appropriate access level
						}//end global check
					}//end passcheck
						
				print "</select>";
			print "</td>";
		print "</tr>";
		print "<tr>";
			print "<td>";
				print "<input 	id='submit_horse' type = 'submit' name = 'submit_horse' class= 'btn btn-warning' value = 'Submit Horse Selection'/>";
			print "</td>";
		print "</tr>";
		print "<tr>";
			print "<td>";
				print "<br>";
			print "</td>";
		print "</tr>";
		print "</form>"; //<!--end horse form-->
		print "<form 
				name='owner'
				id='owner' 
				action='index.php' 
				method = 'post'>";
		print "<tr>";
			print "<td>";
			
				print " <select name='filter' class='filter' id='filter' onchange='showSelectFilter(&quot;filter&quot;, &quot;filter3&quot;, this.value);'>";
					print "<option value=''> Group Horses by Filter </option>";
						
						while($filter = mysqli_fetch_assoc($filters)){
							print "<option value='".str_replace(' ','_',$filter['name'])."'>".$filter['name']."</option>";
						}
				print "</select>";
						
					
				print "<select  class='filter' style='width: 150; display:none;' id='ownerfilter' name='ownerfilter'>";
						print "<option value='none'>Select Owner</option>";
								foreach($role_results as $role){
									if($role['role']=="owner"){
										print "<option value='".$role['key']."'>".$role['first_name']." ".$role['last_name']."</option>";
									}
								}
								reset($role_result);
				print "</select>";

				print "<select  class='filter' style='width: 150; display:none;' id='vetfilter' name='vetfilter'>";
						print "<option value='none'>Select Vet</option>";
								foreach($role_results as $role){
									if($role['role']=="vet"){
										print "<option value='".$role['key']."'>".$role['first_name']." ".$role['last_name']."</option>";
									}
								}
								reset($role_result);
				print "</select>";
				
				print "<select  class='filter' style='width: 150; display:none;' id='farrierfilter' name='farrierfilter'>";
						print "<option value='none'>Select Farrier</option>";
								foreach($role_results as $role){
									if($role['role']=="farrier"){
										print "<option value='".$role['key']."'>".$role['first_name']." ".$role['last_name']."</option>";
									}
								}
								reset($role_result);
				print "</select>";

					
						
						?>
				
			</td>
		</tr>
		<tr>
			<td>
				<input 	id="filter3" style='display:none;' type = "submit" name = "submit_owner" class= "btn btn-warning filter" value = "Submit Filter Selection"/>
			</td>
		</tr>
		</form><!--end owner form-->
		<tr>
			<td>
				<p><div id = "greyline""></div></p>
			</td>
		</tr>	
		
		<tr width='100'>
			<td width='100'><h6 id='insert_response'>
			<?if($_SESSION['passwordcheck']=='pass'){
				print "Welcome ".($_SESSION['first']);
			}elseif($_SESSION['passwordcheck']=='fail'){
				print "Sorry, your entry did not match our passwords.";
			}
		
		print "</h6></td></tr>";
		?>
		<tr><td>Reminders:</tr></td></table><!--end west container div>-->
		
		<div  class='DivWithScroll ui-layout-content'>
		<table id="west_data2" width="100%" align="center">
<?
		//print "<tr><td>Reminders</tr></td>";


	
print "<h6>";
if($physicals){
	print"<tr id='remind'><td class='bold'>Physicals:</td></tr>";
		foreach($physicals as $data){
			print "<tr id='remind'>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".date('l',strtotime($data[next_date]))."</td>";
			print "</tr>";
		}
}else{
	print"<tr id='remind'><td class='bold'>No Scheduled Physicals</td></tr>";
}
if($farrier){
	print"<tr id='remind'><td class='bold'>Farrier:</td></tr>";
		foreach($farrier as $data){
			print "<tr id='remind'>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".date('l',strtotime($data[next_date]))."</td>";
			print "</tr>";
		}
}else{
	print"<tr id='remind'><td class='bold'>No Scheduled Farrier</td></tr>";
}
if($dental){
	print"<tr id='remind'><td class='bold'>Dental:</td></tr>";
		foreach($dental as $data){
			print "<tr id='remind'>";
				print "<td>".getHorseName($data[horse_key],$horse_data)." ".date('l',strtotime($data[next_date]))."</td>";
			print "</tr>";
		}
}else{
	print"<tr id='remind'><td class='bold'>No Scheduled Dental</td></tr>";
}		
		?>
	</h6></table>
	
	<?build_footer()?>
	</div><!--end div with scroll-->
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
        <li><a href="#fragment-4"><span>Farrier</span></a></li>
        <li><a href="#fragment-5"><span>Parasites</span></a></li>
        <li><a href="#fragment-6"><span>Lineage</span></a></li>
        <li><a href="#fragment-7"><span>Medical History</span></a></li>
        <li><a href="#fragment-8"><span>Coggins</span></a></li>
        <li><a href="#fragment-9"><span>Nutrition</span></a></li>
        <li><a href="#fragment-10"><span>Admin</span></a></li>
    </ul>









<?
// ########################## fragment - A ################################## //

print "<div id='fragment-A' class='active'>"; //<!--tab for horse information-->       

if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
	print "<div class='accordion'>";
    if($_SESSION['access'] < 4){

    	if(isset($infoResult)){
        	foreach($infoResult as $row){
  	  	 		print "<h3 id='insert_image_response'>".$row['horse_name']."'s information</h3>";
  	  	 		
  	  	 		print "<div id='delete_info".$row[key]."'>";
  	  	 		print "<table>";//big table
  	  	 			print "<tr><td width='260'><IMG STYLE='border:2px solid black; border-radius:5px; width:250px;' SRC='".str_replace('_',' ',$row[horse_image])."' ALT='Home'></td>";
						print "<td><table id='horse_info'>";//small table

		  	  	 		foreach($info_field_labels as $label){
		  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="horse_image"&&$label!="facility_key"){
		  	  	 				print "<tr>";
		  	  	 					if($label=="owner_key"){
		  	  	 							print "<td class='bottom_borderr' id='field' width='200'>owner</td><td class='bottom_borderr'>".getName($row[owner_key],'login',$dbname)."</td>";
		  	  	 						}elseif($label=="vet_key"){
		  	  	 							print "<td class='bottom_borderr' id='field' width='200'>vet</td><td class='bottom_borderr'>".getName($row[vet_key],'login',$dbname)."</td>";
		  	  	 						}elseif($label=="farrier_key"){
		  	  	 							print "<td class='bottom_borderr' id='field' width='200'>farrier</td><td class='bottom_borderr'>".getName($row[farrier_key],'login',$dbname)."</td>";
		  	  	 						}elseif($label=="facility_key"){
		  	  	 							print "<td class='bottom_borderr' id='field' width='200'>facility</td><td class='bottom_borderr'>".getName($row[facility_key], 'facility',$dbname)."</td>";
		  	  	 						}
		  	  	 						else{  	  	 				
		  	  	 					print "<td class='bottom_borderr' id='field' width='200'>".str_replace('_',' ',$label)."</td><td class='bottom_borderr'>".$row[$label]."</td>";
		  	  	 							}
		  	  	 				print "</tr>";
		  	  	 			}
		  	  	 		}//end foreach

  	  	 				print "</table>";
  	  	 			print "</td></tr>";
  	  	 		print "<tr><td><br></td></tr>";
  				print "</table>";//end big table
  	  	 		?><div id='insert_image_response'>

	 				<form action="image_upload.php" method="post" enctype="multipart/form-data">
						<label for="file">Choose New Image:</label>
						<? print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";?>
						<input type="file" name="file" id="file" value=><br>
						<input type='hidden' name='table' id='table' value="information" />
						<input type='hidden' name='image_type' id='image_type' value="horse_image" />
						<!--<input type="submit" name="submit" value="Submit Image" class= "btn btn-warning">-->
						<input 	id="submit_image" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit-Image"/>
					</form>
				</div><!--image response div-->
				<?
	  	     		print "<table><tr>";
	   	  			if($_SESSION['access']<2){//script for deleting record
	  	  				$element='delete_info'.$row[key];
	  	  				$name=$row['horse_name'];
	  	  				$delete_table='information';
	  	  				print "<form action='javascript:delete_record(".$row[key].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
	  	  	 			print "<input type='hidden' id='info_delete' value='info".$row[key]."'>";
	  	     			print "<td ><input id='delete_info".$row[key]."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$name."' /></td>";
	  	     			print "</form>";
	  	     			
	  	  	 			} 	     		
	  	     		print "</tr></table>";
  	     		print "</div>";

 			}//end for each info result as row
    	}else{
		 	print "No Information has been recorded for". $horse;
		}//end result info if
    }//end access if
    if($_SESSION['access'] < 5){//allow to update information
    	print "<h3>Update ".$horse_name." Information Data</h3>";
    	print "<div id='horseUpdateResponse'>";
     	if($infoResult){
        	foreach($infoResult as $row){
				print "<form  action='javascript:update_horse()' method='post'>";//update horse form
				print "<input type='hidden' name='nhorse_key' id='uhorse_key' value=".$horse_key." />";
				print "<input type='hidden' name='nhorse_image' id='uhorse_image' value=".$row['horse_image']." />";
				print "<input type='hidden' name='nhorse_record' id='uhorse_record' value='update' />";
				print "<table>";
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="owner_key"&&$label!="vet_key"&&$label!="farrier_key"&&$label!="horse_image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date_foaled"||$label=="date"||$label=="next_date"){
  	  	 						//begin date selection - datepicker has problems with touch screens!!
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='umonth' name = 'umonth' >";
									print "<option value = '".date(m,$row[$label])."'>".date(M,$row[$label])."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='uday' name='uday'><option value='".date(d,$row[$label])."'>".date(d,$row[$label])."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='uyear' name='uyear'><option value='".date(Y,$row[$label])."'>".date(Y,$row[$label])."</option>";
								for ($i=1990;$i<=date(Y);$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
								//end date selections
  	  	 					}elseif($label=="height"){
  	  	 						//slect for height
	  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]."  hands </option>";
										for($i = 130; $i <= 180; $i++){
											$j=$i/10;
											print"<option value=$j>$j</option>";
										}//end while
								print "</select></td>";
  	  	 					
  	  	 					}elseif($label=="weight"){
  	  	 						//slect for weight
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]."  pounds </option>";
									for($i = 600; $i <= 1450; $i+=5){
										print"<option value=$i>$i</option>";
									}//end while
								print "</select></td>";
  	  	 					
  	  	 					}
   	  	 					elseif($label=="temperature"){
  	  	 						//slect for weight
	  	  	 					print "<td width='150'>".str_replace('_',' ',$label)." (F)</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]."</option>";
										for($i = 95; $i <= 106; $i+=.1){
											print"<option value=$i>$i</option>";
										}//end while
								print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="pulse"){
  	  	 						//slect for weight
	  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]." per minute </option>";
										for($i = 20; $i <= 50; $i++){
											print"<option value=$i>$i</option>";
										}//end while
								print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="respiration"){
  	  	 						//slect for weight
	  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]." per minute </option>";
										for($i = 10; $i <= 60; $i++){
											print"<option value=$i>$i</option>";
										}//end while
								print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="sex"){
  	  	 						//slect for weight
	  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label."'>";
									print "<option value='".$row[$label]."'>".$row[$label]."</option>";
									print "<option value='stallion'>Stallion</option>";
									print "<option value='gelding'>Gelding</option>";
									print "<option value='mare'>Mare</option>";
								print "</select></td>";
  	  	 					}
  	  	 					else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' value='".$row[$label]."' id='u".$label."'></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td width='150'>Primary Vet</td><td>";
  	  	 					print "<select name='uvet_key' id='uvet_key'>";
									foreach($vet_data as $data){
										if($data[key]==$row[vet_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
									foreach($vet_data as $data){
										if($data[key]!=$row[vet_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								print "<option value='0'>New Vet</option>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td width='150'>Primary Farrier</td><td>";
  	  	 					print "<select name='ufarrier_key' id='ufarrier_key'>";
  	  	 							if($row[farrier_key]<1){
  	  	 								print"<option value=''>'Select Farrier'</option>";
  	  	 							}else{
									foreach($farrier_data as $data){
										if($data[key]==$row[farrier_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
  	  	 							}//end else
									foreach($farrier_data as $data){
										if($data[key]!=$row[farrier_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								//print "<option value='1'>New Farrier</option>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td width='150'>Horse Owner</td><td>";
  	  	 					print "<select name='uowner_key' id='uowner_key'>";
  	  	 							if($row[owner_key]<1){
  	  	 								print"<option value=''>'Select Owner'</option>";
  	  	 							}else{
									foreach($owner_data as $data){
										if($data[key]==$row[owner_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
  	  	 							}//end else
									foreach($owner_data as $data){
										if($data[key]!=$row[owner_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								print "<option value='0'>New Owner</option>";
							print "</select>";
  	  	 				print "</td></tr>";			
			print "</table>";
				?>
				<input 	id="submit_vaccination" type = "submit" name = "submit_vaccination" class= "btn btn-warning" value = "Update Information"/></form>
				<?
  	  	 }//end if for entering new data
        
		}else{//if horse key if
			print	"Please select a horse.";
		}		
		print "</div>";
    }
print "</div>";// <!--end accordion-->	
}					//end horse mode
elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
	print "<div class='roleaccordion'>";
	//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		if($horses){
			foreach($horses as $horse){
				//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
				print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     			print "<div id='role_response".$horse[key]."'>";//place content here

    $element='role_response'.$horse[key];
	print "<form  action='javascript:role_update_horse(&quot;$element&quot;,".$horse[key].")' method='post'>";//update horse form
	
	print "<input type='hidden' name='nhorse_key' id='uhorse_key".$horse[key]."' value=".$horse[key]." />";
	print "<input type='hidden' name='nhorse_image' id='uhorse_image".$horse[key]."' value=".$horse['horse_image']." />";
	print "<input type='hidden' name='nhorse_record' id='uhorse_record".$horse[key]."' value='role_update' />";
	print "<input type='hidden' name='nhorse_record' id='urole_horse_key".$horse[key]."' value='".$horse[key]."' />";
		print "<table>";
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="owner_key"&&$label!="vet_key"&&$label!="farrier_key"&&$label!="horse_image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date_foaled"||$label=="date"||$label=="next_date"){
  	  	 						//begin date selection - datepicker has problems with touch screens!!
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='umonth".$horse[key]."' name = 'umonth' >";
									print "<option value = '".date(m,$horse[$label])."'>".date(M,$horse[$label])."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='uday".$horse[key]."' name='uday'><option value='".date(d,$horse[$label])."'>".date(d,$horse[$label])."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='uyear".$horse[key]."' name='uyear'><option value='".date(Y,$horse[$label])."'>".date(Y,$horse[$label])."</option>";
								for ($i=1990;$i<=date(Y);$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
								//end date selections
  	  	 					}elseif($label=="height"){
  	  	 						//slect for height
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]."  hands </option>";
									for($i = 130; $i <= 180; $i++){
										$j=$i/10;
										print"<option value=$j>$j</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}elseif($label=="weight"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]."  pounds </option>";
									for($i = 600; $i <= 1450; $i+=5){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
   	  	 					elseif($label=="temperature"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)." (F)</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]."</option>";
									for($i = 95; $i <= 106; $i+=.1){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="pulse"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]." per minute </option>";
									for($i = 20; $i <= 50; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="respiration"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]." per minute </option>";
									for($i = 10; $i <= 60; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="sex"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='u".$label."' id='u".$label.$horse[key]."'>";
								print "<option value='".$horse[$label]."'>".$horse[$label]."</option>";
								print "<option value='stallion'>Stallion</option>";
								print "<option value='gelding'>Gelding</option>";
								print "<option value='mare'>Mare</option>";
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' value='".$horse[$label]."' id='u".$label.$horse[key]."'></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td width='150'>Primary Vet</td><td>";
  	  	 					print "<select name='uvet_key' id='uvet_key".$horse[key]."'>";
									foreach($vet_data as $data){
										if($data[key]==$row[vet_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
									foreach($vet_data as $data){
										if($data[key]!=$horse[vet_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								print "<option value='0'>New Vet</option>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td width='150'>Primary Farrier</td><td>";
  	  	 					print "<select name='ufarrier_key' id='ufarrier_key".$horse[key]."'>";
  	  	 							if($horse[farrier_key]<1){
  	  	 								print "<option value=''>Select Farrier</option>";
  	  	 							}else{
									foreach($farrier_data as $data){
										if($data[key]==$horse[farrier_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
  	  	 							}//end else
									foreach($farrier_data as $data){
										if($data[key]!=$horse[farrier_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								//print "<option value='1'>New Farrier</option>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td width='150'>Horse Owner</td><td>";
  	  	 					print "<select name='uowner_key' id='uowner_key'>";
  	  	 							if($row[owner_key]<1){
  	  	 								print "<option value=''>Select Owner</option>";
  	  	 							}else{
									foreach($owner_data as $data){
										if($data[key]==$row[owner_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
  	  	 							}//end else
									foreach($owner_data as $data){
										if($data[key]!=$row[owner_key]){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}
									}//end foreach
								print "<option value='0'>New Owner</option>";
							print "</select>";
  	  	 				print "</td></tr>";			
			print "</table>";
				?>
				<input 	id="submit_vaccination" type = "submit" name = "submit_vaccination" class= "btn btn-warning" value = "Submit Vaccination Information"/></form>
				<?	
 	    			print "</div>";//
					//}//right before h3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
			print "</div>";// <!--end accordion-->
    }else{//if no horse is selected
		
		print "<h2 style='text-align:center'>Welcome to Caval-Connect</h2>";
		print "<br></br>";
        print "<div align='center'><IMG STYLE='border:2px solid black; border-radius:5px; width:300px; horizontal-align:center' SRC='img/cover.jpg' ALT='Home'></div>";
        print "<div align='center'><IMG STYLE=' width:500px;padding-top:-10px;' SRC='img/caval-connect_logo.png' ALT='Home'> </div>";
		
    }
        	 
?>		  
</div> <!--end fragment-A-->

<?if(isset($horse_key)&&$horse_key){
	print "<script type='text/javascript'>";
    print "$('#myCarousel').carousel();";
    print "$('#mydCarousel').carousel();";
    print "</script>";
}

	
	
	
	
	
	
?>	
<div id="fragment-1"><!-- ################################ PHYSICAL TAB ##########################!!!!!!!!!!!!!!!!-->
<?
	if(isset($role_mode)&&$role_mode==0){
	     print "<div class='accordion'>";//call collapsed accordion or not
	}elseif(isset($role_mode)&&$role_mode==1){
		 print "<div class='roleaccordion'>";
	}
    $physical_field_labels=GetMysqlFieldNames("physical", $dbname);
    $image_field_labels=GetMysqlFieldNames("image", $dbname);

    if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode

		if($_SESSION['access'] < 4){//allow to view information
			$physicalResult=GetTableDataFacility("horse_key",$horse_key, "physical", $dbname ,$_SESSION[facility]);
        	if($physicalResult){
        		$ele_counter=0;
        	foreach($physicalResult as $row){
  	  	 		print "<h3>".$row['date']."</h3>";
  	  	 		print "<div id='physical".$row[key]."'>";
  	  	 		
  	  	 		print "<table width='40%' class='physical' >";
  	  	 		print "<tr><td><table>";
  	  	 		foreach($physical_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="xray"&&$label!="caption"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr' >";
  	  	 					print "<td width='110' class='bold'>".str_replace('_',' ',$label)."</td>";
  	  	 						if($row[$label]==2){
  	  	 							print "<td>Yes</td>";
  	  	 						}elseif($row[$label]==1){
  	  	 							print "<td>No</td>";
  	  	 						}else{
  	  	 							print "<td>".$row[$label]."</td>";
  	  	 						}
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>physical date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>next physical</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}
  	  	 		print "<tr><td<br></td></tr>";
  	  	 		print "<tr><td colspan='2'>";
				print "</td></tr>";
  	  	 		print "</table>";
  	  	 		print "</td>";
  	  	 		print "</tr></table>";
  	  	 		
  	  	 		$imageResult=GetTableData("data_key",$row['key'], "image", $dbname ,$_SESSION[facility]);
  	  	 		if($imageResult){
  	  	 		?>
  	  	 		<script>$('.carousel').carousel('pause')</script>
  	  	 		<span id="myCarousel" class="carousel slide physical" style="width:50%;">
  	  	 			<div class="carousel-inner" STYLE='border:2px solid black; border-radius:5px;'>
  	  	 				<?
  	  	 				//print "<div class='active item'><img  src='".img/physicalimg/HM0001.jpg."' alt=''></div>";
  	  	 				$i=0;
  	  	 				foreach($imageResult as $image_row){
  	  	 					if($image_row['type']=='xray'){
  	  	 						if($i==0){
  	  	 							$item="active item";
  	  	 							}else{
  	  	 								$item="item";
  	  	 							}
  	  	 						print "<div class='".$item."'><img  src='".$image_row[location]."' alt=''>";
  	  	 						print "<div class='carousel-caption'><p>".$image_row[description]."</p></div>";
  	  	 						print "</div>";//end img div
  	  	 						$i++;
  	  	 					}
  	  	 				}
  	  	 				?>
  	  	 			</div>
  	  	 			  <!-- Carousel nav -->
  					<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
 					<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
				</span>
<?				}// end if $imageResult	
	  	  	 	print "<div class='new_line'></div>";
		  	  	 	if($imageResult){
		   	  	 		foreach($imageResult as $image_row){
		  	  	 			if($image_row['type']=='blood_panel'){
		  	  	 				print "<div class='physical_right' style='width:50%;'><IMG STYLE='border:2px solid black; border-radius:5px;' SRC='".$image_row[location]."' ALT='Blood Values not found'></div>";
		  	  	 			}
		  	  	 		}
		  	  	 	} 	  	 	
		  	  	 		?>
		  	  	 	
		  	  	<div class='physical'>
		  	  	 	<?
		  	  	 	if ($row['fecal_sampled']==2){
		  	  	 		print "<form  action='insert.php' method='get' enctype='multipart/form-data'>";
		  	  	 			print "<input type='hidden' name='pfecal_key' id='pfecal_key' value='".$row[key]."' />";
		  	  	 			print "<input type='hidden'  name='phorse_key' id='phorse_key' value='".$horse_key."' />";
	 						print "<select onchange='this.form.submit()' name='fecal_count' id='fecal_count'>";
	 							print "<option value = ''>Update Fecal Count</option>";
									print "<option value = '0-200 EPG'>0-200 EPG</option>";
									print "<option value = '200-500 EPG'>200-500 EPG</option>";
									print "<option value = '500-1000 EPG'>500-1000EPG</option>";
							print "</select>";
						print "</form>";
		  	  	 	}
								?>
	 				<form action="image_upload.php" method="post" enctype="multipart/form-data">	
						<label for="file">Choose New Radiograph:</label>
						<? print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";?>
						<? print "<input type='hidden' name='image_key' id='image_key' value=".$row[key]." />";?>
						<input type='hidden' name='data_type' id='data_type' value="xray" />
						<input type='hidden' name='table' id='table' value="physical" />
						<input type='hidden' name='image_type' id='image_type' value="xray" />
						<input type='file' name='file' id='file' onchange="showTextArea('<? echo $ele_counter;?>',&quot;xdescription&quot;);" value=><br>
						<textarea rows="3" placeholder="Image description. . ." name="xdescription" style='display:none;' id="xdescription"></textarea>
						<!--<input type="submit" name="submit" value="Submit Image" class= "btn btn-warning">-->
						<input 	id="submit_xray" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit-Xray"/>
					</form>
	 				<form action="image_upload.php" method="post" enctype="multipart/form-data">	
						<label for="file">Upload Blood Panel PDF:</label>
						<? print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";?>
						<? print "<input type='hidden' name='image_key' id='image_key' value=".$row[key]." />";?>
						<input type='hidden' name='data_type' id='data_type' value="blood_panel" />
						<input type='hidden' name='table' id='table' value="physical" />
						<input type='hidden' name='image_type' id='image_type' value="blood_panel" />
						<input type="file" name="file" id="file" value=><br>
						<!--<input type="submit" name="submit" value="Submit Image" class= "btn btn-warning">-->
						<input 	id="submit_xray" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit Blood Values"/>
					</form>
			
					<?
	  	     		if($_SESSION[access] <2){//only manager can delete
	  	     		print "<table><tr>";
	   	  			if($_SESSION['access']<2){//script for deleting record
	  	  				$element='physical'.$row['key'];
	  	  				$name=$row['horse_name'];
	  	  				$delete_table='physical';
	  	  				print "<form action='javascript:delete_record(".$row['key'].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
	  	  	 			//print "<input type='hidden' id='physical_delete' value='info".$row[key]."'>";
	  	     			print "<td id='delete_physical".$row['key']."'><input id='delete_physical".$row['key']."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$row['date']." Physical' /></td>";
	  	     			print "</form>";
	  	     			
	  	  	 			} 	     		
	  	     		print "</tr></table>";
	  	     		}

	  	     		print "</div>";//end float left physical div
  	     		print "</div>";
  	     		$ele_counter++;
 			}//end foreach loop
        }else{
 		 	print "No Physical Information has been recorded for". $horse;
 		 }
        
        }//end if for viewing physical data
        if($_SESSION['access'] < 5){//allow to update information
        	print "<h3>Enter New Physical Data</h3>";
  	  	 	print "<div id='physical_response'>";
  	  	 	?>
  	  	 	<!-- Show Message for AJAX response -->
			
  	  	 	<form  action='javascript:insert_physical()' method='post' enctype="multipart/form-data">
  	  	 	<?
  	  	 	print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($physical_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pmonth' name = 'pmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='pday' name='pday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='pyear' name='pyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pnmonth' pname = 'umonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='pnday' name='pnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='pnyear' name='pnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="blood_drawn"||$label=="fecal_sampled"||$label=="sheath_cleaned"||$label=="teeth_floated"||$label=="vaccination_given"||$label=="fecal_sampled"||$label=="radiograph_taken"){
  	  	 						print "<tr height='30'><td width='150'>".str_replace('_',' ',$label)."</td><td><input type='radio' id='p".$label."' name='p".$label."' value='2'> Yes <input type='radio' id='p".$label."' name='p".$label."' value='1' checked> No </td></tr>";
  	  	 					}
  	  	 					
  	  	 					   	  	 					elseif($label=="temperature"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)." (F)</td><td><select name='p".$label."' id='p".$label."'>";
								print "<option value=''>Degrees</option>";
									for($i = 95; $i <= 106; $i+=.1){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="pulse"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='p".$label."' id='p".$label."'>";
								print "<option value=''> per minute </option>";
									for($i = 20; $i <= 50; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="respiration"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='p".$label."' id='p".$label."'>";
								print "<option value=''> per minute </option>";
									for($i = 10; $i <= 60; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="right_eye_exam"||$label=="left_eye_exam"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label."_label&quot;); showOtherText(this.value,&quot;p".$label."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Clear</option>";
									 print "<option value = 'cloudy'>Cloudy</option>";
									 print "<option value = 'abrasion'>Abrasion</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="fitness_evaluation"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label."_label&quot;); showOtherText(this.value,&quot;p".$label."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = '1 (poor)'>1 (poor)</option>";
									 print "<option value = '2 (very thin)'>2 (very thin)</option>";
									 print "<option value = '3 (thin)'>3 (thin)</option>";
									 print "<option value = '4 (moderately thin)'>4 (moderately thin)</option>";
									 print "<option value = '5 (moderate)'>5 (moderate)</option>";
									 print "<option value = '6 (moderately fleshy)'>6 (moderately fleshy)</option>";
									 print "<option value = '7 (fleshy)'>7 (fleshy)</option>";
									 print "<option value = '8 (fat)'>8 (fat)</option>";
									 print "<option value = '9 (extremely fat)'>9 (extremely fat)</option>";
								
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="coat_appearance"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label."_label&quot;); showOtherText(this.value,&quot;p".$label."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Shiny</option>";
									 print "<option value = 'cloudy'>Dull</option>";
									 print "<option value = 'abrasion'>Cushings-like</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="gait_symmetry"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label."_label&quot;); showOtherText(this.value,&quot;p".$label."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Even</option>";
									 print "<option value = 'cloudy'>Off left</option>";
									 print "<option value = 'abrasion'>Off Right</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="comments"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><textarea rows='3' placeholder='Enter general comments or recommendations. . .' id='p".$label."'></textarea></td>";
  	  	 					}elseif($label!="vet_key"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id='p".$label."'></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}// if label
  	  	 		}//end label for each
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='pvet_key' id='pvet_key'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print "<option value=$data[key]>".$data[first_name]." ".$data[last_name]."</option>";
											//print "<option value=".$data['key']."/>".$data['key']." ". $data['last_name']."</option>";
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

   			print "</div>";	
  	  	}//end if for entering new data
  	  	 
	}//if horse key if
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='role_physical_response".$horse[key]."'>";//place content here

    				$element='role_physical_response'.$horse[key];
		print "<form  action='javascript:insert_role_physical(&quot;$element&quot;,".$horse[key].")' method='post'>";//update horse form

  	  	 print "<input type='hidden' name='horse_key' id='phorse_key".$horse[key]."' value='".$horse[key]."' />";
  	  	 //print "<input type='hidden' name='pxray' id='pxray' value='none' />";
			print "<table>";
  	  	 		foreach($physical_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pmonth".$horse[key]."' name = 'pmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='pday".$horse[key]."' name='pday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='pyear".$horse[key]."' name='pyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pnmonth".$horse[key]."' pname = 'umonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='pnday".$horse[key]."' name='pnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='pnyear".$horse[key]."' name='pnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="blood_drawn"||$label=="fecal_sampled"||$label=="sheath_cleaned"||$label=="teeth_floated"||$label=="vaccination_given"||$label=="fecal_sampled"||$label=="radiograph_taken"){
  	  	 						print "<tr height='30'><td width='150'>".str_replace('_',' ',$label)."</td><td><input type='radio' id='p".$label.$horse[key]."' name='p".$label.$horse[key]."' value='2'> Yes <input type='radio' id='p".$label.$horse[key]."' name='p".$label.$horse[key]."' value='1' checked> No </td></tr>";
  	  	 					}elseif($label=="temperature"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)." (F)</td><td><select name='p".$label.$horse[key]."' id='p".$label.$horse[key]."'>";
								print "<option value=''>Degrees</option>";
									for($i = 95; $i <= 106; $i+=.1){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="pulse"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='p".$label.$horse[key]."' id='p".$label.$horse[key]."'>";
								print "<option value=''> per minute </option>";
									for($i = 20; $i <= 50; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="respiration"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='p".$label.$horse[key]."' id='p".$label.$horse[key]."'>";
								print "<option value=''> per minute </option>";
									for($i = 10; $i <= 60; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="right_eye_exam"||$label=="left_eye_exam"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label.$horse[key]."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label.$horse[key]."_label&quot;); showOtherText(this.value,&quot;p".$label.$horse[key]."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Clear</option>";
									 print "<option value = 'cloudy'>Cloudy</option>";
									 print "<option value = 'abrasion'>Abrasion</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label.$horse[key]."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label.$horse[key]."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="fitness_evaluation"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label.$horse[key]."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label.$horse[key]."_label&quot;); showOtherText(this.value,&quot;p".$label.$horse[key]."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Fat Both</option>";
									 print "<option value = 'cloudy'>Skinny</option>";
									 print "<option value = 'abrasion'>Just Right</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label.$horse[key]."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label.$horse[key]."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="coat_appearance"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label.$horse[key]."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label.$horse[key]."_label&quot;); showOtherText(this.value,&quot;p".$label.$horse[key]."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Shiny</option>";
									 print "<option value = 'cloudy'>Dull</option>";
									 print "<option value = 'abrasion'>Cushings-like</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label.$horse[key]."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label.$horse[key]."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="gait_symmetry"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  							print "<td><select id ='p".$label.$horse[key]."' name = 'p".$label."'  onchange='showOtherText(this.value,&quot;p".$label.$horse[key]."_label&quot;); showOtherText(this.value,&quot;p".$label.$horse[key]."_other&quot;);'>";
									 print "<option value = ''>Appearance</option>";
									 print "<option value = 'clear'>Even</option>";
									 print "<option value = 'cloudy'>Off left</option>";
									 print "<option value = 'abrasion'>Off Right</option>";
									 print "<option value = 'other'>Other</option>";
								print "</select></td>";
								print "<tr class='other'><td  id='p".$label.$horse[key]."_label' width='150' class='hide_text_box' style='display:none;'>Other Condition</td>";
								print "<td><input type='text' id='p".$label.$horse[key]."_other' class='hide_text_box' style='display:none;'></td></tr>";
  	  	 					
  	  	 					
  	  	 					}elseif($label=="comments"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><textarea rows='3' placeholder='Enter general comments or recommendations. . .' id='p".$label.$horse[key]."'></textarea></td>";
  	  	 					}elseif($label!="vet_key"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id='p".$label.$horse[key]."'></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}// if label
  	  	 		}//end label for each
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='pvet_key' id='pvet_key".$horse[key]."'>";
									print "<option value=''> Select Vet </option>";
										foreach($vet_data as $data){
											print "<option value=$data[key]>".$data[first_name]." ".$data[last_name]."</option>";
											//print "<option value=".$data['key']."/>".$data['key']." ". $data['last_name']."</option>";
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
     		
     		
 	    			print "</div>";//
					//}
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    }//end user mode if	 
 		 ?>

	</div> <!--end accordion-->  
	
</div> <!--end fragment-1-->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<div id="fragment-2"><!-- ############################### VACCINATION TAB  #################################!!!!!!!! -->

<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}


if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
        $vaccination_field_labels=GetMysqlFieldNames("vaccination", $dbname);
        if($horse_key){
        	if($_SESSION['access'] < 4){//allow to view information
        	$vaccinationResult=GetTableData("horse_key",$horse_key, "vaccination", $dbname);
        	if($vaccinationResult){
        	$i=0;
			$immune=array('product'=>array(),'infection'=>array(),'treat_date'=>array(),'expiration'=>array());
			
        	foreach($vaccinationResult as $row){
			$future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$row[date]")) . " +12 months"));//use this in table
			foreach($vacc_product_data as $infection){
				if($infection[$row['type']]==1){	
					if(in_array($infection['infection'],$immune['infection'])){
						$key = array_search($infection['infection'],$immune['infection']);
						if(strtotime($immune['date'][$key])<strtotime($row['date'])){
							
							$immune['date'][$key]=$row['date'];
							$immune['product'][$key]=$row['type'];
							$immune['infection'][$key]=$infection['infection'];
							$immune['treat_date'][$key]=$row['date'];
							$immune['expiration'][$key]=$future;
						}
					}else{
					$immune['product'][$i]=$row['type'];
					$immune['infection'][$i]=$infection['infection'];
					$immune['treat_date'][$i]=$row['date'];
					$immune['expiration'][$i]=$future;
					$i++;
					}
				}//end outer if
			}//end inner foreach
    		
    		
  	  	 		print "<h3>".$row['date']." Vaccination</h3>";
  	  	 		print "<div id='vaccination".$row[key]."'>";	  	 		
  	  	 		print "<table>";
  	  	 		foreach($vaccination_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr'>";
  	  	 					print "<td class='bold' width='150'>".str_replace('_',' ',$label)."</td><td>".str_replace('_',' ',$row[$label])."</td>";
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr'><td class='bold' width='150'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='150'>vaccination date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='150'>next vaccination</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}
  	  	 		
  	     		if($_SESSION[access] <2){//only manager can delete
  	     		print "<tr><td><br></td></tr><tr>";
  	  				$element='vaccination'.$row['key'];
  	  				$name=$row['horse_name'];
  	  				$delete_table='vaccination';
  	  				print "<form action='javascript:delete_record(".$row['key'].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
  	  	 			//print "<input type='hidden' id='physical_delete' value='info".$row[key]."'>";
  	     			print "<td id='delete_vaccination".$row['key']."'><input id='delete_vacc".$row['key']."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$row['date']." Vaccination' /></td>";
  	     			print "</form>";     		
  	     		print "</tr>";
  	     		}  	  
  	  	 		
  	  	 		print "</table>";
  	     		print "</div>";
 			 }//end foreach loop
 			 
      print "<h3>Current Immunizations of $horse_name</h3>";
      print "<div>";
      	print "<table class='records'>";
      	print "<tr class='bottom_borderh'  style='font-weight:bold; padding-right:5px'><td class='bottom_borderh'  width='150'>Product</td><td class='bottom_borderh'  width='150'>Infection</td><td class='bottom_borderh'  width='150'>Treatment Date</td><td class='bottom_borderh'  width='150'>Expiration</td></tr>";
      	$i=0;
      	for($i==0;$i<count($immune['product']);$i++){
      		print "<tr>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',$immune['product'][$i])."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',$immune['infection'][$i])."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',date('F j Y',strtotime($immune['treat_date'][$i])))."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',date('F j Y',strtotime($immune['expiration'][$i])))."</td>"; 
      		print "</tr>";
      	}//end immune while   
      	print "</table>"; 
   print "</div>";
 			 
        	}else{
 		 		print "No Vaccination Information has been recorded for ". $horse_name;
 			}//end if result
   }//end if access <3
              
   if($_SESSION['access'] < 5){//allow to view information
      print "<h3>Enter New Vaccination Data</h3>";
  	  print "<div id='vaccination_response'>";
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
  	  <form action='javascript:insert_vaccination()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($vaccination_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='vmonth' name = 'vmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='vday' name='vday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='vyear' name='vyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='".$i."'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='vnmonth' name = 'vnmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='vnday' name='vnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='vnyear' name='vnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="type"){// Vaccination Product
								print "<tr><td width='150'>Vaccination Product</td>";
								print "<td width='150'>";
								print "<select onchange='showSelect(&quot;vtype2td&quot;, &quot;vtype2&quot;, this.value);' style='width: 150;' id='vtype' name='vtype'>";
								print "<option value=''>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
								print "<tr><td id='vtype2td' class='other' style='display:none;' width='150'>Second Vaccination?</td>";
								print "<td><select onchange='showSelect(&quot;vtype3td&quot;, &quot;vtype3&quot;, this.value);' style='width: 150; display:none;' id='vtype2' name='vtype2'>";
								print "<option value='none'>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
								print "<tr><td id='vtype3td'  class='other'  style='display:none;' width='150'>Third Vaccination?</td>";
								print "<td><select style='width: 150; display:none;' id='vtype3' name='vtype3'>";
								print "<option value='none'>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
  	  	 					}

  	  	 			}//end if
  	  	 		}//end foreach
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vvet_key' id='vvet_key'>";
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
  	  	 }//end if for entering new data
        
	}else{//if horse key if
	print	"Please select a horse.";
	}		
	print "</div>";	//end div vaccination response
}					//end horse mode
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$vaccination_field_labels=GetMysqlFieldNames("vaccination", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='vaccination_response".$horse[key]."'>";//place content here
     		
    				$element='vaccination_response'.$horse[key];
					print "<form  action='javascript:insert_role_vaccination(&quot;$element&quot;,".$horse[key].")' method='post'>";//update horse form
     		
     		
			print "<table>";
  	  	 		foreach($vaccination_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='vmonth".$horse[key]."' name = 'vmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='vday".$horse[key]."' name='vday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='vyear".$horse[key]."' name='vyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='".$i."'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='vnmonth".$horse[key]."' name = 'vnmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='vnday".$horse[key]."' name='vnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='vnyear".$horse[key]."' name='vnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="type"){// Vaccination Product
								print "<tr><td width='150'>Vaccination Product</td>";
								print "<td width='150'>";
								print "<select onchange='showSelect(&quot;vtype2td".$horse[key]."&quot;, &quot;vtype2".$horse[key]."&quot;, this.value);' style='width: 150;' id='vtype".$horse[key]."' name='vtype'>";
								print "<option value=''>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
								print "<tr><td class='other' id='vtype2td".$horse[key]."' style='display:none;' width='150'>Second Vaccination?</td>";
								print "<td><select onchange='showSelect(&quot;vtype3td".$horse[key]."&quot;, &quot;vtype3".$horse[key]."&quot;, this.value);' style='width: 150; display:none;' id='vtype2".$horse[key]."' name='vtype2'>";
								print "<option value='none'>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
								print "<tr><td class='other' id='vtype3td".$horse[key]."' style='display:none;' width='150'>Third Vaccination?</td>";
								print "<td><select style='width: 150; display:none;' id='vtype3".$horse[key]."' name='vtype3'>";
								print "<option value='none'>Select Product</option>";
								foreach($vacc_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</select>";
								print "</td></tr>";
								
  	  	 					}

  	  	 			}//end if
  	  	 		}//end foreach
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='vvet_key' id='vvet_key".$horse[key]."'>";
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
 	    			print "</div>";//end div vaccination response
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
}//end user mode if						 
?>

</div> <!--end accordion-->  
</div> <!--end fragment-2-->













<div id="fragment-3"> <!--DENTAL ACCORDION-->

<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
$dental_field_labels=GetMysqlFieldNames("dental", $dbname);
	if(isset($horse_key)&&$horse_key){
        	if($_SESSION['access'] < 4){//allow to view information
        	$dentalResult=GetTableDataFacility("horse_key",$horse_key, "dental", $dbname ,$_SESSION[facility]);
        	if($dentalResult){
        		$ele_counter=0;
        	foreach($dentalResult as $row){
  	  	 		print "<h3>".$row['date']."</h3>";
  	  	 		print "<div id='dental".$row[key]."'>";
  	  	 		$delete_table=3;
  	  	 		print "<span class='physical'>"; 	 	
  	  	 		print "<table>";
  	  	 		foreach($dental_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr'>";
  	  	 					print "<td class='bold' width='110'>".str_replace('_',' ',$label)."</td><td>".str_replace('_',' ',$row[$label])."</td>";
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr'><td class='bold' width='110'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>dental date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>next dental</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}

  	  	 		print "</table>";
  	  	 		
  	  	 		?>
  	  	 		<form action="image_upload.php" method="post" enctype="multipart/form-data">
  	  	 			<br></br>
  	  	 			<? print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";?>
					<? print "<input type='hidden' name='image_key' id='image_key' value=".$row[key]." />";?>	
					<label for="file">Choose New Dental Image:</label>
					<input type='hidden' name='data_type' id='data_type' value="dimage" />
					<input type='hidden' name='table' id='table' value="dental" />
					<input type='hidden' name='image_type' id='image_type' value="dimage" />
					<input type='file' name='file' id='file' onchange="showTextArea('<? echo $ele_counter;?>',&quot;ddescription&quot;);" value=><br>
					<textarea rows="3" placeholder="Image description. . ." name="ddescription" style='display:none;' id="ddescription"></textarea>
					<!--<input type="submit" name="submit" value="Submit Image" class= "btn btn-warning">-->
					<input 	id="submit_dimage" type = "submit" name = "submit_dimage" class= "btn btn-warning" value = "Submit Image"/>
				</form>
  	  	 		<?  	  	 		
			print "</span>";//end physical span for left float
  	  	 		$imageResult=GetTableData("data_key",$row['key'], "image", $dbname);
  	  	 		if($imageResult){
  	  	 		?>
  	  	 		<script>$('.carousel').carousel('pause')</script>
  	  	 		<span id="mydCarousel" class="carousel slide physical_right" style="width:50%;">
  	  	 			<div class="carousel-inner" STYLE='border:2px solid black; border-radius:5px;'>
  	  	 				<?
  	  	 				//print "<div class='active item'><img  src='".img/physicalimg/HM0001.jpg."' alt=''></div>";
  	  	 				$i=0;
  	  	 				foreach($imageResult as $image_row){
  	  	 					if($image_row['type']=='dimage'){
  	  	 						if($i==0){
  	  	 							$item="active item";
  	  	 							}else{
  	  	 								$item="item";
  	  	 							}
  	  	 						print "<div class='".$item."'><img  src='".$image_row[location]."' alt=''>";
  	  	 						print "<div class='carousel-caption'><p>".$image_row[description]."</p></div>";
  	  	 						print "</div>";//end img div
  	  	 						$i++;
  	  	 					}
  	  	 				}
  	  	 				?>
  	  	 			</div>
  	  	 			  <!-- Carousel nav -->
  					<a class="carousel-control left" href="#mydCarousel" data-slide="prev">&lsaquo;</a>
 					<a class="carousel-control right" href="#mydCarousel" data-slide="next">&rsaquo;</a>
				</span>
<?				}// end if $imageResult	
     		
     		
  	     		if($_SESSION[access] <2){//only manager can delete
  	  	 			$delete_table=1;
  	     		print "<table style='float:left;'><tr>";
   	  			if($_SESSION['access']<2){//script for deleting record
  	  				$element='dental'.$row['key'];
  	  				$name=$row['horse_name'];
  	  				$delete_table='dental';
  	  				print "<form action='javascript:delete_record(".$row['key'].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
  	  	 			//print "<input type='hidden' id='physical_delete' value='info".$row[key]."'>";
  	     			print "<td id='delete_dental".$row['key']."'><input id='delete_dental".$row['key']."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$row['date']." Dental Record' /></td>";
  	     			print "</form>";
  	     			
  	  	 			} 	     		
  	     		print "</tr></table>";

  	     		} 
     		
     		
  	     		print "</div>";
  	     		$ele_counter++;  	     		
        	}     	
 		}else{
 		 	print "No Dental Information has been recorded for ". $horse_name;//end if result
 		}//end if table result
   }//end if access <3
              
   if($_SESSION['access'] < 5){//allow to view information
         print "<h3>Enter New Dental Data</h3>";
  	  	 print "<div id='dental_response'>";
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
  	  <form action='javascript:insert_dental()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($dental_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='dmonth' name = 'dmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='dday' name='dday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='dyear' name='dyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='dnmonth' name = 'dnmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='dnday' name='dnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='dnyear' name='dnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="procedure"){
  	  								print "<td width='150'>".$label."</td>";
  	  								?><td><select id ='dprocedure' name = 'dprocedure' onchange="showOtherText(this.value,'dprocedureother');showOtherText(this.value,'dprocedure_other');">
									 <option value = ''>Procedure</option>
									 <option value = 'Float-Equilibration'>Float-Equilibration</option>
									 <option value = 'Alveolar_pac.'>Alveolar pac.</option>
									 <option value = 'Extraction'>Extraction</option>
									 <option value = 'Flowable_Impression'>Flowable Impression</option>
									 <option value = 'Incisor_realign'>Incisor realign</option>
									 <option value = 'Prophylactic'>Prophylactic</option>
									 <option value = 'Prophylactic'>Prophylactic</option>
									<option value = 'Wave_Correction'>Wave Correction</option>
									 <option value = 'other'>Other</option>
								</select></td></tr>
								<tr class='other'><td  id='dprocedure_other' width='150' class='hide_text_box' style='display:none;'>Other Procedure</td>
								<td><input type='text' id='dprocedureother' class='hide_text_box' style='display:none;'></td>
								</tr></div>
								<?
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='dvet_key' id='dvet_key'>";
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
				  print "</div>";
  	  	 }//end if for entering new data
	}else{//if horse key if
	print	"Please select a horse.";
	}	
	
}//end horse_mode if
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$dental_field_labels=GetMysqlFieldNames("dental", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='dental_response".$horse[key]."'>";//place content here
   				 	$element='dental_response'.$horse[key];
	print "<form  action='javascript:insert_role_dental(&quot;$element&quot;,".$horse[key].")' method='post'>";//update horse form
     		
			print "<table>";
  	  	 		foreach($dental_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='dmonth".$horse[key]."' name = 'dmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='dday".$horse[key]."' name='dday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='dyear".$horse[key]."' name='dyear'><option value='".date(Y)."'>".date(Y)."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='dnmonth".$horse[key]."' name = 'dnmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='dnday".$horse[key]."' name='dnday'><option value='".date(d)."'>".date(d)."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='dnyear".$horse[key]."' name='dnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="procedure"){
  	  								print "<td width='150'>".$label."</td>";
  	  								print "<td><select id ='dprocedure".$horse[key]."' name = 'dprocedure' onchange='showOtherText(this.value,&quot;dprocedure_other".$horse[key]."&quot;); showOtherText(this.value,&quot;dprocedureother".$horse[key]."&quot;);'>";	
  	  								?>
									 <option value = ''>Procedure</option>
									 <option value = 'Float-Equilibration'>Float-Equilibration</option>
									 <option value = 'Alveolar_pac.'>Alveolar pac.</option>
									 <option value = 'Extraction'>Extraction</option>
									 <option value = 'Flowable_Impression'>Flowable Impression</option>
									 <option value = 'Incisor_realign'>Incisor realign</option>
									 <option value = 'Prophylactic'>Prophylactic</option>
									 <option value = 'Prophylactic'>Prophylactic</option>
									<option value = 'Wave_Correction'>Wave Correction</option>
									 <option value = 'other'>Other</option>
								</select></td></tr>
								<?
								print "<tr class='other'><td  id='dprocedure_other".$horse[key]."' width='150' class='hide_text_box' style='display:none;'>Other Procedure</td>";
								print "<td><input type='text' id='dprocedureother".$horse[key]."' class='hide_text_box' style='display:none;'></td>";
								?>
								</tr></div>
								<?
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='dvet_key' id='dvet_key".$horse[key]."'>";
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
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    }	//end user mode if	
 ?>

	</div> <!--end accordion-->  
	</div> <!--end fragment-3-->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<div id="fragment-4"><!--FARRIER ACCORDION -->
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
      $farrier_field_labels=GetMysqlFieldNames("farrier", $dbname);
         if($horse_key){
         	if($_SESSION['access'] < 4){//allow to view information
        		$farrierResult=GetTableDataFacility("horse_key",$horse_key, "farrier", $dbname, $_SESSION['facility']);
		        	if($farrierResult){
			        	foreach($farrierResult as $row){
			  	  	 		print "<h3>".$row['date']."</h3>";
			  	  	 		print "<div id='farrier".$row['key']."'>";
			 			 	
			  	  	 		print "<table>";
			  	  	 		foreach($farrier_field_labels as $label){
			  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
			  	  	 				print "<tr class='bottom_borderr'>";
			  	  	 					print "<td class='bold' width='110'>".str_replace('_',' ',$label)."</td><td>".str_replace('_',' ',$row[$label])."</td>";
			  	  	 				print "</tr>";
			  	  	 			}elseif($label=="vet_key"){
			  	  	 					print "<tr class='bottom_borderr'><td class='bold' width='110'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
			  	  	 			}elseif($label=="date"){
			  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>farrier date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
			  	  	 			}elseif($label=="next_date"){
			  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>next farrier</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
			  	  	 			}
			  	  	 		}
			  	  	 		
			  	     		if($_SESSION[access] <2){//only manager can delete
				  	     		print "<tr><td><br></td></tr><tr>";
				  	  				$element='farrier'.$row['key'];
				  	  				$name=$row['horse_name'];
				  	  				$delete_table='farrier';
				  	  				print "<form action='javascript:delete_record(".$row['key'].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
				  	  	 			//print "<input type='hidden' id='physical_delete' value='info".$row[key]."'>";
				  	     			print "<td id='delete_farrier".$row['key']."'><input id='delete_farr".$row['key']."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$row['date']." Farrier Appointment' /></td>";
				  	     			print "</form>";     		
				  	     		print "</tr>";
			  	     		}  	  	 		
			  	  	 		
			  	  	 		print "</table>";
			  	     		
			  	     		print "</div>";
			        	}
		 			}else{
		 		 		print "No Farier Information has been recorded for ". $horse_name;//end if result
		 			}//end if table result
   			}//end if access <3

	if($_SESSION['access'] < 5){//allow to view information
        print "<h3>Enter New Farrier Data</h3>";
  	  	print "<div id='farrier_response'>";
  	  	?>
  	  	<!-- Show Message for AJAX response -->
		<form action='javascript:insert_farrier()' method='post'>
  	  	<?
  	  	print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($farrier_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='fmonth' name = 'fmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='fday' name='fday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='fyear' name='fyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='fnmonth' name = 'fnmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='fnday' name='fnday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='fnyear' name='fnyear'><option value='".(date(Y)+1)."'>".(date(Y)+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="comments"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><textarea rows='3' placeholder='Enter general comments or recommendations. . .' id='f".$label."'></textarea></td>";
  	  	 					}
  	  	 					elseif($label=="procedure"){
  	  								print "<td width='150'>".$label."</td>";
  	  								?><td><select id ='fprocedure' name = 'fprocedure' onchange="showOtherText(this.value,'fprocedureother');showOtherText(this.value,'fprocedure_other');">
									 <option value = ''>Select</option>
									 <option value = 'Trim'>Trim Front</option>
									 <option value = 'Trim'>Trim Rear</option>
									 <option value = 'Trim'>Trim All</option>
									 <option value = 'Front_Shoe'>Front Shoe</option>
									 <option value = 'Front_Shoe'>Rear Shoe</option>
									 <option value = 'All_Shoe'>All Shoe</option>
									 <option value = 'Balance'>Balance</option>
									 <option value = 'other'>Other</option>
								</select></td></tr>
								<tr class='other'><td  id='fprocedure_other' width='150' style='display:none;'>Other Procedure</td>
								<td><input type='text' id='fprocedureother' style='display:none;'></td>
								</tr></div>
								<?
  	  	 					}

  	  	 			}
  	  	 		}
  	 				print "<tr><td width='150'>Farrier</td>";
  	 					print "<td>";
  	 						print "<select name='fvet_key' id='fvet_key'>";
							print "<option value=''> Select Farrier </option>";
								foreach($farrier_data as $data){
									print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
								}//end foreach
							print "<option value='0'>New Vet</select>";
						print "</select>";
  	 					print "</td>";
  	 				print "</tr>";
			print "</table>";
				?>
					<input 	id="submit_farrier" type = "submit" name = "submit_farrier" class= "btn btn-warning" value = "Submit Farrier Information"/></form>
				<?
  	     print "</div>";
  	  	 }//end if for entering new data
	}else{//if horse key if
		print	"Please select a horse.";
	}
}//end horse mode if
elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$farrier_field_labels=GetMysqlFieldNames("farrier", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse['horse_name']."</strong>  ".$message."</h3>";
     				print "<div id='farrier_response".$horse['key']."'>";//place content here
   				 	$element='farrier_response'.$horse['key'];
					print "<form  action='javascript:insert_role_farrier(&quot;$element&quot;,".$horse[key].")' method='post'>";//update horse form
  
			print "<table>";
  	  	 		foreach($farrier_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='fmonth".$horse[key]."' name = 'fmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='fday".$horse[key]."' name='fday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='fyear".$horse['key']."' name='fyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='fnmonth".$horse['key']."' name = 'fnmonth' >";
									print "<option value = '".date(m)."'>".date(M)."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='fnday".$horse['key']."' name='fnday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='fnyear".$horse['key']."' name='fnyear'><option value='".(date('Y')+1)."'>".(date('Y')+1)."</option>";
								for ($i=date('Y')-1;$i<=date('Y')+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="comments"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><textarea rows='3' placeholder='Enter general comments or recommendations. . .' id='f".$label."'></textarea></td>";
  	  	 					}elseif($label=="procedure"){
  	  								print "<td width='150'>".$label."</td>";
  	  								print "<td><select id ='fprocedure".$horse['key']."' name = 'fprocedure' onchange='showOtherText(this.value,&quot;fprocedure_other".$horse['key']."&quot;); showOtherText(this.value,&quot;fprocedureother".$horse['key']."&quot;);'>";
  	  								?>
									 <option value = ''>Select Procedure</option>
									 <option value = 'Trim'>Trim Front</option>
									 <option value = 'Trim'>Trim Rear</option>
									 <option value = 'Trim'>Trim All</option>
									 <option value = 'Front_Shoe'>Front Shoe</option>
									 <option value = 'Front_Shoe'>Rear Shoe</option>
									 <option value = 'All_Shoe'>All Shoe</option>
									 <option value = 'Balance'>Balance</option>
									 <option value = 'other'>Other</option>
								</select></td></tr>
								<?
								print "<tr class='other'><td  id='fprocedure_other".$horse['key']."' width='150' class='hide_text_box' style='display:none;'>Other Procedure</td>";
								print "<td><input type='text' id='fprocedureother".$horse['key']."' class='hide_text_box' style='display:none;'></td>";
								?>
								</tr></div>
								<?
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Farrier</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='fvet_key' id='fvet_key".$horse['key']."'>";
									print "<option value=''> Select Farrier </option>";
										foreach($farrier_data as $data){
											print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
										}//end foreach
									print "<option value='0'>New Vet</select>";
								print "</select>";
  	  	 					print "</td>";
  	  	 				print "</tr>";
			print "</table>";
				?>
					<input 	id="submit_farrier" type = "submit" name = "submit_farrier" class= "btn btn-warning" value = "Submit Farrier Information"/>
				 	</form>
				<?     		
     		
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    }	//end user mode if	
 ?>
</div> <!--end accordion-->  
</div> <!--end fragment-4-->


<div id="fragment-5"><!--PARASITE TAB !!!!!!!! -->
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
        $parasite_field_labels=GetMysqlFieldNames("parasite", $dbname);
        if($horse_key){
        	if($_SESSION['access'] < 4){//allow to view information
        	$parasiteResult=GetTableData("horse_key",$horse_key, "parasite", $dbname);
        	if($parasiteResult){
        	$i=0;
			$immune=array('product'=>array(),'infection'=>array(),'treat_date'=>array(),'expiration'=>array());
			
        	foreach($parasiteResult as $row){
			$future=date('Y-m-d',strtotime(date("Y-m-d", strtotime("$row[date]")) . " +6 months"));//use this in table
			foreach($deworm_product_data as $infection){
				if($infection[$row['type']]==1){	
					if(in_array($infection['infection'],$immune['infection'])){
						$key = array_search($infection['infection'],$immune['infection']);
						if(strtotime($immune['date'][$key])<strtotime($row['date'])){
							
							$immune['date'][$key]=$row['date'];
							$immune['product'][$key]=$row['type'];
							$immune['infection'][$key]=$infection['infection'];
							$immune['treat_date'][$key]=$row['date'];
							$immune['expiration'][$key]=$future;
						}
					}else{
					$immune['product'][$i]=$row['type'];
					$immune['infection'][$i]=$infection['infection'];
					$immune['treat_date'][$i]=$row['date'];
					$immune['expiration'][$i]=$future;
					$i++;
					}
				}//end outer if
			}//end inner foreach
    		
  	  	 		print "<h3>".$row['date']." Parasite</h3>";
  	  	 		print "<div id='parasite".$row['key']."'>"; 	  	 		
  	  	 		print "<table>";
  	  	 		foreach($parasite_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr'>";
  	  	 					print "<td class='bold' width='150'>".str_replace('_',' ',$label)."</td><td>".str_replace('_',' ',$row[$label])."</td>";
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr'><td class='bold' width='150'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='150'>deworm date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='150'>next deworm</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}
  	  	 		
  	     		if($_SESSION[access] <2){//only manager can delete
  	     		print "<tr><td><br></td></tr><tr>";
  	  				$element='parasite'.$row['key'];
  	  				$name=$row['horse_name'];
  	  				$delete_table='parasite';
  	  				print "<form action='javascript:delete_record(".$row['key'].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
  	     			print "<td id='delete_parasite".$row['key']."'><input id='delete_par".$row['key']."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete ".$row['date']." Deworm' /></td>";
  	     			print "</form>";     		
  	     		print "</tr>";
  	     		}
  	  	 		
  	  	 		print "</table>";

  	     		print "</div>";
 			 }//end foreach loop
 			 
      print "<h3>Current Parasite Treatments of $horse_name</h3>";
      print "<div>";
      	print "<table class='records'>";
      	print "<tr class='bottom_borderh' style='font-weight:bold; padding-right:5px'><td class='bottom_borderh' width='150'>Product</td><td class='bottom_borderh' width='150'>Infection</td><td class='bottom_borderh' width='150'>Treatment Date</td><td class='bottom_borderh' width='150'>Expiration</td></tr>";
      	$i=0;
      	for($i==0;$i<count($immune['product']);$i++){
      		print "<tr>";
      			print "<td class='bottom_borderr' width='150'>".str_replace('_',' ',$immune['product'][$i])."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',$immune['infection'][$i])."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',$immune['treat_date'][$i])."</td>";
      			print "<td class='bottom_borderr'  width='150'>".str_replace('_',' ',$immune['expiration'][$i])."</td>"; 
      		print "</tr>";
      	}//end immune while   
      	print "</table>"; 
      print "</div>";
 			 
        }else{
 		 	print "No Parasite Treatment Information has been recorded for ". $horse_name;
 		 }
         }//end if access
        }//end if horse_key
        
          
      print "<h3>Enter New Parasite Treatment Data</h3>";
  	  print "<div id='parasite_response'>";
  	  if($_SESSION['access']<5){//allow to update information
  	  if($horse_key!=''){
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
  	  <form action='javascript:insert_parasite()' method='post'>
  	  	 <?
  	  	 print "<input type='hidden' name='horse_key' id='horse_key' value=".$horse_key." />";
			print "<table>";
  	  	 		foreach($parasite_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pamonth' name = 'pamonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='paday' name='paday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='payear' name='payear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='panmonth' name = 'panmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='panday' name='panday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='panyear' name='panyear'><option value='".(date('Y')+1)."'>".(date('Y')+1)."</option>";
								for ($i=date('Y')-1;$i<=date('Y')+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="type"){// PARASITE Product
								print "<tr><td width='150'>Parasite Product</td>";
								print "<td td width='150'>";
								print "<select style='width: 150;' id='patype' name='patype'>";
								print "<option value=''>Select Product</option>";
								foreach($deworm_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</td></tr>";
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='pavet_key' id='pavet_key'>";
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
				<input 	id="submit_parasite" type = "submit" name = "submit_parasite" class= "btn btn-warning" value = "Submit Parasite Information"/></form>
				<?
		
  	     print "</div>";
  	}//end if for entering new data
	}else{//if horse key if
	print	"Please select a horse.";
	}
}//end horse mode  begin user mode
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$parasite_field_labels=GetMysqlFieldNames("parasite", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse['horse_name']."</strong>  ".$message."</h3>";
     				print "<div id='parasite_role_response".$horse['key']."'>";//place content here
     		
    				$element='parasite_role_response'.$horse['key'];
					print "<form  action='javascript:insert_role_parasite(&quot;$element&quot;,".$horse['key'].")' method='post'>";//update horse form
			print "<table>";
  	  	 		foreach($parasite_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='pamonth".$horse['key']."' name = 'pamonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='paday".$horse['key']."' name='paday".$horse['key']."'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='payear".$horse['key']."' name='payear".$horse['key']."'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="next_date"){
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='panmonth".$horse['key']."' name = 'panmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='panday".$horse['key']."' name='panday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='panyear".$horse[key]."' name='panyear'><option value='".(date('Y')+1)."'>".(date('Y')+1)."</option>";
								for ($i=date(Y)-1;$i<=date(Y)+2;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}elseif($label=="type"){// PARASITE Product
								print "<tr><td width='150'>Parasite Product</td>";
								print "<td td width='150'>";
								print "<select style='width: 150;' id='patype".$horse['key']."' name='patype'>";
								print "<option value=''>Select Product</option>";
								foreach($deworm_products as $product){
									if($product!="infection"){
										print "<option value='".$product."'>".str_replace('_',' ',$product)."</option>";
									}
								}
								print "</td></tr>";
  	  	 					}

  	  	 			}
  	  	 		}
  	  	 					print "<tr><td width='150'>Veterinarian</td>";
  	  	 					print "<td>";
  	  	 						print "<select name='pavet_key' id='pavet_key".$horse['key']."'>";
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
				<input 	id="submit_vaccination" type = "submit" name = "submit_vaccination" class= "btn btn-warning" value = "Submit Parasite Information"/></form>
				<?	
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
}//end user mode if		
		 
?>
</div> <!--end accordion-->  
</div> <!--end fragment-5-->




<div id="fragment-6"><!--LINEAGE TAB !!!!!!!!!!!!!!!!-->
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
        $lineage_field_labels=GetMysqlFieldNames("lineage", $dbname);
        if($horse_key){
        	if($_SESSION['access'] < 4){//allow to view information
        	$lineageResult=GetTableData("horse_key",$horse_key, "lineage", $dbname);
        	if($lineageResult){
        	foreach($lineageResult as $row){
  	  	 		print "<h3>".$row['date']."</h3>";
  	  	 		print "<div id='lineage'>";
  	  	 		$lineage=str_replace('_',' ',$row['image']);
  	  	 		print "<iframe style='visibility:hidden;' id='iFramePdf_lineage' src='".$lineage."' ></iframe>";
  	  	 		print "<table id='lineage_table'>";
  	  	 		foreach($lineage_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr'>";
  	  	 					print "<td class='bold' width='110'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr'><td class='bold' width='110'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>lineage date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>next lineage</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}
  	  	 		$limage_key=$row['key'];
  	  	 		print "<tr><td>";
  	  	 		print "<input type='submit' class='btn btn-warning' value='Print Lineage' onclick='printTrigger(&quot;iFramePdf_lineage&quot;);' />";
				print "</td>";
				
				
				print "</tr>";
  	  	 		print "</table>";
  	  	 		print "<IMG STYLE='border:2px solid black; border-radius:5px; width:60%;' SRC='".$lineage."' ALT='".$lineage."'>";
  	     		
  	     		
  	     		
  	     		print "</div>";
 			 }//end foreach loop
        }else{
 		 	print "No Lineage has been recorded for". $horse;
 		 	$limage_key=0;
 		 }//end lineage key
        }// end access if
        }//end horse_key if
        
        
        
        print "<h3>Enter New Lineage</h3>";
  	  	 print "<div id='lineage_response'>";
  	  	 if($_SESSION['access']<5){//allow to update information
  	  	 if($horse_key!=''){
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
			
  	  	 <form action="image_upload.php" method="post" enctype="multipart/form-data">
  	  	 <?
			print "<table>";
  	  	 		foreach($lineage_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td>".str_replace('_',' ',$label)."</td></tr>";
  	  	 						print "<tr><td>";						
  	  	 						print "<select style='width: auto;' id ='lmonth' name = 'lmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='lday' name='lday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='lyear' name='lyear'><option value='".date(Y)."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}//end date if
  	  	 			}//end label if
  	  	 		}//foreach
  	  	 		?>
					<tr><td><label for="file">Choose New LINEAGE File:</label></td></tr>
					  	  	<?print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse_key."'/>";
		print "<input type='hidden' name='limage_key' id='limage_key' value='".$limage_key."'/>";
		print "<tr><td><input type='hidden' name='table' id='table' value='lineage' />";?>
					<input type='hidden' name='image_type' id='image_type' value="lineage" />
					<input type="file" name="file" id="file" value=><br></td></tr>
					<tr><td><input 	id="submit_lineage" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit Lineage File"/></td></tr>
				</table>
				</form>
				<?
  	  	 }else{//end if($horse_key!='')
  	  	 	print"Please select a horse";
  	  	 }
  	  	 }else{
			print"Sorry, your access does not allow adding new information.";
		 }//end privilege div
  	     print "</div>";
  	     
	}//end horse mode if
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$lineage_field_labels=GetMysqlFieldNames("lineage", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='lineage_response".$horse[key]."'>";//place content here
   				 	$element='lineage_response'.$horse[key];
   				 	
        			$lineageResult=GetTableData("horse_key",$horse[key], "lineage", $dbname);
        			if($lineageResult){
        				foreach($lineageResult as $row){
  	  	 					$limage_key=$row['key'];
 						}//end foreach loop
        			}else{
        				$limage_key=0;
        			}
  	  	 print "<form action='image_upload.php' method='post' enctype='multipart/form-data'>";
  	  	 
			print "<table>";
  	  	 		foreach($lineage_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td>".str_replace('_',' ',$label)."</td></tr>";
  	  	 						print "<tr><td>";						
  	  	 						print "<select style='width: auto;' id ='lmonth' name = 'lmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='lday' name='lday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='lyear' name='lyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}//end date if
  	  	 			}//end label if
  	  	 		}//foreach
  	  	 		?>
					<tr><td><label for="file">Choose New LINEAGE File:</label></td></tr>
		<?print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse['key']."'/>";
		print "<input type='hidden' name='limage_key' id='limage_key' value='".$limage_key."'/>";
		print "<tr><td><input type='hidden' name='table' id='table' value='lineage' />";?>
					<input type='hidden' name='image_type' id='image_type' value="lineage" />
					<input type="file" name="file" id="file" value=><br></td></tr>
					<tr><td><input 	id="submit_lineage" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit Lineage File"/></td></tr>
				</table>
				</form>
				<?     		
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    }  	     	     		 
 		 ?>
	</div> <!--end accordion-->  
	</div> <!--end fragment-6 LINEAGE-->




<div id="fragment-7"><!--MEDICAL HISTORY TAB !!!!!!!!!!!!!!!!-->
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
        $history_field_labels=GetMysqlFieldNames("medical_history", $dbname);
        if($horse_key){
        	if($_SESSION['access'] < 4){//allow to view information
        	$historyResult=GetTableData("horse_key",$horse_key, "medical_history", $dbname);
        	if($historyResult){

        	print "<h3>Medical History for ".$horse_name."</h3>";
        	print "<div>";//inner accordion

        	print "<table>";
        	foreach($historyResult as $row){		
  	  	 		$delete_table=7;
 			 	print "<form action='javascript:delete_record(".$row['key'].",".$delete_table.")' method='post' enctype='multipart/form-data'>"; 
  	  	 			
  	  	 				foreach($history_field_labels as $label){
  	  	 					if($label!="key"&&$label!="horse_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 						print "<tr class='bottom_borderr'><td class='bold' width='110'>".$label."</td><td width='250'>".$row[$label]."</td></tr>";
  	  	 					}elseif($label=="date"){
  	  	 							print "<tr class='bottom_borderr' ><td class='bold' width='110'>record date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 					}elseif($label=="next_date"){
  	  	 							print "<tr class='bottom_borderr' ><td class='bold' width='110'>next physical</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	     					}
  	  	 				}
  	  	 				
  	  	 			if($_SESSION[access]=="1"){
  	  	 				print "<input type='hidden' id='admin_delete' value='".$row['key']."'>";
  	     				print "<tr><td><input 	id='delete_history' type = 'submit' name = 'delete_history' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete Record' /></td></tr>";
  	  	 			}//end session global if
  	  	 		
  	     		print "</form>";
 			 }// end foreach historyResult
 			 print "</table>";
 	 print "</div>";//inner accordion div
        }//end if HISTORY data
        }// end if access
        }else{//end if($horse_key!='')
  	  	 	print"Please select a horse";
        }
        ?>		 
<!--ADD NEW HISTORY -->

	<h3>Enter New Medical History Data</h3>
    <div id="history_response"><!--start inner accordion div-->
<?if($_SESSION['access']<5){//allow to update information
?>
  	  	<form action='javascript:insert_history()' method='post'>
  	  	 <?
  	  	 	print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse_key."' />";
			print "<table>";
  	  	 		foreach($history_field_labels as $label){
  	  	 			  	  if($label=="date"){
  	  	 						
  	  	 						print "<tr><td>";						
  	  	 						print "<select style='width: auto;' id ='hmonth' name = 'hmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='hday' name='hday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='hyear' name='hyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date(Y)-3;$i<=date(Y)+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td></tr>";
  	  	 					}//end date if  	  	 			
  	  	 					elseif($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 						print "<tr>";
  	  	 						print "<td width='350'><textarea rows='5' placeholder='Enter Medical Record or Health Event Here...' id='h".$label."'></textarea></td>";
  	  	 						print "</tr>";
  	  	 			}
  	  	 		}
  	  	 	  ?>

			</table>
				<input 	id="submit_history" type = "submit" name = "submit_history" class= "btn btn-warning" value = "Submit New Medical History Information"/>
		</form>
<?
  	}else{
		print"Sorry, your access does not allow adding new History";
	} 
	print "</div>";//end history response div
	}//end horse mode if
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$history_field_labels=GetMysqlFieldNames("medical_history", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='history_response".$horse[key]."'>";//place content here
   				 	$element='history_response'.$horse[key];
 
	print "<form  action='javascript:insert_role_history(&quot;$element&quot;,".$horse['key'].")' method='post'>";//update horse form
  	 			print "<table>";
  	  	 		foreach($history_field_labels as $label){
  	  	 			  	  if($label=="date"){
  	  	 						
  	  	 						print "<tr><td>";						
  	  	 						print "<select style='width: auto;' id ='hmonth".$horse[key]."' name = 'hmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='hday".$horse['key']."' name='hday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='hyear".$horse['key']."' name='hyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td></tr>";
  	  	 					}//end date if  	  	 			
  	  	 					elseif($label!="key"&&$label!="horse_key"&&$label!="facility_key"){
  	  	 						print "<tr>";
  	  	 						print "<td width='350'><textarea rows='5' placeholder='Enter Medical Record or Health Event Here...' id='h".$label.$horse['key']."'></textarea></td>";
  	  	 						print "</tr>";
  	  	 			}
  	  	 		}
  	  	 	  ?>

			</table>
				<input 	id="submit_history" type = "submit" name = "submit_history" class= "btn btn-warning" value = "Submit New Medical History Information"/>
		</form>
				<?     		
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    } 
?>
	</div> <!-- end inner accordion -->    
</div> <!--end fragment-7 MEDICAL HISTORY-->



<div id="fragment-8"><!--COGGINS TAB !!!!!!!!!!!!!!!!-->
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if(isset($horse_key)&&$horse_key&&$_SESSION['passwordcheck']=='pass'&&$role_mode==0){//horse_key mode
    $coggins_field_labels=GetMysqlFieldNames("coggins", $dbname);
    if($horse_key){
       	if($_SESSION['access'] < 4){//allow to view information
        	$cogginsResult=GetTableData("horse_key",$horse_key, "coggins", $dbname);
        	if($cogginsResult){
        	 foreach($cogginsResult as $row){
  	  	 		print "<h3>".$row['date']."</h3>";
  	  	 		print "<div id='coggins'>";
  	  	 		$coggins=str_replace('_',' ',$row['image']);
  	  	 		print "<iframe style='visibility:hidden;' id='iFramePdf' src='".$coggins."' ></iframe>";
  	  	 		print "<table id='coggins_table'>";
  	  	 		foreach($coggins_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="vet_key"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 				print "<tr class='bottom_borderr'>";
  	  	 					print "<td class='bold' width='50'>".str_replace('_',' ',$label)."</td><td>".$row[$label]."</td>";
  	  	 				print "</tr>";
  	  	 			}elseif($label=="vet_key"){
  	  	 					print "<tr class='bottom_borderr'><td width='50'>vet</td><td>".getName($row[$label],'login',$dbname)."</td></tr>";
  	  	 			}elseif($label=="date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>coggins date</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}elseif($label=="next_date"){
  	  	 					print "<tr class='bottom_borderr' ><td class='bold' width='110'>next physical</td><td>".date('F j Y',strtotime($row[$label]))."</td></tr>";
  	  	 			}
  	  	 		}
  	  	 		$cimage_key=$row['key'];
  	  	 		print "<tr><td>";
  	  	 		print "<input type='submit' class='btn btn-warning' value='Print Coggins' onclick='printTrigger(&quot;iFramePdf&quot;);' />";
				print "</td></tr>";
  	  	 		print "</table>";
  	  	 		print "<IMG STYLE='border:2px solid black; border-radius:5px; width:60%;' SRC='".$coggins."' ALT='".$coggins."'>";
  	     		if($_SESSION[access]=="1"){
  	  	 			$delete_table=8;
 			 		/*print "<form action='javascript:delete_record(".$row[key].",".$delete_table.")' method='post' enctype='multipart/form-data'>"; 
  	     			print "<input 	id='delete_physical' type = 'submit' name = 'delete_physical' class= 'btn btn-danger delete_record' value = 'Delete ".$row['date']." Data' onclick='delete_precord(".$row[key].")'/>";*/
  	     		}
  	     		print "</form>";
  	     		
  	     		print "</div>";
 			 }//end foreach loop
        }else{
 		 	print "No Coggins has been recorded for". $horse;
 		 	$cimage_key=0;
 		 }//end if coggins result
        }//end access
        }else{//end if($horse_key!='')
  	  	 	print"Please select a horse";
        }
        print "<h3>Enter New Coggins</h3>";
  	  	 print "<div id='coggins_response'>";
  	  	 if($_SESSION['access']<5){//allow to update information
  	  	 if($horse_key!=''){
  	  	 	
  	  	 ?>
  	  	 <!-- Show Message for AJAX response -->
			
  	  	 <form action="image_upload.php" method="post" enctype="multipart/form-data">
  	  	 <?
			print "<table>";
  	  	 		foreach($coggins_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td>".str_replace('_',' ',$label)."</td>";
  	  	 						  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='cmonth' name = 'cmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='cday' name='cday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='cyear' name='cyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}//end date if
  	  	 			}//end label if
  	  	 		}//foreach
  	  	 		?>
					<tr><td><label for="file">Choose New Coggins File:</label></td></tr>
					  	  	<?print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse_key."'/>";
		print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse_key."'/>";
		print "<input type='hidden' name='cimage_key' id='cimage_key' value='".$cimage_key."'/>";
		print "<tr><td><input type='hidden' name='table' id='table' value='coggins' />";?>
					<input type='hidden' name='image_type' id='image_type' value="coggins" />
					<input type="file" name="file" id="file" value=><br></td></tr>
					<tr><td><input 	id="submit_coggins" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit-Coggins"/></td></tr>
				</table>
				</form>
				<?
  	  	 }else{//end if($horse_key!='')
  	  	 	print"Please select a horse";
  	  	 }
  	  	 }else{
			print"Sorry, your access does not allow adding new information.";
		 }//end privilege div
  	     print "</div>";		 
	}//end horse mode if
	elseif(isset($role_key)&&$role_mode==1&&$_SESSION['passwordcheck']=='pass'&&$access<3){//put caval-connect in data entry mode only
		//$horses=GetRoleTableData($role,$role_key,'information',$_SESSION['facility'],$db);
		$coggins_field_labels=GetMysqlFieldNames("coggins", $dbname);
			if($horses){
				foreach($horses as $horse){
					//if($horse[owner_key]==$role_key||$horse[vet_key]==$role_key||$horse[farrier_key]){
					print "<h3><strong>".$horse[horse_name]."</strong>  ".$message."</h3>";
     				print "<div id='coggins_response".$horse[key]."'>";//place content here
   				 	$element='coggins_response'.$horse[key];
   				 	
        			$cogginsResult=GetTableData("horse_key",$horse[key], "coggins", $dbname);
        			if($cogginsResult){
        				foreach($cogginsResult as $row){
  	  	 					$cimage_key=$row['key'];
 						}//end foreach loop
        			}else{
        				$cimage_key=0;
        			}
  	  	 print "<form action='image_upload.php' method='post' enctype='multipart/form-data'>";
  	  	 
			print "<table>";
  	  	 		foreach($coggins_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date"){
  	  	 						print "<td>".str_replace('_',' ',$label)."</td></tr>";
  	  	 						print "<tr><td>";						
  	  	 						print "<select style='width: auto;' id ='cmonth' name = 'cmonth' >";
									print "<option value = '".date('m')."'>".date('M')."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='cday' name='cday'><option value='".date('d')."'>".date('d')."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='cyear' name='cyear'><option value='".date('Y')."'>".date('Y')."</option>";
								for ($i=date('Y')-3;$i<=date('Y')+1;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
  	  	 					}//end date if
  	  	 			}//end label if
  	  	 		}//foreach
  	  	 		?>
					<tr><td><label for="file">Choose New Coggins File:</label></td></tr>
		<?print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse[key]."'/>";
		print "<input type='hidden' name='cimage_key' id='cimage_key' value='".$cimage_key."'/>";
		print "<tr><td><input type='hidden' name='table' id='table' value='coggins' />";?>
					<input type='hidden' name='image_type' id='image_type' value="coggins" />
					<input type="file" name="file" id="file" value=><br></td></tr>
					<tr><td><input 	id="submit_lineage" type = "submit" name = "submit_image" class= "btn btn-warning" value = "Submit Lineage File"/></td></tr>
				</table>
				</form>
				<?     		
 	    			print "</div>";//
					//}//right before H3
				}
			}else{
				print $role_name. " is not registered with any horses at this facility";
			}//end if horses exists
    }  	     	     		 
 		 ?>

		</div> <!--end accordion-->  
	</div> <!--end fragment-8 COGGINS-->





<!-- ########################## ADMIN TAB !!!!! ################################-->

<div id="fragment-10">
<?
if(isset($role_mode)&&$role_mode==0){
	print "<div class='accordion'>";//call collapsed accordion or not
}else{
	print "<div class='roleaccordion'>";
}
if($_SESSION['access']<3){//dont see this tab if vet or farrier

	if($_SESSION['passwordcheck']=='pass'){
        // if($login_data){
		if($login_field_labels&&$login_data){
        	print "<h3>Access Levels for Current Users</h3>";

        	print "<table>";
        	  	 print "<tr>";
  	  	 			foreach($login_field_labels as $label){
  	  	 				if($label!="key"&&$label!="password"&&$label!="facility_key"&&$label!="date"&&$label!="next_date"){
  	  	 					print "<th class='bottom_borderh' style='font-weight:bold;'>".str_replace('_',' ',$label)."</th>";
  	  	 				}
  	  				}
  	 			print "</tr>";
  	 			print "<form>";
        	foreach($login_data as $row){		
  	  	 		$delete_table='login';
  	  	 		
  	  	 		print "<tr>";
  	  	 			foreach($login_field_labels as $label){
  	  	 				if($label!="key"&&$label!="password"&&$label!="facility_key"){
  	  	 					print "<td class='bottom_borderr'>".$row[$label]."</td>";
  	  	 				}elseif($label=="facility_key"){
  	  	 					print "<td class='bottom_borderr'>".getName($row[$label],'facility',$dbname)."</td>";
  	  	 				}
  	  				}
  	  			if($_SESSION['access']<2){//script for deleting record
  	  				$element='delete_admin'.$row[key];
  	  				$name=$row['first_name'];
  	  				print "<form action='javascript:delete_record(".$row[key].",&quot;".$delete_table."&quot;,&quot;".$element."&quot;,&quot;".$name."&quot;)' method='post' enctype='multipart/form-data'>";
  	  	 			print "<input type='hidden' id='admin_delete' value='ad".$row[key]."'>";
  	     			print "<td id='delete_admin".$row[key]."'><input id='delete".$row[key]."' type = 'submit' name = 'delete_admin' class= 'btn btn-danger delete_admin btn-mini' value = 'Delete User' /></td>";
  	     			print "</form>";
  	     			
  	  	 			}
  	  	 			print "</tr>";
  	  	 			
        	}
 			 print "</table>";

        }//end if login data
  	    	
    
        ?>		 
<!--ADD NEW ADMIN -->

    <h3>Enter New Administrator, Vet, Farrier, or Trainer Information</h3>
    <div id="insert_admin_response"><!--start inner accordion div-->
<?if($_SESSION['access']<2 && $_SESSION['passwordcheck']=='pass'){//allow to update information
?>
        <form action='javascript:insert_admin()' method='post'>
         <?
         print "<input type='hidden' name='horse_key' id='horse_key' value='".$horse_key."' />";
            print "<table>";
                foreach($login_field_labels as $label){
                    if($label!="key"&&$label!="facility_key"){
                        if($label=="access"){
                            ?>              
                    <tr><td>Caval-Connect Access</td>
                    <td>
                            <select name='access' id='login_access'>
                                    <option value=''> Select Access Level </option>
                                    <option value='1'>Entire Facility</option>
                                    <option value='2'>Owner</option>
                                    <option value='3'>Vet</option>
                                    <option value='4'>Vet Data Only</option>
                                    <option value='3'>Farrier</option>
                                    <option value='4'>Farrier Data Only</option>
                                    <option value='5'>Trainer</option>
                            </select>
                    </td></tr>
                        <?
                        }elseif($label=="role"){
                            ?>              
                             <tr><td>Caval-Connect Role</td>
                                <td>
                                <select name='role' id='login_role'>
                                    <option value=''>Role</option>
                                    <option value='manager'>Barn Manager</option>
                                    <option value='owner'>Owner</option>
                                    <option value='vet'>Vet</option>
                                    <option value='farrier'>Farrier</option>
                                    <option value='trainer'>Trainer</option>
                                    <option value='student'>Student</option>
                                </select>
                    </td></tr>
                        <?
                        }else{
                            print "<tr>";
                                print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id='login_".$label."'></td>";
                            print "</tr>";
                        }
                    }
                }
              ?>

            </table>
        <input  id="submit_admin" type = "submit" name = "submit_admin" class= "btn btn-warning" value = "Submit New Admin Information"/>
        </form>
<?
    }else{
        print"Sorry, your access does not allow adding new Administrators";
    } 
?>
    </div> <!-- end inner accordion --> 


<!--ADD NEW FACILITY -->    
    <h3>Enter New Facility Data</h3>
    <div id="facility_response"><!--start inner accordion div--> 
<?if($_SESSION['access']<2 && $_SESSION['passwordcheck']=='pass'){//allow to update information
?>  
        <form action='javascript:insert_facility()' method='post'>
         <?
         $facility_field_labels=GetMysqlFieldNames("facility", $dbname);
         //print "<input type='hidden' name='horse_key' id='farrierhorse_key' value=".$horse_key." />";
            print "<table>";
                foreach($facility_field_labels as $label){
                    if($label!="key"&&$label!="access"&&$label!="horse_key"){
                        print "<tr>";
                            print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id='facility".$label."'></td>";
                        print "</tr>";
                    }
                }
              ?>
            </table>
        <input  id="submit_facility" type = "submit" name = "submit_facility" class= "btn btn-warning" value = "Submit New Facility Information"/>
        </form>
<?
    }else{
        print"Sorry, your access does not allow adding new Facilities";
    } 
?>
       </div><!--end inner accordion div -->  
<!--END ADD NEW FACILITY -->
		<? 
	}//end if pass check
}//end if for admin access
?> 
</div> <!--end accordion--> 
		
</div> <!-- ################################# end fragment-10 #################################-->










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
  	print "<input type='hidden' name='nhorse_key' id='nhorse_key' value='' />";
	print "<input type='hidden' name='nhorse_image' id='nhorse_image' value='' />";
	print "<input type='hidden' name='nhorse_record' id='nhorse_record' value='new' />";
			print "<table>";
  	  	 		foreach($info_field_labels as $label){
  	  	 			if($label!="key"&&$label!="horse_key"&&$label!="owner_key"&&$label!="vet_key"&&$label!="horse_image"&&$label!="facility_key"){
  	  	 				print "<tr>";
  	  	 					if($label=="date_foaled"||$label=="date"||$label=="next_date"){
  	  	 						//begin date selection - datepicker has problems with touch screens!!
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td>";
  	  	 						print "<td>";						
  	  	 						print "<select style='width: auto;' id ='nmonth' name = 'nmonth' >";
									print "<option value = '".date(m,$row[$label])."'>".date('M',$row[$label])."</option>";
									print "<option value = '01'>January</option>";
									print "<option value = '02'>February</option>";
									print "<option value = '03'>March</option>";
									print "<option value = '04'>April</option>";
									print "<option value = '05'>May</option>";
									print "<option value = '06'>June</option>";
									print "<option value = '07'>July</option>";
									print "<option value = '08'>August</option>";
									print "<option value = '09'>September</option>";
									print "<option value = '10'>October</option>";
									print "<option value = '11'>November</option>";
									print "<option value = '12'>December</option>";
								print "</select>";
								print "<select style='width: auto;' id='nday' name='nday'><option value='".date('d',$row[$label])."'>".date('d',$row[$label])."</option>";
								for ($i=1;$i<=31;$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "<select style='width: auto;' id='nyear' name='nyear'><option value='".date('Y',$row[$label])."'>".date('Y',$row[$label])."</option>";
								for ($i=1990;$i<=date('Y');$i++){
									print "<option value='$i'>".$i."</option>";
								}
								print "</select>";
								print "</td>";
								//end date selections
  	  	 					}elseif($label=="height"){
  	  	 						//slect for height
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".$label." in hands </option>";
									for($i = 130; $i <= 180; $i++){
										$j=$i/10;
										print"<option value=$j>$j</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}elseif($label=="weight"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".$label." in pounds </option>";
									for($i = 600; $i <= 1450; $i+=5){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
   	  	 					elseif($label=="temp-farenheit"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".$label."</option>";
									for($i = 95; $i <= 106; $i+=.1){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="heart_rate"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".str_replace('_',' ',$label)." per minute </option>";
									for($i = 20; $i <= 50; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="respiration_rate"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".str_replace('_',' ',$label)." per minute </option>";
									for($i = 10; $i <= 60; $i++){
										print"<option value=$i>$i</option>";
									}//end while
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					elseif($label=="sex"){
  	  	 						//slect for weight
  	  	 					print "<td width='150'>".str_replace('_',' ',$label)."</td><td><select name='n".$label."' id='n".$label."'>";
								print "<option value='0'> Select ".str_replace('_',' ',$label)."</option>";
								print "<option value='stallion'>Stallion</option>";
								print "<option value='gelding'>Gelding</option>";
								print "<option value='mare'>Mare</option>";
							print "</select></td>";
  	  	 					
  	  	 					}
  	  	 					else{
  	  	 						print "<td width='150'>".str_replace('_',' ',$label)."</td><td><input type='text' id='n".$label."'></td>";
  	  	 					}
  	  	 				print "</tr>";
  	  	 			}
  	  	 		}
  	  	 				print "<tr><td width='150'>Primary Vet</td><td>";
  	  	 					print "<select name='nvet_key' id='nvet_key'>";
								print "<option value='0'> Select Vet </option>";
									foreach($vet_data as $data){
										print"<option value=$data[key]>$data[first_name] $data[last_name]</option>";
									}//end while
								print "<option value='0'>New Vet</select>";
							print "</select>";
  	  	 				print "</td></tr>";
  	  	 				print "<tr><td width='150'>Horse Owner</td><td>";
  	  	 					print "<select name='nowner_key' id='nowner_key'>";
								print "<option value='0'> Select Owner </option>";
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
					print "<td width='150'><input type='password' id='passcheck' name='passcheck'></td>";
  	  	 		print "</tr>";			
			print "</table>";
			?>  
			
			 <input id="submit_login"  type = "submit" class="btn btn-warning" aria-hidden="true"  value = "Login"/>
			 <br></br>
  </div>
</form>
</div><!--end modal div-->
<!--begin sendemail modal-->
<div id="myModal_sendemail" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  action='javascript:sendemail()' method='post'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">Can not remember password</h3>
  </div>
  <div class="modal-body">
  <?
			print "<table>";
  	  	 		print "<tr>";
					print "<td width='150'><input type='text' id='sendemailfirst' name='sendemailfirst' placeholder='Enter First Name'></td>";
  	  	 		print "</tr>";	
  	  	 		print "<tr>";
					print "<td width='150'><input type='text' id='sendemaillast' name='sendemaillast' placeholder='Enter Last Name'></td>";
  	  	 		print "</tr>";		
			print "</table>";
			?>  
			
			 <input id="submit_login"  type = "submit" class="btn btn-warning" aria-hidden="true"  value = "Send email"/>
			 <br></br>
  </div>
</form>
</div><!--end sendemail div-->
<!--begin facility modal-->
<div id="myModal_facility" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form  action='login.php' method='post'>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times</button>
    <h3 id="myModalLabel">Choose Facility</h3>
  </div>
  <div class="modal-body">
  <?
			print "<table>";
  	  	 		print "<tr>";
					print "<td width='150'><input type='password' id='passcheck' name='passcheck'></td>";
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