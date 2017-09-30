<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <title></title>
  <meta name="GENERATOR" content="Quanta Plus">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="/elt01/inc/elt_ajax_f_01.js"></script>
</head>
<body>
<script language="javascript">

var elt_object = new ajax_request();
//var elt_object = new XMLHttpRequest();
function elt_get_entry()
{
	rnd = Math.random();

	w_url = "/elt01/inc/elt_get_diary_entry.php?x_month=7&x_year=2009&x_rnd="+rnd;
	//location.href = w_url;
	//alert("here");

	elt_object.open("GET",w_url,true);
	elt_object.overrideMimeType("text/xml");
	//elt_object.setRequestHeader('Content-Type', "text/xml");
	elt_object.onreadystatechange = elt_de_response;

	elt_object.send(null);
}

function elt_de_response()
{

	/*while (elt_object.readyState < 4)
	{
		alert(elt_object.readyState);
	}*/

	if (elt_object.readyState == 4)
	{
		if (elt_object.status == 200)
		{
			var elt_de_data_t = elt_object.responseText;
			var elt_de_data = elt_object.responseXML.documentElement;
			//alert(elt_de_data::user_id);
			document.getElementById('id1').innerHTML=elt_de_data_t;

			var w = elt_de_data.getElementsByTagName('num_rows')[0].childNodes[0].nodeValue;
			document.getElementById('id2').innerHTML=w;
		}
		else
		{
			document.getElementById('id1').innerHTML="HTTP Error encountered.";
		}
	}
	else
	{
		w_msg =  "Click [Refresh Screen] to update";
		document.getElementById('err').innerHTML=w_msg;
		//alert(w_msg);
	}
}


</script>

<div id="id1">1</div>
<div id="id2">NR</div>
<div id="err">e</div>

<INPUT type="button" name="test" value="Test" onclick="elt_get_entry()">
</body>
</html>
