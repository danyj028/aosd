var tk_new_order = new ajax_request();

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

function tk_order_item(f_m_id, f_qty, f_price, f_session_id, f_r_id, f_r_zone)
{

	w_url = "tk_order.php?x_m_id="+f_m_id+"&x_m_qty="+f_qty+"&x_m_price="+f_price;
	w_url = w_url + "&x_sessid="+f_session_id + "&x_r_id="+f_r_id +"&x_r_zone="+f_r_zone;

	//window.open(w_url,"order","");
	tk_new_order.open("GET", w_url, true);
	tk_new_order.onreadystatechange = tk_order_response;
	tk_new_order.send(null);

}

function tk_order_response()
{
	if (tk_new_order.readyState == 4)
	{
		alert("Thank you. Your order has been recorded.");
	}
}

