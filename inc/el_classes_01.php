<?php
// Useful eLiveLearn Classes

//Page header
class el_header
{
	var $h_title;
	var $h_username;
	var $h_home;
	var $h_return;
	var $h_close;
	var $h_reload;
	var $h_msg;
	var $h_logo;
	var $h_date_time;
	var $h_check_save;  // prompt for save?

	function h_display() //alisasing display function
	{
		$this->display();
	}

	function display()
	{

	$f_logo = "<td align=\"center\" valign=\"top\"><img src=\"/el01/el01img/ellearn_h_logo.png\" alt=\"eLiveTrain - Online Training Diary\" width=\"100\" border=0 align=\"right\"></td>
		</tr>";
	$f_home ="<a href=\"/el01/el01_00.php\"><font size=\"-1\"><img src=\"/el01/el01img/home.jpg\" alt=\"[Home]\" border=\"0\"></font></a>";
	$f_return = "";
	$f_close = "";
	$f_reload = "";
	$f_date_time = "";
	$f_check_save = "0";  // prompt for save?

	if ($this->h_check_save == "t")
	{
		$f_check_save = "1";
	}

	if (($this->h_return == "t")||($this->h_return == ""))
	{
		$f_return = "<a href=\"javascript:return01($f_check_save)\"><img src=\"/el01/el01img/return-bs.jpg\" size=\"10\" alt=\"[Return]\" border=\"0\"></a>";
	}

	if ($this->h_close == "t")
	{
		$f_close = "<a href=\"javascript:close01($f_check_save);\"><img src=\"/el01/el01img/close-rs.jpg\" size=\"10\" alt=\"[Close]\" border=\"0\"></a>";
		$f_return = "";
	}

	if ($this->h_reload == "t")
	{
		$f_reload = "<span style=\"color:#880000;\">Click to view latest update --&gt;</span><a href=\"javascript:document.location.reload()\"><img src=\"/el01/el01img/reload-brs.jpg\" size=\"10\" alt=\"[Reload]\" border=\"0\"></a>";	}

	if ($this->h_home == "f")
	{
		$f_home = "";
	}

	if ($this->h_logo == "f")
	{
		$f_logo = "";
	}

	if ($this->h_date_time == "t")
	{
		$f_date_time = date("Y-m-d @  H:i:s");

	}
	
	$this->h_username = "";	

	if (isset($_SESSION["EL_loginname"]))
	{
		$this->h_username = $_SESSION["EL_loginname"];
	}

	print <<< endprint

	<script language="javascript">
	function check_save()
	{
		if (confirm("Have you saved the information before exiting?\\n OK to continue or Cancel and Save Data."))
		{
			this.close();
		}
	}

	function close01(chksave)
	{
		if (chksave == 1)
		{
	     if (confirm("Have you saved the information before exiting?\\n OK to continue or Cancel and Save Data."))
		   {
			   this.close();
		   }
		}
		else
		{
			this.close();
		}
	}

	function return01(chksave)
	{
		if (chksave == 1)
		{
	     if (confirm("Have you saved the information before exiting?\\n OK to continue or Cancel and Save Data."))
		   {
			   history.back();
		   }
		}
		else
		{
			history.back();
		}
	}

</script>

		<table width="100%">
		<tr>
		<td>$f_home</font></a><span style="color: #000080; font-size:10pt;padding-left:15pt;position:relative;top:-4px; color:##0000BD">User: $this->h_username</style>
		<td align="center"><span style="color: #000080; font-weight: bold;">$this->h_title</span></td>
		$f_logo
		</tr>
		<tr>
		<td><span style="color: #000080; font-size:10pt;">$f_date_time</span></td>
		<td colspan=2 align=right>
		<div align="right">
    		$f_reload &nbsp;&nbsp;$f_return $f_close
  		</div>
		</td>
		</table>
		<span style=font-size:10pt;>
		$this->h_msg
		</span>
		<hr>


endprint;

	}
}
}


class el_report
{
	var $r_title;
	var $r_msg;
	var $r_query_string;
	var $r_headings;
	var $r_fields;
	var $r_rec_page;
	var $r_rec_offset;
	var $r_script_name;
	var $r_printable;
	var $r_export_file;
	var $r_userid;
	//var $r_max_rec;
	
	//function
	function r_export_data(&$w_db, $w_query)
	{
		$w_userid = $_COOKIE["ELuserid"];
		
		$f1 = explode("/", $_SERVER["PHP_SELF"]);
		$f2 = explode(".",$f1[count($f1)-1]);
		$file_name = $f2[0]."_".$w_userid.".exported_data".".txt";
		
		$export_file = "/home/httpd/html/el01/el_user_files/".$w_userid."/$file_name";
		
		$f = fopen($export_file, "w+");
		
		$w_db->query($w_query);
		
		while ($w_db->next_record())
		{
			$f_string = "";
			foreach ($this->r_fields as $w_rf)
			{
				$f_string = $f_string.$w_db->f($w_rf).",";
			}
			
			fwrite($f, substr(trim($f_string),0, -1)."\n");
			
		}
		
		fclose($f);
		
		echo "<div style=\"font-size:14pt;color:#000099;\"> ";
		echo "<u>ALL</u> records for report have been exported to file:<p><b>".$file_name."</b><p>found in your file area and which you can access using the \"Manage Files\" option.<br>";
		echo "</div><hr>";
		
		
	}
	
