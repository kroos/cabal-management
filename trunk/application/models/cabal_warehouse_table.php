<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_warehouse_table extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function get_alz($usernum)
			{
				return $this->db->get_where('cabal_warehouse_table', array('UserNum' => $usernum));
			}

		function get_item($usernum)
			{
				return $this->db->query("exec cabal_tool_GetWarehouse $usernum");
			}

//UPDATE
		function update_alz($uid, $alz)
			{
				return $this->db->where(array('UserNum' => $uid))->update('cabal_warehouse_table', array('Alz' => $alz));
			}

//INSERT


//DELETE

#############################################################################################################################
	}
?>