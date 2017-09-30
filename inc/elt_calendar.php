<?php

require_once "connect_to_db.php";

session_start();

$w_user_id = $_SESSION['ELTuserid'];
$w_loginname = $_SESSION['ELT_loginname'];

//$w_db = new elt_db;

$entry_date_array= array();


print <<< endscript
<script language="javascript" src="/elt01/jscript/ajax_request.js"></script>
<script language="javascript" src="/elt01/jscript/elt_user.js"></script>
<script language="javascript">
function elt_show_month(f_m, f_y)
{
	location.href = "./elt_month_diary.php?x_month="+f_m+"&x_year="+f_y;
}
	
function elt_next_month(f_m, f_y)
{
	f_m++;
	if (f_m > 12) 
	{
		f_m = 1;
		f_y = f_y + 1;
	}
	location.href= "./elt_month_diary.php?x_month="+f_m+"&x_year="+f_y;
}

function elt_prev_month(f_m, f_y)
{
	f_m--;
	if (f_m < 1) 
	{
		f_m = 12;
		f_y = f_y - 1;
	}
	location.href= "./elt_month_diary.php?x_month="+f_m+"&x_year="+f_y;
}

function elt_next_year(f_m, f_y)
{
	f_y++;
	
	location.href= "./elt_month_diary.php?x_month="+f_m+"&x_year="+f_y;
}

function elt_prev_year(f_m, f_y)
{
	f_y--;
	location.href= "./elt_month_diary.php?x_month="+f_m+"&x_year="+f_y;
}

function elt_dv(d,mm,yy,f_div)
{
	l1 = document.getElementById(f_div);
	h1 = document.getElementById("h_div");
	d3 = document.getElementById("data_3");
	h1.innerHTML=d+"-"+mm+"-"+yy;
	l1.style.visibility="visible";
	d3.innerHTML="<textarea name='injury' style='border:solid;border-width:1px;width:640;height:50;padding:2px;font-size:10pt;color:#005500;font-family:sans'>"+
	"none"+"</textarea>";
}

function cancel_dv(f_div)
{
	l1 = document.getElementById(f_div);
	l1.style.visibility="hidden";
}


function wk_success()
{
	alert("Sucess");
}

function wk_forwad()
{
	alert("Forwad");
}
	
function wk_cancel()
{
	alert("Cancel");
}

function cancel_diary_entry()
{

	if (confirm("Do you really want to cancel this diary entry?"))
	{
		alert("cancel");
		document.form1.reset();
		document.form1.cancel;
	}
}	

function save_diary_entry()
{
	alert("Save");
	document.form1.submit();
}

function save_diary_data()
{
	alert("save_data");
}  

function fetch_data(f_day, f_month, f_year, w_userid)
{
	alert("Fetch_data for: "+ w_userid);
}


</script>
endscript;

/*
$day_name=array("Sunday", "Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday");
$day_name_short=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$month_name=array("January","February","March","April","May","June","July","August","September","October","November","December");
$month_name_short=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
*/

function entry_date_array($f_year, $f_month, $f_user_id, &$elt_db_pdo)
{

	global $entry_date_array;
	
	//echo "YM".$f_year."-".$f_month;
	
	$w_query="select extract(day from elt_d_date) as db_date from elt_diary_entry where
		 (extract(month from elt_d_date)=$f_month) and
		 (extract(year from elt_d_date) = $f_year) and
		  (elt_d_user_id = '$f_user_id') ";
		  
		  //echo ($w_query); die();
		$w_stm = $elt_db_pdo->prepare($w_query);
		$w_stm->execute();
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
		
		$w_rec_no = $w_stm->rowCount();  
		  
		//$f_db->query($w_query);
		  
		  while ($w_rec)
		  {
		  	//$entry_date_array[] = $f_db->f("db_date");
		  	$entry_date_array[] = $w_rec["db_date"];
		  	$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		  }	
		  
}		  

function check_has_entry($f_date)
{
	
	global $entry_date_array;
	

	if (in_array($f_date, $entry_date_array))
	{
		return(true);
	}
}

