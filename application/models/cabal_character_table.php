<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal_character_table extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function character()
			{
				return $this->db->get('cabal_character_table');
			}

		function topchar()
			{
				return $this->db->limit(50)->order_by('Reset DESC, Rebirth DESC, LEV DESC, Reputation DESC')->get('cabal_character_table');
			}

		function online_player()
			{
				return $this->db->order_by('LoginTime DESC')->get_where('cabal_character_table', array('Login >' => 0));
			}

		function charid($charid)
			{
				return $this->db->get_where('cabal_character_table', array('CharacterIdx' => $charid));
			}

		function channel_status($charid)
			{
				return $this->db->get_where('cabal_character_table', array('ChannelIdx' => $charid, 'Login' => 1));
			}

		function online($v1)
			{
				return $this->db->where("CharacterIdx between ($v1 * 8) and ($v1 * 8 + 5) AND Login <> 0")->get('cabal_character_table');
			}

		function gm($v1)
			{
				return $this->db->where("CharacterIdx between ($v1 * 8) and (($v1 * 8) + 5) AND Nation = 3")->get('cabal_character_table');
			}

		function charuser($v1)
			{
				return $this->db->where("CharacterIdx between ($v1 * 8) and (($v1 * 8) + 5)")->get('cabal_character_table');
			}

		function charb($char)
			{
				return $this->db->where(array('Name' => $char))->get('cabal_character_table');
			}


//UPDATE
		function update_rebirth($char, $rb)
			{
				return $this->db->where(array('CharacterIdx' => $char))->update('cabal_character_table', array('LEV' => 1, 'EXP' => 0, 'Rebirth' => $rb));
			}

		function update_reset_rebirth($char, $times_rb)
			{
				return $this->db->where(array('CharacterIdx' => $char))->update('cabal_character_table', array('Rebirth' => 0, 'Reset' => $times_rb));
			}

		function update_offline($charid)
			{
				return $this->db->where(array('CharacterIdx' => $charid))->update('cabal_character_table', array('Login' => 0));
			}

		function update_char($charidx, $str, $dex, $int, $pnt, $rnk, $alz, $style, $wc, $mc, $rp, $reput, $nat, $rb, $rs)
			{
				$data = array
							(
								'STR' => $str,
								'DEX' => $dex,
								'INT' => $int,
								'PNT' => $pnt,
								'Rank' => $rnk,
								'Alz' => $alz,
								'Style' => $style,
								'WarpBField' => $wc,
								'MapsBField' => $mc,
								'RP' => $rp,
								'Reputation' => $reput,
								'Nation' => $nat,
								'Rebirth' => $rb,
								'Reset' => $rs
							);
				return $this->db->where(array('CharacterIdx' => $charidx))->update('cabal_character_table', $data);
			}

//INSERT


//DELETE

#############################################################################################################################
	}
?>