//  User with auth_level > 2 have adminstrator access to


echo "dada";

print <<< endprint

<!DOCTYPE public "-//w3c//dtd html 4.01 transitional//en"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta HTTP-EQUIV="Pragma" CONTENT="No-cache">
    <link rel=stylesheet href="mz_css/elt_01.css" type="text/css">
    <title>MZone</title>

<script language="javascript">
    function confirm_logout()
   {
   if (confirm("Please click [OK] to confirm logout from MZone, or [Cancel] to continue working."))
     {
        location.href = "/mrs/mz_logout.php";
     }
   }

	function check_announcement(w_userid,w_username)
	{
		window.open("/mzone/el_tools/el_s_an_display.php?x_userid=w_userid","Announcement","width=640, height=440");
		w_url = "/mzone/el_tools/el_p_an_display.php?x_userid="+w_userid+"&x_username=" + w_username;
		window.open(w_url,"Personal Announcement","width=640, height=440");
	}

</script>

</head>

<body bgcolor=#CDBE83>

	<!--div align="center">
	<img src="/mzone/elt_img/mzone_01_12.png"  width="180" alt="MZone : Membership Manageent" border=0>
  </div-->
  <p>
  <br>
<!--div style="position:relative;top:10px;text-align:center;">
<IMG src="elt_mg/ell_pg_bkg1.png" width="597" height="297" align="middle" border="0">
</div>

<div style="position:relative;top:-260px;text-align:center;"-->
<div style="position:relative;text-align:center;">
  <table width="50%" align="center" border="0" cellspacing="1" >
  <tr valign="top"><td>
  <!--div style="color: #E7E7E7;background: #0008A9;font-size:14pt;" align="center"-->
	<div style="color: #FFDD00;background: #8F9700;font-size:14pt;" align="center">
  	<b>Current User is&nbsp;&nbsp;<i> $w_username</i></b>
		<br>
			<span style="font-size:10pt;">$w_time_string</span>
		</div></td><tr><td align="center">
  <table cellpadding="5" width="100%">
    <tr align="center"> <td width="33%">
		<a href="el_educator/el_ed_00.php" name="Instructor_area"><IMG src="el01img/as2325.gif" width="125" height="150" border="1"><br>Educator</a></td>
    <td width="33%"><a href="el_student/el_st_00.php"
name="Student_area"><IMG src="elt_img/as1287.gif" width="125" height="150" border="1"><br>Student</a></td>
     <td width="*">
		<a href="elt_01.html" name="Admin_area"><IMG src="elt_img/as0134.gif" width="125" height="150" border="1"><br>Administrator</a></td></tr>
			<tr><td colspan="3"><hr color=#8F9700></td></tr>

      </table>
  </td>
  </tr>
  </table>
  <br>
   <div align="center"><font size="+1" >
  <a href="javascript:confirm_logout()" name="Logout"><img src="./elt_img/elt_logout_1.png" width="66" height="21" alt="Logout" border="0"></a>
   </font>
   </div>

</div>

</body>
</html>

endprint;


if (isset($_SESSION['EL_do_announcement']))
	{
		$EL_do_announcement = $_SESSION['EL_do_announcement'];
		$w_an_tag = false;

		check_anouncement($w_userid, $w_username, $EL_do_announcement, $db, $w_an_tag);

		$_SESSION["EL_do_announcement"] = $EL_do_announcement;
	}

