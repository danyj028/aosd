<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>MemberZone Login</title>
		<meta name="author" content="root" >
		<meta name="generator" content="Bluefish 2.2.3" >
		<meta name="description" content="" >
		<meta name="keywords" content="AOSD Management" >
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" >
		<meta http-equiv="Content-Script-Type" content="text/javascript" >
		<meta http-equiv="Content-Style-Type" content="text/css" >
		<link rel="stylesheet" href="elt_css/elt_01.css" type="text/css">
		
	</head>
	<!--body style="background-color: rgb(233, 251, 255);"-->
	<body>
<script language="javascript" type="text/javascript">
<!--
if (document.images)
{
login_up = new Image;
login_up2 = new Image;
login_dn = new Image;
login_up.src = "/mrs/elt_img/elt_login_1.png";
login_up2.src = "/mrs/elt_img/elt_login_1b.png";
login_dn.src = "/mrs/elt_img/elt_login_1.png"; 
}
-->

function search_d()
{
	//alert("In Development");
	location.href=("mz_dir_search.php");
}
</script>

<?php

//include "./inc/el_sys_menu.php";
//$m = new el_sys_menu;

$title_string = "Australian Open Source Directory";
include "./inc/mz_header.php";

$h = new mz_header;

$h->h_logo = "t";
$h->h_return="f";
$h->h_home="f";
$h->h_username="Unknown Guest";
// $h->h_title = "<font size=\"+1\">MemberZone : Membership Management</font>";
//$h->h_title = "<img src=\"/mzone/elt_img/mzone_01_30.png\" width=\"120\"  alt=\"Membership Management\" align=\"left\">";
$h->h_title = "<div style=\"font-size:1.3em;color:#79A0F5;background:#ffffff;padding:8px;border-radius:15px 15px;border:2px solid;\">$title_string</div>";
$h->h_date_time = "t";
$h->h_display();


print <<< endprint

<div>
<table>
<tr><td valign="top" 
    style="
	width: 100%;
	
	text-align:left; 
	padding-left: 10pt;
	padding-bottom: 10pt;
	padding-top: 25pt;
	margin-right:10pt;
	border-top-width: 1;
	border-left-width: 0.5;
	border-bottom-width: 1;
	border-right-width: 1;
	border-top-style: none;
	border-left-style: none;
	border-bottom-style: solid;
	border-right-style: solid;
	border-color: #cc0000;	
	border-radius:12px;
	background-color: #FFFFFF;
	font-size:1.0em;
	
">
The Australian Open Source Directory contains a list of business who provide services for and based on Open Source software.
<p>OSIA Member business have priority listing. Non-Member business are also able to join and be listed.  To list business
products and services, please <a href="mz_register.php">register</a>.
<p>
New Members can register and after registration Members can login and complete their profile details.
<p>
Business and organisations looking for services for open source software, or seeking  more information about open source software
can search the directory.
<p>

<input type="button" name="search_d" value="Search Directory"
 style="font-size:15px;font-weight:bold;background-color:#F9c338;padding:8px;border-radius:5px;" onclick="javascript:search_d()">

<!--/div-->
</td>
<td>
<div style="width;25%">
<div style="

	width: 240pt;

	text-align:left; 
	padding-left: 10pt;
	padding-bottom: 10pt;
	padding-top: 10pt;
	margin-right:10pt;
	border-top-width: 1;
	border-left-width: 0.5;
	border-bottom-width: 1;
	border-right-width: 1;
	border-top-style: none;
	border-left-style: solid;
	border-bottom-style: solid;
	border-right-style: none;
	border-color: #0000aa;	
	border-radius:12px;
	
	background-color: #D7E3F4;
	
">

<span style="
	padding: 5px;
	//background-color: #0000aa;
	color: #0000aa;
	font-weight:bold;
	font-size:12px;
	text-align:center;
	radius:3px;
	">
	Login
	</span>
	
<!--form name="login_form" action="/mzone/elt_login_01.php" method="get"-->
<form name="login_form" action="/mrs/inc/auth_psql.php" method="get">
<input name="xfer_page" value="/mrs/mz_00.php" type="hidden">

<div style="margin-top: 15pt;">
<div style="position: relative; font-size:8pt;">
Username or Email address:
</div>

<div style="position: relative; margin-right:20pt; ">
<input style="font-size:10pt;" name="x_username" size="30" maxlength="50" align="left">
</div>

<br>
<div style="position: relative; font-size:8pt;">
Password:
</div>

<div style="position: relative; margin-right: 20pt;">
<input style="font-size:10pt;" name="x_password" size="30" maxlength="20" type="password" align="left">
</div>

<div style="position: relative; margin-top:10pt;text-align:center;">
<!--a href=javascript:document.login_form.submit()><img src="/mzone/elt_img/elt_login_1.png" width="68" height="16" alt="Login" border="0"></a-->
<input type="button" name="login" value="Login" style="font-size:12px;background-color:#dadada;color:#0000aa;padding:2px;border-radius:5px;" onclick="javascript:submit()"/>
<br>
<br>
<div style="position: relative; font-size:8pt; text-align:center; margin-right:2pt">
<a href="mz_register.php">Register</a>
&nbsp;&nbsp;&nbsp;
<a href="/mrs/mz_forgot_pwd.php">Lost Password</a>
&nbsp;&nbsp;&nbsp;
<a href="mailto:admin@osia.com.au">Contact</a>
</div>

</form>

</div>

</div>
</tr>
</td>
</table>
</div>

endprint;

?>

This system is in beta status.	
</body>
</html>
