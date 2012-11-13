<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabal extends CI_Controller 
	{

		public function index()
			{
			if ($this->session->userdata('logged_in') == TRUE)
				{
					redirect('/user/cabal/index', 'location');
				}
				else
				{
					$this->load->database('ACCOUNT', TRUE);
					$data['news'] = $this->cabalweb_html->news();
					$this->load->view('home', $data);
				}
			}

		public function download()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('ACCOUNT', TRUE);
						$data['event'] = $this->cabalweb_html->download();
						$this->load->view('download', $data);
					}
			}

		public function event()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('ACCOUNT', TRUE);
						$data['event'] = $this->cabalweb_html->event();
						$this->load->view('event', $data);
					}
			}

		public function donate()
			{
				$this->load->view('donate');
			}

		public function login()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								$this->load->view('login');
							}
							else
							{
								if($this->input->post('sign-in', TRUE))
									{
										$login = $this->input->post('username', TRUE);
										$passwd = $this->input->post('passwd', TRUE);

										$data['query'] = $this->cabal_auth_table->account_user($login, $passwd);
										$rows = $data['query']->num_rows();

										if ($rows == 1)
											{
												$this->load->database('GAMEDB', TRUE);
												//checking if the account is online or not
												if ($this->cabal_character_table->online($data['query']->row()->UserNum)->num_rows() > 0)
													{
														//echo $this->cabal_character_table->online($data['query']->row()->UserNum)->num_rows();
														$data['info'] = 'Sorry, i cant let you enter the system. '.$this->cabal_character_table->online($data['query']->row()->UserNum)->num_rows().' of your characters are still online';
														$this->load->view('login', $data);
													}
													else
													{
														if($this->cabal_character_table->gm($data['query']->row()->UserNum)->num_rows() > 0)
															{
																$user_category = 'GM';
															}
															else
															{
																$user_category = 'Normal';
															}
															$user = array
																		(
																			'usernum'	=> $data['query']->row()->UserNum,
																			'authkey'	=> $data['query']->row()->AuthKey,
																			'username' => $login,
																			'password' => $passwd,
																			'group' => $user_category,
																			'logged_in' => TRUE
																		);
															$this->session->set_userdata($user);
															redirect('/user/cabal', 'location');
													}
											}
											else
											{
												//login not correct
												$data['info'] = 'Login incorrect or you havent register/activate your account';
												$this->load->view('login', $data);
											}
									}
							}
					}
			}

		public function register()
			{
				//initiate var for captcha helper
				$vals = array
					(
						'word' => rand(10000, 99999),
						'img_path' => './images/captcha/',
						'img_url' => base_url().'images/captcha/',
						//'font_path' => './path/to/fonts/texb.ttf',
						'img_width' => 150,
						'img_height' => 30,
						'expiration' => 1800
					);
				$data['cap'] = create_captcha($vals);
				//echo $data['cap']['word'];
				$this->captcha->insert_captcha($data['cap']['time'], $data['cap']['word']);

				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('register', $data);
							}
							else
							{
								//form process
								$username = $this->input->post('username', TRUE);
								$password1 = $this->input->post('password1', TRUE);
								$verify = $this->input->post('verify', TRUE);
								$email = $this->input->post('email', TRUE);

								if ($this->input->post('create_acc', TRUE))
									{
										if ($username == $password1)
											{
												$data['info'] = 'Sorry, please choose another password or your username. Your password and your username cant be the same.';
												$this->load->view('register', $data);
											}
											else
											{
												//we need to check the capthca
												$expiration = time()-1800; // Two hour limit
												//delete captcha 2 hours ago
												$this->captcha->delete_captcha($expiration);

												//check the new 1
												$check = $this->captcha->captcha($verify, $expiration)->num_rows();

												if ($check == 0)
													{
														$data['info'] = 'You must submit the word that appears in the image';
														$this->load->view('register', $data);
													}
													else
													{
														$passkey = md5(uniqid(rand()));
														$date = mssqldate();
														$subject = $this->config->item('homepage').' Activation Link For '.$username.' Account';
														$message = "<html>
																	<head>
																	<meta http-equiv='Content-Language' content='en-us'>
																	<meta name='GENERATOR' content='Microsoft FrontPage 6.0'>
																	<meta name='ProgId' content='FrontPage.Editor.Document'>
																	<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>
																	<title>".$this->config->item('server')." Activation Link.</title>
																	</head>
																	<body>
																	<p align='center'>Your username : $username</p>";
														$message .= "<p align='center'>This is your password : $password1</p>";
														$message .=	"<p align='center'><a href='".$this->config->item('forum')."'>".$this->config->item('server')." Forum</a></p>
																	<p align='center'><a href='".site_url()."'>".$this->config->item('server')." Account Management Tools</a></p>
																	<p align='center'><a href='".site_url("cabal/activate/$passkey")."'>Click Here To Activate Your Account.</a></p>
																	<p align='center'>You are receiving this e-mail because a user with an IP address of ".$_SERVER['REMOTE_ADDR']." signed up on <a href='".base_url()."'>".$this->config->item('server')." Account Management Tools</a> using your e-mail address. If this was not you, simply ignore this e-mail, and no further messages will be sent.</p>
																	</body></html>";

														$email1 = send_email($email, $username, $subject, $message, $this->config->item('pop3_server'), $this->config->item('pop3_port'), $this->config->item('username'), $this->config->item('password'), $this->config->item('SMTP_auth'), $this->config->item('smtp_server'), $this->config->item('smtp_port'), $this->config->item('SMTP_Secure'), $this->config->item('addreplyto_email'), $this->config->item('addreplyto_name'), $this->config->item('from'), $this->config->item('from_name'));
														if ($email1 == TRUE)
															{
																$query = $this->temp_account->insert_temp_account($username, $password1, $email, $passkey);
																if($query)
																	{
																		$data['info'] = 'Please check activation email<br />If the email is not in the inbox, please check your JUNK folder and add it into white list';
																		$this->load->view('register', $data);
																	}
																	else
																	{
																		$data['info'] = 'Please check activation email<br />Please try again later. We are sorry for the inconvenience';
																		$this->load->view('register', $data);
																	}
															}
															else
															{
																$data['info'] = 'Activation email cant be send right now<br />Please try again later';
																$this->load->view('register', $data);
															}
													}
											}
									}
							}
					}
			}

		public function resetp()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('resetp');
							}
							else
							{
								//form process
								if ($this->input->post('forgot_password', TRUE))
									{
										$username = $this->input->post('username', TRUE);
										$email = $this->input->post('email', TRUE);

										$query = $this->cabal_auth_table->account_email($username, $email);
										if ($query->num_rows() == 1)
											{
												$password = generatePassword(6, 1);
												$subject = 'Your Password For '.$this->config->item('server').' Private Server';
												$message = "<html>
															<head>
															<meta http-equiv='Content-Language' content='en-us'>
															<meta name='GENERATOR' content='Microsoft FrontPage 6.0'>
															<meta name='ProgId' content='FrontPage.Editor.Document'>
															<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>
															<title>".$this->config->item('server')." Password Retrieval</title>
															</head>
															<body>
															<p align='center'>Your username : ".$username."</p>";
												$message .= "<p align='center'>This is your password for ".$this->config->item('homepage')." : ".$password."</p>";
												$message .=	"<p align='center'><a href='".$this->config->item('forum')."'>".$this->config->item('server')." Forum</a></p>
															<p align='center'><a href='".base_url()."'>".$this->config->item('server')." Account Management Tools</a></p>
															</body>
															</html>";
												$t = $this->cabal_auth_table->update_resetp($username, $email, $password);
												if($t)
													{
														$email = send_email($email, $username, $subject, $message, $this->config->item('pop3_server'), $this->config->item('pop3_port'), $this->config->item('username'), $this->config->item('password'), $this->config->item('SMTP_auth'), $this->config->item('smtp_server'), $this->config->item('smtp_port'), $this->config->item('SMTP_Secure'), $this->config->item('addreplyto_email'), $this->config->item('addreplyto_name'), $this->config->item('from'), $this->config->item('from_name'));
														if ($email == TRUE)
															{
																$data['info'] = 'Successful send password';
																$this->load->view('resetp', $data);
															}
															else
															{
																$data['info'] = array('Please try again later', $email);
																$this->load->view('resetp', $data);
															}
													}
													else
													{
														$data['info'] = 'Sorry, i cant reset your password at the moment. Please try again later.';
														$this->load->view('resetp', $data);
													}
											}
											else
											{
												$data['info'] = 'Your username and your email doesnt match';
												$this->load->view('resetp', $data);
											}
									}
							}
					}
			}

		public function status()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('GAMEDB', TRUE);
						$data['channels'] = $this->config->item('channels');
						$this->load->view('status', $data);
					}
			}

		public function topchar()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_character_table->topchar(50);
						$this->load->view('topchar', $data);
					}
			}

		public function topsd()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('topsd');
							}
							else
							{
								//form process
								if ($this->input->post('sd', TRUE))
									{
										$sd = $this->input->post('dungeon', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_event_singledg->topsd($sd);
										$this->load->view('topsd', $data);
									}
							}
					}
			}

		public function topgd()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								$this->load->view('topgd');
							}
							else
							{
								//form process
								if ($this->input->post('gd', TRUE))
									{
										$gd = $this->input->post('dungeon', TRUE);

										$this->load->database('GAMEDB', TRUE);
										$data['query'] = $this->cabal_event_partydg->topgd($gd);
										$this->load->view('topgd', $data);
									}
							}
					}
			}

		public function topcombo()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_record_combo->topcombo();
						$this->load->view('topcombo', $data);
					}
			}

		public function nationwar()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_instantwar_nationrewardwarresults->war();
						$this->load->view('nationwar', $data);
					}
			}

		public function activate()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('ACCOUNT', TRUE);
						$activate = $this->uri->segment(3, 0);
						$y = $this->temp_account->temp_account($activate);

						if ($y->num_rows() != 1)
							{
								$data['info'] = 'Sorry, i can\'t find your activation code, probably your account have been activated or you didn\'t register at all';
								$this->load->view('activate', $data);
							}
							else
							{
								if ($y->num_rows() == 1)
									{
										$username = $y->row()->Username;		//case sencitive
										$password = $y->row()->Password;
										$email = $y->row()->Email;

										$u = $this->cabal_auth_table->account_uid($username);
										$ur = $u->num_rows();
										if ($ur == 1)
											{
												$data['info'] = 'Your username '.$username.' have been registered. Please register again using another username.';
												$this->load->view('activate', $data);
											}
											else
											{
												$i = $this->cabal_auth_table->account_mail($email);
												$io = $i->num_rows();
												if ($io ==  1)
													{
														$data['info'] = 'Your email '.$email.' have been registered. Please register again with another email account.';
														$this->load->view('activate', $data);
													}
													else
													{
														$p = $this->cabal_auth_table->activate($username, $password, $email);
														if (!$p)
															{
																$data['info'] = 'Error creating account account, please try again later';
																$this->load->view('activate', $data);
															}
															else
															{
																$this->temp_account->delete_temp_account($activate);
																$data['info'] = 'Congratulations!! Your account have been activated.<br>Have fun in our server!';
																$this->load->view('activate', $data);
															}
													}
											}
									}
							}
					}
			}

		public function online()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->load->database('GAMEDB', TRUE);
						$data['query'] = $this->cabal_character_table->online_player();
						$this->load->view('player_online', $data);
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
//error 404
		public function page_missing()
			{
				$this->load->view('errors/error_custom_404');
			}

#############################################################################################################################
//template
/*
		public function home()
			{
				if ($this->session->userdata('logged_in') == TRUE)
					{
						redirect('/user/cabal/index', 'location');
					}
					else
					{
						$this->form_validation->set_error_delimiters('<font color="#FF0000">', '</font>');
						if ($this->form_validation->run() == FALSE)
							{
								//form
								
							}
							else
							{
								//form process
								
							}
					}
			}
*/
#############################################################################################################################
	}

/* End of file cabal.php */
/* Location: ./application/controllers/cabal.php */