function work_out_select(&$f_wks, &$f_db, &$elt_db_pdo)
{

	$f_wks = "<select name=\"wkout_list\" style=\"width:500px;color:#880000;background-color:#e0ffe0;\">";

	$w_query="select elt_wk_id, elt_wk_title from elt_wkout order by elt_wk_title";
	
	//echo ($w_query);die();
	$w_stm = $elt_db_pdo->prepare($w_query);
	$w_stm->execute();
		
	$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
	$w_rec_no = $w_stm->rowCount();

	//$f_db->query($w_query);
	
	//while($f_db->next_record())
	while ($w_rec)
	{	
	
		$w_wk_id=$w_rec["elt_wk_id"];
		$w_wk_title =$w_rec["elt_wk_title"];
		$w_wk_title_trunc = trim(substr($w_wk_title,0,60))."...";
		
		$f_wks.="<option value=\"$w_wk_id\" label=\"$w_wk_title\">$w_wk_title_trunc</option>";
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
	}	
	$f_wks.="</select>";
	//echo($f_wks);
	
}

function cal_day_show($f_date)
{
}

function cal_week_show($f_date)
{
}

function cal_month_show($f_month, $f_year, $w_user_id, &$elt_db_pdo)
{

entry_date_array($f_year, $f_month, $w_user_id, $elt_db_pdo);

$day_name=array("Sunday", "Monday","Tuesday", "Wednesday","Thursday","Friday","Saturday");
$day_name_short=array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$month_name_array=array("Month_name","January","February","March","April","May","June","July","August","September","October","November","December");
$month_name_short=array("Mon_name","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");


$w_first_day = getdate(mktime(0,0,0, $f_month, 1, $f_year));
$w_first_day_num = (int) $w_first_day["wday"];

$w_month_name = $month_name_array[$f_month];

$w_next_year = "<a href=javascript:elt_next_year($f_month,$f_year) style=\"font-size:14px;padding:5px;\">Next Year&gt;&gt</a>";
$w_prev_year = "<a href=javascript:elt_prev_year($f_month,$f_year) style=\"font-size:14px;padding:5px;\" >&lt;&lt;Prev Year</a>";
$w_prev_month = "<a href=javascript:elt_prev_month($f_month,$f_year) style=\"font-size:12px;padding:5px;\">&lt;Prev Month</a>";
$w_next_month = "<a href=javascript:elt_next_month($f_month,$f_year) style=\"font-size:12px;padding:5px;\">Next Month&gt;</a>";

echo "<div style=\"width:95%;margin-top:-10px;text-align:center;font-size:12px;color:#000099;background:#C0EB52;
border-width: 2px;border-right-style: solid;border-bottom-style: solid;border-color:#666666;\">";
echo($w_prev_year)."&nbsp;-&nbsp;";
for ($m=1;$m<=12;$m++)
{
	echo("<a href=javascript:elt_show_month($m,$f_year)>".$month_name_short[$m]."</a>&nbsp;-&nbsp;");
	
}	
echo($w_next_year);
echo "</div>";

echo "<div style=\"width:95%;text-align:center;font-size:16px;color:#000099;font-weight:bold;\";> :: ".$w_month_name." ".$f_year." :: </div>";
echo("<table style=\"width:95%;border-style:groove; border-width:3px;border-color:#009900;\">");

	//print header
	echo("<tr style=\"height:40px;\">");
		
	for ($w_hr=1; $w_hr<=7; $w_hr++)
	{
		//print <<< endhead
			echo("<td style=\"width:11%; border-width:1px;border-style:none; text-align:center;background:#d3e8b1;\">");
 			echo("<span style=\"font-size:18px;font-weight:bold;color:#009900;\">".$day_name_short[$w_hr-1]."</span>");
 			echo("</td>");
 			
	}
	echo("</tr>");
	
	$w_k = 1;
 	for ($w_row = 1; $w_row <=6; $w_row++)
 	{
 		echo("<tr style=\"border-style:groove;padding:3px;\">");
 		
 	 		
 		for ($w_col = 1; $w_col <= 7; $w_col++)
 		{
 	
 	$w_id = "c_".$w_k;
	print <<< endcol
	<!--td style="width:12%; border-width:1px;border-style:solid;text-align:center;"-->
	<td style="width:12%; text-align:center;padding:2px;">
	<div id=$w_id style="color:#aaaaaa;font-size:16px;font-weight:bold;border-width:1px;
	border-style:solid;padding:3px; background-color:#cecece;">
	-
	</div>
	</td>

		
endcol;
			$w_k++;			
 		}
 		echo("</tr>");
 	}
 	echo("</table>");
 	 	
 	echo("<script language=\"javascript\">");
 	
 	print <<< endfunc
 	function goto_day(f_day, f_month, f_year, w_user_id)
 	{
  		fetch_data(f_day, f_month, f_year, w_user_id)
		elt_dv(f_day,f_month, f_year, "dv1");
 	}
endfunc;
 	
 	$w_today = getdate();
	
 	$w_d = 1;
 	$w_nm_d = 1;
 	$w_k_f = $w_first_day_num + 1;
 	
	for($w_k=$w_k_f;$w_k<=42;$w_k++)
 	{
 	
 	$w_id = "c_".$w_k;
 	
 	if (checkdate($f_month, $w_d, $f_year))
 	{
		
		if ((($w_d == $w_today["mday"])&&($f_month==$w_today["mon"]))&&($f_year==$w_today["year"]))
		{
			//echo("document.getElementById(\"$w_id\").style.borderWidth=\"3px\";");
			echo("document.getElementById(\"$w_id\").style.backgroundColor=\"#76B4F0\";");
			//echo("document.getElementById(\"$w_id\").style.borderColor=\"#aa0000\";");
		}
		
		//if (check_has_entry($w_d)&&(($f_year==$w_today["year"])&&($f_month==$w_today["mon"])))
		if (check_has_entry($w_d))
		//checks if has a diary entry for date and set cell border to show
		{
				echo("document.getElementById(\"$w_id\").style.borderWidth=\"2px\";");
				echo("document.getElementById(\"$w_id\").style.borderColor=\"#0000cc\";");
		}
				
		echo("document.getElementById(\"$w_id\").style.padding=\"3px\";");
		
		$w_month_name=$month_name_array[$f_month];
		$w_d_link ="<a href=javascript:goto_day('$w_d','$w_month_name','$f_year','$w_user_id')>$w_d</a>";
		echo("document.getElementById(\"$w_id\").innerHTML=\"$w_d_link\";");
		
		$w_d++;	
	}
	 else
	{
		echo("document.getElementById(\"$w_id\").innerHTML=\"<span style='padding:3px;color:#aaaaaa;';>$w_nm_d</span>\";");
		$w_nm_d++;
 	};
 	
 	}
 	echo("</script>");
}



