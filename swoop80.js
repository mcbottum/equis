// Global Swoop variables
var canvas, ctx, code, points = new Array(), inactive = new Array(), social = new Array(), entries = new Array(), animate = new Array(), 
ycur = [60,60+125,60+125*2,60+125*3,60+125*4], prevEntries = null, style, isAnimating = false, 
drag = null,inactive_drag = null, social_drag = null, dPoint, center, num, radius,remove_radius, rad, first = true, 
    RED = 128,
    GREEN = 128,
    BLUE = 128,
    CRED = 152,
    CGREEN = 152,
    CBLUE = 255,
    width = 0,
    height = 0,
    touchx = 0,
    touchy = 0;
var terms = ['single','married','age 19-24','female'];
//radius is the swoop circle radius, rad is the radius to draw the points, and remove_radius is the radius of the remove line

// Decide whether we are submitting the search form or just reordering results based on weight
var formsubmit = false;
// Don't redraw the Swoop circle constantly.
var swoop_circle_drawn = false;

var background = new Image();
background.src = 'http://static.swoopsrch.com/facebook_background_2.png';

var person_1 = new Image();
person_1.src = 'http://static.swoopsrch.com/person_1.png';

var person_2 = new Image();
person_2.src = 'http://static.swoopsrch.com/person_2.png';

var person_3 = new Image();
person_3.src = 'http://static.swoopsrch.com/person_3.png';

var person_4 = new Image();
person_4.src = 'http://static.swoopsrch.com/person_4.png';

var person_5 = new Image();
person_5.src = 'http://static.swoopsrch.com/person_5.png';

var person_6 = new Image();
person_6.src = 'http://static.swoopsrch.com/person_6.png';

var person_7 = new Image();
person_7.src = 'http://static.swoopsrch.com/person_7.png';

var person_8 = new Image();
person_8.src = 'http://static.swoopsrch.com/person_8.png';

var person_9 = new Image();
person_9.src = 'http://static.swoopsrch.com/person_9.png';

var person_10 = new Image();
person_10.src = 'http://static.swoopsrch.com/person_10.png';

var person_11 = new Image();
person_11.src = 'http://static.swoopsrch.com/person_11.png';

var person_12 = new Image();
person_12.src = 'http://static.swoopsrch.com/person_12.png';

var person_13 = new Image();
person_13.src = 'http://static.swoopsrch.com/person_13.png';

var person_14 = new Image();
person_14.src = 'http://static.swoopsrch.com/person_14.png';

var person_15 = new Image();
person_15.src = 'http://static.swoopsrch.com/person_15.png';

var person_16 = new Image();
person_16.src = 'http://static.swoopsrch.com/person_16.png';

var person_17 = new Image();
person_17.src = 'http://static.swoopsrch.com/person_17.png';

var person_18 = new Image();
person_18.src = 'http://static.swoopsrch.com/person_18.png';

var person_19 = new Image();
person_19.src = 'http://static.swoopsrch.com/person_19.png';

var person_20 = new Image();
person_20.src = 'http://static.swoopsrch.com/person_20.png';

var person_21 = new Image();
person_21.src = 'http://static.swoopsrch.com/person_21.png';

var person_22 = new Image();
person_22.src = 'http://static.swoopsrch.com/person_22.png';

var person_23 = new Image();
person_23.src = 'http://static.swoopsrch.com/person_23.png';

var person_24 = new Image();
person_24.src = 'http://static.swoopsrch.com/person_24.png';

var person_25 = new Image();
person_25.src = 'http://static.swoopsrch.com/person_25.png';

var person_26 = new Image();
person_26.src = 'http://static.swoopsrch.com/person_26.png';

var person_27 = new Image();
person_27.src = 'http://static.swoopsrch.com/person_27.png';

var person_28 = new Image();
person_28.src = 'http://static.swoopsrch.com/person_28.png';

var person_29 = new Image();
person_29.src = 'http://static.swoopsrch.com/person_29.png';

var person_30 = new Image();
person_30.src = 'http://static.swoopsrch.com/person_30.png';

var person_31 = new Image();
person_31.src = 'http://static.swoopsrch.com/person_31.png';

var person_32 = new Image();
person_32.src = 'http://static.swoopsrch.com/person_32.png';

var Spotify = new Image();
Spotify.src = 'http://www.bjw.me.uk/uploaded_images/Spotify-3-721626.png';

// define initial points
function SwoopPoint(x,y,r,g,b,prev,next,prevcp,nextcp,label,value,weight,category){
    this.x=x;
    this.y=y;
    this.r=r;
    this.g=g;
    this.b=b;
    this.prev=prev;
    this.next=next;
    this.prevcp=prevcp;
    this.nextcp=nextcp;
    this.label=label;
    this.value=value;
    this.weight=weight;
    this.category=category;
    this.isSuggested = false;
    this.isSocial = false;
}
function ControlPoint(x,y){
    this.x=x;
    this.y=y;
}
function SocialPoint(img,x,y,prev,next,prevcp,nextcp,value,weight,category){
	this.img=img;
	this.x=x;
	this.y=y;
	this.prev=prev;
    this.next=next;
    this.isSocial = true;
    this.weight = 0.1;
    this.prevcp=prevcp;
    this.nextcp=nextcp;
    this.value=value;
    this.weight=weight;
    this.category=category;
    this.isSuggested = false;
}

// Prepare to create the Swoop Circle
function init() {
    $("#dialog-message").hide();
    canvas = document.getElementById("canvas");
    ctx = canvas.getContext("2d");
//    canvas.width = $(window).width();
//    canvas.height = $(window).height();
    width = canvas.width;
    height = canvas.height;

    center = [1025, 205];

    radius = 90;
    remove_radius = radius + 30;
    //bring the points in 25%
    var pointrad = radius - radius / 4;

    // default styles
    style = {
        curve: {
            width: 1,
            color: "#969696"
        },
        cpline: {
            width: 1,
            color: "#969696"
        },
        point: {
            radius: 10,
            width: 2,
            arc1: 0,
            arc2: 2 * Math.PI
        }
    }

    // line style defaults
    ctx.lineCap = "round";
    ctx.lineJoin = "round";
    
    //event handlers
    canvas.addEventListener("mousedown", MouseStart, false);
    canvas.addEventListener("touchstart", TouchStart, false);   
    
    canvas.addEventListener("mousemove", Mousing, false);
    canvas.addEventListener("touchmove", Touching, true);

    document.body.addEventListener("mouseup", MouseEnd, false);
    document.body.addEventListener("touchend", TouchEnd, false);
    
    document.body.addEventListener("touchcancel", TouchEnd, false);
  
    getSocialPoints();
    addSuggested();
    setEntries();
  
/* this portion adds in the demo points */  
  //a single point needs to be [display, value, name]
  addPoints([["male","male","male"],["country","country","country"],["UW Madison","UW Madison","UW Madison"]]);
  getCpoints();
  
  swoopWeights();

  first = true;
  reorderEntries();
  first = false;
  
  reconnectPoints();  
  
  DrawCanvas();
    
  addSearchHistory();
}

