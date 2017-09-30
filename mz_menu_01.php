<?php

class mz_menu_01
{
	var $mz_menu_title[];
    var $h_username;
	var $h_home;
	var $h_return;
	var $h_close;
	var $h_reload;
	var $h_msg;
	var $h_logo;
	var $h_date_time;
	var $h_check_save;  // prompt for save?
	
	function menu_display() //alisasing display function
	{
		$this->display();
	}	
	
	function display()
	{
	
	$this->mz_menu_title[1]="Manage_Member_Records";
	$this->mz_menu_title[]="Manage_Membership";
	$this->mz_menu_title[]="Sysetm Admin";
			
	print <<< endprint	
	
	<script>document.getElementById("mz_menu01").innerHTML="Manage_Membership";</script>	

	<style>
	.mz_menu
	{
		background-color:#ededed;
		color: #000055;
		font-sze:14px;
		padding:3px;
		border-style: solid;
		border-right:solid;border-right-width:2px;
		border-left:solid;border-left-width:2px;
		border-color:#000000;
	}	
	</style>
	
	<div><span id="mz_menu01" class="mz_menu"></span></div>
	
	

		
endprint;

	}
}
