//begin of drag functions

function hookEvent(element, eventName, callback)
{
  if(typeof(element) == "string")
    element = document.getElementById(element);
  if(element == null)
    return;
  if(element.addEventListener)
    element.addEventListener(eventName, callback, false);
  else if(element.attachEvent)
    element.attachEvent("on" + eventName, callback);
}

function unhookEvent(element, eventName, callback)
{
  if(typeof(element) == "string")
    element = document.getElementById(element);
  if(element == null)
    return;
  if(element.removeEventListener)
    element.removeEventListener(eventName, callback, false);
  else if(element.detachEvent)
    element.detachEvent("on" + eventName, callback);
}

function cancelEvent(e)
{
  e = e ? e : window.event;
  if(e.stopPropagation)
    e.stopPropagation();
  if(e.preventDefault)
    e.preventDefault();
  e.cancelBubble = true;
  e.cancel = true;
  e.returnValue = false;
  return false;
}

function Position(x, y)
{
  this.X = x;
  this.Y = y;
  
  this.Add = function(val)
  {
    var newPos = new Position(this.X, this.Y);
    if(val != null)
    {
      if(!isNaN(val.X))
        newPos.X += val.X;
      if(!isNaN(val.Y))
        newPos.Y += val.Y
    }
    return newPos;
  }
  
  this.Subtract = function(val)
  {
    var newPos = new Position(this.X, this.Y);
    if(val != null)
    {
      if(!isNaN(val.X))
        newPos.X -= val.X;
      if(!isNaN(val.Y))
        newPos.Y -= val.Y
    }
    return newPos;
  }
  
  this.Min = function(val)
  {
    var newPos = new Position(this.X, this.Y)
    if(val == null)
      return newPos;
    
    if(!isNaN(val.X) && this.X > val.X)
      newPos.X = val.X;
    if(!isNaN(val.Y) && this.Y > val.Y)
      newPos.Y = val.Y;
    
    return newPos;  
  }
  
  this.Max = function(val)
  {
    var newPos = new Position(this.X, this.Y)
    if(val == null)
      return newPos;
    
    if(!isNaN(val.X) && this.X < val.X)
      newPos.X = val.X;
    if(!isNaN(val.Y) && this.Y < val.Y)
      newPos.Y = val.Y;
    
    return newPos;  
  }  
  
  this.Bound = function(lower, upper)
  {
    var newPos = this.Max(lower);
    return newPos.Min(upper);
  }
  
  this.Check = function()
  {
    var newPos = new Position(this.X, this.Y);
    if(isNaN(newPos.X))
      newPos.X = 0;
    if(isNaN(newPos.Y))
      newPos.Y = 0;
    return newPos;
  }
  
  this.Apply = function(element)
  {
    if(typeof(element) == "string")
      element = document.getElementById(element);
    if(element == null)
      return;
    if(!isNaN(this.X))
      element.style.left = this.X + 'px';
    if(!isNaN(this.Y))
      element.style.top = this.Y + 'px';  
  }
}