function addEntry(key, name, gender, school, music, age, relationship_status, music_weight, image){
	//last index is the weight for each entry
	entries.push();
	
	entries.push({
	
		key: key,
		name: name,
		gender: gender,
		school: school,
		music: music,
		music_weight: music_weight,
		spotify: false,
		age: age,
		status: relationship_status,
		img: image,
		weight:	0,
		animate: false
		
	});
	
	
}

function setEntries(){

	addEntry(1, 'Rob Jauquet', 'male', 'UW Madison', 'jazz', 22, 'single', 3, person_1);
    addEntry(2, 'Quinn Bottum', 'male', 'Minnesota', 'country', 22, 'single', 6, person_2);
    addEntry(3, 'Josh Gachnang', 'male', 'UW Madison', 'country', 23, 'married', 4, person_3);
    addEntry(4, 'Jackie Bauer', 'female', 'Michigan', 'country', 22, 'married', 8, person_4);
    addEntry(5, 'Tyler Gregory', 'male', 'Iowa', 'rock', 22, 'married', '5', person_5);
    
    addEntry(6, 'Bill Nye', 'male', 'Minnesota', 'country', 20, 'single', 9, person_6);
    addEntry(7, 'Steph Kapp', 'female', 'Purdue', 'rock', 29, 'single', 7, person_7);
    addEntry(8, 'Red Forman', 'male', 'UW Madison', 'jazz', 26, 'single', 4, person_8);
    addEntry(9, 'James Tyler', 'male', 'Iowa', 'rock', 22, 'married', 2, person_9);
    addEntry(10, 'Pete Smith', 'male', 'UW Madison', 'country', 25, 'married', 7, person_10);
    
    addEntry(11, 'Ally Schmidt', 'female', 'Minnesota', 'jazz', 31, 'single', 6, person_11);
    addEntry(12, 'Jim Beam', 'male', 'Michigan', 'country', 55, 'single', 5, person_12);
    addEntry(13, 'Mary Snow', 'female', 'Indiana', 'country', 34, 'married', 10, person_13);
    addEntry(14, 'Mike Lucky', 'male', 'Iowa', 'rock', 41, 'married', 8, person_14);
    addEntry(15, 'Natalie Bateman', 'female', 'Penn State', 'country', 22, 'married', 5, person_15);
    
    addEntry(16, 'Jane Jo', 'female', 'UW Madison', 'rock', 19, 'single', 1, person_16);
    addEntry(17, 'Sally Marie', 'female', 'Penn State', 'country', 22, 'single', 3, person_17);
    addEntry(18, 'Randy Saphner', 'male', 'Minnesota', 'jazz', 23, 'single', 5, person_18);
    addEntry(19, 'Bear Grils', 'male', 'Indiana', 'rock', 20, 'married', 4, person_19);
    addEntry(20, 'Mandy Hamm', 'female', 'Purdue', 'country', 18, 'married', 8, person_20);
    
    addEntry(21, 'Liz Waters', 'female', 'UW Madison', 'rock', 31, 'single', 5,  person_21);
    addEntry(22, 'Kim Daton', 'female', 'Iowa', 'country', 32, 'single', 1, person_22);
    addEntry(23, 'Stan Lee Crup', 'male', 'UW Madison', 'rock', 33, 'married', 2, person_23);
    addEntry(24, 'Travis Jachnung', 'male', 'Iowa', 'rock', 22, 'married', 5, person_24);
    addEntry(25, 'Mel Woods', 'female', 'UW Madison', 'country', 32, 'married', 9, person_25);
    
    addEntry(26, 'Jake Phineas', 'male', 'Indiana', 'rock', 22, 'single', 10, person_26);
    addEntry(27, 'Tae Kwuan', 'male', 'UW Madison', 'country', 24, 'single', 8, person_27);
    addEntry(28, 'Sarah Whitters', 'female', 'Minnesota', 'jazz', 23, 'single', 7, person_28);
    addEntry(29, 'Bob Cappchop', 'male', 'Iowa', 'rock', 22, 'single', 6, person_29);
    addEntry(30, 'Austin Topp', 'male', 'UW Madison', 'country', 22, 'married', 4, person_30);
    
    addEntry(31, 'Paul Ryan', 'male', 'Purdue', 'rock', 22, 'single', 10, person_31);
    addEntry(32, 'Kate Hyerman', 'female', 'UW Madison', 'jazz', 29, 'single', 8, person_32);
    
	setSpotify();
	    
}

function setSpotify(){
	// 1 - rob
	entries[0].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[1].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[2].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[3].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[4].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[5].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[6].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[7].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[8].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[9].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[10].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[11].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[12].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[13].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[14].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[15].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[16].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[17].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[18].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[19].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[20].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[21].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[22].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[23].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[24].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[25].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[26].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}
	// 3 - josh
	entries[27].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 54,
		rank:0
	}
	// 4 - tyler
	entries[28].spotify = {
		music: 'country',
		playlists: 34,
		countryInLists: 12,
		rank:0
	}
	// 5 - jackie		
	entries[29].spotify = {
		music: 'country',
		playlists: 11,
		countryInLists: 100,
		rank:0
	}
	
		// 1 - rob
	entries[30].spotify = {
		music: 'country',
		playlists: 8,
		countryInLists: 2,
		rank:0
	}
	// 2 - quinn
	entries[31].spotify = {
		music: 'country',
		playlists: 20,
		countryInLists: 33,
		rank:0
	}

	rankSpotify();		
}

