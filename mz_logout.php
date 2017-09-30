<?php

//session_start();


/* assumed login code is not used here
if (isset($_SESSION["MZassume_login"]))
{
  
	if ($_SESSION["MZassume_login"] == 1)
	{
		$_SESSION["MZassume_login"] = 0;
		print <<< endprint
   			<META HTTP-EQUIV="Refresh" CONTENT="0;URL=mz_restore_user_login.php">
endprint;
	}


}
*/

ob_start(); //Allows the cookie to be run after the code.

// Specific punbb code - to terminate a discussion session if it exists

// unset cookie for authorisation
if  (isset($_SESSION["MZauth"]))
{

$auth_level = $_COOKIE["MZauth"];
$auth_userID = $_COOKIE["MZuserid"];
$auth_rec_status = $_COOKIE["MZuser_rec_status"];
$auth_loginname = $_COOKIE["MZ_loginname"];
$php_session_id = $_COOKIE["PHPSESSID"];
$w_dbxxx = $_COOKIE["MZ_dbxxx"];

setcookie("MZuserid",$auth_userID,(time()-3600), "/mzone", "");
setcookie("MZauth", $auth_level,(time()-3600), "/mzone", "");
setcookie("MZuser_rec_status", $auth_rec_status, time()-3600, "/mzone", "");
setcookie("MZ_loginname", $auth_loginname, time()-3600, "/mzone", "");
setcookie("PHPSESSID", $php_session_id, time()-3600, "/", "");
setcookie("MZ_dbxxx",$w_dbxxx, time()-3600, "/mzone", "");

unset($_SESSION["MZuserid"]);
}



//update log
require "./inc/connect_to_db.php";

//$db = new mz_db;

//Log user in log file.
$w_log_session =substr(session_id(),0,15);
$w_query = "update mz_log01 set log_session = '-'||log_session where log_session = '$w_log_session' ";

$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();
//$db->query($w_query);

print <<< endprint

<html>
<head>
  <META HTTP-EQUIV="Refresh" CONTENT="2;URL=/mrs/mz_logout_page.html">
</head>
<body>
<p><p>
<br><br>
<div align="center"><span style="background-color: #D7E3F4; color: #000055; font: bold;
                             font-size: 20; line-height: 1;
                             font-family: arial, helvetica, sans-serif;
                             text-align: center;
                             padding-left: 15; padding-right: 15;
                            padding-bottom: 15; padding-top: 15; ">
                       Logout successful. Please wait...
 </span></div>

</body>

</html>

endprint;

ob_end_flush();

session_unset();




?>

