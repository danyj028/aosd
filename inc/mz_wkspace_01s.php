<?php
//require "./inc/mz_menu_options.php";

class mz_menu_01
{
	var $mz_menu_title_array;
    var $h_username;
	var $h_home;
	var $h_return;
	var $h_close;
	var $h_reload;
	var $h_msg;
	var $h_logo;
	var $h_date_time;
	var $h_check_save;  // prompt for save?
	var $h_userid;
	
	public function __construct($o_userid)
	{
		$this->h_userid = $o_userid;
	}	
	
	function menu_display() //alisasing display function
	{
		$this->display();
	}	
	
	function display()
	{
		
	$bx="<input class=\"mz_x\" id=\"bx\" type=\"button\" value=\"X\" style=\"color:#aa0000;padding:1px;border-radius:1px;\" onclick=\"mz_do_clear_menus(1)\"></input>";

 $b1="<input class=\"mz_b_menu\" id=\"b1\" type=\"button\" value=\"Edit Membership\" style=\"color:#0000aa;padding:1px;\" onclick=\"mz_do_menus(1)\"></input>";
 $b2="<input class=\"mz_b_menu\" id=\"b2\" type=\"button\" value=\"Products and Services\" style=\"color:#0000aa;padding:1px;\" onclick=\"mz_do_menus(2)\"></input>";
 $b3="<input class=\"mz_b_menu\" id=\"b2\" type=\"button\" value=\"Edit Profile Blurb\" style=\"color:#0000aa;padding:1px;\" onclick=\"mz_do_menus(3)\"></input>";
 $b4="<input class=\"mz_b_menu\" id=\"b3\" type=\"button\" value=\"logout\" style=\"color:#0000aa;padding:1px;\" onclick=\"w_logout()\"></input>";
 //$b4="<input class=\"mz_b_menu\" id=\"b4\" type=\"button\" value=\"Logout\" style=\"color:#aa0000;padding:1px;\" onclick=\"w_logout()\"></input>";
 
 $mz_menu_sys = $b1.$b2.$b3.$b4;
  $mz_menu_sys_b1 = "";
   $mz_menu_sys_b2 = "";
    $mz_menu_sys_b3 = "";
    $mz_menu_sys_b13 ="";

 
 $b21="<input class=\"mz_b_s_menu\" type=\"button\" value=\"Category Select\" style=\"color:#0000aa;padding:1px;\" onclick=\"mz_do_menus(21)\"></input>";
 $b22="<input class=\"mz_b_s_menu\" type=\"button\" value=\"Custom Specify\" style=\"color:#0000aa;padding:1px;\" onclick=\"mz_do_menus(22)\"></input>";
 
 
 $mz_menu_sys_b2 = $bx.$b21.$b22;
 
 
$w_ref_tag = "";


		
print <<< endprint
	
	<style>
	.mz_x
	{
		background-color:#dddddd;
		color: #ffffff;
		font-size: 1em;
		padding: 1px;
		width: 20px;
		height: 40px;
	}
	
	.mz_menu
	{
		background-color:#dddddd;
		color: #000055;
		font-size:2em;
		padding:1px;
		text-decoration:underline;		
		
	}	
	
	.mz_menu:hover, .mz_menu:active
	{
	    	background:#ffffff;
	    	text-decoration:underline;
    }	
    
    .mz_b_menu
	{
		background-color:#dddddd;
		color: #000055;
		font-size:1em;
		#text-decoration:underline;		
		width:150px;
		height:40px;
		#border-top:0px;
		#border-left:0px;
		#border-bottom:2px;
		#border-right:2px;
		
	}	
	
	.mz_b_menu_sm
	{
		background-color:#dddddd;
		color: #000055;
		font-size:1em;
		width:100px;
		height:30px;
			
	}	
	
	.mz_b_menu:hover, .mz_b_s_menu:active
	{
	    	background-color:#ffffff;
	    	text-decoration:underline;
	    		
    }
    
    .mz_b_s_menu
	{
		background-color:#dddddd;
		color: #000055;
		font-size:1em;
		#text-decoration:underline;
		width:150px;
		height:40px;
		#border-top:1px;
		#border-left:0px;
		#border-bottom:10px;
		#border-right:2px;
				
	}	
	
	.mz_b_s_menu:hover, .mz_b_s_menu:active
	{
	    	background-color:#ffffff;
	    	text-decoration:underline;
    }
	</style>
	
	<script>
	var f_userid;
	f_userid = document.x_userid.value;
	
	function mz_do_clear_menus(m)
	{
		// not using m for now 
		var mn = document.getElementById("mz_sys_menu_b1");
		mn.style.display = "none";
		var mn = document.getElementById("mz_sys_menu_b2");
		mn.style.display = "none";
		var mn = document.getElementById("mz_sys_menu_b3");
		mn.style.display = "none";
		var mn = document.getElementById("mz_sys_menu_b13");
		mn.style.display = "none";
	}
	
	function w_logout()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");
		//m1.style.zIndex=0;
		m1.style.display ="none";
		
		confirm_logout();
			
	}
	