function absoluteCursorPostion(eventObj)
{
  eventObj = eventObj ? eventObj : window.event;
  
  if(isNaN(window.scrollX))
    return new Position(eventObj.clientX + document.documentElement.scrollLeft
                        + document.body.scrollLeft, 
                        eventObj.clientY + document.documentElement.scrollTop
                        + document.body.scrollTop);
  else
    return new Position(eventObj.clientX + window.scrollX, 
                        eventObj.clientY + window.scrollY);
}
//here is new code for weight calc
function dragObject(element, attachElement, lowerBound, upperBound,
                    startCallback, moveCallback, endCallback, attachLater)
{
  if(typeof(element) == "string")
    element = document.getElementById(element);

  if(element == null)
    return;
  
  if(lowerBound != null && upperBound != null)
  {
    var temp = lowerBound.Min(upperBound);
    upperBound = lowerBound.Max(upperBound);
    lowerBound = temp;
  }

  var cursorStartPos = null;
  var elementStartPos = null;
  var dragging = false;
  var listening = false;
  var disposed = false;
  
  function dragStart(eventObj)
  { 
    if(dragging || !listening || disposed) 
      return;

    dragging = true;
    
    if(startCallback != null)
      startCallback(eventObj, element);
    
    cursorStartPos = absoluteCursorPostion(eventObj);
    
    elementStartPos = new Position(parseInt(element.style.left),
                                   parseInt(element.style.top));
   
    elementStartPos = elementStartPos.Check();
    
    hookEvent(document, "mousemove", dragGo);
    hookEvent(document, "mouseup", dragStopHook);
    
    return cancelEvent(eventObj);
  }
  
  function dragGo(eventObj)
  {
    if(!dragging || disposed)
      return;
    
    var newPos = absoluteCursorPostion(eventObj);
    newPos = newPos.Add(elementStartPos).Subtract(cursorStartPos);
    newPos = newPos.Bound(lowerBound, upperBound)
    newPos.Apply(element);
    if(moveCallback != null)
      moveCallback(newPos, element);

      
   	//calls function main to reshape space as parameter is dragged 
    var ele_drag_coord_array=[];
    var ele=element.getAttribute("Id");
	var eleArray = ele.split('_');
	var pos=parseFloat(eleArray[1]);
	if(ele!="center"){
		for(var i=1;i<=search_count;i++){
			var element_name="term_"+i;
			ele_drag_coord_array.push(parseInt(document.getElementById(element_name).style.left));
			ele_drag_coord_array.push(parseInt(document.getElementById(element_name).style.top));
		}
		main(0.3,ele_drag_coord_array);
	}
    
    //change font size while dragging
    var xpos=parseInt(element.style.left);
	var ypos=parseInt(element.style.top);
	var weightValue=Math.abs(weightCalc(xpos,ypos,element));
	var size=weightValue*5+7;
    element.style.fontSize=size+"px";   
    return cancelEvent(eventObj); 
  }
  
  function dragStopHook(eventObj)
  {

    dragStop();
    return cancelEvent(eventObj);
  }
//cals for weight calc  
  function dragStop()
  {
    
    if(!dragging || disposed)
      return;

    unhookEvent(document, "mousemove", dragGo);
    unhookEvent(document, "mouseup", dragStopHook);
    cursorStartPos = null;
    elementStartPos = null;
    if(endCallback != null)
      endCallback(element);
    dragging = false;

	var search_mode=0;    
	if(search_mode==0){
		
	var min_weight=2;
	var wovenWeightArray=new Array();
	var js_weight_array=new Array();

//for yelp drag into search space
		 var ele=element.getAttribute("Id");
		 if(ele=="yelp_drag"){
		 	var xpos=parseInt(element.style.left);
		 	var ypos=parseInt(element.style.top);
		 	var state=document.getElementById("yelp_state").value;
		 //	alert(document.getElementById("yelp_state").value);
		 			if(xpos<200 && ypos<230 && state!="active"){

						var weightValue = 10;
					}else if(xpos<200 && ypos<230 && state=="active"){
						var weightValue=Math.abs(weightCalc(xpos,ypos,element));
						//document.getElementById("yelp_weight").value = weightValue;
					}
					
					else if(xpos>220 && ypos>150){
						var weightValue=5;
						//state="inactive";
						element.style.left=290+"px";
						element.style.top=0+"px";
					}
					
					document.getElementById("yelp_weight").value = weightValue;
					document.getElementById("yelp_state").value = state;	
					//alert(document.getElementById("yelp_state").value);
					
		 }
   				
// end yelp drag scripting
	for(var i=1;i<=search_count;i++){
		var element_name="term_"+i;
		
		var xpos=parseInt(document.getElementById(element_name).style.left);
		var ypos=parseInt(document.getElementById(element_name).style.top);
		//alert(ypos);
		if(xpos>250 && ypos>250){
			//alert("hi");
			var weightValue=5;
		}else{
			
    	var weightValue=Math.abs(weightCalc(xpos,ypos,element));
		}
   		element.weight=weightValue;
   		document.getElementById("weight_"+i).value = weightValue;
		if(weightValue<=min_weight && weightValue!=0){
			min_weight=weightValue;
			//alert("b");
		}
		//alert(weightValue);
		//if(weightValue<.98){
		//	document.getElementById(element_name).style.display="none";
		//}
		js_weight_array.push(weightValue);
	}//end for

		if(min_weight<.98){
			var holder;
			for(var i=1;i<=search_count;i++){
				holder=(document.getElementById("weight_"+i).value-min_weight)/1.7+1;
				if(holder>=2){
					holder=1.95;
				}
				document.getElementById("weight_"+i).value=holder;
				//alert("docweight "+document.getElementById("weight_"+i).value);
			}
	}
	}else{
	var weightValue=woven_weightCalc(element.style.left,element.style.top);
	}
  var xpos=parseInt(document.getElementById(element_name).style.left);
  var ypos=parseInt(document.getElementById(element_name).style.top);
  }
 
  this.Dispose = function()
  {
    if(disposed)
      return;

    this.StopListening(true);
    element = null;
    attachElement = null
    lowerBound = null;
    upperBound = null;
    startCallback = null;
    moveCallback = null
    endCallback = null;
    disposed = true;
    
    
  }
  
  this.StartListening = function()
  {
    if(listening || disposed)
      return;

    listening = true;
    hookEvent(attachElement, "mousedown", dragStart);
  }
  
  this.StopListening = function(stopCurrentDragging)
  {
    if(!listening || disposed) 
      return;

    unhookEvent(attachElement, "mousedown", dragStart);
    listening = false;
    
    if(stopCurrentDragging && dragging)
      dragStop();
  }
  
  this.IsDragging = function(){ return dragging; }
  this.IsListening = function() { return listening; }
  this.IsDisposed = function() { return disposed; }
  
  if(typeof(attachElement) == "string")
    attachElement = document.getElementById(attachElement);
  if(attachElement == null)
    attachElement = element;
    
  if(!attachLater)
    this.StartListening();
}


