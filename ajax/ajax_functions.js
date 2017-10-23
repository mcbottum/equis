src="http://code.jquery.com/jquery-1.8.2.js";
src="http://code.jquery.com/ui/1.9.1/jquery-ui.js";
src="http://layout.jquery-dev.net/lib/js/jquery.layout-latest.js";
function showUser(str)
{
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

            	$(document).ready(function() {
            		//$( "#accordion" ).accordion({heightStyle: "content",icons: icons });
            		//$( "#accordion" ).style.fontSize=30+"px";
            		document.getElementById("accordion").style.fontSize=30+"px";
                });
            	//document.getElementById("accordion").fontcolor('red');
            	//document.getElementById("accordion").style.fontSize=30+"px"; 
                try // try to output this to the javascript console
                {
                	//document.getElementById("accordion").innerHTML=response; 
                	//alert(response.length);
                	var i=0;
                	//$(document).ready(function() {
                	document.getElementById("accordion").innerHTML = '';
					    while(i < response.length){ 
    						mssgs ='<h3>'+ response[i] +'</h3>' + '<br/><div><p>hi there</p></div>';
   							 document.getElementById("accordion").innerHTML += mssgs;
   							 i++;
   						 }
   						 
                	//}//end doc ready function
                }//end try
                catch(an_exception) // alert for the users that don't have a javascript console
                {
                	//alert("hi");
                    //alert('product id ' + response.item_id + ': quantity = ' + response.quantity + ' & price = ' + response.price);
                }

            }//end parseRequest function