	function member_reports()
	{
		var m1 = document.getElementById("mz_sys_menu_b2");
		//m1.style.zIndex=2;
		m1.style.display ="none";
		
		//alert("Doing Reports");
	}
	
	function mz_sys_admin()
	{
		var m3 = document.getElementById("mz_sys_menu_b3");
		
		m3.style.zIndex=2;
		m3.style.display ="inherit";
		
		//alert("Doing Sysadmin");
	}
	
	function mz_manage_member()
  	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=2;
		m1.style.display ="inherit";
		
	}	
	
	function mz_prod_serv()
  	{
		var m2 = document.getElementById("mz_sys_menu_b2");

		m2.style.zIndex=2;
		m2.style.display ="inherit";
	}	
	
	
	function mz_member_process()
  	{
		mz_clear_panes();
		var m13 = document.getElementById("mz_sys_menu_b13");
		m13.style.zIndex=2;
		m13.style.display = "inherit";
	}	
	
	function mz_add_member()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="none";
		//location.href="mz_register.php";
		document.getElementById("mz_add_pane").style.visibility="visible";
	}
	
	function mz_edit_member()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		cancel_mz_prod_edit();
		cancel_mz_blurb_edit();
		
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		document.getElementById("mz_edit_pane").style.visibility="visible";
		
	}
	
	function mz_edit_member_s(f_userid)
	{
		var m1 = document.getElementById("mz_sys_menu_b1");
		
		//alert(f_userid);
		
		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		cancel_mz_prod_edit();
		cancel_mz_blurb_edit();
		cancel_mz_prod_cat_edit()
		
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		document.getElementById("mz_edit_pane").style.visibility="visible";
		
		mz_get_user_s(f_userid,"id");
		
	}
	
	function mz_edit_prods()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		cancel_mz_edit();
		cancel_mz_blurb_edit();
		cancel_mz_prod_cat_edit()
				
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		document.getElementById("mz_prod_edit_pane").style.visibility="visible";
	
	}
	
	function mz_edit_prods_cat()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		cancel_mz_edit();
		cancel_mz_blurb_edit();
				
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		document.getElementById("mz_prod_cat_edit_pane").style.visibility="visible";
	
	}
	
	function mz_edit_blurb()
	{
		var m1 = document.getElementById("mz_sys_menu_b1");

		m1.style.zIndex=0;
		m1.style.display ="inherit";
		
		cancel_mz_edit();
		cancel_mz_prod_edit();
		cancel_mz_prod_cat_edit()
				
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		document.getElementById("mz_blurb_edit_pane").style.visibility="visible";
	
	}
	
	function mz_find_member(f_member_search_key)
	{
		//alert(f_member_search_key);
		w_href="mz_get_member.php?x_search_key="+f_member_search_key;
		location.href=w_href;
	}
	
	function cancel_mz_edit()
	{
		l1 = document.getElementById("mz_edit_pane");
		l1.style.visibility="hidden";
	}
	
	function cancel_mz_prod_edit()
	{
		l1 = document.getElementById("mz_prod_edit_pane");
		l1.style.visibility="hidden";
	}
	
	function cancel_mz_prod_cat_edit()
	{
		l1 = document.getElementById("mz_prod_cat_edit_pane");
		l1.style.visibility="hidden";
		l1 = document.getElementById("mz_prod_cat_edit_pane_long");
		l1.style.visibility="hidden";
	}
	
	function cancel_mz_blurb_edit()
	{
		l1 = document.getElementById("mz_blurb_edit_pane");
		l1.style.visibility="hidden";
	}
	
	function cancel_mz_add()
	{
		l2 = document.getElementById("mz_add_pane");
		l2.style.visibility="hidden";
	}
	
	function close_mzlist()
	{
		document.getElementById("mz_list").style.visibility="hidden";
	}	
	
	function close_wkspace_00()
	{
		document.getElementById("mz_wkspace_00").style.visibility="hidden";
	}
	
	function mz_clear_panes()
	{
		document.getElementById("mz_edit_pane").style.visibility ="hidden";
		document.getElementById("mz_prod_edit_pane").style.visibility ="hidden";
	}
	
	function reset_wkspace_00()
	{
		document.getElementById("mz_sys_menu_b1").style.display ="none";
		document.getElementById("mz_sys_menu_b2").style.display ="none";
		document.getElementById("mz_sys_menu_b3").style.display ="none";
		document.getElementById("mz_sys_menu_b13").style.display ="none";
		document.getElementById("mz_wkspace_00").style.visibility ="hidden";
	}
	
	function mz_select_list(ln)
	{
		
		/*var m1 = document.getElementById("mz_sys_menu_b1"); 

		m1.style.zIndex=0;
		m1.style.display ="inherit"; */
		
		cancel_mz_edit();
		cancel_mz_blurb_edit();
				
		document.getElementById("b1").style.backgroundcolor="#ffffff";
		//document.getElementById("mz_sys_menu_b1").style.display ="inherit";
		
		if (ln == 'l')
		{
			document.getElementById("mz_prod_cat_edit_pane").style.visibility="hidden";	
			document.getElementById("mz_prod_cat_edit_pane_long").style.visibility="visible";
		}
		else
		{
			document.getElementById("mz_prod_cat_edit_pane").style.visibility="visible";	
			document.getElementById("mz_prod_cat_edit_pane_long").style.visibility="hidden";
		}	
	}

	function mz_do_menus(w_menu_option)
	{
		
				
		switch(w_menu_option)
		{
		case 1:
			reset_wkspace_00();
			mz_edit_member_s($this->h_userid);
			break;
		case 2:
			reset_wkspace_00();
			//mz_edit_prods();
			mz_prod_serv();
			break;
		case 3:
			//alert("Doing Sys_Admin");
			reset_wkspace_00();
			mz_edit_blurb();
			break;		
		case 11:
			reset_wkspace_00();
			document.getElementById("mz_edit_pane").style.visibility ="hidden";
			document.getElementById("mz_add_pane").style.visibility ="visible";
			mz_add_member();
			break;
		case 12:
			//alert("Doing Edit");
			reset_wkspace_00();
			document.getElementById("mz_add_pane").style.visibility ="hidden";
			document.getElementById("mz_edit_pane").style.visibility ="visible";
			mz_edit_member();
			break;
		case 13:
			//alert("Doing Process");
			reset_wkspace_00();
			document.getElementById("mz_sys_menu_b1").style.display ="inherit";
			mz_member_process();
			break;
		case 14:
			alert("Doing List");
			break;
		case 15:
			alert("Doing Process Membership");
			break;
		case 16:
			alert("Doing Edit");
			break;
		case 17:
			alert("Doing Edit");
			break;
		case 21:
			//alert("Doing 21");
			reset_wkspace_00();
			//mz_get_report(1, "Active Members");
			mz_edit_prods_cat();
			break;
		case 22:
			//alert("Doing 22");
			reset_wkspace_00();
			//mz_get_report(2, "Expired Members");
			mz_edit_prods();
			break;
		case 23:
			//alert("Doing 23");
			reset_wkspace_00();
			mz_get_report(3, "Suspended Members");
			break;
		case 24:
			alert("Doing 24");
			break;			
		case 25:
			alert("Doing 25");
			break;	
		case 26:
			alert("Doing 26");
			break;	
        case 27:
			//alert("Doing 27");
			reset_wkspace_00();
			//mz_all_member_records();
			mz_get_report(7, "All Members Records");
			break;				
		case 31:
			alert("Doing 31");
			break;	
		case 32:
			alert("Doing 32");
			break;			
		case 33:
			alert("Doing 33");
			break;	
		case 34:
			alert("Doing 34");
			break;	
		case 35:
			alert("Doing 35");
			break;	
		case 131:
			//alert("Doing 131");
			mz_do_wkspace_99(131);
			document.getElementById("mz_wkspace_00").style.visibility="visible";
			break;	
		case 132:
			//alert("Doing 132");
			mz_do_wkspace_99(132);
			document.getElementById("mz_wkspace_00").style.visibility="visible";
			break;	
		case 133:
			//alert("Doing 133");
			mz_do_wkspace_99(133);
			document.getElementById("mz_wkspace_00").style.visibility="visible";
			break;
		default:
			alert("No Option");
		}
			
	}	
	
	</script>
	
		<!--table>
		<tr>
		<td-->
		
		<div style="position:relative;top:-10px;">$mz_menu_sys</div>
		
			<div id="mz_sys_menu_b1" 
		    	style="position:relative;top:-20px;left:10px;width:90%;
				z-index:0;display:none;">
			$mz_menu_sys_b1
			</div>
			
			<div id="mz_sys_menu_b2" 
		    	style="position:relative;top:-20px;left:10px;width:90%;
				z-index:0;display:none;">
			$mz_menu_sys_b2
			</div>
			
			<div id="mz_sys_menu_b3" 
		    	style="position:relative;top:-20px;left:10px;width:90%;
				z-index:0;display:none;">
			$mz_menu_sys_b3
			</div>
			
			<div id="mz_sys_menu_b13" 
		    	style="position:relative;top:+10px;left:-433px;
				z-index:0;display:none;">
			$mz_menu_sys_b13
			</div>

		
		<!--/td>
		</tr-->
		
		<div id="mz_edit_pane"
							
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#D7E3F4;opacity:0.90;
			position:absolute;
			bottom:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:inherit;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="cancel_mz_edit()">
