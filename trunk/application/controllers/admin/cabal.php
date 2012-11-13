<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal extends CI_Controller
	{
#############################################################################################################################

		public function editing_news()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['news'] = $this->cabalweb_html->news();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/editing_news', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('add_news', TRUE))
									{
										$subject = $this->input->post('subject', TRUE);
										$author = $this->input->post('character', TRUE);
										$html = stripslashes($this->input->post('news_add', TRUE));

										$this->load->database('ACCOUNT', TRUE);
										$j = $this->cabalweb_html->insert_news($author, $subject, $html);
										
										if (!$j)
											{
												$data['info'] = 'News not published. Please try again';
												$data['news'] = $this->cabalweb_html->news();
												$this->load->view('admin/editing_news', $data);
											}
											else
											{
												$data['info'] = 'News published';
												$data['news'] = $this->cabalweb_html->news();
												$this->load->view('admin/editing_news', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function news_edit()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						if (is_numeric($bil))
							{
								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										//form
										$this->load->view('admin/news_edit', $data);
									}
									else
									{
										//form processor
										if ($this->input->post('news_edit_btn', TRUE))
											{
												$subject = $this->input->post('subject', TRUE);
												$author = $this->input->post('character', TRUE);
												$html = stripslashes($this->input->post('news_edit', TRUE));

												$this->load->database('ACCOUNT', TRUE);
												$j = $this->cabalweb_html->update_cabalweb($bil, $html, $subject, $author);
												
												if (!$j)
													{
														$data['info'] = 'News not update. Please try again';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/news_edit', $data);
													}
													else
													{
														$data['info'] = 'News updated';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/news_edit', $data);
													}
											}
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('admin/news_edit', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function news_del()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						if (is_numeric($bil))
							{
								$r = $this->cabalweb_html->delete_cabalweb($bil);
								if ($r)
									{
										redirect (site_url('admin/cabal/editing_news'), 'location');
									}
									else
									{
										$data['info'] = 'Cant delete the news. Please try again later';
										$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
										$this->load->view('admin/news_edit', $data);
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
								$this->load->view('admin/news_edit', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function editing_download()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['news'] = $this->cabalweb_html->download();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/editing_download', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('add_download', TRUE))
									{
										$subject = $this->input->post('subject', TRUE);
										$author = $this->input->post('character', TRUE);
										$html = stripslashes($this->input->post('download_add', TRUE));

										$this->load->database('ACCOUNT', TRUE);
										$j = $this->cabalweb_html->insert_download($author, $subject, $html);
										
										if (!$j)
											{
												$data['info'] = 'Download not inserted. Please try again';
												$data['news'] = $this->cabalweb_html->download();
												$this->load->view('admin/editing_download', $data);
											}
											else
											{
												$data['info'] = 'Download inserted';
												$data['news'] = $this->cabalweb_html->download();
												$this->load->view('admin/editing_download', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function download_edit()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						if (is_numeric($bil))
							{
								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										//form
										$this->load->view('admin/download_edit', $data);
									}
									else
									{
										//form processor
										if ($this->input->post('download_edit_btn', TRUE))
											{
												$subject = $this->input->post('subject', TRUE);
												$author = $this->input->post('character', TRUE);
												$html = stripslashes($this->input->post('download_edit', TRUE));

												$this->load->database('ACCOUNT', TRUE);
												$j = $this->cabalweb_html->update_cabalweb($bil, $html, $subject, $author);
												
												if (!$j)
													{
														$data['info'] = 'Download not update. Please try again';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/download_edit', $data);
													}
													else
													{
														$data['info'] = 'Download updated';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/download_edit', $data);
													}
											}
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('admin/download_edit', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function download_del()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						if (is_numeric($bil))
							{
								$r = $this->cabalweb_html->delete_cabalweb($bil);
								if ($r)
									{
										redirect (site_url('admin/cabal/editing_download'), 'location');
									}
									else
									{
										$data['info'] = 'Cant delete the Download. Please try again later';
										$this->load->view('admin/editing_download', $data);
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('admin/editing_download', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function editing_event()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['news'] = $this->cabalweb_html->event();
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/editing_event', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('add_event', TRUE))
									{
										$subject = $this->input->post('subject', TRUE);
										$author = $this->input->post('character', TRUE);
										$html = stripslashes($this->input->post('event_add', TRUE));

										$this->load->database('ACCOUNT', TRUE);
										$j = $this->cabalweb_html->insert_event($author, $subject, $html);
										
										if (!$j)
											{
												$data['info'] = 'Event not inserted. Please try again';
												$data['news'] = $this->cabalweb_html->event();
												$this->load->view('admin/editing_event', $data);
											}
											else
											{
												$data['info'] = 'Event inserted';
												$data['news'] = $this->cabalweb_html->event();
												$this->load->view('admin/editing_event', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function event_edit()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						$this->load->database('GAMEDB', TRUE);
						$data['char'] = $this->cabal_character_table->charuser($this->session->userdata('usernum'));
						if (is_numeric($bil))
							{
								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										//form
										$this->load->view('admin/event_edit', $data);
									}
									else
									{
										//form processor
										if ($this->input->post('event_edit_btn', TRUE))
											{
												$subject = $this->input->post('subject', TRUE);
												$author = $this->input->post('character', TRUE);
												$html = stripslashes($this->input->post('event_edit', TRUE));

												$this->load->database('ACCOUNT', TRUE);
												$j = $this->cabalweb_html->update_cabalweb($bil, $html, $subject, $author);
												
												if (!$j)
													{
														$data['info'] = 'Event not update. Please try again';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/event_edit', $data);
													}
													else
													{
														$data['info'] = 'Event updated';
														$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
														$this->load->view('admin/event_edit', $data);
													}
											}
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('admin/event_edit', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function event_del()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$bil = $this->uri->segment(4, 0);
						$data['news'] = $this->cabalweb_html->cabalweb_id($bil);
						if (is_numeric($bil))
							{
								$r = $this->cabalweb_html->delete_cabalweb($bil);
								if ($r)
									{
										redirect (site_url('admin/cabal/editing_event'), 'location');
									}
									else
									{
										$data['info'] = 'Cant delete the news. Please try again later';
										$this->load->view('admin/event_edit', $data);
									}
							}
							else
							{
								$data['info'] = 'What are you trying to do?';
								$this->load->view('admin/editing_event', $data);
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function info_account()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/info_account');
							}
							else
							{
								//form processor
								if ($this->input->post('search', TRUE))
									{
										$char = $this->input->post('char', TRUE);
										//echo $char.' character<br />';

										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_character_table->charb($char);
										$valid = $data['query']->num_rows();
										if ($valid == 1)
											{
												$charidx = $data['query']->row()->CharacterIdx;

												$f = fmod($charidx, 8);
												if (0 <= $f && $f <= 5)
													{
														$usernum = ($charidx - $f) / 8;

														$this->load->database('ACCOUNT', TRUE);
														$data['acc'] = $this->cabal_auth_table->find_acc($usernum);
														$data['auth'] = $this->cabal_charge_auth->getAll($usernum);
														$data['type'] = $this->config->item('Type');
														$data['servicekind'] = $this->config->item('ServiceKind');
														$this->load->database('GAMEDB', TRUE);
														$data['char'] = $this->cabal_character_table->charuser($usernum);
														$this->load->view('admin/info_account', $data);
													}
													else
													{
														$data['info'] = 'An act of hacking occured. Your action have been record';
														$this->load->view('admin/info_account', $data);
													}
											}
											else
											{
														$usernum = 0;
														$this->load->database('ACCOUNT', TRUE);
														$data['acc'] = $this->cabal_auth_table->find_acc($usernum);
														$data['auth'] = $this->cabal_charge_auth->getAll($usernum);
														$data['type'] = $this->config->item('Type');
														$data['servicekind'] = $this->config->item('ServiceKind');
														$this->load->database('GAMEDB', TRUE);
														//$data['char'] = $this->cabal_character_table->charuser($usernum
												$data['info'] = 'Sorry, I cant find '.$char.'. Make sure your spelling is correct or the character might been deleted';
												$this->load->view('admin/info_account', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function online_chars()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_character_table->online_player();
						$this->load->view('admin/player_online_admin', $data);
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function char_offline()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						$bil = $this->uri->segment(4, 0);
						if (is_numeric($bil))
							{
								$this->load->database('GAMEDB', TRUE);
								$data['query'] = $this->cabal_character_table->update_offline($bil);
								redirect('admin/cabal/online_chars', 'location');
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

		public function edit_account()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['Type'] = $this->config->item('Type');
						$data['ServiceKind'] = $this->config->item('ServiceKind');
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$data['Type'] = $this->config->item('Type');
								$data['ServiceKind'] = $this->config->item('ServiceKind');
								$this->load->view('admin/edit_account', $data);
							}
							else
							{
								//form processor
								if ($this->input->post('changeacc', TRUE))
									{
										$char = $this->input->post('char', TRUE);
										$type = $this->input->post('type', TRUE);
										$servicekind = $this->input->post('servicekind', TRUE);
										$date = $this->input->post('date', TRUE);
										
										//echo $char.' char<br/>'.$type.' type<br/>'.$servicekind.' servicekind<br/>'.$date.' date<br/>';
										if ($type == 0 && $servicekind != 0)
											{
												$data['info'] = 'I cant change account ServiceKind other than <strong>'.$data['ServiceKind'][0].'</strong> if you choose account Type <strong>'.$data['Type'][0].'</strong>';
												$this->load->view('admin/edit_account', $data);
											}
											else
											{
												$this->load->database('GAMEDB', TRUE);
												$data['query'] = $this->cabal_character_table->charb($char);
												$valid = $data['query']->num_rows();
												if ($valid == 1)
													{
														$charidx = $data['query']->row()->CharacterIdx;

														$f = fmod($charidx, 8);
														if (0 <= $f && $f <= 5)
															{
																$usernum = ($charidx - $f) / 8;

																$this->load->database('ACCOUNT', TRUE);
																$r = $this->cabal_charge_auth->update_acc($usernum, $type, $date, $servicekind);
																if (!$r)
																	{
																		$data['info'] = 'Cant update the data. Please try again later';
																		$this->load->view('admin/edit_account', $data);
																	}
																	else
																	{
																		$data['info'] = 'Success update data';
																		$this->load->view('admin/edit_account', $data);
																	}
															}
															else
															{
																$data['info'] = 'An act of hacking occured. Your action have been record';
																$this->load->view('admin/edit_account', $data);
															}
													}
													else
													{
														$data['info'] = 'Sorry, I cant find '.$char.'. Make sure your spelling is correct or the character might been deleted';
														$this->load->view('admin/edit_account', $data);
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

		public function ban_account()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/ban_account');
							}
							else
							{
								//form processor
								if ($this->input->post('banacc', TRUE))
									{
										$char = $this->input->post('char', TRUE);
										$date = $this->input->post('date', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_character_table->charb($char);
										$valid = $data['query']->num_rows();
										if ($valid == 1)
											{
												$charidx = $data['query']->row()->CharacterIdx;

												$f = fmod($charidx, 8);
												if (0 <= $f && $f <= 5)
													{
														$usernum = ($charidx - $f) / 8;

														$this->load->database('ACCOUNT', TRUE);
														$r = $this->cabal_auth_table->ban_user($usernum, $date);
														if (!$r)
															{
																$data['info'] = 'Cant update the data. Please try again later';
																$this->load->view('admin/ban_account', $data);
															}
															else
															{
																$data['info'] = 'Success update data';
																$this->load->view('admin/ban_account', $data);
															}
													}
													else
													{
														$data['info'] = 'An act of hacking occured. Your action have been record';
														$this->load->view('admin/ban_account', $data);
													}
											}
											else
											{
												$data['info'] = 'Sorry, I cant find '.$char.'. Make sure your spelling is correct or the character might been deleted';
												$this->load->view('admin/ban_account', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function unban_account()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['query'] = $this->cabal_auth_table->list_ban();
						$this->load->view('admin/unban_account', $data);
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function unban_user()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$usernum = $this->uri->segment(4, 0);
						if (is_numeric($usernum))
							{
								$t = $this->cabal_auth_table->unban_user($usernum);
								if (!$t)
									{
										$data['info'] = 'Please try again later.';
										$this->load->view('admin/unban_account', $data);
									}
									else
									{
										redirect('admin/cabal/unban_account', 'location');
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

		public function hackuserlog()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$data['query'] = $this->cabal_hackuser_list->get_all();
						$this->load->view('admin/hackuserlog', $data);
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function ban_user()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$usernum = $this->uri->segment(4, 0);
						if (is_numeric($usernum))
							{
								$t = $this->cabal_auth_table->ban_user($usernum, '2020-01-01 00:00:00');
								if (!$t)
									{
										$data['info'] = 'Please try again later.';
										$this->load->view('admin/hackuserlog', $data);
									}
									else
									{
										redirect('admin/cabal/hackuserlog', 'location');
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

		public function del_hackuserlog()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$r = $this->cabal_hackuser_list->del_all();
						if(!$r)
							{
								$data['info'] = 'Unable to delete all the logs. Please try again later';
								$this->load->view('admin/hackuserlog', $data);
							}
							else
							{
								redirect('admin/cabal/hackuserlog', 'location');
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function char_stats_search()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('admin/char_stats_search');
							}
							else
							{
								//form processor
								if ($this->input->post('search', TRUE))
									{
										$char = $this->input->post('char', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_character_table->charb($char);
										$valid = $data['query']->num_rows();
										if ($valid == 1)
											{
												$charidx = $data['query']->row()->CharacterIdx;
												//echo $charidx;
												//$data['query'] = $this->cabal_character_table->charid($charidx);
												//$this->load->view('admin/char_stats_search', $data);
												redirect('admin/cabal/char_stats/'.$charidx, 'location');
											}
											else
											{
												$data['info'] = 'Sorry, I cant find '.$char.'. Make sure your spelling is correct or the character might been deleted';
												$this->load->view('admin/char_stats_search', $data);
											}
									}
							}
					}
					else
					{
						redirect(base_url(), 'location');
					}
			}

		public function char_stats()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) && ($this->session->userdata('group') == 'GM') )
					{
						//process
						$charidx = $this->uri->segment(4, 0);
						if (is_numeric($charidx))
							{
								$this->form_validation->set_error_delimiters('&nbsp;&nbsp;<font color="#FF0000">', '</font>&nbsp;&nbsp;');
								if ($this->form_validation->run() == FALSE)
									{
										//form
										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_character_table->charid($charidx);
										$this->load->view('admin/char_stats', $data);
									}
									else
									{
										//form processor
										if($this->input->post('submit', TRUE))
											{
												$str = $this->input->post('str', TRUE);
												$dex = $this->input->post('dex', TRUE);
												$int = $this->input->post('int', TRUE);
												$pnt = $this->input->post('pnt', TRUE);
												$rnk = $this->input->post('rnk', TRUE);
												$alz = $this->input->post('alz', TRUE);
												$style = $this->input->post('style', TRUE);
												$wc = $this->input->post('wc', TRUE);
												$mc = $this->input->post('mc', TRUE);
												$rp = $this->input->post('rp', TRUE);
												$reput = $this->input->post('reput', TRUE);
												$nat = $this->input->post('nat', TRUE);
												$rb = $this->input->post('rb', TRUE);
												$rs = $this->input->post('rs', TRUE);

												$charidx = $this->uri->segment(4, 0);
												if(is_numeric($charidx))
													{
														$this->load->database('GAMEDB', TRUE);
														$style1 = $this->cabal_character_table->charid($charidx)->row()->Style;
														$str1 = $this->cabal_character_table->charid($charidx)->row()->STR;
														$dex1 = $this->cabal_character_table->charid($charidx)->row()->DEX;
														$int1 = $this->cabal_character_table->charid($charidx)->row()->INT;
														$l = $this->cabal_character_table->update_char($charidx, ($str1 + $str), ($dex1 + $dex), ($int1 + $int), $pnt, $rnk, $alz, ($style1 + $style), $wc, $mc, $rp, $reput, $nat, $rb, $rs);
														if(!$l)
															{
																$this->load->database('GAMEDB', TRUE);
																$data['query'] = $this->cabal_character_table->charid($charidx);
																$data['info'] = 'Unable to update the data. Please try again later';
																$this->load->view('admin/char_stats', $data);
															}
															else
															{
																$this->load->database('GAMEDB', TRUE);
																$data['query'] = $this->cabal_character_table->charid($charidx);
																$data['info'] = 'Success update the data.';
																$this->load->view('admin/char_stats', $data);
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
					else
					{
						redirect(base_url(), 'location');
					}
			}


#############################################################################################################################
		public function logout()
			{
				if ( ($this->session->userdata('logged_in') == TRUE) )
					{
						//process
						$array = array 
								(
									'username' => '',
									'password' => '',
									'group' => '',
									'logged_in' => '',
								);
						$this->session->unset_userdata($array);
						redirect(base_url(), 'location');
					}
					else
					{
						redirect(base_url(), 'location');
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
//form validation data process
///*
		public function old_password_check($username)
			{
				if ($username != $this->session->userdata('password'))
					{
						//echo $query;
						$this->form_validation->set_message('old_password_check', "The %s not correct");
						return FALSE;
					}
					else
					{
						//echo $query;
						return TRUE;
					}
			}
//*/
///*
		public function points_check($points)
			{
				if ($points > 65535)
					{
						//echo $query;
						$this->form_validation->set_message('points_check', "%s exceed more than 65535");
						return FALSE;
					}
					else
					{
						//echo $query;
						return TRUE;
					}
			}
//*/
	}

/* End of file cabal.php */
/* Location: ./application/controllers/admin/cabal.php */