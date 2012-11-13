<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends CI_Controller
	{
#############################################################################################################################

		public function index()
			{
				//process
				$v1 = $this->uri->segment(3, 0);
				$v2 = $this->uri->segment(4, 0);
				$cate = $this->uri->segment(5, 0);
				
				//echo $v1.'<br />'.$v2.'<br />'.$cate.'<br />';
				if (!is_numeric($v1) && !ctype_alnum($v2) && !is_numeric($cate))
					{
						//if unauthorised, go to this location
						if ($this->session->userdata('logged_in') == TRUE)
							{
								redirect('', 'location');
							}
							else
							{
								redirect('http://cabalclose', 'location');
							}
					}
					else
					{
						//authenticate
						$this->load->database('ACCOUNT', TRUE);
						$g = $this->cabal_auth_table->webshop($v1, $v2);

						if ($g->num_rows() == 1)
							{
								//display all from the shopitem table
								$this->load->database('CASHSHOP', TRUE);
								$data['query'] = $this->shopitems->shop($cate);
								$data['cats'] = $this->config->item('cats');

								//just wanna redirect to 1st key. skip this if $cate not 0
								if ($cate == 0)
									{
										// make sure array pointer is at first element
										reset($this->config->item('cats'));

										$firstKey = key($this->config->item('cats')); 
										$cate = $firstKey;
										redirect('shop/index/'.$v1.'/'.$v2.'/'.$cate, 'location');
									}

								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										//form
										$this->load->view('user/shop', $data);
									}
									else
									{
										//form processor
										if ($this->input->post('buy', TRUE))
											{
												$v11 = $this->input->post('usernum', TRUE);
												$v22 = $this->input->post('authkey', TRUE);
												$catee = $this->input->post('category', TRUE);
												$itemm = $this->input->post('item', TRUE);
												//echo $v11.' = v1<br />'.$v22.' = v2<br />'.$catee.' = cate<br />'.$itemm.' = item<br />';

												$this->load->database('ACCOUNT', TRUE);
												$g = $this->cabal_auth_table->webshop($v11, $v22);

												if ($g->num_rows() == 1)
													{
														$this->load->database('CASHSHOP', TRUE);
														$rt = $this->shopitems->getAll($itemm, $catee)->num_rows();
														if ($rt == 1)
															{
																$this->load->database('CASHSHOP', TRUE);
																$e = $this->shopitems->item($itemm)->row();
																$itemidx = $e->ItemIdx;
																$itemopt = $e->ItemOpt;
																//echo $itemopt.' = itemopt<br />';
																$durationidx = $e->DurationIdx;
																$avail = $e->Available;
																//echo $avail.' = avail<br />';
																$alz = $e->Alz;
																//echo $alz.' = alz<br />';

																$this->load->database('CASHSHOP', TRUE);
																$alzbank = $this->bank->get_alz($v11)->row()->Alz;
																//echo $alzbank.' = alzbank<br />';

																//must check the alz b4 purchasing
																if ($alzbank >= $alz)
																	{
																		$this->load->database('CABALCASH', TRUE);
																		//gives the item to the account
																		$t = $this->mycashitem->buy($v11, $itemidx, $itemopt, $durationidx);

																		//substract 1 from the invemtory of shop
																		$unit = $avail - 1;
																		//echo $unit.' = unit<br />';
																		$this->load->database('CASHSHOP', TRUE);
																		$s = $this->shopitems->update_item($itemm, $unit);

																		//subtract item price from the bank
																		$price = $alzbank - $alz;
																		//echo $price.' = price<br />';
																		$this->load->database('CASHSHOP', TRUE);
																		$this->bank->update_alz($v11, $price);

																		if (!$t)
																			{
																				$data['info'] = 'Sorry, cant purchase the item. Internal server error';
																				$this->load->database('CASHSHOP', TRUE);
																				$data['query'] = $this->shopitems->shop($catee);
																				$this->load->view('user/shop', $data);
																			}
																			else
																			{
																				$data['info'] = 'Success purchase the item';
																				$this->load->database('CASHSHOP', TRUE);
																				$data['query'] = $this->shopitems->shop($catee);
																				$this->load->view('user/shop', $data);
																			}
																	}
															}
													}
											}
									}
							}
							else
							{
								if ($this->session->userdata('logged_in') == TRUE)
									{
										redirect('', 'location');
									}
									else
									{
										redirect('http://cabalclose', 'location');
									}
							}
					}
			}
//http://localhost/cabal/shop/index/2/4590D9E5267E42D280E440A13F9BE1B4.py
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
				if ($this->session->userdata('logged_in') == TRUE)
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