function rankSpotify(){
	var totalLists = 0;
	var totalInLists = 0;
	var keyToRank = [];
	for(var i=0; i<entries.length; i++){
		if(entries[i].spotify != false){
			totalLists += entries[i].spotify.playlists;
			totalInLists += entries[i].spotify.countryInLists;
		}
	}
	for(var i=0; i<entries.length; i++){
		if(entries[i].spotify != false){
			keyToRank.push([entries[i].key,(.3*entries[i].spotify.playlists/totalLists + .7*entries[i].spotify.countryInLists/totalInLists)])
		}
	}
	keyToRank.sort(function(a,b) {return (a[1] > b[1]) ? -1 : ((b[1] > a[1]) ? 1 : 0);} );
	
	for(var i=0; i<keyToRank.length; i++){
		for(var j=0; j<entries.length; j++){
			if(entries[j].spotify != false){
				if(keyToRank[i][0] == entries[j].key){
					entries[j].spotify.rank = i;
				}	
			}
		}
	}
	console.log(keyToRank)
}

function getSocialPoints(){
	//foursquare
		
	social.push(new SocialPoint(Spotify,null,null));
	social[social.length-1].value = 'spotify';
//	social.push(new SocialPoint(null,null,null));
//	social.push(new SocialPoint(null,null,null));
//	social.push(new SocialPoint(null,null,null));
	
	orderSocial();
}

//creates a linked list of SwoopPoint(x,y,r,g,b,prev,next,prevcp,nextcp,label,point,value)
function addPoints(pts) {
    rad = radius-10;
    //add first point [p.display ,point, value]
    var x = center[0] + Math.cos(2 * 0 * Math.PI / pts.length) * rad;
    var y = center[1] + Math.sin(2 * 0 * Math.PI / pts.length) * rad;
    points.push(new SwoopPoint(x, y,RED,GREEN,BLUE,null,null,null,null,pts[0][0],pts[0][1],1-disToCenter(x,y)/rad,pts[0][2]));
    
    //add points and connect if they exist
    if(pts.length > 1){              
        for (var i = 1; i < pts.length-1; i++) {
            x = center[0] + Math.cos(2 * i * Math.PI / pts.length) * rad;
            y = center[1] + Math.sin(2 * i * Math.PI / pts.length) * rad;
            points.push(new SwoopPoint(x, y,RED,GREEN,BLUE,points[i-1],null,null,null,pts[i][0],pts[i][1],1-disToCenter(x,y)/rad,pts[i][2]));
            points[i-1].next=points[i];
        }
        var x = center[0] + Math.cos(2 * (pts.length-1) * Math.PI / pts.length) * rad;
        var y = center[1] + Math.sin(2 * (pts.length-1) * Math.PI / pts.length) * rad;
        
        points.push(new SwoopPoint(x, y,RED,GREEN,BLUE,points[pts.length-2],points[0],null,null,pts[pts.length-1][0],pts[pts.length-1][1],1-disToCenter(x,y)/rad,pts[pts.length-1][2]));
        points[0].prev = points[pts.length-2].next = points[pts.length-1]; 
    }                
    return;
}
//add single point to points
function addPoint(point){
	if(point != undefined){
		if(points.length <= 1){
			points.push(point);
			points[points.length-1].r = 128;
            points[points.length-1].g = 128;
            points[points.length-1].b = 128;
		}
		else{
			var index = getAddIndex(point.x,point.y);
			points.splice(index,0,point);
			if(index == 0){
				//newly added point set prev and next
				points[index].prev = points[points.length-1];
				points[index].next = points[index+1];
				
				//fix prev and next of the new points prev and next
				points[points.length-1].next = points[index];
				points[index+1].prev = points[index];	
			}
			else if(index == points.length-1){
				//newly added point set prev and next
				points[index].prev = points[index-1];
				points[index].next = points[0];
				
				//fix prev and next of the new points prev and next
				points[index-1].next = points[index];
				points[0].prev = points[index];		
			}
			else{
				//newly added point set prev and next
				points[index].prev = points[index-1];
				points[index].next = points[index+1];
				
				//fix prev and next of the new points prev and next
				points[index-1].next = points[index];
				points[index+1].prev = points[index];
			}
	
			if(points[index].isSocial == true){
				points[index].weight = 0.1;
				points[index].FoursquareValue = "[new]";
			}
			if(points[index].isSuggested == true){
				points[index].weight = 0.1;
				points[index].value = "[new]";
			}
			points[index].r = 128;
            points[index].g = 128;
            points[index].b = 128;
			reorganizeSwoopPoints();
			getCpoints();
		}
	}
	orderInactive();
	//DrawCanvas();
}

function getAddIndex(x,y){
	var curToNext;
	var curToNew;
	var newToNext;
	
	var index = 0;
	
	for(var i=0;i<points.length;i++){
        
		curToNext = getAngle(points[i].x,points[i].y,points[i].next.x,points[i].next.y);
		curToNew = getAngle(points[i].x,points[i].y,x,y);
		newToNext = getAngle(x,y,points[i].next.x,points[i].next.y);
		if(curToNext > curToNew && curToNext > newToNext){
			index = i+1;
		}
	}
	return index;
}

function getAngle(x1,y1,x2,y2){
	
	var a,b,c,A,B,C;
	
	//angle A will be the angle at the center, so side a is the cord of the circle, not one of the rays
	a = Math.sqrt((x2-x1)*(x2-x1)+(y2-y1)*(y2-y1));
	//b will be the start point to the center
	b = Math.sqrt((center[0]-x1)*(center[0]-x1)+(center[1]-y1)*(center[1]-y1));
	//c will be the end point to the center
	c = Math.sqrt((center[0]-x2)*(center[0]-x2)+(center[1]-y2)*(center[1]-y2));
	
	A = Math.acos((b*b + c*c - a*a)/(2*b*c));
	B = Math.asin(b*Math.sin(A)/a);
	C = Math.asin(c*Math.sin(A)/a);
	
	A *= 180/Math.PI;
	B *= 180/Math.PI;
	C *= 180/Math.PI;
	
	return A;
	
}

function getPointOnCircle(x,y){
	var A = x + radius*(x-center[0])/Math.sqrt((x-center[0])*(x-center[0]) + (y-center[1])*(y-center[1]));
	var B = ((y - center[1])/(x - center[0]))*(A-x) + y;
	
	return {x:A,y:B};
}

