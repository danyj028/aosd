<?php

include("../el_tools/fckeditor/fckeditor.php") ;
//include("/FCKeditor/fckeditor.php") ;

function el_fckedit($w_name, $w_width, $w_height, $w_answer)
{
	
	$browser = get_browser(null, true);
	
	//check browser stuff! 
	$w_browser = get_browser(null, true);
	
	foreach ($w_browser as $name => $value)
	{
//		echo "<b>$name:</b> $value <br />\n";
		$w_browser_a[$name] = $value;
	} 

	$w_display_text = $w_answer;
	
	if (in_array(strtoupper($w_browser_a["browser"]), array("IE","FIREFOX","MOZILLA")))
	{
	
		if (!strpos($w_answer, "<br")) //check already has <br in string!
		{
		
		$w_bb = strtoupper($w_browser_a["browser"]);
		$w_bv = $w_browser_a["version"]* 1.0;
		
		
		if (!strcmp($w_bb,"IE")&&($w_bv > 5.0))
		{
			$w_display_text = nl2br($w_answer);
		}
		else
		{
			if (!strcmp($w_bb,"FIREFOX"))
			{
				$w_display_text = nl2br($w_answer);
			}
			else
			{
				if ((!strcmp($w_bb,"MOZILLA"))&&($w_bv > 1.0))
				{
					$w_display_text = nl2br($w_answer);
				}
			}			
		}
	}
	}
	else
	{
	print <<< endprint
	<script language="javascript">
		alert("You are using a browser that may not work well with the on-line editor.\\nIt  is preferable that you upgrade your browser.");
	</script>
endprint;
	}
	
	$sBasePath = "/el01/el_tools/fckeditor/";
	//$oFCKeditor = new FCKeditor('x_answer') ;
	$oFCKeditor = new FCKeditor($w_name) ;
	$oFCKeditor->Width 		= $w_width ;
	$oFCKeditor->Height		= $w_height;
	$oFCKeditor->BasePath	= $sBasePath ;
	$oFCKeditor->Value		= $w_display_text ;
	$oFCKeditor->Create(); 
}

?>