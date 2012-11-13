<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_instantwar_nationrewardwarresults extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT

		function war()
			{
				return $this->db->get('cabal_instantwar_nationrewardwarresults');
			}

		function procyonwin()
			{
				return $this->db->get_where('cabal_instantwar_nationrewardwarresults', array('ProcyonWin' => 1));
			}

		function capellawin()
			{
				return $this->db->get_where('cabal_instantwar_nationrewardwarresults', array('CapellaWin' => 1));
			}

//UPDATE

//INSERT


//DELETE

#############################################################################################################################
	}
?>