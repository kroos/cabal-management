<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_charge_auth extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function getAll($usernum)
			{
				return $this->db->get_where('cabal_charge_auth', array('UserNum' => $usernum));
			}

//UPDATE
		function update_acc($usernum, $type, $date, $servicekind)
			{
				return $this->db->where(array('UserNum' => $usernum))->update('cabal_charge_auth', array('Type' => $type, 'ExpireDate' => $date, 'ServiceKind' => $servicekind));
			}

//INSERT

//DELETE

#############################################################################################################################
	}
?>