function getCpoints() {
    var cpxy;
    var previous;
    var next;
    if(points.length > 1){
        for(var i=0; i<points.length;i++){
            cpxy = getControlPoint(points[i].prev, points[i], 1);
            previous = new ControlPoint(cpxy[0],cpxy[1]);
            points[i].prevcp=previous;
            
            cpxy = getControlPoint(points[i], points[i].next, 0);
            next = new ControlPoint(cpxy[0],cpxy[1]);
            points[i].nextcp = next;
        }
    }
}

//returns the x and y locations of both control points for a bezier curve

function getControlPoint(start, end, first) {
    var cpts = new Array();
    var len = Math.sqrt((start.x - end.x) * (start.x - end.x) + (start.y - end.y) * (start.y - end.y));

    var segx = getXseg(start.x, end.x);
    var segy = getYseg(start.y, end.y);

    //the base offset for the control points
    var offset = (len / 5);

    //the angle adjusted x,y offsets
    var xoff = getXOff(offset, segx, segy);
    var yoff = getYOff(offset, segx, segy);
    //checks for horez line in the two point case (not working well)
    if (xoff == -1 || yoff == -1) {
        xoff = segx;
        if ((end.x - start.x) > 0) {
            yoff = segy + offset;
        }
        else {
            yoff = segy - offset;
        }

    }
    //return shifted control point
    if (first == 1) {
        cpts.push(end.x + 2/3*(xoff - end.x))
        cpts.push(end.y + 2/3*(yoff - end.y));
    }
    else {
        cpts.push(start.x + 2/3*(xoff - start.x))
        cpts.push(start.y + 2/3*(yoff - start.y));
    }
    return cpts;
}

function getXOff(offset, x, y) {
    var mag = Math.sqrt((x - center[0]) * (x - center[0]) + (y - center[1]) * (y - center[1]));
    if (mag == 0) {
        return -1;
    }
    else {
        return x + offset * (x - center[0]) / mag;
    }

}

function getYOff(offset, x, y) {
    var mag = Math.sqrt((x - center[0]) * (x - center[0]) + (y - center[1]) * (y - center[1]));
    if (mag == 0) {
        return -1;
    }
    else {
        return y + offset * (y - center[1]) / mag;
    }
}

function getXseg(x1, x2) {
    return (x2 + x1) / 2;
}

function getYseg(y1, y2) {
    return (y2 + y1) / 2;
}

// draw canvas

function printEntry(entry,x,y){
	if(!isAnimating){
		ctx.drawImage(entry.img, x, y, 430, 110);
	}
	
	ctx.fillText("Key:" + entry.key, x+435, y+0);
	ctx.fillText("Name:" + entry.name, x+435, y+15);
	ctx.fillText("Gender:" + entry.gender, x+435, y+30);
    ctx.fillText("School:" + entry.school, x+435, y+45);
    ctx.fillText("Music:" + entry.music, x+435, y+60);
    ctx.fillText("Status:" + entry.status, x+435, y+75);
    ctx.fillText("Weight:" + entry.weight, x+435, y+90);
    
	ctx.stroke();
}

function DrawCanvas() {
    canvas.width = background.width;
    canvas.height = background.height;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.beginPath();
    
    //draw static background
    ctx.drawImage(background, 0, 0, canvas.width, canvas.height);

    //clear table area
//    ctx.clearRect(465,200,330,500);
    
    //get table entry objects, in this example, there are five of them

    if(entries.length >= 5){
        for(var i=0; i<5; i++){        
        	printEntry(entries[i],230,60+125*i);
    	}
    }
    else{
        for(var i=0; i<entries.length; i++){        
        	printEntry(entries[i],230,60+125*i);
    	}
    }
    
    // curve
    ctx.lineWidth = style.curve.width;
    ctx.strokeStyle = style.curve.color;
    
    //draw Swoop Space
    circle(center[0], center[1], radius, radius / 10, RED, GREEN, BLUE);
    
    //draw delete area
    ctx.moveTo(center[0]+remove_radius,center[1]);       
    ctx.arc(center[0], center[1], remove_radius, 0, 2*Math.PI, true);
    ctx.stroke();
    if (points.length > 1) {
        //connect all points except beginning and end
        for (var i = 0; i < points.length - 1; i++) {
            ctx.moveTo(points[i].x, points[i].y);
            ctx.bezierCurveTo(points[i].nextcp.x, points[i].nextcp.y, points[i+1].prevcp.x, points[i+1].prevcp.y, points[i + 1].x, points[i + 1].y);

        }
        //connect beginning and end
        ctx.moveTo(points[points.length - 1].x, points[points.length - 1].y);
        ctx.bezierCurveTo(points[points.length - 1].nextcp.x, points[points.length - 1].nextcp.y, points[0].prevcp.x, points[0].prevcp.y, points[0].x, points[0].y);

        ctx.stroke();
    }

    //draw points
	for (var i = 0; i < points.length; i++) {
		//draw if it isn't a social point
		if(!points[i].isSocial){
			ctx.lineWidth = style.point.width;
			ctx.strokeStyle = "rgba(" + points[i].r + "," + points[i].g + "," + points[i].b + ",1)";
			ctx.fillStyle = "rgba(" + points[i].r + "," + points[i].g + "," + points[i].b + ",1)";
			ctx.beginPath();
			ctx.arc(points[i].x, points[i].y, style.point.radius, style.point.arc1, style.point.arc2, true);
			ctx.fill();
			//add label
			ctx.font = '12px sans-serif';
			ctx.textBaseline = 'top';
			ctx.fillText(points[i].label, points[i].x-15, points[i].y+15);
			ctx.stroke();
		}
		else {
			ctx.drawImage(Spotify, points[i].x-(36*.8/2), points[i].y-(36*.8/2), 36*.8, 36*.8);
			ctx.font = '12px sans-serif';
			ctx.textBaseline = 'top';
			ctx.fillStyle = '#1EFF00';
			ctx.fillText("spotify", points[i].x-15, points[i].y+15);
			ctx.stroke();
		}   
		
	}

    //draw inactive
    drawInactive();
    drawSocial();
    
    ctx.closePath();
}

