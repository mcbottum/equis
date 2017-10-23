<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;
	charset=utf-8" />
<title>EquiNet</title>
	<link rel="stylesheet" type="text/css" href="js/bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/layout-default-latest.css"/>
  <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
  <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
  <script src="http://layout.jquery-dev.net/lib/js/jquery.layout-latest.js"></script>
  <script src="js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="ajax/ajax_functions.js" type="text/javascript"></script>
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
  //initialize tabs and effects
  var myLayout;
  $(document).ready(function() {
  	//myLayout = $('body').layout();
    $("#tabs").tabs({ event: "mouseover"},{ fx:{opacity:"toggle"}});
  	var icons = {header: "ui-icon-circle-arrow-e",
           activeHeader: "ui-icon-circle-arrow-s"
        };
    $( "#accordion" ).accordion({heightStyle: "content",icons: icons });
    myLayout = $('body').layout({
			west__size:230, east__size:300, north__size:"10%"
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
  });
//jsonp functions
function showUser(str)
{
	var div="hi";
	//alert("hi");
if (str=="")
  {
  document.getElementById("accordion").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("accordion").innerHTML=xmlhttp.responseText;
   
    $( "#accordion" ).html(xmlhttp.responseText);
     //$( "#accordion" ).accordion({heightStyle: "content",icons: icons });
    }
  }
xmlhttp.open("GET","getuser.php?q="+str+"?div="+div,true);
xmlhttp.send();
}

            function callTheJsonp(str)
            {
                // the url of the script where we send the asynchronous call
                //var url = "http://localhost/utils/jsonp/ajax.php?callback=parseRequest";
                var url = "http://localhost/equis/jsonp/ajax.php?callback=parseRequest&q="+str;
                alert(url);
                // create a new script element
                var script = document.createElement('script');
                // set the src attribute to that url
                script.setAttribute('src', url);
                // insert the script in out page
                document.getElementsByTagName('head')[0].appendChild(script);
            }
 
            // this function should parse responses.. you can do anything you need..
            // you can make it general so it would parse all the responses the page receives based on a response field
            function parseRequest(response)
            {
            	//document.getElementById("accordion").style.fontSize=30+"px"; 
                try // try to output this to the javascript console
                {
                	var i=0;
                	//$(document).ready(function() {
                	document.getElementById("accordion").innerHTML = '';
					    while(i < response.length){ 
    						mssgs ='<h3>'+ response[i] +'</h3>' + '<br/><div><p>hi there</p></div>';
   							 document.getElementById("accordion").innerHTML += mssgs;
   							 i++;
   						 }
   	
                }//end try
                catch(an_exception) // alert for the users that don't have a javascript console
                {
                	//alert("hi");
                    //alert('product id ' + response.item_id + ': quantity = ' + response.quantity + ' & price = ' + response.price);
                }
            	$(document).ready(function() {
            		$( "#accordion" ).accordion({heightStyle: "content",icons: icons });
            		//$( "#accordion" ).style.fontSize=30+"px";
            		//document.getElementById("accordion").style.fontSize=30+"px";
                });
            }//end parseRequest function  
  
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
$dbname = 'equis';
$conn=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db($dbname);
/**/
$horse_key=$_REQUEST['horse'];
$owner_key=$_REQUEST['owner'];

if(!$horse_key&&!$owner_key){
	$dbTable1='horse';
	$dbTable2='owner';
	$sql1="SELECT * FROM $dbTable1";
	$sql2="SELECT * FROM $dbTable2";
	$horse_result = mysql_query($sql1,$conn);
	$owner_result = mysql_query($sql2,$conn);
}
/*if ($horse_key){

	$sql1="SELECT * FROM physical WHERE horse_key='$horse_key'";
	$physical_result = mysql_query($sql1,$conn);
}
*/
?>
<body style="font-size:62.5%;">
<!--<div id="north_container" class="ui-layout-north">-->
<div id="north_container" class="ui-layout-north ui-widget-content" style="display: none;">
	EquiVitae<?print $horse_key?>
</div><!--end north_-->
<div id="north_spacer">
</div><!--end north_spacer-->

<div id="west_container" class="ui-layout-west" style="display: none;">
	<table id="west_data" width="100%" align="center">
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<form 	
				name="form"
				action = "equinet.php"
				method = "post">
		<tr>
			<td>
				<!--this works <select name="horse" onchange="showUser(this.value)">-->
				<select name="horse" onchange="callTheJsonp(this.value)">
					<option  value=""> Select Horse </option>
					<?while($row = mysql_fetch_array($horse_result)){
						print"<option value=$row[key]>$row[nick_name]</option>";
					}//end while
						?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input 	type = "submit"
						name = "submit"
						class= "btn btn-warning"
						value = "Submit Horse"/>
			</td>
		</tr>
		</form>
		<tr>
			<td>
				<br>
			</td>
		</tr>
		<form 	
				name="form"
				action = "equinet.php"
				method = "post">
		<tr>
			<td>
				<!--this works json <select name="owner" onchange="showUser(this.value)">-->
				<select name="owner" onchange="callTheJsonp()">
					<option value=""> Select Owner </option>
					<?while($row = mysql_fetch_array($owner_result)){
						print"<option value=$row[key]>$row[first_name] $row[last_name]</option>";
					}//end while
						?>
				</select>
			</td>
		</tr>
		</form>
		<tr>
			<td>
				<input 	type = "submit"
						name = "submit"
						class= "btn btn-warning"
						value = "Submit Owner"/>
			</td>
		</tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<select>
					<option value=""> Select Trainer </option>
					<option value="Zague"> Zague </option>
					<option value="Spell"> Spell </option>
					<option value="Tora"> Tora </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input 	type = "submit"
						name = "submit"
						class= "btn btn-warning"
						value = "Submit Trainer"/>
			</td>
		</tr>
			<td>
				<br>
			</td>
		</tr>
		<tr>
			<td>
				<select>
					<option value=""> Select Student </option>
					<option value="Zague"> Zague </option>
					<option value="Spell"> Spell </option>
					<option value="Tora"> Tora </option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<input 	type = "submit"
						name = "submit"
						class= "btn btn-warning"
						value = "Submit Student"/>
			</td>
		</tr>
		<tr>
			<td>
				<div id = "greyline""></div>
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
	</table>
	
	<div id="accordion1" class="basic">
	</div><!--end accordion1-->
</div><!--end west_sidebar-->
<div id="west_spacer">
</div><!--end spacer div-->
<div id="main_container" class="ui-layout-center"> 
<div id="tabs">

    <ul>
        <li><a href="#fragment-1"><span>Coggins</span></a></li>
        <li><a href="#fragment-2"><span>Physicals</span></a></li>
        <li><a href="#fragment-3"><span>Vaccinations</span></a></li>
        <li><a href="#fragment-4"><span>Parasites</span></a></li>
        <li><a href="#fragment-5"><span>Lineage</span></a></li>
        <li><a href="#fragment-6"><span>Medical History</span></a></li>
        <li><a href="#fragment-7"><span>Dental</span></a></li>
        <li><a href="#fragment-8"><span>Farrier</span></a></li>
        <li><a href="#fragment-9"><span>Nutrition</span></a></li>
        <li><a href="#fragment-10"><span>Rehab</span></a></li>
    </ul>
    <div id="fragment-1" class="active">

        <p>First tab is active by default:</p>

        <pre><code>$('#example').tabs();</code></pre>
    </div>
 	<div id="fragment-2">
            	<script type='text/javascript'>
            	$(document).ready(function() {
            		$( "#accordion" ).accordion({heightStyle: "content",icons: icons });
                });
                </script>
        <div id="accordion">

        <!--<span id="data"></span>-->
    		<h3>November 12 2010</h3>
   			 <div>
      		  <p>
        amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
       		 </p>
    		</div>
    		<h3>May 12 2011</h3>
    		<div>
      			  <p>
        velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
        suscipit faucibus urna.
       			</p>
    		</div>
    		<h3>Agust 12 2012</h3>
    		<div>
      			 <p>
        Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet

       			</p>
    		</div> 
  
		 <!--end data -->
		</div><!-- end accordion -->  
	</div><!--end fragment-2-->
	<div id="fragment-3">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
	</div>
	<div id="fragment-4">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
    </div>
</div><!-- end tabs div -->
</div><!--end main_container div-->
</body>
</html>