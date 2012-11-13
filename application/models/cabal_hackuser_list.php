<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_hackuser_list extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function get_all()
			{
				return $this->db->order_by('registerDate DESC')->get('cabal_hackuser_list');
			}

//UPDATE

//INSERT

//DELETE
		function del_all()
			{
				return $this->db->empty_table('cabal_hackuser_list');
			}

#############################################################################################################################
	}
?>