//re-calculates coordinates of search terms given their weights
function calculate_circle_points(search_count,center_x,center_y,radius,weight_array,max_weight){
	var angle=2*3.141/search_count;
	var js_coord_array=new array();
	for(var i=0;i<search_count;i++){
		coord_array.push=cos(angle*i)*radius*(max_weight-weight_array[i])+center_x;
		coord_array.push=sin(angle*i)*radius*(max_weight-weight_array[i])+center_y;
	}
	return js_coord_array;
}


//called from dragstop function
function weightCalc(xpos,ypos,element){//calculate weight of each search term, max weight =2,center of space =149px
	var xcenter=parseInt(document.getElementById("center").style.left);
	var ycenter=parseInt(document.getElementById("center").style.top);
	xpos=parseFloat(xpos);
	ypos=parseFloat(ypos);
	if(element.getAttribute("Id")=="center"){
		var weight=2-(Math.sqrt(Math.pow(xpos-xcenter,2)+Math.pow(ypos-ycenter,2)))/149;
		assignCenterCoords(element)
	}else{
		var weight=2-(Math.sqrt(Math.pow(xpos-xcenter,2)+Math.pow(ypos-ycenter,2)))/149;
	}
	//alert(xcenter+"  "+ycenter+"  "+weight);
	return weight;
}

////////////////end of dragfunctions//////////////



///////////validates HawkeyeSearch.php form////////////
function validate_form()
{
	valid=true;
	var alertstring=new String("");
	

	if(document.form.searchString.value=="" && document.form.NewTable.checked==false){
		alertstring=alertstring+"\n search terms.";
		document.form.searchString.style.background = "yellowgreen";
		valid=false;
	}else{
		document.form.searchString.style.background = "white";
	}//end trig check
	
	if(document.form.table.selectedIndex=="" && document.form.NewTable.checked==false){
		alertstring=alertstring+"\n DataBase.";
		document.form.table.style.background = "yellowgreen";
		valid=false;
	}else{
		document.form.table.style.background = "white";
	}//end trig check
	if(valid==false){
		alert("Please enter the following data;" + alertstring);
	}
	return valid;
}

///////////////following functions for activating dragspace////////////


function term_1End()
{
}
function term_2End()
{
}
function term_3End()
{
}
function term_4End()
{
}
function term_5End()
{
}
function term_6End()
{
}
function term_centerEnd()
{
}
function PeteEnd()
{
}
function yelpEnd()
{
}

//assign center coordinates to value for center input
function assignCenterCoords(element){
	var xpos=parseInt(document.getElementById("center").style.left);
	var ypos=parseInt(document.getElementById("center").style.top);
	document.getElementById("centerPos").value=xpos+"_"+ypos;
}

function assignWeightValues(element){
	var ele=element.getAttribute("Id");
  	document.getElementById(ele).value = element.weight;
}
function AddXYPosToCoordArray(coord_array,element,xpos,ypos){
	//alert("hi");
	var ele=element.getAttribute("Id");
	var eleArray = ele.split('_');
	var pos=parseInt(eleArray[1]);
	xpos=parseInt(xpos);
	ypos=parseInt(ypos);
	var sp_position=parseInt(2*pos-2);
	
	var sp_position=parseInt(2*pos-2);
	//js_coord_array.splice(sp_position,2,xpos,ypos);

}

