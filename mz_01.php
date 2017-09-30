<?php

include_once "./inc/mz_header.php";
include_once "./inc/mz_wkspace_01.php";
include_once "./inc/mz_wkspace_02.php";
//include_once "./inc/mz_wkspace_03.php";

$h = new mz_header_2;
$m = new mz_menu_01;

$h->h_logo = "t";
$h->h_return="f";
$h->h_home="f";
$h->h_username="";
$h->h_title = "<span style=\"font-size:1.5em;font-family: serif;\">Australian Open Source Directory</style>";
// $h->h_title = "<img src=\"/mzone/elt_img/mzone_01_12.png\" width=\"180\"  alt=\"MZone Membership Management\" align=\"left\">";
$h->h_date_time = "t";

$h->h_display();

 #  User with auth_level <= 2 have normal user area only access

print <<< endprint


<script language="javascript">
    function confirm_logout()
   {
   if (confirm("Please click [OK/Yes] to confirm logout from MemberZone, or [Cancel/No] to continue working."))
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

<body>

</body>  
endprint;

$w_an_tag = false;

if (false)
{
//check_anouncement($w_userid, $w_username, $EL_do_announcement, &$db, &$w_an_tag);

//$_SESSION["EL_do_announcement"] = $EL_do_announcement;

}
else
{
  // echo "<font color=#FF0000><h3>Your Login Session is not valid anymore. Please close the browser and start again.</h3></font>";
}

/*
//if ($w_an_tag)
{
	echo "<div style=\"font-size:10pt;text-align:right;padding-bottom:20px;\"><a href=javascript:check_announcement('$w_userid','$w_username')>[Read Announcements]</a></div>";
}

echo "<div style=\"font-size:8pt;color:#00aa00;text-align:right;\">Connected to database: ".$w_dbxxx."<br>[php version]<div>";
*/


$m->display();
?>
