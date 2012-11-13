<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabalweb_html extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for a3web_html
//SELECT
	function news()
		{
			return $this->db->order_by('Date', 'DESC')->get_where('CabalWeb_HTML', array('Category' => 'NEWS'));
		}

	function download()
		{
			return $this->db->order_by('Date', 'DESC')->get_where('CabalWeb_HTML', array('Category' => 'DOWNLOAD'));
		}

	function event()
		{
			return $this->db->order_by('Date', 'DESC')->get_where('CabalWeb_HTML', array('Category' => 'EVENT'));
		}

	function cabalweb_id($id)
		{
			return $this->db->order_by('Date', 'DESC')->get_where('CabalWeb_HTML', array('Bil' => $id));
		}

//UPDATE
	function update_cabalweb($bil, $html, $subject, $char)
		{
			return $this->db->where(array('bil' => $bil))->update('CabalWeb_HTML', array('HTML' => $html, 'Subject' => $subject, 'Author' => $char, 'Date' => mssqldate()));
		}

//INSERT
	function insert_news($author, $subject, $html)
		{
			return $this->db->insert('CabalWeb_HTML', array('Author' => $author, 'Category' => 'NEWS', 'Subject' => $subject, 'HTML' => $html, 'Date' => mssqldate()));
		}

	function insert_download($author, $subject, $html)
		{
			return $this->db->insert('CabalWeb_HTML', array('Author' => $author, 'Category' => 'DOWNLOAD', 'Subject' => $subject, 'HTML' => $html, 'Date' => mssqldate()));
		}

	function insert_event($author, $subject, $html)
		{
			return $this->db->insert('CabalWeb_HTML', array('Author' => $author, 'Category' => 'EVENT', 'Subject' => $subject, 'HTML' => $html, 'Date' => mssqldate()));
		}

//DELETE
	function delete_cabalweb($bil)
		{
			return $this->db->delete('CabalWeb_HTML', array('bil' => $bil));
		}


#############################################################################################################################
	}
?>