//here below draws bezier curves between searchpoints
function HSVtoRGB(h,s,v,opacity){
  // inputs h=hue=0-360, s=saturation=0-1, v=value=0-1
  // algorithm from Wikipedia on HSV conversion
    var toHex=function(decimalValue,places){
        if(places == undefined || isNaN(places))  places = 2;
        var hex = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F");
        var next = 0;
        var hexidecimal = "";
        decimalValue=Math.floor(decimalValue);
        while(decimalValue > 0){
            next = decimalValue % 16;
            decimalValue = Math.floor((decimalValue - next)/16);
            hexidecimal = hex[next] + hexidecimal;
        }
        while (hexidecimal.length<places){
            hexidecimal = "0"+hexidecimal;
        }
        return hexidecimal;
    }
    var hi=Math.floor(h/60)%6;
    var f=h/60-Math.floor(h/60);
    var p=v*(1-s);
    var q=v*(1-f*s);
    var t=v*(1-(1-f)*s);
    var r=v;  // case hi==0 below
    var g=t;
    var b=p;
    switch(hi){
        case 1:r=q;g=v;b=p;break;
        case 2:r=p;g=v;b=t;break;
        case 3:r=p;g=q;b=v;break;
        case 4:r=t;g=p;b=v;break;
        case 5:r=v;g=p;b=q;break;
    }
    //  At this point r,g,b are in 0...1 range.  Now convert into rgba or #FFFFFF notation
    if(opacity){
        return "rgba("+Math.round(255*r)+","+Math.round(255*g)+","+Math.round(255*b)+","+opacity+")";
    }else{
       return "#"+toHex(r*255)+toHex(g*255)+toHex(b*255);
    }
}
function hexToCanvasColor(hexColor,opacity){
    // Convert #AA77CC to rbga() format for Firefox
    opacity=opacity || "1.0";
    hexColor=hexColor.replace("#","");
    var r=parseInt(hexColor.substring(0,2),16);
    var g=parseInt(hexColor.substring(2,4),16);
    var b=parseInt(hexColor.substring(4,6),16);
    return "rgba("+r+","+g+","+b+","+opacity+")";
}

function getControlPoints(x0,y0,x1,y1,x2,y2,t){
    //  x0,y0,x1,y1 are the coordinates of the end (knot) pts of this segment
    //  x2,y2 is the next knot -- not connected here but needed to calculate p2
    //  p1 is the control point calculated here, from x1 back toward x0.
    //  p2 is the next control point, calculated here and returned to become the 
    //  next segment's p1.
    //  t is the 'tension' which controls how far the control points spread.
    
    //  Scaling factors: distances from this knot to the previous and following knots.
    var d01=Math.sqrt(Math.pow(x1-x0,2)+Math.pow(y1-y0,2));
    var d12=Math.sqrt(Math.pow(x2-x1,2)+Math.pow(y2-y1,2));
   
    var fa=t*d01/(d01+d12);
    var fb=t-fa;
  
    var p1x=x1+fa*(x0-x2);
    var p1y=y1+fa*(y0-y2);

    var p2x=x1-fb*(x0-x2);
    var p2y=y1-fb*(y0-y2);  
    
    return [p1x,p1y,p2x,p2y]
}

function drawSpline(ctx,pts,t){
    showDetails=document.getElementById('details').checked;
    ctx.lineWidth=4;
    ctx.save();
    var cp=[];   // array of control points, as x0,y0,x1,y1,...
    var n=pts.length;


        //   Append and prepend knots and control points to close the curve
        pts.push(pts[0],pts[1],pts[2],pts[3]);
        pts.unshift(pts[n-1]);
        pts.unshift(pts[n-1]);
        for(var i=0;i<n;i+=2){
            cp=cp.concat(getControlPoints(pts[i],pts[i+1],pts[i+2],pts[i+3],pts[i+4],pts[i+5],t));
        }
        cp=cp.concat(cp[0],cp[1]);   
        for(var i=2;i<n+2;i+=2){
            var color=HSVtoRGB(Math.floor(240*(i-2)/(n-2)),0.8,0.8);
           // if(!showDetails){color="#555555"}

            ctx.strokeStyle=hexToCanvasColor(color,0.75);       
            ctx.beginPath();
            ctx.moveTo(pts[i],pts[i+1]);
            ctx.bezierCurveTo(cp[2*i-2],cp[2*i-1],cp[2*i],cp[2*i+1],pts[i+2],pts[i+3]);
            ctx.stroke();
            ctx.closePath();
			//ctx.fill();
        }

    ctx.restore();
    

}
//main spline function - change canvas size here
function main(t,js_coord_array){
    var e=document.getElementById("canvas1");
    e.width=300;
    e.height=300;
    e.parentNode.style.width=e.width+"px";  //  The div around the canvas element should fit snugly.
    var ctx=e.getContext('2d');
    ctx.fillStyle = '#f00';
    if(!ctx){return}
    ctx.clearRect(0,0,e.width,e.height);
	
    drawSpline(ctx, js_coord_array, t)
    
	
}
//End Bezier spline functions

