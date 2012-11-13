<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
##################################################################################################

//form validation through controller
//format
/*
$config = array	( 
					'controller/function' => array
					( 
						array
							(
								'field' => 'login',
								'label' => 'Login',
								'rules' => 'trim|required|min_length[6]|max_length[12]|xss_clean'
							)
					)
				);
*/
##################################################################################################

$config = array	( 
					'cabal/login' => array
					( 
						array
							(
								'field' => 'username',
								'label' => 'Username',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
							array
							(
								'field' => 'passwd',
								'label' => 'Password',
								'rules' => 'trim|required|min_length[4]|max_length[10]|alpha_numeric|xss_clean'
							)
					),
					'cabal/register' => array
					(
						array
							(
								'field' => 'username',
								'label' => 'Username',
								'rules' => 'trim|callback_username_check|required|min_length[6]|max_length[10]|is_unique[cabal_auth_table.ID]|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'password1',
								'label' => 'Password',
								'rules' => 'trim|required|matches[password2]|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'password2',
								'label' => 'Retype Password',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'email',
								'label' => 'Email',
								'rules' => 'trim|required|valid_email|min_length[6]|is_unique[cabal_auth_table.Email]|xss_clean'
							),
						array
							(
								'field' => 'verify',
								'label' => 'Image Verification',
								'rules' => 'trim|required|min_length[5]|max_length[5]|is_natural|xss_clean'
							)
					),
					'cabal/resetp' => array
					(
						array
							(
								'field' => 'username',
								'label' => 'Username',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'email',
								'label' => 'Email',
								'rules' => 'trim|required|valid_email|min_length[6]|xss_clean'
							)
					),
					'cabal/topsd' => array
					(
						array
							(
								'field' => 'dungeon',
								'label' => 'Dungeon',
								'rules' => 'trim|required|min_length[6]|xss_clean'
							)
					),
					'cabal/topgd' => array
					(
						array
							(
								'field' => 'dungeon',
								'label' => 'Dungeon',
								'rules' => 'trim|required|min_length[6]|xss_clean'
							)
					),
					//user part
					//tricky part overhere
					'cabal/index' => array
					(
						array
							(
								'field' => 'bil_post',
								'label' => 'Post',
								'rules' => 'trim|required|numeric|xss_clean'
							),
						array
							(
								'field' => 'news_reply',
								'label' => 'News Reply',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Author',
								'rules' => 'trim|required|min_length[2]|xss_clean'
							)
					),
					'cabal/download' => array
					(
						array
							(
								'field' => 'bil_post',
								'label' => 'Bil Post',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'news_reply',
								'label' => 'Reply Section',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|min_length[2]|max_length[12]|xss_clean'
							)
					),
					'cabal/event' => array
					(
						array
							(
								'field' => 'bil_post',
								'label' => 'Bil Post',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'news_reply',
								'label' => 'Reply Section',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|min_length[2]|max_length[12]|xss_clean'
							)
					),
					'cabal/reply' => array
					(
						array
							(
								'field' => 'edit_news',
								'label' => 'Edit Reply',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							)
					),
					'cabal/change_password' => array
					( 
						array
							(
								'field' => 'username',
								'label' => 'Username',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
							array
							(
								'field' => 'currpasswd',
								'label' => 'Current Password',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							),
							array
							(
								'field' => 'newpasswd',
								'label' => 'New Password',
								'rules' => 'trim|required|min_length[6]|matches[rnewpasswd]|callback_old_password_check|max_length[10]|alpha_numeric|xss_clean'
							),
							array
							(
								'field' => 'rnewpasswd',
								'label' => 'Retype New Password',
								'rules' => 'trim|required|min_length[6]|max_length[10]|alpha_numeric|xss_clean'
							)
					),
					'cabal/rebirth' => array
					(
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|min_length[2]|numeric|xss_clean'
							)
					),
					'cabal/reset_rebirth' => array
					(
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|min_length[2]|numeric|xss_clean'
							)
					),
					'shop/index' => array
					(
						array
							(
								'field' => 'usernum',
								'label' => 'UserNum',
								'rules' => 'trim|required|is_natural_no_zero|xss_clean'
							),
						array
							(
								'field' => 'authkey',
								'label' => 'AuthKey',
								'rules' => 'trim|required|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'category',
								'label' => 'Category',
								'rules' => 'trim|required|is_natural_no_zero|xss_clean'
							),
						array
							(
								'field' => 'item',
								'label' => 'Character',
								'rules' => 'trim|required|is_natural_no_zero|xss_clean'
							),
					),
					//admin part
					'cabal/editing_news' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'news_add',
								'label' => 'News',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/news_edit' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'news_edit',
								'label' => 'News',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/editing_download' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'download_add',
								'label' => 'Download',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/download_edit' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'download_edit',
								'label' => 'Download',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/editing_event' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'event_add',
								'label' => 'Event',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/event_edit' => array
					(
						array
							(
								'field' => 'subject',
								'label' => 'Subject',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'event_edit',
								'label' => 'Event',
								'rules' => 'trim|required|min_length[10]|prep_for_form|encode_php_tags|xss_clean'
							),
						array
							(
								'field' => 'character',
								'label' => 'Character',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/info_account' => array
					(
						array
							(
								'field' => 'char',
								'label' => 'Character',
								'rules' => 'trim|required|alpha_numeric|xss_clean'
							)
					),
					'cabal/edit_account' => array
					(
						array
							(
								'field' => 'char',
								'label' => 'Character',
								'rules' => 'trim|required|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'type',
								'label' => 'Account Type',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'servicekind',
								'label' => 'Account Service Kind',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'date',
								'label' => 'Expire Date',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/ban_account' => array
					(
						array
							(
								'field' => 'char',
								'label' => 'Character',
								'rules' => 'trim|required|alpha_numeric|xss_clean'
							),
						array
							(
								'field' => 'date',
								'label' => 'Expiry Date',
								'rules' => 'trim|required|xss_clean'
							)
					),
					'cabal/char_stats_search' => array
					(
						array
							(
								'field' => 'char',
								'label' => 'Character',
								'rules' => 'trim|required|alpha_numeric|xss_clean'
							)
					),
					'cabal/char_stats' => array
					(
						array
							(
								'field' => 'str',
								'label' => 'Strength',
								'rules' => 'trim|required|is_natural|max_length[7]|xss_clean'
							),
						array
							(
								'field' => 'dex',
								'label' => 'Dexterity',
								'rules' => 'trim|required|is_natural|max_length[7]|xss_clean'
							),
						array
							(
								'field' => 'int',
								'label' => 'Intelligence',
								'rules' => 'trim|required|is_natural|max_length[7]|xss_clean'
							),
						array
							(
								'field' => 'pnt',
								'label' => 'Extra Points',
								'rules' => 'trim|required|is_natural|max_length[7]|xss_clean'
							),
						array
							(
								'field' => 'rnk',
								'label' => 'Rank',
								'rules' => 'trim|required|is_natural|max_length[15]|xss_clean'
							),
						array
							(
								'field' => 'alz',
								'label' => 'Alz',
								'rules' => 'trim|required|is_natural|max_length[15]|xss_clean'
							),
						array
							(
								'field' => 'style',
								'label' => 'Style',
								'rules' => 'trim|required|is_natural|max_length[15]|xss_clean'
							),
						array
							(
								'field' => 'wc',
								'label' => 'Warp Code',
								'rules' => 'trim|required|is_natural|max_length[4]|xss_clean'
							),
						array
							(
								'field' => 'mc',
								'label' => 'Map Code',
								'rules' => 'trim|required|is_natural|max_length[4]|xss_clean'
							),
						array
							(
								'field' => 'rp',
								'label' => 'RP',
								'rules' => 'trim|required|is_natural|max_length[15]|xss_clean'
							),
						array
							(
								'field' => 'reput',
								'label' => 'Reputation',
								'rules' => 'trim|required|is_natural|max_length[15]|xss_clean'
							),
						array
							(
								'field' => 'nat',
								'label' => 'Nation',
								'rules' => 'trim|required|is_natural|max_length[2]|xss_clean'
							),
						array
							(
								'field' => 'rb',
								'label' => 'Rebirth',
								'rules' => 'trim|required|is_natural|max_length[2]|xss_clean'
							),
						array
							(
								'field' => 'rs',
								'label' => 'Reset',
								'rules' => 'trim|required|is_natural|max_length[2]|xss_clean'
							)
					),
					'shop/add_item' => array
					(
						array
							(
								'field' => 'item_name',
								'label' => 'Item Name',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'item_desc',
								'label' => 'Item Description',
								'rules' => 'trim|xss_clean'
							),
						array
							(
								'field' => 'item_id',
								'label' => 'Item Id',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_opt',
								'label' => 'Item Option',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'iduration',
								'label' => 'Duration',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_img',
								'label' => 'Item Image',
								'rules' => 'trim|xss_clean'
							),
						array
							(
								'field' => 'item_alz',
								'label' => 'Item Alz Cost',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_cat',
								'label' => 'Item Category',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_avail',
								'label' => 'Item Available',
								'rules' => 'trim|required|is_natural|xss_clean'
							)
					),
					'shop/edit_item' => array
					(
						array
							(
								'field' => 'item_name',
								'label' => 'Item Name',
								'rules' => 'trim|required|xss_clean'
							),
						array
							(
								'field' => 'item_desc',
								'label' => 'Item Description',
								'rules' => 'trim|xss_clean'
							),
						array
							(
								'field' => 'item_id',
								'label' => 'Item Id',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_opt',
								'label' => 'Item Option',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'iduration',
								'label' => 'Duration',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_img',
								'label' => 'Item Image',
								'rules' => 'trim|xss_clean'
							),
						array
							(
								'field' => 'item_alz',
								'label' => 'Item Alz Cost',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_cat',
								'label' => 'Item Category',
								'rules' => 'trim|required|is_natural|xss_clean'
							),
						array
							(
								'field' => 'item_avail',
								'label' => 'Item Available',
								'rules' => 'trim|required|is_natural|xss_clean'
							)
					),
				);

/* End of file form_validator.php */
/* Location: ./application/config/form_validator.php */
