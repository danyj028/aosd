
var elt_user_data_xml;

var elt_object = new ajax_request();

function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function ucfirst(w_str)
{
	w_str = w_str.toLowerCase();
	w_str_1 = w_str.substring(0,1);
	return (w_str_1.toUpperCase() + w_str.substring(1));
}


function elt_save_user(f_userid, f_sname, f_fname, f_oname, f_doby, f_dobm, f_dobd,
	f_gender, f_add1, f_add2, f_city, f_pcode, f_state, f_country,
	f_phone, f_mob, f_alt_cont,f_email)
{
	w_url = "/virnutes/elt_save_user.php?x_userid="+f_userid;
	w_url = w_url + "&x_sname="+f_sname.toLowerCase();
	w_url = w_url + "&x_fname="+f_fname.toLowerCase();
	w_url = w_url + "&x_oname="+f_oname.toLowerCase();
	w_url = w_url + "&x_doby="+f_doby;
	w_url = w_url + "&x_dobm="+f_dobm;
	w_url = w_url + "&x_dobd="+f_dobd;
	//w_url = w_url + "&x_gender="+f_gender;
	w_url = w_url + "&x_add1="+f_add1;
	w_url = w_url + "&x_add2="+f_add2;
	w_url = w_url + "&x_city="+f_city.toLowerCase();
	w_url = w_url + "&x_pcode="+f_pcode;
	w_url = w_url + "&x_state="+f_state.toLowerCase();
	w_url = w_url + "&x_country="+f_country.toLowerCase();
	w_url = w_url + "&x_phone="+f_phone;
	w_url = w_url + "&x_phone_mob="+f_mob;
	w_url = w_url + "&x_alt_cont="+f_alt_cont;
	w_url = w_url + "&x_email_add="+f_email;
	
	//alert("u: "+w_url);
	
	elt_user = elt_object.open("GET", w_url, true);
	elt_object.onreadystatechange = elt_save_object_response;

	elt_object.send(null);
	
}


function elt_save_object_response()
{

	if (elt_object.readyState == 4)
	{
		if (elt_object.status == 200)
		{
			var elt_object_response = elt_object.responseText;
						
			alert(elt_object_response);
		}
		else
		{
			//document.getElementById('id1').innerHTML="HTTP Error encountered.";
			alert("Error");	
		}
	}
	else
	{
		w_msg =  "Click [Refresh Screen] to update";
		//document.getElementById('id1').innerHTML="Click [Refresh Screen] to update.";
		//document.getElementById('id1').innerHTML=w_msg;
	}

}

function elt_get_user(f_userid, k)
{
	
	document.getElementById("user_list1").style.visibility="hidden";
	w_url = "elt_get_user.php?x_userid="+f_userid+"&x_key="+k;
	
	//alert(w_url);
	
	elt_object.open("GET",w_url,true);
	elt_object.overrideMimeType("text/xml");
	elt_object.onreadystatechange = elt_get_user_response;
	
	//elt_user = elt_object.open("GET", w_url, true);
	//elt_user.onreadystatechange = elt_get_object_response;

	elt_object.send(null);
	
}

function elt_get_diary_entry(f_year, f_month, f_day, f_user_id)
{
	w_url = "elt_get_diary_entry_t.php?x_year="+f_year+"&x_month="+f_month+"&x_day="+f_day+"&x_userid="+f_user_id;
	elt_object.open("GET", w_url, true);
	elt_object.overrideMimeType("text/xml");
	elt_object.onreadstatechange = elt_get_diary_response;

	elt_object.send(null);
}

/*function elt_get_user_response()
{
	if (elt_object.readyState == 4)
	{
		elt_user_data_xml = elt_object.responseXML.documentElement;
		//elt_user_data_xml = elt_object.responseText;
		
		f_fname = elt_user_data_xml.getElementsByTagName('elt_fname')[0].childNodes[0].nodeValue;
		
		document.form1.x_fname.value = f_fname;
	}
}*/


