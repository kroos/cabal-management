<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends CI_Model 
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
				return $this->db->query('exec GetBankAlz '.$usernum.'');
			}

//UPDATE
		function update_alz($usernum, $alz)
			{
				//return $this->db->where(array('UserNum' => $usernum))->update('bank', array('Alz' => $alz));
				return $this->db->query('exec SetBankAlz '.$usernum.', '.$alz.'');
			}


//INSERT

//DELETE

#############################################################################################################################
	}
?>