var mz_data = new ajax_request();

var mem_status = ["Unknown!","ACTIVE","SUSPENDED", "CANCELLED","PENDING","EXPIRED","MARKED FOR DELETION"];

var status_color =["#d4d4d4","#00d400","#d40000","#a4a4a4","#7BC4FA","#fbab33","#616161"];
var status_font_size=["1em", "1.2em","1.5em","1.2em","1.2em","1.5em","1.2em"];

function ajax_request()
{
	var request = false
	try
	{
		request = new XMLHttpRequest(); /* eg: Firefox */
	}
	catch(err1)
	{
		try
		{
			request = new ActiveXObject("Msxml2.XMLHTTP");
			/* Some IE version */
		}
		catch(err2)
		{
			try
			{
				request = new ActiveXObject("Microsoft.XMLHTTP");
				/* Some IE version */
			}
			catch(err3)
			{
				request = false;
			}
		}
	}
	return request;
}

function mz_get_user(f_search_key, f_st)
{
	w_url = "./mz_get_member.php?x_search_key="+f_search_key+"&x_st="+f_st;
	//alert(w_url);
	mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_data_response;
	mz_data.send(null);
}	

function mz_get_user_s(f_search_key, f_st)
{
	w_url = "./mz_get_member.php?x_search_key="+f_search_key+"&x_st="+f_st;
		
	//location.href = w_url;
	mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_data_response_s;
	mz_data.send(null);
}	



function mz_get_report(f_report_id, f_report_title)
{
	w_url = "./mz_get_member_report.php?x_report_id="+f_report_id;
	w_url = w_url + "&x_report_title="+f_report_title;
	mz_data.open('GET', w_url, true);
	//mz_data.onreadystatechange = mz_report_response("Report_title");
	mz_data.onreadystatechange = mz_report_response;
	mz_data.send(null);
}	


function mz_add_user()
{
	w_param = "?x_orgname="+document.form_add.x_orgname.value;
	w_param = w_param + "&x_fname="+document.form_add.x_fname.value;
	w_param = w_param + "&x_surname="+document.form_add.x_surname.value;
	w_param = w_param + "&x_email_add="+document.form_add.x_email_add_a.value;
	w_param = w_param + "&x_phone="+document.form_add.x_phone.value;
	w_param = w_param + "&x_mphone="+document.form_add.x_mphone.value;
	w_param = w_param + "&x_addr_1="+document.form_add.x_addr_1.value;
	w_param = w_param + "&x_addr_2="+document.form_add.x_addr_2.value;
	w_param = w_param + "&x_suburb="+document.form_add.x_suburb.value;
	w_param = w_param + "&x_pcode="+document.form_add.x_pcode.value;
	w_param = w_param + "&x_state="+document.form_add.x_state.value;
	w_param = w_param + "&x_country="+document.form_add.x_country.value;
	w_param = w_param + "&x_sec_name="+document.form_add.x_sec_name.value;
	w_param = w_param + "&x_sec_phone="+document.form_add.x_sec_phone.value;
	w_param = w_param + "&x_login_name="+document.form_add.x_login_name_a.value;
	w_param = w_param + "&x_pword="+document.form_add.x_pword1.value;
	w_param = w_param + "&x_find_us=\"manual_entry\"";
	w_param = w_param + "&x_reference=";
		
	
	w_url = "./mz_add_member_2.php"+w_param;
	mz_show_anim();
	//alert(w_url);
	
	//location.href=w_url;
	mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_add_response;
	mz_data.send(null);
}

function mz_data_response()
{
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{
			
			var mz_data_text = mz_data.responseText;
			
			mz_show_member(mz_data_text);
			//mz_json = JSON.parse(mz_data_text);
			//document.getElementById('x_surname').value = mz_json.surname;
		}
		else
		{
			document.getElementById('response_div').innerHTML="HTTP Error encountered.";
		}
	}
}

function mz_data_response_s()
{
		
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{		
			var mz_data_text = mz_data.responseText;
			
			mz_show_member_s(mz_data_text);
			//mz_json = JSON.parse(mz_data_text);
			//document.getElementById('x_surname').value = mz_json.surname;
		}
		else
		{
			document.getElementById('response_div').innerHTML="HTTP Error encountered.";
		}
	}
}


function mz_report_response()
{
	
	
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{
			
			var mz_data_text = mz_data.responseText;

			//mz_show_report(mz_data_text, 5);
			mz_show_report(mz_data_text);
			//mz_json = JSON.parse(mz_data_text);
			//document.getElementById('x_surname').value = mz_json.surname;
		}
		else
		{
			document.getElementById('response_div').innerHTML="HTTP Error encountered.";
		}
	}
}

function mz_add_response()
{
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{
			
			mz_hide_anim();
			var mz_add_text = mz_data.responseText;

			if (mz_add_text == 0)
			{
				alert("New Member successfully added");
			}
			else if (mz_add_text == 1)
			{
				alert("*ERROR* adding new record. Please consult the system administrator");
			}	
			alert(mz_add_text);
		}
		else
		{
			document.getElementById('response_div').innerHTML="HTTP Error encountered.";
		}
	}
}