function drawInactive(){
	// set the x and y for all inactive points
	for(var i=0; i < inactive.length; i++){
		//draw the point
		ctx.lineWidth = style.point.width;

		//radial gradiant inactive points
		
		// add linear gradient
		var grd = ctx.createRadialGradient(inactive[i].x, inactive[i].y, 0, inactive[i].x, inactive[i].y, style.point.radius + 10);
		// light ruby
		grd.addColorStop(0, '#4A64C7');   
		// dark ruby
		grd.addColorStop(1, '#374A92');
		ctx.fillStyle = grd;
          
        ctx.beginPath();
        ctx.arc(inactive[i].x, inactive[i].y, style.point.radius, style.point.arc1, style.point.arc2, true);
        ctx.fill();
        //add label
        ctx.font = '12px sans-serif';
        ctx.textBaseline = 'top';
        ctx.fillText(inactive[i].label, inactive[i].x-15, inactive[i].y+15);
        ctx.stroke();
	}
	
}

function drawSocial(){
    for(var i=0; i < social.length; i++){
			ctx.drawImage(social[0].img, social[0].x-(36*.8/2), social[0].y-(36*.8/2), 36*.8, 36*.8);
			ctx.font = '12px sans-serif';
			ctx.textBaseline = 'top';
			ctx.fillStyle = '#1EFF00';
			ctx.fillText("Spotify", social[0].x-15, social[0].y+15);
			ctx.stroke();
	}
}

function orderInactive(){
	for(var i=0; i < inactive.length; i++){
		inactive[i].x = center[0] + Math.cos((Math.PI*i/2)/inactive.length + 3*Math.PI/4) * remove_radius;
		inactive[i].y = center[1] + Math.sin((Math.PI*i/2)/inactive.length + 3*Math.PI/4) * remove_radius;
        inactive[i].r =0;
        inactive[i].g =0;
        inactive[i].b =255;
	}
}

function orderSocial(){
	for(var i=0; i < social.length; i++){
		social[i].x = center[0] + Math.cos((Math.PI*i/2)/social.length /*+ 3*Math.PI/4*/) * remove_radius;
		social[i].y = center[1] + Math.sin((Math.PI*i/2)/social.length /*+ 3*Math.PI/4*/) * remove_radius;
	}
}

function reconnectPoints(){
	//clear all connections and get angles
	for(var i=0;i<points.length;i++){
		points[i].prev = null;
		points[i].next = null;
		points[i].angle = Math.atan2(center[1] - points[i].y,center[0] - points[i].x);
	}
	//sort on angle
	points.sort(function(a, b){
		return a.angle-b.angle;
	});
	//reconnect all points
	points[0].prev = points[points.length-1];
	points[0].next = points[1];
	for(var i=1;i<points.length-1;i++){
		points[i].next = points[i+1];
		points[i].prev = points[i-1];
	}
	points[points.length-1].prev = points[points.length-2];
	points[points.length-1].next = points[0];
	
	getCpoints();
}

function MouseStart(e){
	e = MousePos(e);
	DragStart(e);
}

// start dragging
function TouchStart(e){
    e = TouchPos(e);
    DragStart(e);
}

function DragStart(e) {
    var dx, dy;
    for (var i = 0; i < points.length; i++) {
        dx = points[i].x - e.x;
        dy = points[i].y - e.y;
        if ((dx * dx) + (dy * dy) < style.point.radius * style.point.radius) {
            drag = i;
            inactive_drag = null;
            social_drag = null;
            dPoint = e;
            canvas.style.cursor = "move";
            return;
        }
    }
    for (var i=0; i<inactive.length;i++){
		dx = inactive[i].x - e.x;
        dy = inactive[i].y - e.y;
        if ((dx * dx) + (dy * dy) < style.point.radius * style.point.radius) {
            inactive_drag = i;
            drag = null;
            social_drag = null;
            dPoint = e;
            canvas.style.cursor = "move";
            return;
        }
    }
    for (var i=0; i<social.length;i++){
		dx = social[i].x - e.x;
        dy = social[i].y - e.y;
        if ((dx * dx) + (dy * dy) < 36*.8 * 36*.8) {
            social_drag = i;
            inactive_drag = null;
            drag = null;
            dPoint = e;
            canvas.style.cursor = "move";
            return;
        }
    }
}


// dragging
function Touching(e){
    e = TouchPos(e);
    Dragging(e);
}

function Mousing(e){
    e = MousePos(e);
    Dragging(e);
}

function Dragging(e) {
    if (drag != null) {
        if (inCircle(e.x, e.y,remove_radius) && !inCircle(e.x,e.y,radius)) {
            //moving away from center
            var dis = disToCenter(e.x,e.y) - disToCenter(dPoint.x,dPoint.y);
            if(dis > 0){
                if (disToCenter(e.x,e.y) < remove_radius) {
                	//might need to add the actual equation for the color change
                    points[drag].r += Math.round((123/100)*dis);
                    points[drag].g -= Math.round((128/100)*dis);
                    points[drag].b -= Math.round((128/100)*dis);
                }
            }
            else{
                points[drag].r += Math.round((123/100)*dis);
                points[drag].g -= Math.round((128/100)*dis);
                points[drag].b -= Math.round((128/100)*dis);
            }        
        }
        else if(!inCircle(e.x, e.y,remove_radius) && points.length > 1){
			num--;
			removePoint(drag);
			DragEnd(e);
			return;
        }
        else if(!inCircle(e.x, e.y,remove_radius) && points.length == 1){
			num--;
			removePoint(drag);
			drag = null;
			social_drag = null;
			inactive_drag = null;
			DrawCanvas();
			return;
        }
        else {
            points[drag].r = 128;
            points[drag].g = 128;
            points[drag].b = 128;
        }    
        points[drag].x += e.x - dPoint.x;
        points[drag].y += e.y - dPoint.y;
        
        if(points.length > 1){
            getCpoints();

            points[drag].prevcp.x += e.x - dPoint.x;
            points[drag].prevcp.y += e.y - dPoint.y;
            points[drag].nextcp.x += e.x - dPoint.x;
            points[drag].nextcp.y += e.y - dPoint.y;

            if (drag == 0) {
                points[drag + 1].prevcp.x += (e.x - dPoint.x);
                points[drag + 1].prevcp.y += (e.y - dPoint.y);
                points[points.length - 1].nextcp.x += (e.x - dPoint.x);
                points[points.length - 1].nextcp.y += (e.y - dPoint.y);
            }
            else if (drag == points.length - 1) {
                points[0].prevcp.x += (e.x - dPoint.x);
                points[0].prevcp.y += (e.y - dPoint.y);
                points[drag - 1].nextcp.x += (e.x - dPoint.x);
                points[drag - 1].nextcp.y += (e.y - dPoint.y);
            }
            else {
                points[drag + 1].prevcp.x += (e.x - dPoint.x);
                points[drag + 1].prevcp.y += (e.y - dPoint.y);
                points[drag - 1].nextcp.x += (e.x - dPoint.x);
                points[drag - 1].nextcp.y += (e.y - dPoint.y);
            }
        }

        dPoint = e;
        DrawCanvas();
    }
    else if (drag != null && points.length == 1) {

        if (inCircle(e.x, e.y, radius)) {
        	points[drag].x += e.x - dPoint.x;
        	points[drag].y += e.y - dPoint.y;
            CRED = 175;
            CGREEN = 237;
            CBLUE = 250;
        }
        dPoint = e;
        DrawCanvas();
    }
    else if (inactive_drag != null){
    	inactive[inactive_drag].x += e.x - dPoint.x;
        inactive[inactive_drag].y += e.y - dPoint.y;
		dPoint = e;
        DrawCanvas();
    }
    else if(social_drag != null){
		social[social_drag].x += e.x - dPoint.x;
		social[social_drag].y += e.y - dPoint.y;
		dPoint = e;
        DrawCanvas();
    }
}