</div>

endprint;

include "./inc/mz_show_edit_pane_inc_s.php";

print <<< endprint
</div>

<div id="mz_prod_edit_pane"
							
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#D7E3F4;opacity:0.90;
			position:absolute;
			bottom:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:inherit;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="cancel_mz_prod_edit()">
</div>

endprint;

include "./inc/mz_prod_edit_pane_inc_s.php";

print <<< endprint
</div>

<div id="mz_prod_cat_edit_pane"
							
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#D7E3F4;opacity:0.90;
			position:absolute;
			top:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:inherit;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="cancel_mz_prod_cat_edit()">
</div>

endprint;

include "./inc/mz_prod_cat_edit_pane_inc_s.php";


print <<< endprint
</div>

<div id="mz_prod_cat_edit_pane_long"
							
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#D7E3F4;opacity:0.90;
			position:absolute;
			top:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:inherit;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="cancel_mz_prod_cat_edit()">
</div>

endprint;

include "./inc/mz_prod_cat_edit_pane_inc_s_long.php";


print <<< endprint
</div>

<div id="mz_blurb_edit_pane"
							
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#e1e1f7;opacity:0.90;
			position:absolute;
			bottom:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:inherit;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="cancel_mz_blurb_edit()">
</div>

endprint;

include  "./inc/mz_blurb_edit_pane_inc_s.php";

print <<< endprint
			
</div>
		
	<div id="mz_list" 
style="margin-left:10px;position:relative;top:-20px;left:60%;height:80%;width:35%;
z-index:inherit;border:solid;border-width:1px;
background-color:#fafafa;opacity:0.95;visibility:hidden;">
	<div style="margin-left:10px;">	
		<br>
	</div>
</div>

<div id="mz_wkspace_00"
					
			style="margin-left:10px;
			margin-right:10px;
			margin-top:10px;
			margin-bottom:10px;
			padding-right:20px;
			padding-left:20px;
			padding-top: 10px;
			padding-bottom:20px;
			background-color:#F6FA00;opacity:0.95;
			position:absolute;
			bottom:5px;right:5px;left:5px;
			border:solid;
			visibility:hidden;z-index:10;">
			
			<div style="text-align:right;position:relative;top:-9px;right:-18px;">
<input type="button" style="height:30px; width:30px;background-color:#ffffff;font-size:16px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="Y" onclick="close_wkspace_00();">
</div>
		
endprint;

include "./inc/mz_wkspace_99.php";

print ("</div>");

	}
}
