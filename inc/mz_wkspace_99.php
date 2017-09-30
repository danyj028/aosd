<?php

if (isset($_REQUEST["x_wkspace"]))
{
$w_wkspace = urldecode($_REQUEST["x_wkspace"]);

switch ($w_wkspace) {
	
	case 127:
	include "./mz_do_wkspace_127.php";
	break;
	
	case 131:
	include "./mz_do_wkspace_131.php";
	break;

	case 132:
	include "./mz_do_wkspace_132.php";
	break;
	
	case 133:
	include "./mz_do_wkspace_133.php";
	break;
	}	
}
?>