//right now it assumes foursquare was the point just added
function SetFoursquareSubmit(){
	for(var i=0; i<points.length; i++){
		if(points[i].FoursquareValue == "[new]"){
		//	points[i].FoursquareValue = $("#FoursquareSubmit").val();
		//	points[i].label = $("#FoursquareSubmit").val();
		//	addToSearchForm($("#FoursquareSubmit").val());
		//	DrawCanvas();
		}
	}
}

//right now it assumes foursquare was the point just added
function SetSuggestedSubmit(){
	var addText;
	for(var i=0; i<points.length; i++){
		if(points[i].value == null){
		//	addText = getLabelText($("#SuggestedSubmit").val(), points[i].category);
		//	addToSearchForm(addText);
		//	points[i].value = $("#SuggestedSubmit").val();
		//	points[i].label = addText;
		//	DrawCanvas();
		}
	}
}

function getLabelText(userText,category){
	if(category == "type"){
		return userText;
	}
	else if(category == "parking"){
		return category;
	}
	else if(category == "bedrooms"){
		return userText + " " + category;
	}
	else if(category == "baths"){
		return userText + " " + category;
	}
	else if(category == "rent"){
		return userText;
	}
	else if(category == "street"){
		return userText;
	}
	else if(category == "area"){
		return userText;
	}
}

// end dragging
function TouchEnd(e){
    if(drag != null || social_drag != null || inactive_drag != null){	
    	//get correct touch position    	
        e = TouchPos(e);
        DragEnd(e);
    }
}
function MouseEnd(e){
	if(drag != null || social_drag != null || inactive_drag != null){	
    	//get correct mouse position
		e = MousePos(e);
		DragEnd(e);
    }

}
function DragEnd(e) {

	if(social_drag != null && inCircle(e.x, e.y,radius)){
		addPoint(social.splice(social_drag,1)[0]);
		social_drag = null;
	}
	if(inactive_drag != null && inCircle(e.x, e.y,radius)){
		if(inactive[inactive_drag].isSuggested == true){
			inactive[inactive_drag].isSuggested = false;
		}
		addPoint(inactive.splice(inactive_drag,1)[0]);
		inactive_drag = null;
	}
	swoopWeights();
    
    reorderEntries();
    
	social_drag = null;
	drag = null;
	inactive_drag = null;
	canvas.style.cursor = "default";
	reconnectPoints();
	DrawCanvas();
    addSearchHistory();
}

function reorderEntries(){	
	//for every entry, add weight of every point
	for(var i=0; i<entries.length; i++){
		entries[i].weight = 0;
		for(var j=0; j<points.length; j++){            
			if(EntryContainsPoint(entries[i],points[j])){
				entries[i].weight += points[j].weight;
			}
			else if(points[j].value == 'spotify' && entries[i].spotify != false){
				entries[i].weight += spotifyWeight(entries[i]);
			}
		}
	}
	
	//get top five from previous
	prevEntries = entries.slice(0,5);
	
	entries = mergeSort(entries);

	if(prevEntries != null && first == false){
        AnimateEntries();
    }
}       

function spotifyWeight(entry){
	return (1 - entry.spotify.rank/entries.length);
}

function AnimateEntries(){
    //x is always at 230. these are the y locations
    var yloc = [60,60+125,60+125*2,60+125*3,60+125*4];
    var curEntries = entries.slice(0,5);
    ycur = yloc.slice(0);
    animate = [];
    var added = false;
    
    for(var i=0; i<curEntries.length; i++){
    	for(var j=0; j<prevEntries.length; j++){
			if(prevEntries[j].key == curEntries[i].key){
				animate.push({
					on: true,
					img: curEntries[i].img,
					dis: (yloc[i] - yloc[j])/100,
					loc: yloc[j]
				});
				added = true;
			}
		}
		if(!added){
			animate.push({
				on: false,
				img: curEntries[i].img,
				dis: 0,
				loc: yloc[i]
			});
		}
		else{
			added = false;
		}
    }

    var delay = 1;
    for(var i=0;i<100;i++) {
        setTimeout(
            (function(num) {
                return function() {
                	isAnimating = true;
                	DrawCanvas();
                    DrawAnimation(num);
                    isAnimating = false;  
                }
            })(i), delay);
        delay += 1;
    }
    
    DrawCanvas();
}

function DrawAnimation(num){
	console.log(animate.length)
	//draw images in transition
	for(var j=0; j<animate.length; j++){
		animate[j].loc += animate[j].dis;
		ctx.drawImage(animate[j].img, 230, animate[j].loc, 430, 110);
	}
	//draw any that are not being animated
		
}

function merge(left, right){
    var result  = [],
        il      = 0,
        ir      = 0;

    while (il < left.length && ir < right.length){
        if (right[ir].weight > left[il].weight){
            result.push(right[ir++]);
        } else {
            result.push(left[il++]);
        }
    }

    return result.concat(left.slice(il)).concat(right.slice(ir));
}

