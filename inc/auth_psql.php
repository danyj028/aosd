<?php
//Program version
$w_mz_version= "MZone ver.02";

// Authenticating user at lever $x_userlevel

//$w_username = trim(substr(urldecode($_REQUEST["x_username"]),0,20));
$w_username = trim(urldecode($_REQUEST["x_username"]));
$w_password = trim(substr(urldecode($_REQUEST["x_password"]),0,20));
$w_xfer_page = trim(urldecode($_REQUEST["xfer_page"]));


//echo $w_xfer_page; die();

require "connect_to_db1.php";

    // $db = new MZ_db;
     
     $w_sql = "select * from user_auth where username = '$w_username'";
     $w_stm = $mz_db->prepare($w_sql);
	$w_stm->execute();
		
	$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
	$w_rec_no = $w_stm->rowCount();

     //$db->query("select * from user_auth where username = '$w_username'");


     //$e_password = crypt($w_password, "XY");
     
    $e_password = substr(md5($w_username.$w_password),0,20);
    //$w_cpword = substr(md5($w_login_name.$w_pword),0,20);
    //echo($w_username."--".$e_password."----".$w_password);
	//die();

if (($w_rec_no) > 0)
{

//$db->next_record();

/*$stored_password =  $db->f("password");
$w_user_level = $db->f("level");
$w_userID = $db->f("id");
$w_dbxxx = $db->f("exl_db");
$w_acc_status = $db->f("account_status");
*/

$w_stored_password =  $w_rec["password"];
$w_user_level = $w_rec["level"];
$w_userID = $w_rec["id"];
$w_dbxxx = $w_rec["user_db"];
$w_acc_status = $w_rec["account_status"];


if ($w_dbxxx == "")
{
  $w_dbxxx = "mzone";
}

$w_need_pwd_change = $w_rec["need_pwd_change"];
$w_change_pwd_msg = "Please change your Password immediately, then login again when requested.";

if ($w_need_pwd_change  == 't' ) //forcing a password change if first time login ..
{
    $w_page = "/mzone/mz_pwd_change.php?x_username=".$w_username."&x_forced_change=t'";
}
else
{
##$w_page = $w_xfer_page.":NOSSL";  // not sure why NOSSL was added
$w_page = $w_xfer_page; 
}

if ($e_password != $w_stored_password)     // invalid password
  {



      sleep(10);
   echo ("<center>");
   echo ("<font color=#FF0000 >");
   echo ("<hr>Access Denied.<hr>");
   echo ("</font>");
   echo ("</center>");

// force end to script execution if wrong password..
   die();
  }
}
else    // invalid username
{
      sleep(10);

print <<< endprint
   <br>
   <center>
   <hr>
   <span style="background-color: #FFFFFF; color: #FF0000; font: bold;
                             font-size: 20; 
                             font-family: arial, helvetica, sans-serif; font-style: oblique;
                             text-align: center;
                            ">
         <br>Access Denied.<br>
   </span>
   <hr>
  </center>

endprint;

// force end to script execution if fail authentification ...
   die();
}


//check rec_status in mzuser
$w_sql = "select rec_status from mzuser where id = '$w_userID'";
 
$w_stm = $mz_db->prepare($w_sql);
$w_stm->execute();
		
$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
$w_rec_no = $w_stm->rowCount();
//die("here_1");

//$db->query($w_query);

if ($w_rec_no > 0)
{

$w_rec_status = $w_rec["rec_status"];

if ($w_rec_status == "-1")  // user status = inactive
  {
      sleep(10);

print <<< endprint
   <br>
   <center>
   <span style="background-color: #493D7A; color: #FF0000; font: bold;
           font-size: 20; line-height: 1;
           font-family: arial, helvetica, sans-serif; font-style: oblique;
           text-align: center;
           padding-left: 15; padding-right: 15;
           padding-bottom: 15; padding-top: 15; ">
           <hr><br>Access Denied.<br><hr>
   </span>
  </center>

endprint;

// force end to script execution if user status = inactive
   die();
  }
}


