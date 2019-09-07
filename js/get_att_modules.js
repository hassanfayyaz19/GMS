// JavaScript Document
/* The following function creates an XMLHttpRequest object... */

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

/* You can get more specific with version information by using 
	parseInt(navigator.appVersion)
	Which will extract an integer value containing the version 
	of the browser being used.
*/
/* The variable http will hold our new XMLHttpRequest object. */
var http = createRequestObject();
var thttp=http; 

/* Function called to get the product categories list */
function getmod(t,aVal){
	/* Create the request. The first argument to the open function is the method (POST/GET),
		and the second argument is the url... 
		document contains references to all items on the page
		We can reference document.form_category_select.select_category_select and we will 		
		be referencing the dropdown list. The selectedIndex property will give us the 
		index of the selected item. 
	*/

//Geting Values for conditions

var ob_val=aVal;
var ob_id=t.value;

var guid =Math.random()* 99999999999912999.32211254555;


	http.open('get', 'get_att_modules.php?action='+ob_val+'&id=' 
			+ob_id+'&guid='+guid);
			//alert(document.form1.select_category_select.value);
			
	 http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	/* Define a function to call once a response has been received. This will be our
		handleProductCategories function that we define below. */
	http.onreadystatechange = handlelinks; 
	/* Send the data. We use something other than null when we are sending using the POST
		method. */
	http.send(null);
}

/* Function called to handle the list that was returned from the internal_request.php file.. */
function handlelinks(){
	if(thttp.readyState == 4){ 
			if (thttp.status == 200)
						 {
				
			var subList = thttp.responseXML.getElementsByTagName('subcat');
			//loop for check boxs
			
			for(s=0; s < document.getElementById('tloop').value; s++){
			document.getElementById('chk'+s).checked=false;	
			}
			
			for(i=0;i<subList.length;i++){
						//alert(subList1[i].getAttribute('grp_p'));
				if(subList[i].getAttribute('grp_p')=='Y'){
					document.getElementById('chk'+i).checked=true;	
				}else{
					document.getElementById('chk'+i).checked=false;	
				}
			}	
		}
	}
}