function mergeSort(items){

    // Terminal case: 0 or 1 item arrays don't need sorting
    if (items.length < 2) {
        return items;
    }

    var middle = Math.floor(items.length / 2),
        left    = items.slice(0, middle),
        right   = items.slice(middle);

    return merge(mergeSort(left), mergeSort(right));
}

function EntryContainsPoint(entry,point){
    if(entry != null){
    
		if(entry.name == point.value){
			return true;
		}
		else if(entry.gender == point.value){
			return true;
		}
		else if(entry.school == point.value){
			return true;
		}
		else if(entry.music == point.value){
			return true;
		}
		else if(point.value == 'spotify' && entry.spotify != false){	
			return false;
		}
        else if(point.value.substring(0, 3) == "age"){
        	var lower = parseInt(point.value.substring(4, point.value.indexOf('-')));
        	var upper = parseInt(point.value.substring(point.value.indexOf('-')+1, point.value.length));
        	
        	if(entry.age >= lower || entry.age <= upper){
        		return true;
        	}
        	else{
        		return false;
        	}
        }
		else if(entry.status == point.value){
			return true;
		}
		
        else{
            return false;
        }
    }
}

function shuffle (myArray) {
  var i = myArray.length, j, tempi, tempj;
  if ( i == 0 ) return false;
  while ( --i ) {
     j = Math.floor( Math.random() * ( i + 1 ) );
     tempi = myArray[i];
     tempj = myArray[j];
     myArray[i] = tempj;
     myArray[j] = tempi;
   }
}


// event parser
function TouchPos(event){
    event = (event ? event : window.event);
    var pos = findPos(canvas);

	if(event.targetTouches.length != 0){
	    touchx = event.targetTouches[0].pageX - pos[0];
    	touchy = event.targetTouches[0].pageY - pos[1];
	}
    if(event.targetTouches[1] == null){
        event.preventDefault();
    }
    return {
         x: touchx,
         y: touchy
    }
}

function MousePos(event) {
    event = (event ? event : window.event); 
    var pos = findPos(canvas);
    var x = event.pageX - pos[0];
    var y = event.pageY - pos[1];
    return {
        x: x,
        y: y
    }
}

function inCircle(x, y, inRad) {
    if ((x - center[0]) * (x - center[0]) + (y - center[1]) * (y - center[1]) <= inRad * inRad) {
        return true;
    }
    else {
        return false;
    }
}

function disToCenter(x,y){
    var rsq = ((x - center[0]) * (x - center[0]) + (y - center[1]) * (y - center[1]));
    return Math.sqrt(rsq);
}

function disToPoint(p1,p2){
    var rsq = ((p1.x - p2.x) * (p1.x - p2.x) + (p1.y - p2.y) * (p1.y - p2.y));
    return Math.sqrt(rsq);
}

// Build a circle, given coordinates for the center and an outer radius and inner radius


function circle(x, y, r, i) {
	
	// add linear gradient
    var grd = ctx.createRadialGradient(x, y, 0, x, y, r+30);
    // light ruby
    grd.addColorStop(0, '#4A64C7');   
    // dark ruby
    grd.addColorStop(1, '#374A92');
    ctx.fillStyle = grd;


    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI * 2, true);
    ctx.closePath();
    ctx.fill();

    // Draw inner circle
    ctx.fillStyle = "#FFFFFF";
    ctx.beginPath();
    ctx.arc(x, y, i, 0, Math.PI * 2, true);
    ctx.closePath();
    ctx.fill();
}

function removePoint(i){
    if(points.length == 1){
    	points[i].prev = points[i].next = points[i].prevcp = points[i].nextcp = null;
    	if(points[i].isSocial == true){
    		social.push(points.slpice(i,1)[0]);
    	}
    	else{
    		inactive.push(points.splice(i,1)[0]);
    	}
    	points.length = 0;
    	orderInactive();
    	orderSocial();
    	reorganizeSwoopPoints();
    }
    else{
         if(i == 0){
            points[points.length-1].nextcp = points[i].nextcp;
            points[i+1].prevcp = points[i].prevcp;
            points[points.length-1].next=points[i].next;
            points[i+1].prev = points[i].prev;
        }
        else if(i == points.length-1){
            points[i-1].nextcp = points[i].nextcp;
            points[0].prevcp = points[i].prevcp;
            points[i-1].next=points[i].next;
            points[0].prev = points[i].prev;
        }
        else{
            points[i-1].nextcp = points[i].nextcp;
            points[i+1].prevcp = points[i].prevcp;
            points[i-1].next=points[i].next;
            points[i+1].prev = points[i].prev;
        }
        points[i].prev = points[i].next = points[i].prevcp = points[i].nextcp = null;
    	if(points[i].isSocial == true){
    		var pt = points.splice(i,1)[0];
    		social.push(pt);
    	}
    	else{
    		inactive.push(points.splice(i,1)[0]);
    	}
        getCpoints();
        orderInactive();
    	orderSocial();
    	reorganizeSwoopPoints();
    }  
}


function drawTextAlongArc(context, str, centerX, centerY, radius, angle){
    // context: canvas context
    // str: string to write around circle
    // centerX, centerY: coordinates of circle center
    // radius: distance from center to bottom of text
    // angle: Angle to start the first letter on, in radians.
    // Given an arc, draw text that curves aroundit.
    // Number of degrees to reverse by

    kern = 1
    // Text settings
    context.save();
    context.stroke();
    context.font = "12pt Calibri";
    context.textAlign = "center";
    context.fillStyle = "#666";
    context.strokeStyle = "#666";
    context.lineWidth = 4;
    
    
    //Draw the text
    // Reset angle
    context.setTransform(1, 0, 0, 1, 0, 0);
    context.translate(centerX, centerY);
    // Rotate to starting angle
    context.rotate(angle);
    context.rotate(str.length * (kern / str.length) / 2);
    for (var n = 0; n < str.length; n++) {
        context.rotate(kern / str.length);
        context.save();
        context.translate(0, -1 * radius);
        var char = str[n];
        context.fillText(char, 0, 0);
        context.restore();
    }
    
    context.restore();
    
}