function elt_get_user_response()
{
	
	if (elt_object.readyState == 4)
	{
		if (elt_object.status == 200)
		{
			//elt_user_data_t = elt_object.responseText;
			elt_user_data_xml = elt_object.responseXML.documentElement;
			
			//alert ("data: "+elt_user_data_t);
			
			elt_display_user(elt_user_data_xml)
			

			/*var rec_num = elt_user_data_xml.getElementsByTagName('num_rows')[0].childNodes[0].nodeValue;
					
			if (rec_num > 0) //has an entry - hence display it.
			{
			  	display_de(0);
			  	
			  	if (rec_num > 1)
				{
					next_rec = "More Records&nbsp;&nbsp;&nbsp;<a href='javascript:display_de(1)' style='font-size:10px;'><IMG src='/elt01/elt_img/next-c.jpg' width='20' height='20' border='0'></a>";
					document.getElementById('next_rec').innerHTML=next_rec;
				}
			}
				*/
		
		}
		else
		{
			//document.getElementById('id1').innerHTML="HTTP Error encountered.";
			//alert("cont");
		}
	}
	else
	{
		w_msg =  "Continue ...";
		//document.getElementById('err').innerHTML=w_msg;
		//alert(w_msg);
	}
}

function elt_show_user(f_userid)
{
	var elt_user_data_xml = null;

	elt_get_user(f_userid);
	
	//alert("Got-It");

}


function elt_display_user(elt_user_data_xml)
{
	
	f_rec_no = elt_user_data_xml.getElementsByTagName('elt_rec_no')[0].childNodes[0].nodeValue;
	
	//f_rec_no = 1;
	
	//alert(f_rec_no);
	
	if (f_rec_no == 1)
	{
	f_userid = elt_user_data_xml.getElementsByTagName('elt_userid')[0].childNodes[0].nodeValue;
	document.form1.x_userid.value = f_userid;
	f_sname = elt_user_data_xml.getElementsByTagName('elt_sname')[0].childNodes[0].nodeValue;
	document.form1.x_sname.value = ucfirst(f_sname);
	
	f_fname = elt_user_data_xml.getElementsByTagName('elt_fname')[0].childNodes[0].nodeValue;
	document.form1.x_fname.value = ucfirst(f_fname);
	
	f_oname = elt_user_data_xml.getElementsByTagName('elt_oname')[0].childNodes[0].nodeValue;
	document.form1.x_oname.value = ucfirst(f_oname);
	
	f_add1 = elt_user_data_xml.getElementsByTagName('elt_add1')[0].childNodes[0].nodeValue;
	document.form1.x_add_1.value = f_add1;
	
	f_add2 = elt_user_data_xml.getElementsByTagName('elt_add2')[0].childNodes[0].nodeValue;
	document.form1.x_add_2.value = f_add2;
	
	f_city= elt_user_data_xml.getElementsByTagName('elt_city')[0].childNodes[0].nodeValue;
	document.form1.x_city.value =ucfirst( f_city);
	
	f_state = elt_user_data_xml.getElementsByTagName('elt_state')[0].childNodes[0].nodeValue;
	document.form1.x_state.value = ucfirst(f_state);
	
	f_pcode = elt_user_data_xml.getElementsByTagName('elt_pcode')[0].childNodes[0].nodeValue;
	document.form1.x_pcode.value = f_pcode;
	
	f_country = elt_user_data_xml.getElementsByTagName('elt_country')[0].childNodes[0].nodeValue;
	document.form1.x_country.value = ucfirst(f_country);
	
	f_phone = elt_user_data_xml.getElementsByTagName('elt_phone')[0].childNodes[0].nodeValue;
	document.form1.x_phone.value = f_phone;
	
	
	f_mob = elt_user_data_xml.getElementsByTagName('elt_mob_phone')[0].childNodes[0].nodeValue;
	document.form1.x_phone_mob.value = f_mob;
	
	f_email = elt_user_data_xml.getElementsByTagName('elt_email')[0].childNodes[0].nodeValue;
	document.form1.x_email_add.value = f_email;
	
	}
	else if (f_rec_no > 1)
	{
		w_d = document.getElementById('user_list1');
		w_d.style.visibility="visible";
		
		f_user_data_html = elt_user_data_xml.getElementsByTagName('elt_user_list')[0].childNodes[0].nodeValue;
		w_d = document.getElementById('user_list1b');
		w_d.innerHTML = f_user_data_html;
	}
	else 
	{
			f_user_id = elt_user_data_xml.getElementsByTagName('elt_userid')[0].childNodes[0].nodeValue;
		
			document.form1.reset();
			document.form1.x_userid.value = f_user_id;
		
			alert("Error: Invalid UserID : " + f_user_id);
	}

}



