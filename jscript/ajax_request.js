
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
				try
				{
					request = new window.XML.HttpRequest();
				}
				catch(err4)
				{	
					request = false;
				}
			}
		}
	}
	return request;
}