	function r_generate(&$w_db)
	{
		
		$f_date_time = date("Y-m-d @  H:i:s");
		
		$t_css = "<link rel=stylesheet href=\"/el01/css/ts_09.css\" type=\"text/css\">";
		$p_url=$this->r_script_name."x_rec_page=1000&x_rec_offset=0&x_printable=1";
		$t_export_data = "<a href=$p_url&export_data=>[Export Data]</a>";
		$t_print_version = "<a href=$p_url>[Printable Version]</a>";
		$w_return_button = "<a href=\"javascript:history.back()\"><img src=\"/el01/el01img/return-bs.jpg\" width=55 alt=\"[Return]\" border=0></a>";
		
		if ($this->r_printable == 1)
		{
			$t_print_version=$t_export_data="";
			$t_css = "";
			$w_return_button = "<span style=\"font-size:8pt;\">Max 1000 Records shown. Click [Next Page] for more if necessary.</span>";
		}	

		
		print <<< endprint
		
		<!doctype public "-//w3c//dtd html 4.01 transitional//en" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
   		<META HTTP-EQUIV="Pragma" CONTENT="No-cache">
   		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   		<meta name="GENERATOR" content="Mozilla/4.7 [en] (X11; I; Linux 2.2.5-15 i686) [Netscape]">
   		<TITLE>Excelearn Report</TITLE>
   		$t_css
		</head>
		<style>
			body {
				font-size: 12pt;
					}
			table {
				font-size: 10pt;
					}
		</style>
		<body>
		<table width="100%">
		<tr>
		<td><span style="font-size:10pt;">Valid  on: $f_date_time</span></font></a></td>
		<td align="center"><span style="font-weight:bold;">$this->r_title</span></td>
		<td align="right"><img src="/el01/el01img/el01-00.jpg" alt="Excelearn - Online Learning Enironment" height=30 border=0 align="right"></td>
		</tr>
		<tr>
		<td><span style="font-weight:bold;">$this->r_msg</span></td>
		<td align=right colspan=2>
		 $t_export_data&nbsp;&nbsp$t_print_version&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 $w_return_button
		<!--a href="javascript:history.back()"><img src="/el01/el01img/return-bs.jpg" width=55 alt="[Return]" border=0></a--></td>
		</tr>
		</table>
		<hr>
		
endprint;

		if (isset($_GET["export_data"]))
		{
			$this->r_export_data(&$w_db, $this->r_query_string);
		}
		else
		{

	$w_offset = $this->r_rec_offset*$this->r_rec_page;
			
	$w_query = $this->r_query_string." limit ".$this->r_rec_page." offset ".$w_offset;
	
	//echo $w_query; die();

	
	$w_db->query($w_query);	
	
	 if ($w_db->num_rows() > 0)
	 {
			echo("<table width=100%>"); 
			$bg_color="#d3d3d3";
			echo("<th><span style=\"color:#888888;\">No</span></th>");
			foreach ($this->r_headings as $w_h)
			{
				echo("<th bgcolor='$bg_color'>".strtoupper($w_h)."</th>");
			}
			
			echo("<br>");
			
			/*$w_offset = $this->r_rec_offset*$this->r_rec_page;
			
			$w_query = $this->r_query_string." limit ".$this->r_rec_page." offset ".$w_offset; */
			
			$xf = $this->r_rec_offset +1;
			$w_url=$this->r_script_name."x_rec_page=".$this->r_rec_page;
			$w_url = $w_url."&x_rec_offset=".$xf;
			
			$t_prev_page = "";
			
			if ($this->r_rec_offset > 0)
			{
				$t_prev_page = "<a href=\"javascript:history.back()\">[Prev page]</a>";
			}	
			$t_next_page = "<a href=$w_url>[Next Page]</a>";
						
		    $w_db->query($w_query);
		 
		 //echo($this->r_query_string);
		
		$r_n = 0;
		$bg_color="#e3e3e3";
		 while ($w_db->next_record())
		 {
		 	echo("<tr>");
			
			$r_n = $r_n+1;
			echo("<td width=1% align=right><span style=\"color:#888888;\">$r_n:</span></td>");
			
		 	foreach ($this->r_fields as $w_rf)
			{
				$w_alignment = "center";
				echo("<td align=$w_alignment bgcolor='$bg_color'>".$w_db->f($w_rf)."</td>");
			}
			
			echo("</tr>");

			if ($bg_color=="#e3e3e3")
			{
				$bg_color="#d3d3d3";
			}
			else
			{
				$bg_color="#e3e3e3";
			}
		 }
		 
		 echo("</table>");
		 
		 echo "<br><hr><div style=\"text-align:right;font-size:10pt;\">$t_prev_page&nbsp;&nbsp;$t_next_page</div>";
		}
		else
		{
			 echo "<br><div style=\"text-align:center;font-size:12pt;font-weight:bold;\">No Record Found.</div><br><hr>";
			 $t_prev_page = "<a href=\"javascript:history.back()\">[Prev page]</a>";
		 echo "<br><div style=\"text-align:right;font-size:10pt;\">$t_prev_page</div>";
		}
		
		}	 
	}
}
	
?>

</body>
</html>
