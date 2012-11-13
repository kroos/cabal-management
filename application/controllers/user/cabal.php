<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal extends CI_Controller
	{
#############################################################################################################################

		public function index()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$data['news'] = $this->cabalweb_html->news();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('user/home', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('rely_news', TRUE))
									{
										$bil_post = $this->input->post('bil_post', TRUE);
										$html = stripslashes($this->input->post('news_reply', TRUE));
										$author = $this->input->post('character', TRUE);

										$this->load->database('ACCOUNT', TRUE);
										$b = $this->cabalweb_comment->insert_news($author, $bil_post, $html);
										if(!$b)
											{
												$data['info'] = 'Please try again later';
												$this->load->view('user/home', $data);
											}
											else
											{
												$data['info'] = 'Successfull send reply';
												$this->load->view('user/home', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function download()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$data['download'] = $this->cabalweb_html->download();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('user/download', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('rely_news', TRUE))
									{
										$bil_post = $this->input->post('bil_post', TRUE);
										$html = stripslashes($this->input->post('news_reply', TRUE));
										$author = $this->input->post('character', TRUE);

										$this->load->database('ACCOUNT', TRUE);
										$b = $this->cabalweb_comment->insert_news($author, $bil_post, $html);
										if(!$b)
											{
												$data['info'] = 'Please try again later';
												$this->load->view('user/download', $data);
											}
											else
											{
												$data['info'] = 'Successfull send reply';
												$this->load->view('user/download', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function event()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$data['event'] = $this->cabalweb_html->event();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('user/event', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('rely_news', TRUE))
									{
										$bil_post = $this->input->post('bil_post', TRUE);
										$html = stripslashes($this->input->post('news_reply', TRUE));
										$author = $this->input->post('character', TRUE);

										$this->load->database('ACCOUNT', TRUE);
										$b = $this->cabalweb_comment->insert_news($author, $bil_post, $html);
										if(!$b)
											{
												$data['info'] = 'Please try again later';
												$this->load->view('user/event', $data);
											}
											else
											{
												$data['info'] = 'Successfull send reply';
												$this->load->view('user/event', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function reply()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						if (is_numeric($this->uri->segment(4, 0)))
							{
								$data['reply'] = $this->cabalweb_comment->reply_edit($this->uri->segment(4, 0))->row();
								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										$this->load->view('user/reply', $data);
									}
									else
									{
										//form processor
										if($this->input->post('news_edit', TRUE))
											{
												$y = $this->cabalweb_comment->update_comment($this->uri->segment(4, 0), $this->input->post('edit_news', TRUE));
												if (!$y)
													{
														$data['info'] = 'Please try again later';
														$this->load->view('user/reply', $data);
													}
													else
													{
														$data['info'] = 'Done edit news';
														$data['reply'] = $this->cabalweb_comment->reply_edit($this->uri->segment(4, 0))->row();
														$this->load->view('user/reply', $data);
													}
											}
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('user/reply', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function replyr()
			{
				if ( $this->session->userdata('logged_in') == TRUE && $this->session->userdata('group') == 'GM' )
					{
						//process
						if (is_numeric($this->uri->segment(4, 0)))
							{
								$h = $this->cabalweb_comment->delete_cabalweb($this->uri->segment(4, 0));
								if (!$h)
									{
										$data['info'] = 'Please try again later';
										$this->load->view('user/home', $data);
									}
									else
									{
										redirect(base_url(), 'location');
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('user/home', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}
			
		public function rebirth()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('user/rebirth', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('rebirth', TRUE))
									{
										$char = $this->input->post('character', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$t = $this->cabal_character_table->charid($char);

										//--------------------check level rebirth----------------------------
										$rblvl = $t->row()->Rebirth;

										//--------------------check char level--------------------------
										$charlvl = $t->row()->LEV;

										//--------------------check online----------------------------------
										$rbonline = $t->row()->Login;
										//echo $rbonline.' rbonline<br />';

										//--------------------check wz----------------------------------
										$this->load->database('CASHSHOP', TRUE);
										$t1 = $this->bank->get_alz($this->session->userdata('usernum'));
										$rbwz = $t1->row()->Alz;

										//---------------------------rebirth operation----------------------------------------------------
										//initializing lvl to rebirth
										$charlvlforrb = $rblvl + $this->config->item('rebirth_level');

										//initializing rebirth lvl
										$rblvlforrb = $rblvl + 1;

										//initializing wz for rebirth
										$wzforrb = $this->config->item('rebirth_wz') * $rblvl;

										//balance wz
										$sqlwz = $rbwz - $wzforrb;
										$sqlrblvl = $rblvl + 1;

										//check online
										if ($rbonline < 1)
											{
												//1st we check lvl
												if ($charlvl >= $charlvlforrb)
													{
														//then we check its wz
														if ($rbwz >= $wzforrb)
															{
																//change the exp value to 0
																$rssuccess1 = $this->bank->update_alz($char, $sqlwz);
																$this->load->database('GAMEDB', TRUE);
																$rssuccess = $this->cabal_character_table->update_rebirth($char, $sqlrblvl);
																if (!$rssuccess && !$rssuccess)
																	{
																		$data['info'] = 'Sorry, internal server error, please try again later';
																		$this->load->view('user/rebirth', $data);
																	}
																	else
																	{
																		$data['info'] = "Successfully rebirth";
																		$this->load->view('user/rebirth', $data);
																	};
															}
															else
															{
																$data['info'] = "You need at least $wzforrb Alz for rebirth level $rblvl";
																$this->load->view('user/rebirth', $data);
															};	
													}
													else
													{
														$data['info'] = "You need at least level $charlvlforrb for rebirth level $rblvl";
														$this->load->view('user/rebirth', $data);
													}
											}
											else
											{
												$data['info'] = 'Character online. Please logoff and try again';
												$this->load->view('user/rebirth', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function reset_rebirth()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('user/reset_rebirth', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('reset_rebirth', TRUE))
									{
										$char = $this->input->post('character', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$t = $this->cabal_character_table->charid($char);

										//--------------------check level reset rebirth----------------------------
										$rblvl = $t->row()->Reset;

										//--------------------check char level--------------------------
										$charlvl = $t->row()->LEV;

										//--------------------check online----------------------------------
										$rbonline = $t->row()->Login;
										//echo $rbonline.' rbonline<br />';

										//--------------------check wz----------------------------------
										$this->load->database('CASHSHOP', TRUE);
										$t1 = $this->bank->get_alz($this->session->userdata('usernum'));
										$rbwz = $t1->row()->Alz;

										//---------------------------reset rebirth operation----------------------------------------------------
										//check online
										if ($rbonline < 1)
											{
												//1st we check rb times, it should be no more than 2 times rb
												if ($rblvl < $this->config->item('rrebirthcapped'))
													{
														//1st we check rebirth level
														if ($rblvl >= $this->config->item('rebirth_count'))
															{
																//then we check the wz
																if ($rbwz >= $this->config->item('alzresetrebirth'))
																	{
																		//initialize wz balance
																		$wz = $rbwz - $this->config->item('alzresetrebirth');

																		//initialize reset rb times
																		$resetrb = $rblvl + 1;

																		$rson1 = $this->bank->update_alz($char, $wz);
																		$this->load->database('GAMEDB', TRUE);
																		$rson = $this->cabal_character_table->update_reset_rebirth($char, $resetrb);
																		if (!$rson && !$rson1)
																			{
																				$data['info'] = 'Sorry, internal server error, please try again later';
																				$this->load->view('user/reset_rebirth', $data);
																			}
																			else
																			{
																				$data['info'] = 'Successful reset rebirth';
																				$this->load->view('user/reset_rebirth', $data);
																			};
																	}
																	else
																	{
																		$data['info'] = "Insufficient wz, your character only have $rbwz Alz";
																		$this->load->view('user/reset_rebirth', $data);
																	};
															}
															else
															{
																$data['info'] = "Character rebirth level is $rblvl, Character need to have at least rebirth level ".$this->config->item('rebirth_count')." to reset its rebirth";
																$this->load->view('user/reset_rebirth', $data);
															};
													}
													else
													{
														$data['info'] = 'You are now a god in this server, you cant reset rebirth anymore';
														$this->load->view('user/reset_rebirth', $data);
													}
											}
											else
											{
												$data['info'] = 'Character online. Please logoff and try again';
												$this->load->view('user/reset_rebirth', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function account()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');

						if ($this->input->post('withdraw', TRUE))
							{
								$this->form_validation->set_rules('alzwithdraw', 'Alz Withdraw', 'trim|required|is_natural_no_zero|xss_clean');
							}
							else
							{
								if ($this->input->post('deposit', TRUE))
									{
										$this->form_validation->set_rules('alzdeposit', 'Alz Deposit', 'trim|required|is_natural_no_zero|xss_clean');
									}
							}


						if ($this->form_validation->run() == FALSE)
							{
								//empty form
								$this->load->database('GAMEDB', TRUE);
								$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

								$this->load->database('CASHSHOP', TRUE);
								$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

								$this->load->view('user/account', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('withdraw', TRUE))
									{
										$withdraw = $this->input->post('alzwithdraw', TRUE);
										$this->load->database('GAMEDB', TRUE);
										$walz = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row()->Alz - $withdraw;
										if ($walz < 0)
											{
												$this->load->database('GAMEDB', TRUE);
												$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

												$this->load->database('CASHSHOP', TRUE);
												$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

												$data['info'] = 'Sorry, you withdraw more than you have in your warehouse.';
												$this->load->view('user/account', $data);
											}
											else
											{
												$r = $this->cabal_warehouse_table->update_alz($this->session->userdata('usernum'), $walz);
												$this->load->database('CASHSHOP', TRUE);
												$p = $this->bank->get_alz($this->session->userdata('usernum'))->row()->Alz + $withdraw;
												$m = $this->bank->update_alz($this->session->userdata('usernum'), $p);
												if (!$r && !$m)
													{
														$this->load->database('GAMEDB', TRUE);
														$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

														$this->load->database('CASHSHOP', TRUE);
														$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

														$data['info'] = 'Sorry, internal server error. Please try again later';
														$this->load->view('user/account', $data);
													}
													else
													{
														$this->load->database('GAMEDB', TRUE);
														$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

														$this->load->database('CASHSHOP', TRUE);
														$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

														$data['info'] = 'Success withdraw from warehouse to the bank';
														$this->load->view('user/account', $data);
													}
											}
									}
									else
									{
										if ($this->input->post('deposit', TRUE))
											{
												$deposit = $this->input->post('alzdeposit', TRUE);
												$this->load->database('CASHSHOP', TRUE);
												$r = $this->bank->get_alz($this->session->userdata('usernum'))->row()->Alz - $deposit;
												if ($r < 0)
													{
														$this->load->database('GAMEDB', TRUE);
														$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

														$this->load->database('CASHSHOP', TRUE);
														$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

														$data['info'] = 'Sorry, you withdraw more than you have in your bank.';
														$this->load->view('user/account', $data);
													}
													else
													{
														$this->load->database('GAMEDB', TRUE);
														$b = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row()->Alz + $deposit;

														$this->load->database('CASHSHOP', TRUE);
														$n = $this->bank->update_alz($this->session->userdata('usernum'), $r);
														$this->load->database('GAMEDB', TRUE);
														$n1 = $this->cabal_warehouse_table->update_alz($this->session->userdata('usernum'), $b);
														if (!$n && !$n1)
															{
																$this->load->database('GAMEDB', TRUE);
																$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

																$this->load->database('CASHSHOP', TRUE);
																$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

																$data['info'] = 'Sorry, internal server error. Please try again later';
																$this->load->view('user/account', $data);
															}
															else
															{
																$this->load->database('GAMEDB', TRUE);
																$data['warehouse'] = $this->cabal_warehouse_table->get_alz($this->session->userdata('usernum'))->row();

																$this->load->database('CASHSHOP', TRUE);
																$data['bank'] = $this->bank->get_alz($this->session->userdata('usernum'))->row();

																$data['info'] = 'Success withdraw from bank to the warehouse';
																$this->load->view('user/account', $data);
															}
													}
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function change_password()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$data['acc'] = $this->cabal_auth_table->find_acc($this->session->userdata('usernum'));
								$this->load->view('user/change_password', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('changepass', TRUE))
									{
										$username = $this->input->post('username', TRUE);
										$password = $this->input->post('newpasswd', TRUE);
										$o = $this->cabal_auth_table->update_idpasswd($username, $password);
										if (!$o)
											{
												$data['info'] = 'Sorry, i cant update your password. Please try again later.';
												$this->load->view('user/change_password', $data);
											}
											else
											{
												$this->session->set_userdata(array('password' => $password));
												$data['info'] = 'Success change your password';
												$this->load->view('user/change_password', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function donate()
			{
				$this->load->view('user/donate');
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
//form validation data process
		public function old_password_check($password)
			{
				if ($password == $this->session->userdata('password'))
					{
						//echo $query;
						$this->form_validation->set_message('old_password_check', "The new password cant be the same as the old password");
						return FALSE;
					}
					else
					{
						//echo $query;
						return TRUE;
					}
			}
	}

/* End of file cabal.php */
/* Location: ./application/controllers/user/cabal.php */