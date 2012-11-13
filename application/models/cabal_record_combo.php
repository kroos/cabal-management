<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_record_combo extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function topcombo()
			{
				return $this->db->limit(50)->order_by('cntcombo DESC')->get('cabal_record_combo');
			}

			//UPDATE

//INSERT


//DELETE

#############################################################################################################################
	}
?>