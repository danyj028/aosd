<?php

include "./inc/mz_user_classes.php";
include "./inc/connect_to_db.php";

$w_search_key = urldecode($_REQUEST["x_search_key"]);
$w_st = urldecode($_REQUEST["x_st"]);


$mz_member = new mz_user;

$mz_member->mz_get_user($w_search_key, $w_st, $mz_db)


?>


