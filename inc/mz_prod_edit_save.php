<?php

require_once "connect_to_db1.php";

$w_service_array = array();

$w_userid = urldecode($_REQUEST["x_userid"]);
//$w_userid = "10032";
//$w_scount = urldecode($_REQUEST["x_service_count"]);
$w_scount = 11;

$w_area_array[]="-99";

$w_area_array_list=[0,1,2,3,4,5,6,7,8,10,9,11];

$k=1;
for ($k==1;$k<=$w_scount;$k++)
{
	
	$w_area_btn="ab".$k;
	
	if (isset($_REQUEST[$w_area_btn]))
	{
		$w_btnv = $_REQUEST[$w_area_btn];
		$w_area_array[]=$w_area_array_list[$k];
	}	
}

$w_ar_count= count($w_area_array);

$k2=0;

// delete existing entries for user if present.
$w_query0 = "delete from mz_user_service_area where user_id = '$w_userid'";
$w_query02= "delete from mz_user_service_2 where user_id = '$w_userid'";

$mz_db->beginTransaction();
$w_stm0 = $mz_db->prepare($w_query0);
$w_stm0->execute();
$w_stm0 = $mz_db->prepare($w_query02);
$w_stm0->execute();
$mz_db->commit();


$mz_db->beginTransaction();

for ($k2==0;$k2<$w_ar_count;$k2++)
{
//Save data
$w_query = "insert into mz_user_service_area values($w_userid, $w_area_array[$k2])";
$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

}

$mz_db->commit();


//Save key words

$k3=1;

for ($k3==1;$k3<=20;$k3++)
{
	$w_kw_ndx="p".$k3;
		
	if (trim(urldecode($_REQUEST[$w_kw_ndx] !== "")))
	{
	   $w_key_word[] = trim(urldecode($_REQUEST[$w_kw_ndx]));
	}  
}

$w_nkw = count($w_key_word);

$k4=0;

$mz_db->beginTransaction();

for ($k4==0;$k4<$w_nkw;$k4++)
{
	//echo $w_key_word[$k4].";    ";
	$w_l_key_word = strtolower($w_key_word[$k4]);
	
	$w_query1 = "select * from mz_service_key where service_title = '$w_l_key_word'";
	
	//echo $w_query1."<br>";
	
	$w_stm = $mz_db->prepare($w_query1);
	$w_stm->execute();
	
	$w_rec = $w_stm->fetch(PDO::FETCH_ASSOC);
	
	if  (isset($w_rec) && $w_rec > 0)
	{
		$w_service_id = $w_rec["service_id"];
		
		$w_query2="insert into mz_user_service_2 values('$w_userid', $w_service_id)";
		//echo $w_query2." aa <br>";
		$w_stm = $mz_db->prepare($w_query2);
		$w_stm->execute();
	}
	else
	{
		
		$w_query3 = "select max(service_id) as nlv from mz_service_key";
		$w_query4 = "insert into mz_service_key values('$w_l_key_word', default)";
					
		$w_stm3 = $mz_db->prepare($w_query3);
		$w_stm3->execute();
		$w_rec3 = $w_stm3->fetch(PDO::FETCH_ASSOC);
		$w_service_id = $w_rec3["nlv"] + 1;
		
		$w_query2="insert into mz_user_service_2 values('$w_userid', $w_service_id)";
		//echo $w_query2."  b <br>";
		$w_stm = $mz_db->prepare($w_query2);
		$w_stm->execute();
		
		$w_stm4 = $mz_db->prepare($w_query4);
		$w_stm4->execute();
		 
	}	
	
}	
$mz_db->commit();

echo "Data saved";
?>