function mz_show_member(f_mz_data_text)
{
	mz_hide_anim();
		
	//document.getElementById("rd2").innerHTML = f_mz_data_text;
	
	mz_j = JSON.parse(f_mz_data_text);

	w_rec_no = mz_j[0].mz_t_rec_no;
	
	if (w_rec_no > 1)
	{
		
		document.getElementById("mz_list").style.visibility="visible";
				
		mz_show_name_list(f_mz_data_text, w_rec_no);
			
	}
	else
	{
	
	document.form_key.x_find.value = mz_j[1].fname+' '+mz_j[1].surname;
	
	document.form_edit.x_orgname.value = mz_j[1].orgname;
	document.form_edit.x_category.value = mz_j[1].category;
	document.form_edit.x_create_date.value = mz_j[1].rec_create_date;
	document.form_edit.x_active_date.value = mz_j[1].rec_active_date;
	document.form_edit.x_fname.value = mz_j[1].fname;
	document.form_edit.x_surname.value = mz_j[1].surname;
	document.form_edit.x_addr_1.value = mz_j[1].add1;
	document.form_edit.x_addr_2.value = mz_j[1].add2;
	document.form_edit.x_suburb.value = mz_j[1].city;
	document.form_edit.x_state.value = mz_j[1].state;
	document.form_edit.x_pcode.value = mz_j[1].pcode;
	document.form_edit.x_country.value = mz_j[1].country;
	document.form_edit.x_phone.value = mz_j[1].phone;
	document.form_edit.x_mphone.value = mz_j[1].mphone;
	document.form_edit.x_second_name.value = mz_j[1].sec_contact;
	document.form_edit.x_email_add.value = mz_j[1].email_add;
	document.form_edit.x_second_phone.value = mz_j[1].sec_contact_phone;
	
	mem_status_code = parseInt(mz_j[1].rec_status);
	
	
		if (mem_status_code == null)
		{
			mem_status_code = 1;
		}
	
	document.form_edit.x_status.value = mem_status[mem_status_code];
	document.form_edit.x_status.style.background=status_color[mem_status_code];
	document.form_edit.x_status.style.color="#ffffff";
	document.form_edit.x_status.style.fontSize=status_font_size[mem_status_code];
	
	document.form_edit.x_id.value = mz_j[1].id;
	
	//document.form_edit.x_add_1.value = mz_j[1].rec_status;
	//document.form_edit.x_add_1.value = mz_j[1].reference;
	}	
}


function mz_show_member_s(f_mz_data_text)
{
	mz_hide_anim();
	

	//document.getElementById("rd2").innerHTML = f_mz_data_text;
	
	mz_j = JSON.parse(f_mz_data_text);

	w_rec_no = mz_j[0].mz_t_rec_no;


	if (w_rec_no > 1)
	{
		
		document.getElementById("mz_list").style.visibility="visible";
				
		mz_show_name_list(f_mz_data_text, w_rec_no);
			
	}
	else
	{
	
	document.form_edit_s.x_orgname.value = mz_j[1].orgname;
	document.form_edit_s.x_create_date.value = mz_j[1].rec_create_date;
	//document.form_edit_s.x_active_date.value = mz_j[1].rec_active_date;
	document.form_edit_s.x_fname.value = mz_j[1].fname;
	document.form_edit_s.x_surname.value = mz_j[1].surname;
	document.form_edit_s.x_addr_1.value = mz_j[1].add1;
	document.form_edit_s.x_addr_2.value = mz_j[1].add2;
	document.form_edit_s.x_suburb.value = mz_j[1].city;
	document.form_edit_s.x_state.value = mz_j[1].state;
	document.form_edit_s.x_pcode.value = mz_j[1].pcode;
	document.form_edit_s.x_country.value = mz_j[1].country;
	document.form_edit_s.x_phone.value = mz_j[1].phone;
	document.form_edit_s.x_mphone.value = mz_j[1].mphone;
	document.form_edit_s.x_second_name.value = mz_j[1].sec_contact;
	document.form_edit_s.x_email_add.value = mz_j[1].email_add;
	document.form_edit_s.x_second_phone.value = mz_j[1].sec_contact_phone;
	
	mem_status_code = parseInt(mz_j[1].rec_status);
	
	
		if (mem_status_code == null)
		{
			mem_status_code = 1;
		}
	
	document.form_edit_s.x_status.value = mem_status[mem_status_code];
	document.form_edit_s.x_status.style.background=status_color[mem_status_code];
	document.form_edit_s.x_status.style.color="#ffffff";
	document.form_edit_s.x_status.style.fontSize=status_font_size[mem_status_code];
	
	document.form_edit_s.x_id.value = mz_j[1].id;
	
	//document.form_edit_s.x_add_1.value = mz_j[1].rec_status;
	//document.form_edit_s.x_add_1.value = mz_j[1].reference;
	}	
}

function mz_show_anim()
{
	document.getElementById("wait_anim").style.visibility="visible";
}

function mz_hide_anim()
{
	document.getElementById("wait_anim").style.visibility="hidden";
}

