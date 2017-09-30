<?php

include "./inc/mz_user_classes.php";
include "./inc/connect_to_db.php";

$w_id = trim(urldecode($_REQUEST["x_id"]));
$w_status = substr(trim(urldecode($_REQUEST["x_status"])),0,1);

$w_query = "update mzuser set rec_status = '$w_status' where id = '$w_id' ";

$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

echo $w_status;

?>


