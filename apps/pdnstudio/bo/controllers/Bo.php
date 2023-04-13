<?php
defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed');

class Bo extends CI_Controller {
	function __construct()
	{
		$this->data = [];
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function title()		{return 'Kontak';}
	public function author()	{return 'Pudin S I';}
	public function MainModel()	{return 'Bo_Model';}
	public function contact()	{return 'najzmitea@gmail.com';}
	public function ClassNama()	{return 'bo';}
	
	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		
		if($this->form_validation->run() == FALSE){
			$this->data['title'] = $this->title();
			$this->load->view('login', $this->data);
		}else{
			// Validasi berhasil
			$this->_login();
		}
	}
	
	private function _login(){
		$email = $this->input->post('email', true);
		$password = $this->input->post('password', true);
		
		$where_user = ['users_email' => $email];
		$this->load->model($this->MainModel(), 'M_najzmi');
		$user = $this->M_najzmi->db_get_where($where_user);
		$create_token = md5(time().'https://t.me/pudin_ira');
		$token_user = array('users_token' => $create_token);
		if($user){
			// Jika user ada
			if($user['users_active'] == 1){
				// User aktiv
				if(password_verify($password, $user['users_password'])){
					//password benar/sama
					if ($user['users_level'] == 'Admin'){
						//ADMIN
						$this->M_najzmi->update_token($token_user,$where_user);
						$create_session['pdn_email'] 		= $user['users_email'];
						$create_session['pdn_level'] 		= $user['users_level'];
						$create_session['pdn_login'] 		= $user['id_users'];
						$create_session['pdn_token'] 		= $create_token;
						//BUAT SESSION
						$this->session->set_userdata($create_session);
						//REDIRECT
						redirect(base_url('adm_user'), 'refresh');
					}elseif($user['admin_level'] == 'Operator'){
						//ADMINISTRATOR
						$create_session['pdn_email'] 		= $user['admin_email'];
						$create_session['pdn_level'] 		= $user['admin_level'];
						$create_session['pdn_idunit'] 		= $user['admin_idunit'];
						$create_session['pdn_namaunit'] 	= $user['unit_nama'];
						$create_session['pdn_login'] 		= $user['id_admin'];
						//BUAT SESSION
						$this->session->set_userdata($create_session);
						//REDIRECT
						redirect(base_url('dash'), 'refresh');
					}elseif($user['admin_level'] == 'Pengawas'){
						//PENGAWAS
						$create_session['pdn_email'] 		= $user['admin_email'];
						$create_session['pdn_level'] 		= $user['admin_level'];
						$create_session['pdn_login'] 		= $user['id_admin'];
						//BUAT SESSION
						$this->session->set_userdata($create_session);
						//REDIRECT
						redirect(base_url('peng_dash'), 'refresh');
					}else{
						//Level tidak terdaftar
					$message = "Level tidak Terdaftar!";
					$this->session->set_flashdata('error', $message);
					redirect(base_url('bo/logout'), 'refresh');
					}
				}else{
					//password salah
					$message = "Wrong password!";
					$this->session->set_flashdata('error', $message);
					redirect(base_url('bo'), 'refresh');
				}
			}else{
				// User tidak aktiv
				$message = "This email has not been activated!";
				$this->session->set_flashdata('error', $message);
				redirect(base_url('bo'), 'refresh');
			}
		}else{
			// Jika tidak user ada
			$message = "Email is not registered!";
			$this->session->set_flashdata('error', $message);
			redirect(base_url('bo'), 'refresh');
		}
		
	}
	
	function change_password()
	{
		$this->admin_bo->pdn_is_login();
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]',[
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		
		$this->load->model($this->MainModel(), 'M_najzmi');
		if($this->form_validation->run() == FALSE){
			$this->data[$this->ClassNama()] = 'active';
			$this->template->load('template/admin','password',$this->data);
			
		}else{
			$_id = $this->session->userdata('pdn_login');
			$pass = $this->input->post('password1');
			$this->load->model($this->MainModel(), 'M_najzmi');
			$c_data['users_password'] = password_hash($pass, PASSWORD_DEFAULT);
			$input = $this->M_najzmi->c_pass($c_data,$_id);
			if ($input){
					$message = "Password berhasil diganti!";
					$this->session->set_flashdata('success', $message);
			}else{
					$message = "MAAF, Password gagal diganti!";
					$this->session->set_flashdata('error', $message);
					
			}
			redirect(base_url($this->ClassNama().'/logout'), 'refresh');
		}
	}
	
	public function logout(){
		$this->session->unset_userdata(array('pdn_email','pdn_login','pdn_level','pdn_token'));
		//$this->session->sess_destroy();
		
		$message = "You have been logged out!";
		$this->session->set_flashdata('success', $message);
		redirect(base_url('bo'), 'refresh');
	}
}
