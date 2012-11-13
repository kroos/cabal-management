<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_auth_table extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function account()
			{
				return $this->db->get('cabal_auth_table');
			}

		function online()
			{
				return $this->db->get_where('cabal_auth_table', array('Login' => 1));
			}

		function account_user($username, $password)
			{
				return $this->db->get_where('cabal_auth_table', array('ID' => $username, 'Password' => md5($password)));
			}

		function account_email($username, $email)
			{
				return $this->db->get_where('cabal_auth_table', array('ID' => $username, 'Email' => $email));
			}

		function account_uid($username)
			{
				return $this->db->get_where('cabal_auth_table', array('ID' => $username));
			}

		function account_mail($mail)
			{
				return $this->db->get_where('cabal_auth_table', array('Email' => $mail));
			}

		function webshop($v1, $v2)
			{
				return $this->db->where(array('UserNum' => $v1, 'AuthKey' => $v2))->get('cabal_auth_table');
			}

		function find_acc($v1)
			{
				return $this->db->where(array('UserNum' => $v1))->get('cabal_auth_table');
			}

		function list_ban()
			{
				return $this->db->where(array('AuthType <>' => 1))->get('cabal_auth_table');
			}


//UPDATE
		function update_resetp($username, $email, $password)
			{
				return $this->db->where(array('ID' => $username, 'Email' => $email))->update('cabal_auth_table', array('Password' => md5($password)));
			}

		function update_idpasswd($username, $password)
			{
				return $this->db->where(array('usernum' => $this->session->userdata('usernum')))->update('cabal_auth_table', array('Password' => md5($password), 'ID' => $username));
			}

		function ban_user($usernum, $date)
			{
				return $this->db->query('exec cabal_tool_RegisterBlockUser '.$usernum.', "'.$date.'", 2');
			}

		function unban_user($usernum)
			{
				return $this->db->query('exec cabal_tool_ReleaseBlockUser '.$usernum.'');
			}


//INSERT
		function activate($uid, $pass, $email)
			{
				return $this->db->query("exec cabal_tool_registerAccount '$uid', '$pass', '$email'");
			}

//DELETE

#############################################################################################################################
	}
?>