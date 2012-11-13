<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shopitems extends CI_Model 
	{
		function __construct()
			{
				parent::__construct();
			}
#############################################################################################################################
//CRUD for temp_account
//SELECT
		function shop($cats)
			{
				return $this->db->get_where('ShopItems', array('Category' => $cats));
			}

		function item($item)
			{
				return $this->db->get_where('ShopItems', array('Id' => $item));
			}

		function getAll($id, $cate)
			{
				return $this->db->get_where('ShopItems', array('Id' => $id, 'Category'=> $cate));
			}


//UPDATE
		function update_item($id, $unit)
			{
				return $this->db->where(array('Id' => $id))->update('ShopItems', array('Available' => $unit));
			}

		function update_items($item, $iname, $idesc, $iid, $iopt, $idura, $iimg, $ialz, $icat, $iavail)
			{
				$data = array
							(
								'Name' => $iname,
								'Description' => $idesc,
								'ItemIdx' => $iid,
								'DurationIdx' => $idura,
								'ItemOpt' => $iopt,
								'Image' => $iimg,
								'Honour' => 0,
								'Alz' => $ialz,
								'Category' => $icat,
								'Available' => $iavail
							);
				return $this->db->where(array('Id' => $item))->update('ShopItems', $data);
			}


//INSERT
		function insert_items($iname, $idesc, $iid, $iopt, $idura, $iimg, $ialz, $icat, $iavail)
			{
				$data = array
							(
								'Name' => $iname,
								'Description' => $idesc,
								'ItemIdx' => $iid,
								'DurationIdx' => $idura,
								'ItemOpt' => $iopt,
								'Image' => $iimg,
								'Honour' => 0,
								'Alz' => $ialz,
								'Category' => $icat,
								'Available' => $iavail
							);
				return $this->db->insert('ShopItems', $data);
			}
//DELETE
		function del_items($item)
			{
				return $this->db->delete('ShopItems', array('Id' => $item));
			}

#############################################################################################################################
	}
?>