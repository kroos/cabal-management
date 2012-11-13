<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mycashitem extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT


//UPDATE



//INSERT
		function buy($v1, $itemidx, $itemopt, $durationidx)
			{
				return $this->db->query("exec up_addmycashitem '".$v1."','1','".$this->config->item('svridx')."','".$itemidx."','".$itemopt."','".$durationidx."'");
			}
//DELETE

#############################################################################################################################
	}
?>