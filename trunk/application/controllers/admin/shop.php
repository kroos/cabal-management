<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller
	{
#############################################################################################################################

		public function home()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						$cate = $this->uri->segment(4, 0);
						//process
						$data['cats'] = $this->config->item('cats');
						$this->load->database('CASHSHOP', TRUE);
						$data['query'] = $this->shopitems->shop($cate);

						//echo  $cate.' 1<br />';
						if ($cate == 0)
							{
								// make sure array pointer is at first element
								reset($this->config->item('cats'));

								$firstKey = key($this->config->item('cats')); 
								$cate = $firstKey;
								redirect('admin/shop/home'.'/'.$cate, 'location');
							}

							$this->load->view('admin/shop', $data);
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function add_item()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$data['cats'] = $this->config->item('cats');
								$data['idur'] = $this->config->item('idur');
								$this->load->view('admin/add_item', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('add_item', TRUE))
									{
										$iname = $this->input->post('item_name', TRUE);
										$idesc = $this->input->post('item_desc', TRUE);
										$iid = $this->input->post('item_id', TRUE);
										$iopt = $this->input->post('item_opt', TRUE);
										$idura = $this->input->post('iduration', TRUE);
										$iimg = $this->input->post('item_img', TRUE);
										$ialz = $this->input->post('item_alz', TRUE);
										$icat = $this->input->post('item_cat', TRUE);
										$iavail = $this->input->post('item_avail', TRUE);

										$this->load->database('CASHSHOP', TRUE);
										$t = $this->shopitems->insert_items($iname, $idesc, $iid, $iopt, $idura, $iimg, $ialz, $icat, $iavail);
										if (!$t)
											{
												$data['cats'] = $this->config->item('cats');
												$data['idur'] = $this->config->item('idur');
												$data['info'] = 'Please try again. Cant add the item';
												$this->load->view('admin/add_item', $data);
											}
											else
											{
												$data['cats'] = $this->config->item('cats');
												$data['idur'] = $this->config->item('idur');
												$data['info'] = 'Adding the item complete';
												$this->load->view('admin/add_item', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function edit_item()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$cate = $this->uri->segment(4, 0);
						$item = $this->uri->segment(5, 0);

						if (is_numeric($cate) && is_numeric($item))
							{
								$this->load->database('CASHSHOP', TRUE);
								$data['edit'] = $this->shopitems->getAll($item, $cate);
								if ($data['edit']->num_rows() == 1)
									{
										$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
										if ($this->form_validation->run() == FALSE)
											{
												//form
												$data['edit'] = $this->shopitems->getAll($item, $cate);
												$data['cats'] = $this->config->item('cats');
												$data['idur'] = $this->config->item('idur');
												$this->load->view('admin/edit_item', $data);
											}
											else
											{
												//form processor
												if ($this->input->post('edit_item', TRUE))
													{
														$iname = $this->input->post('item_name', TRUE);
														$idesc = $this->input->post('item_desc', TRUE);
														$iid = $this->input->post('item_id', TRUE);
														$iopt = $this->input->post('item_opt', TRUE);
														$idura = $this->input->post('iduration', TRUE);
														$iimg = $this->input->post('item_img', TRUE);
														$ialz = $this->input->post('item_alz', TRUE);
														$icat = $this->input->post('item_cat', TRUE);
														$iavail = $this->input->post('item_avail', TRUE);

														$y = $this->shopitems->update_items($item, $iname, $idesc, $iid, $iopt, $idura, $iimg, $ialz, $icat, $iavail);
														if(!$y)
															{
																$data['info'] = 'Please try again. Cant udpate the item';
																$this->load->view('admin/edit_item', $data);
															}
															else
															{
																redirect ('admin/shop/edit_item/'.$icat.'/'.$item, 'location');
															}
													}
											}
									}
									else
									{
										redirect(base_url(), 'location');
									}
							}
							else
							{
								redirect(base_url(), 'location');
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function del_item()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						$cate = $this->uri->segment(4, 0);
						$item = $this->uri->segment(5, 0);
						if (is_numeric($cate) && is_numeric($item))
							{
								$this->load->database('CASHSHOP', TRUE);
								$d = $this->shopitems->del_items($item);
								if (!$d)
									{
										
									}
									else
									{
										redirect('admin/shop/home/'.$cate, 'location');
									}
							}
							else
							{
								redirect(base_url(), 'location');
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

#############################################################################################################################
		public function logout()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$array = array 
								(
									'usernum' => '',
									'authkey' => '',
									'username' => '',
									'password' => '',
									'group' => '',
									'logged_in' => FALSE,
								);
						$this->session->unset_userdata($array);
						redirect('', 'location');
					}
					else
					{
						redirect('', 'location');
					}
			}
#############################################################################################################################
//function template
/*
		public function home()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
							}
							else
							{
								//form processor
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}
//*/
#############################################################################################################################
//error 404
		public function page_missing()
			{
				$this->load->view('errors/error_custom_404');
			}

#############################################################################################################################
	}

/* End of file shop.php */
/* Location: ./application/controllers/shop.php */