function mz_show_name_list(f_mz_data_text, f_rec_no)
{
	f_j = JSON.parse(f_mz_data_text);
			
    w_name_list_header = "<div style=\"text-align:right;position:relative;top:-10px;right:-10px;\"> \
<input type=\"button\" style=\"height:24px;  width:24px;background-color:#ffffff;font-size:12px;text-align:center; solid;font-weight:bold;color:#880000;\"  name=\"Cancel\" value=\"X\" onclick=\"close_mzlist()\"> \
</div>The following "+f_rec_no+" members were found matching the search criteria.  Please select one or refine  your search criteria (at most 20 members will be shown here.):<br><hr>";
			
	w_name_lines = "";
	
	for(var i=0;i<f_rec_no;i++)
	{
			j = i+1;
			
			w_surname = f_j[j][0].surname;
			w_fname = f_j[j][0].fname;
			w_orgname = f_j[j][0].orgname;
			w_url = j +". <a href=\"javascript:mz_hide_m_list();mz_show_anim();mz_get_user("+f_j[j][0].id+",'id');\">";
			w_name_lines = w_name_lines + w_url + w_fname+" "+w_surname+" of "+w_orgname+"</a><br>";
	}		
	
	w_div = document.getElementById("mz_list");
	w_div.innerHTML = w_name_list_header + w_name_lines;
}

//function mz_show_report(f_mz_data_text, f_rec_no)
function mz_show_report(f_mz_data_text)
{
	document.getElementById("mz_wkspace_00").style.visibility="visible";
	document.getElementById("mz_wkspace_00").style.height=10;
	
	f_j = JSON.parse(f_mz_data_text);
	
	w_report_title = f_j[0].mz_report_title;
	w_rec_no = f_j[0].mz_t_rec_no;
			
    w_name_list_header = "<div style=\"text-align:right;position:relative;top:-10px;right:-20px;\"> \
<input type=\"button\" style=\"height:30px;  width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;\"  name=\"Cancel\" value=\"X\" onclick=\"close_wkspace_00()\"> \
</div><span style=\"font-size:16px;font-weight:bold;\">"+w_report_title+"</span> ("+ w_rec_no +" records found).<br><hr>";
			
	w_report_lines = "<table>";
	
	for(var i=0;i<w_rec_no;i++)
	{
			j = i+1;
			
			w_surname = f_j[j][0].surname;
			w_fname = f_j[j][0].fname;
			w_orgname = f_j[j][0].orgname;
					
			w_url = j +". <a href=\"javascript:mz_show_anim();document.getElementById('mz_edit_pane').style.visibility ='visible'; document.getElementById('mz_edit_pane').style.zIndex =15; mz_get_user("+f_j[j][0].id+",'id');\">";
			//w_report_lines = w_report_lines + "<tr><td>"+ w_url + w_fname+"</td><td> //"+w_surname+"</td><td>"+w_orgname+"</td><tr>";
			w_report_lines = w_report_lines + "<tr><td>"+ w_url + w_fname+" "+ w_surname+ " of "+ w_orgname+"</a></td><tr>";
			
	}		
	
	w_div = document.getElementById("mz_wkspace_00");
	w_div.style.height = "500px";
	w_div.innerHTML = w_name_list_header + w_report_lines + "</table>";
	

}

function mz_hide_m_list()
{
	document.getElementById("mz_list").style.visibility="hidden";
}	
	
function mz_test_alert()
{
	alert("In mx_ajax");
}	

function mz_change_member_status(f_mstatus)
{
	w_url = "./mz_change_member_status.php?x_id="+document.form_edit.x_id.value;
	w_url = w_url + "&x_status="+f_mstatus;
	//location.href=w_url;
	
	mz_show_anim();
	mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_status_response;
	mz_data.send(null);
}	

function mz_status_response()
{
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{
			mz_hide_anim();
			var mz_response_text = parseInt(mz_data.responseText);
			var f_r_text = "Member status set to "+mem_status[mz_response_text]+".";
			document.form_edit.x_status.value = mem_status[mz_response_text];
			document.form_edit.x_status.style.background=status_color[mz_response_text];
			document.form_edit.x_status.style.color="#ffffff";
			document.form_edit.x_status.style.fontSize=status_font_size[mz_response_text];
			//alert(f_r_text);
		}
		else
		{
			document.getElementById('response_div').innerHTML="HTTP Error encountered.";
		}
	}
}

function mz_do_wkspace_99(f_wkspace)
{
	w_url = "./inc/mz_wkspace_99.php?x_wkspace="+f_wkspace;
	//alert(w_url);
	mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_wkspace_99_response;
	mz_data.send(null);
}	


function mz_wkspace_99_response()
{
	document.getElementById('mz_wkspace_00').innerHTML = mz_data.responseText;
}


//function mz_save_user_s(f_search_key, f_st)
function mz_save_edit_s()
{
	w_url = "./inc/mz_save_edit_s.php";

	mz_data.open("POST", w_url, true);
	mz_data.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
	location.href = w_url;
	/*mz_data.open('GET', w_url, true);
	mz_data.onreadystatechange = mz_edit_save_response_s;
	mz_data.send(null); */
}	