work_out_select($wk_select,$w_db, $elt_db_pdo);

 	$w_today = getdate();
 	$w_today_d = $w_today["mday"];
 	$w_today_m = $w_today["month"];
 	$w_today_mn = $w_today["mon"];
  	$w_today_y = $w_today["year"];
  	
//entry_date_array($w_today_y, $w_today_mn, $w_user_id, &$w_db, &$elt_db_pdo);  
//entry_date_array($f_year, $f_month, $w_user_id, &$w_db, &$elt_db_pdo);
	


print <<< end_dv

<div id="dv1" style="position:absolute;top:0px;left:2px;width:96%;height:60%;
	background-color:#BDE1B0;opacity:0.95;color:#005500;
	padding-right:5px;padding-left:5px;padding-top:5px;padding-bottom:5px;
	border:solid;visibility:hidden;">

<div style="text-align:right;">
<form name="form1" method="POST" action="javascript:save_diary_data()" enctype="multipart/form-data">

<input type="button" style="height:25px; width:25px;background-color:#aa0000;font-size:12px;text-align:center; solid;font-weight:bold;color:#ffffff;font-family:sans;" name="Cancel" value="X" onclick="cancel_dv('dv1')">
</div>
<span id="h_div" style="font-size:14px;font-weight:bold;color:#000099;text-align:center;
position:relative;top:-20px;padding-left:20px;padding-right:20px;background-color:#ffffff;"></span>
<span style="position:relative;top:-20px;padding-right:200px;">&nbsp;</span>
<span id="h2_div" style="font-size:12px;color:#000099;text-align:center;
position:relative;top:-22px;width:200px;"><span style="font-weight:bold;">Time</span> from 
<input type="text" name="from_hh" value="00"  style="font-size:10px;width:25px;text-align:center;border-width:1px;">:<input type="text" name="from_mm" value="00"  style="font-size:10px;width:25px;text-align:center;border-width:1px;"> to 
<input type="text" name="to_hh" value="00"  style="font-size:10px;width:25px;text-align:center;border-width:1px;;">:<input type="text" name="to_mm_hh" value="00"  style="font-size:10px;width:25px;text-align:center;border-width:1px;">
</span>
<div style="position:relative; top:-20px;height:1px;border-bottom:solid;border-bottom-width:1px;">&nbsp</div>
<div>
	<table style="font-size:12px;color:#005500;position:relative;top:-15px;">
	<tr>
		<td>Workout:	</td>
		<!--td><input type="text" name="wk1" value=""	style="border:solid;border-width:1px;width:640px;"></td-->
		<td>$wk_select</td>
	</tr>
	<tr >
	<td>Fitness Level:</td>
	<td colspan=2>
			<table style="font-size:12px;color:#005500;border:solid;border-width:1px;">
			<tr style="padding:20px;">
			<td>
			<div style="position:relative;top:-3px;">
			1:<input type="radio" name="x_fitness">&nbsp;
			2:<input type="radio" name="x_fitness">&nbsp;
			3:<input type="radio" name="x_fitness">&nbsp;
			4:<input type="radio" name="x_fitness">&nbsp;
			5:<input type="radio" name="x_fitnbess">
			</div>
			</td>
		</table>
	</td>
	</tr>
	<tr>
	<td>Performance: </td>
	<td colspan=2>
	<table style="font-size:12px;color:#005500;border:solid;border-width:1px;">
			<tr>
			<td>
			Distance: <input type="text" name="x_distance" style="font-size:10px;width:50px;text-align:center;border-width:1px;">
			&nbsp;<select name="x_dist_unit" style="font-size:10px;color:#880000;background-color:#e0ffe0;">
			<option value="m">mtrs</option>
			<option value="k">kms</option>
			<option value="l">miles</option>
		
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;
			Time: <input type="text" value="00" name="x_time" style="font-size:10px;width:30px;text-align:center;border-width:1px;">hr<input type="text" value="00" name="x_time" style="font-size:10px;width:30px;text-align:center;border-width:1px;">min<input type="text" value="00"  name="x_time" style="font-size:10px;width:30px;text-align:center;border-width:1px;">.<input type="text" name="x_time" value="000" style="font-size:10px;width:30px;text-align:center;border-width:1px;">sec &nbsp;&nbsp;<b>OR</b>&nbsp;&nbsp; Repeats: x<input type="text" value="1" name="x_rpt" style="font-size:10px;width:20px;text-align:center;border-width:1px;">
			</td>
			</table>
	</td>
	<tr>
		<td valign="top">
		Injury/Soreness: </td>
		<td>		
		<div id="data_3"></div>
		</td>
	<tr>
		<td valign="top">
		Comment: </td>
		<td>		
		<textarea style="border:solid;border-width:1px;width:640;height:100px;padding:10px;
		font-size:12pt;color:#005500;font-family:sans"></textarea>
		</td>
	</tr>
		
	<tr>
		<td valign="top" width="120px">
		Coach Comment: </td>
		<td>		
		<textarea style="border:solid;border-width:1px;width:640;height:50px;padding:10px;
		font-size:12pt;color:#005500;font-family:sans"></textarea>
		</td>
	</tr>
	<tr>
		<td valign="top">
		To aim for: </td>
		<td valign="top">	
			
		<textarea style="border:solid;border-width:1px;width:640;height:50px;padding:10px;
		font-size:12pt;color:#005500;font-family:sans"></textarea>
	
		<div style="height:18px;text-align:right;padding-bottom:1px;">
			<input type="button" value="Success" style="margin-top:1px;width:60px;height:15px;font-size:10px;
			background-color:#55ff55;border:solid;border-width:1px;border-color:#888888;" onclick="wk_success()">
			<input type="button" value="Forward" style="margin-top:1px;width:60px;height:15px;font-size:10px;
			background-color:#f6f645;border:solid;border-width:1px;border-color:#888888;" onclick="wk_forward()">
			<input type="button" value="Cancel" style="margin-top:1px;width:60px;height:15px;font-size:10px;
			background-color:#ff5555;border:solid;border-width:1px;border-color:#888888;" onclick="wk_cancel()">
		</div>
		<hr>	
		</td>
		
	</tr>


	</table>
</div>
<div style="position:relative;text-align:center;">
<button style="width:80px;" onclick="save_diary_entry()">Save</button>
<button style="width:80px;" onclick="cancel_diary_entry();">Cancel</button>
</div>
</form>
</div>

end_dv;

?>