//does not work yet - for woven search
function wovenWeightCalc(wovenWeightArray){
/*
var j=0;
var woven_weight_array=new Array();
var h=wovenWeightArray.length;
for(var i=0;i<h-1;i+=2){
	j=i+2;
	while(j<h){
		woven_weight_array.push(2-(Math.sqrt(Math.pow((coord_array[j] - coord_array[i]),2)+Math.pow((coord_array[j+1] -coord_array[i+1]),2))/149));
		j=j+2;
	}
}
var weight_array=new Array;
if(coord_array.length==4){
	weight_array=woven_weight_array;
}else if(coord_array.length==6){
	weight_array[0]=woven_weight_array[0] + woven_weight_array[1];
	weight_array[1]=woven_weight_array[2] + woven_weight_array[0];
	weight_array[2]=woven_weight_array[1] + woven_weight_array[2];
}else if(coord_array.length==8){
	weight_array[0]=woven_weight_array[0]+woven_weight_array[1]+woven_weight_array[2];
	weight_array[1]=woven_weight_array[3]+woven_weight_array[4],woven_weight_array[0];
	weight_array[2]=woven_weight_array[5]+woven_weight_array[1],woven_weight_array[3]
	weight_array[3]=woven_weight_array[2]+woven_weight_array[4]+woven_weight_array[5];
}
*/
}
function formValidator(){
	// Make quick references to our fields
	var password = document.getElementById('password');
	
	// Check each input in the order that it appears in the form!
	
				if(notEmpty(password, "Please enter highlighted information")){
					if(passValidator(password, "Please check to make sure your password  is valid")){
						return true;		
					}
				}
	return false;
}

function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		elem.style.background = 'Yellow';
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	elem.style.background = 'white';
	return true;
}
//simple js password check to get out of home page
function passValidator(elem, helperMsg){
	var passExp ="colton";
	if(elem.value.match(passExp)){
		elem.style.background = 'white';
		return true;
	}else{
		elem.style.background = 'Yellow';
		alert(helperMsg);
		elem.focus();
		return false;
	}
}
 function CalcFontSize(){//called when page refreshes to resize fonts
		for(var i=1;i<=search_count;i++){
			var element_name="term_"+i;
			var elem=document.getElementById(element_name);
			var xp=parseInt(elem.style.left);
			var yp=parseInt(elem.style.top);
			var weightValue=Math.abs(weightCalc(xp,yp,elem));
			var size=weightValue*5+7;
    		elem.style.fontSize=size+"px";
		}
 }
 function formValidator2(){
	// Make quick references to our fields
	var firstname = document.getElementById('firstname');
	//var zip = document.getElementById('zip');
	//var state = document.getElementById('state');
	//var username = document.getElementById('username');
	var mail = document.getElementById('mail');

	
	// Check each input in the order that it appears in the form!
	if(notEmpty(firstname, "Please enter highlighted information")){
		if(notEmpty(mail, "Please enter highlighted information")){
			if(emailValidator(mail, "Please check to make sure your e-mail address is valid")){
				
				
				return true;		
			}
		}
	}
	return false;
}

function notEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		elem.style.background = 'Yellow';
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return false;
	}
	elem.style.background = 'white';
	return true;
}

function emailValidator(elem, helperMsg){
	var emailExp = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(elem.value.match(emailExp)){
		elem.style.background = 'white';
		return true;
	}else{
		elem.style.background = 'Yellow';
		alert(helperMsg);
		elem.focus();
		return false;
	}
}