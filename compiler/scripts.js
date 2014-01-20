function createContest(divID) {
	var xmlhttp = false;
	var con=document.forms["contestf"]["contest"].value;
	var crypt=document.forms["contestf"]["cry"].value;
	var sd=document.forms["contestf"]["start_date"].value;
	var st=document.forms["contestf"]["start_time"].value;
	var ed=document.forms["contestf"]["end_date"].value;
	var et=document.forms["contestf"]["end_time"].value;
	var sap=document.forms["contestf"]["sap"].value;
	var eap=document.forms["contestf"]["eap"].value;
	st=st+" "+sap;
	et=et+" "+eap;
	if (window.XMLHttpRequest) 
		{ xmlhttp = new XMLHttpRequest(); 
		} 
	else if (window.ActiveXObject) 
	{ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	if(xmlhttp) 
		{ var obj = document.getElementById(divID);
			xmlhttp.open("GET","admn_contestup.php?contest="+con+"&cry="+crypt+"&start_date="+sd+"&start_time="+st+"&end_date="+ed+"&end_time="+et); 
			xmlhttp.onreadystatechange = function() { 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				 { obj.innerHTML =xmlhttp.responseText; } 
				 } 
				xmlhttp.send(null); 
		}
	}
function createproblems(){
	var xmlhttp = false;
	var crypt=escape(document.forms["problems"]["security"].value)
	var contest=escape(document.forms["problems"]["contest"].value);
	var title=escape(document.forms["problems"]["title"].value);
	var pcode=escape(document.forms["problems"]["pcode"].value);
	var pbl=escape(document.forms["problems"]["pblm"].value);
	var time=escape(document.forms["problems"]["time"].value);
	var inputs=escape(document.forms["problems"]["inputs"].value);
	var outputs=escape(document.forms["problems"]["outputs"].value);
	var finale="cry="+crypt+"&contest="+contest+"&pcode="+pcode+"&title="+title+"&pblm="+pbl+"&time="+time+"&"+"inputs="+inputs+"&outputs="+outputs;
	if (window.XMLHttpRequest) 
		{ xmlhttp = new XMLHttpRequest(); 
		} 
	else if (window.ActiveXObject) 
	{ xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); }
	if(xmlhttp) 
		{ var obj = document.getElementById("result_pro");
			xmlhttp.open("POST","admn_problems_up.php");
			xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xmlhttp.send(finale); 
			xmlhttp.onreadystatechange = function() { 
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				 { obj.innerHTML =xmlhttp.responseText; } 
				 } 
}}