ob_start(); //Allows the cookie to be set after the code.

//Start session and register some variables
session_start();

if (!isset($PHPSESSID))
{
	
$PHPSESSID = session_id();

$MZuserid=$w_userID;
$MZauth=$w_user_level;
$MZ_loginname = $w_username;
$MZ_prog_version = $w_mz_version;
$MZ_dbxxx = $w_dbxxx;
$MZ_acc_status = $w_acc_status;

$_SESSION['PHPSESSID']=$PHPSESSID;

$_SESSION['MZ_host']=$_SERVER["SERVER_NAME"];
$_SESSION['MZuserid']=$MZuserid;
$_SESSION['MZauth']=$MZauth;
$_SESSION['MZ_loginname']=$MZ_loginname;
$_SESSION['MZ_prog_version']=$MZ_prog_version;
$_SESSION['MZ_dbxxx']=$MZ_dbxxx;
$_SESSION['MZ_acc_status']=$MZ_acc_status;
$_SESSION['MZ_do_announcement']=true; 

$_SESSION['MZcomponent_id'] = ""; //??
$_SESSION['MZprogram_id']= ""; //??

if ($w_rec_status == 11)
{
	$EL_no_pwd_change = true;
	$_SESSION['MZ_no_pwd_change']=true;
}

}

//$f ="/home/httpd/html/MZ01/eLiveTrain_host.conf";
//$EL_eLiveTrain_host = trim(fread(fopen($f, "r"), filesize($f)));
//$EL_eLiveTrain_host = $SERVER_NAME;
$EL_MZ_host = $_SERVER["SERVER_NAME"]; //$SERVER_NAME;
// set cookie for authorisation and misc.
//if  (!isset($ELauth))
{

setcookie("MZuserid",$w_userID,0, "/mzone", "");
setcookie("MZauth", $w_user_level,0, "/mzone", "");
setcookie("MZuser_rec_status", $w_rec_status, 0, "/mzone", "");
setcookie("MZ_loginname", $w_username, 0, "/mzone", "");
setcookie("MZ_dbxxx", $w_dbxxx, 0, "/mzone", "");
setcookie("MZ_host", $EL_MZ_host, 0,"/mzone","");
setcookie("MZ_acc_status",$w_acc_status, 0,"/mzone","");

## echo "no auth";

// session_start();

/*$ELuserid=$w_userID;
$ELauth=$w_user_level;
$EL_loginname = $w_username;
$EL_prog_version = "Exlver.001";
$EL_dbxxx = $w_dbxxx;
$EL_acc_status = $w_acc_status; */
//$EL_do_announcement = true;

}


/*
$short_session_id = substr($PHPSESSID,0,15);
$w_timestamp = date( "Y-m-d, h:m:s", time() );

echo $short_session_id;die();
//Log user in log file.
$w_query = "insert into el_log01 (id, log_date_time,log_session) values ('$w_userID',  '$w_timestamp', '$short_session_id')";
$db->query($w_query);
*/

//echo $w_page;
//die();

print <<< endprint

<html>
<head>
   <META HTTP-EQUIV="Refresh" CONTENT="2;URL=$w_page">
   <META HTTP-EQUIV="content-type" CONTENT="No-cache; text/html; charset=utf-8">
    <!--META HTTP-EQUIV="Refresh" CONTENT="2;URL=$w_page:NOSSL"-->
</head>

<body>
<br>
<br>
<br>
<center>
<span style="background-color: #D7E3F4; color: #000055; font: bold;
                             font-size: 20; line-height: 1;
                             font-family: arial, helvetica, sans-serif; font-style: bold;
                             text-align: center;
                             padding-left: 15; padding-right: 15;
                            padding-bottom: 15; padding-top: 15; ">
         Successful login. Please wait while loading next screen ...
 </span>
 </center>

</body>

</html>

endprint;

ob_end_flush();


?>
