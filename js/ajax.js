// JavaScript Document
function createRequestObject(){
	var request_o; //declare the variable to hold the object.
	var browser = navigator.appName; //find the browser name
	if(browser == "Microsoft Internet Explorer"){
		/* Create the object using MSIE's method */
		request_o = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		/* Create the object using other browser's method */
		request_o = new XMLHttpRequest();
	}
	return request_o; //return the object
}

function getbrand(d, url){
	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){

		if(thttp.readyState == 4){ 	
			if (thttp.status == 200)
				{
				document.getElementById(dvid).innerHTML = http.responseText;
				}
		}
	}
	
	http.open('get', url,true);
	http.send(null);
	
}






function getUsr(a, d, url){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"?gUid="+guid;	
	//alert(a.value);	
	var aid=a.value;

	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}
	
http.open('get', pURL+'&subid='+aid,true);
http.send(null);

}


function getList(k,c,s, d, url){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"?gUid="+guid;	
	//alert(a.value);	
	var kid=k.value;
	var cid=c.value;
	var sid=s.value;

	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}
	
http.open('get', pURL+'&kword='+kid+'&city='+cid+'&sic='+sid,true);
http.send(null);

}



function getFile(d, url){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"?gUid="+guid;	
	//alert(a.value);	

	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}
	
http.open('get', pURL,true);
http.send(null);

}


function enableField()
{

if(document.form1.isFile.checked==true){
getFile('list_div', 'upload_listings.php');
}else{
getFile('list_div', 'add_s_listing.php');
}
}

function addField(d, t,cname, capd,cap, lname)
{
//alert(document.getElementById(cname).checked);
if(cname.checked==true){
document.getElementById(d).innerHTML = '<input type="text" name="'+t+'" id="'+t+'" class="textfield" />';
document.getElementById(capd).innerHTML = cap;
document.getElementById(capd).style.paddingTop="20px";
document.getElementById(lname).disabled = true;

}else{
document.getElementById(d).innerHTML = '';
document.getElementById(capd).innerHTML = '';
document.getElementById(lname).disabled = false;
}


}

function getMod(a, d, url,chkp){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"?gUid="+guid;	
	//alert(chkp);	
	var aid=a.value;

	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}
	
http.open('get', pURL+'&subid='+a+'&chkp='+chkp,true);
http.send(null);

}

function getMimages(a, d, url,chkp){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"&gUid="+guid;	
	//alert(chkp);	
	var aid=a.value;

	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}
	
http.open('get', pURL+'&subid='+a+'&chkp='+chkp,true);
http.send(null);

}

function getSub(d, url){
	var guid =Math.random()* 99999999999912999.32211254555;
	
	var pURL = url+"&gUid="+guid;	


	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
						document.getElementById(dvid).style.visibility = "visible";
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}

http.open('get', pURL,true);
http.send(null);

}

function getSubCat(d, url){
var guid =Math.random()* 99999999999912999.32211254555;
	//alert(url);
	var pURL = url+"&gUid="+guid;	


	var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){
	
		if(thttp.readyState == 4){ 	
					if (thttp.status == 200)
					{
					document.getElementById(dvid).innerHTML = http.responseText;
					}
		}
	}

http.open('get', pURL,true);
http.send(null);

	}

<!-- Dynamic Version by: Nannette Thacker -->
<!-- http://www.shiningstar.net -->
<!-- Original by :  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->
<!-- Use one function for multiple text areas on a page -->
<!-- Limit the number of characters per textarea -->
<!-- Begin
function textCounter(field,cntfield,maxlimit) {

if (field.value.length > maxlimit){ // if too long...trim it!
field.value = field.value.substring(0, maxlimit); 
alert('Less then '+maxlimit+' characters allowed.');
// otherwise, update 'characters left' counter
}else{
cntfield.value = maxlimit - field.value.length;
}
}
//  End -->

<!-- Begin
function keyCounter(field,cntfield,maxlimit) {
/*var numk=field.value.split(",");*/
var nk= field.value.length;
if (nk > maxlimit){ // if too long...trim it!
field.value = field.value.substring(0, field.value.length-1); 
//alert(numk.join(","));
alert('Less then '+maxlimit+' characters allowed.');
// otherwise, update 'characters left' counter
}else{
cntfield.value = maxlimit - nk;
}
}
//  End -->

function getlogin(a,d, url){
	//alert(a);
if(document.getElementById('c_login').checked==true){


        var guid =Math.random()* 99999999999912999.32211254555;

         var pURL = url+"?gUid="+guid;	
//alert(a.value);	

var http = createRequestObject();
	var thttp=http; 
	var dvid=d;
	
	http.onreadystatechange = function(){

		if(thttp.readyState == 4){ 	
			if (thttp.status == 200)
				{
				document.getElementById(dvid).innerHTML = http.responseText;
				}
		}
	}
	
	http.open('get', pURL+'&empid='+a,true);
	http.send(null);
	

		}else{
	document.getElementById(d).innerHTML ="";	
		}
		
}


function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function disableFields(cname, f1, f2)
{

if(cname.checked==true)
{
document.getElementById(f1).value ='';
document.getElementById(f2).value = '';
document.getElementById(f1).disabled = true;
document.getElementById(f2).disabled = true;

}else{

document.getElementById(f1).disabled = false;
document.getElementById(f2).disabled = false;
}


}


function disableoneField(cname, f1)
{
if(cname.checked==true)
{
document.getElementById(f1).value =0;
document.getElementById(f1).disabled = true;


}else{
document.getElementById(f1).value =0;
document.getElementById(f1).disabled = false;

}


}

function disablerevFields(cname, f1, f2)
{
if(cname.checked==true)
{
document.getElementById(f1).disabled = false;
document.getElementById(f2).disabled = false;
}else{


document.getElementById(f1).value ='';
document.getElementById(f2).value = '';
document.getElementById(f1).disabled = true;
document.getElementById(f2).disabled = true;

}


}

function disablerevthreeFields(cname, f1, f2,f3)
{
if(cname.checked==true)
{
document.getElementById(f1).disabled = false;
document.getElementById(f2).disabled = false;
document.getElementById(f3).disabled = false;
}else{


document.getElementById(f1).value ='';
document.getElementById(f2).value = '';
document.getElementById(f3).value = '';
document.getElementById(f1).disabled = true;
document.getElementById(f2).disabled = true;
document.getElementById(f3).disabled = true;

}


}
//document.getElementById('lname').disabled = false;