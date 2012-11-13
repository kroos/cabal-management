<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabalweb_comment extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for a3web_comment
//SELECT
		function reply($id)
			{
				return $this->db->order_by('bil', 'ASC')->get_where('CabalWeb_Comment', array('bil_post' => $id));
			}

		function reply_edit($id)
			{
				return $this->db->get_where('CabalWeb_Comment', array('bil' => $id));
			}

//UPDATE
		function update_comment($bil, $html)
			{
				return $this->db->where(array('bil' => $bil))->update('CabalWeb_Comment', array('HTML' => $html, 'date' => mssqldate()));
			}

//INSERT
		function insert_news($author, $bil_post, $html)
			{
				return $this->db->insert('CabalWeb_Comment', array('author' => $author, 'bil_post' => $bil_post, 'html' => $html, 'date' => mssqldate()));
			}

//DELETE
		function delete_cabalweb($bil)
			{
				return $this->db->delete('CabalWeb_Comment', array('bil' => $bil));
			}


#############################################################################################################################
	}
?>