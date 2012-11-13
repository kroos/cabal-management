<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_event_singledg extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function topsd($dn)
			{
				return $this->db->limit(50)->order_by('passTime ASC')->where(array('dungeounName' => $dn))->get('cabal_event_singledg');
			}

			//UPDATE

//INSERT


//DELETE

#############################################################################################################################
	}
?>