// Before submit, calculate the weights of all the points.
function swoopWeights() {
    var TotalDis = 0;
    var PointDis = 0;
    
    for(var i=0; i<points.length; i++){
        for(var j=i+1; j<points.length; j++){
            TotalDis += disToPoint(points[i],points[j]);
        }    
    }
    
    // Take the distance from the center and divide by radius to get a weight between 0 and 1
    var w1 = 0,w2 = 0;
    for(var i=0; i<points.length; i++){
        w1 = 1 - disToCenter(points[i].x,points[i].y)/rad;
        PointDis = 0;
        for(var j=0; j<points.length; j++){
            PointDis += disToPoint(points[i],points[j]);
        }
        w2 = 1 - PointDis/TotalDis;
        w2 = w2*w2;
        points[i].weight = w1*.7 + w2*.3;
    }
}

// Convert #AA77CC to rbga() format for Firefox
function hexToCanvasColor(hexColor,opacity){
    opacity=opacity || "1.0";
    hexColor=hexColor.replace("#","");
    var r=parseInt(hexColor.substring(0,2),16);
    var g=parseInt(hexColor.substring(2,4),16);
    var b=parseInt(hexColor.substring(4,6),16);
    return "rgba("+r+","+g+","+b+","+opacity+")";
}

function findPos(e){
    var offs = new Array()
    var curleft = 0, curtop = 0;
    if (e.offsetParent) {
        do {
            curleft += e.offsetLeft;
            curtop += e.offsetTop;
        } while (e = e.offsetParent);
        offs.push(curleft);
        offs.push(curtop);
        return offs;
    }
    return undefined;
}

function cancelEvent(e) {
    e = e || window.event;
    if (e.stopPropagation) e.stopPropagation();
    e.cancelBubble = true;
    return false;
}
function contactSuccess() {
   // $("#id_name").val('')
   // $("#id_email").val('')
   // $("#id_message").val('')
    return false;
}

// need to rewrite this one
function reorganizeSwoopPoints(){
	/*for (var i=0; i<points.length; i++){
	    dist = (points[i].weight-1)*rad;
	    var x = center[0] + Math.cos(2 * i * Math.PI / points.length) * dist;
    	var y = center[1] + Math.sin(2 * i * Math.PI / points.length) * dist;
    	
    	points[i].x=x;
    	points[i].y=y;	
	}
	getCpoints();*/
}

function addSuggested(){
	inactive = new Array();
	var sugTerms = terms.slice();
	for(var i=0; i<points.length; i++){
		if(sugTerms.indexOf(points[i].category) != -1){
			var index = sugTerms.indexOf(points[i].category);
			sugTerms.splice(index,1);
		}
	}
	for(var i=0; i<sugTerms.length; i++){
		inactive.push(new SwoopPoint(0,0,0,0,255,null,null,null,null,sugTerms[i],sugTerms[i],0,sugTerms[i]));
		inactive[inactive.length-1].isSuggested = true;
	}
	orderInactive();
}

/* Start Anyaltics */

function AnalyticsPoint(x, y, label, category, value, weight) {
    this.weight = weight;
    this.x = x;
    this.y = y;
    this.label = label;
    this.category = category;
    this.value = value;
}

// Keep track of all searches and their weights
search_history = [];

// Call each time weights are updated
function addSearchHistory() {
    search = []
    for (point in points) {
        p = points[point];
//        console.log("Point: ", p);
        analytics = new AnalyticsPoint(p.x, p.y, p.label, p.category, p.value, p.weight);
//        console.log("analytics: ", analytics);
        search.push(analytics);
    }
    search_history.push(search);
//    console.log("Search history: ", search_history);
} 
 
function getAverageWeight() {
    average_weight = {}
    for (s in search_history) {
        search = search_history[s];
        for (p in search) {
            point = search[p];
            if (point.category in average_weight) {
                average_weight[point.category] = average_weight[point.category] + point.weight;
            } else {
                average_weight[point.category] = point.weight;
            }
        }
    }
    // For each weight, divide by length of points
    for (weight in average_weight) {
        average_weight[weight] = average_weight[weight] / search_history.length;
    }
    console.log("Average weight: ", average_weight);
    return average_weight;
} 

function getAveragePosition() {
    average_position = {}
    // Compute total x,y,z
    for (s in search_history) {
        search = search_history[s];
        for (p in search) {
            point = search[p];
            if (point.category in average_position) {
                x = average_position[point.category][0] + point.x;
                y = average_position[point.category][1] + point.y;
                average_position[point.category] = [x, y];
            } else {
                average_position[point.category] = [point.x, point.y];
            }
        }
    }
    // Compute average
    for (category in average_position) {
        xy = average_position[category];
        x = xy[0] / search_history.length;
        y = xy[1] / search_history.length;
        average_position[category] = [x, y];

    }
    return average_position;
}

function analyticsDisplay() {
    // Get the analytics values
    var average_position = getAveragePosition();
    var average_weight = getAverageWeight();
    var swoop_weights = getSwoopWeights();
    // Build the table inside the modal before displaying
    for (position in average_position) {
        pos = average_position[position];
        $("#average_position_body").append("<tr><td>" + position + "</td><td>" + pos[0] + "</td><td>" + pos[1] + "</td></tr>");
    }
    for (w in average_weight) {
        weight = average_weight[w];
        $("#average_weight_body").append("<tr><td>" + w + "</td><td>" + weight + "</td></tr>");
    }
    for (w in swoop_weights) {
        weight = swoop_weights[w];
        $("#current_weights").append("<tr><td>" + w + "</td><td>" + weight[0] + "</td><td>" + weight[1] + "</td></tr>");
    }
    $( "#dialog-message" ).dialog({
      modal: true,
      width: 'auto',
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
}

function getSwoopWeights() {
	var weights = {}
    var TotalDis = 0;
    var PointDis = 0;
    
    for(var i=0; i<points.length; i++){
        for(var j=i+1; j<points.length; j++){
            TotalDis += disToPoint(points[i],points[j]);
        }    
    }
    
    // Take the distance from the center and divide by radius to get a weight between 0 and 1
    var w1 = 0,w2 = 0;
    for(var i=0; i<points.length; i++){
        w1 = 1 - disToCenter(points[i].x,points[i].y)/rad;
        PointDis = 0;
        for(var j=0; j<points.length; j++){
            PointDis += disToPoint(points[i],points[j]);
        }
        w2 = 1 - PointDis/TotalDis;
        w2 = w2*w2;
        weights[points[i].category] = [w1*.7, w2*.3];
    }
	console.log("Weights: ", weights);
	return weights;
}

/* End Analytics */
