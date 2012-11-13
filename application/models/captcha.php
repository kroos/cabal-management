<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//SELECT
	function captcha($verify, $expiration)
		{
			return $this->db->get_where('Captcha', array('word' => $verify, 'ip_address' => $this->input->ip_address(), 'captcha_time >' => $expiration ));
		}

//UPDATE

//INSERT
	function insert_captcha($time, $word)
		{
			$data = array
						(
							'captcha_time' => $time,
							'ip_address' => $this->input->ip_address(),
							'word' => $word
						);
			return $this->db->insert('Captcha', $data );
		}

//DELETE
	function delete_captcha($expiration)
		{
			return $this->db->delete('Captcha', array('captcha_time <' => $expiration));
		}
#############################################################################################################################
	}
?>