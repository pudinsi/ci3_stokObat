<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); 

class Adm_user extends CI_Controller {
	function __construct(){
		$this->data = [];
		parent::__construct();
			$this->admin_bo->pdn_is_login();
			date_default_timezone_set ('Asia/Jakarta');
	}
	public function nameApp()		{ return 'Stok Obat'; }
	public function title()       	{ return 'User'; }
    public function author()      	{ return 'Pudin S I'; }
	public function MainModel()   	{ return 'Adm_userModel'; }
    public function contact()     	{ return 'najzmitea@gmail.com'; }
	public function ClassNama()   	{ return 'adm_user'; }
	
	public function index()
	{
		$this->data[$this->ClassNama()] = 'active';
		$this->data['pdn_title'] 		= $this->nameApp().' | '.$this->title();
		$this->data['pdn_info'] 		= $this->title();
		$this->data['pdn_url'] 			= $this->ClassNama();
		$this->template->pdn_load('template/admin','konten','konten_kode',$this->data);
	}
	
	function add()
	{
		//Hanya Untuk Administrator
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.users_email]',[
			'is_unique' => 'This email has already registered!',
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]',[
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short!',
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		//LOAD MODEL
		$this->load->model($this->MainModel(), 'M_najzmi');
		if($this->form_validation->run() == FALSE){
			$this->data['nama'] = [
				'name' 			=> 'nama',
				'id' 			=> 'nama',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Nama Lengkap',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('nama'),
			];
			$this->data['email'] = [
				'name' 			=> 'email',
				'id' 			=> 'email',
				'type' 			=> 'email',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Email Address',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('email'),
			];
			$this->data['pdn_title'] 		= $this->nameApp().' | Tambah - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Tambah';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/add';
			$this->data[$this->ClassNama()] = 'active';
			$this->template->load('template/admin','add',$this->data);
		}else{
			$register_data['users_nama'] 		= htmlspecialchars($this->input->post('nama', true));
			$register_data['users_email'] 		= htmlspecialchars($this->input->post('email', true));
			$register_data['users_password'] 	= password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$register_data['users_level'] 		= $this->input->post('level', true);
			$register_data['users_active'] 		= 1;
			$register_data['users_tgl_input'] 	= date('Y-m-d H:i:s');
			
			
			$input = $this->M_najzmi->save($register_data);
		
			if ($input){
				$message = $this->title()." berhasil dibuat!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}else{
				$message = "MAAF, ".$this->title()." tidak bisa dibuat";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama().'/add'), 'refresh');
			}
			
		}
	}

	function edit()
	{
		//Hanya Untuk Administrator
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		
		$this->load->model($this->MainModel(), 'M_najzmi');
		if($this->form_validation->run() == FALSE){
			$_id = base64_decode($this->uri->segment(3));
			$this->data['dt_user'] = $this->M_najzmi->edit($_id);
			
			$this->data[$this->ClassNama()] = 'active';
			$this->data['pdn_title'] 		= $this->nameApp().' | Edit - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Edit';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/edit';
			$this->template->load('template/admin','edit',$this->data);
		}else{
			$register_data['users_nama'] 		= htmlspecialchars($this->input->post('nama', true));
			$register_data['users_email'] 		= htmlspecialchars($this->input->post('email', true));
			$_id 								= htmlspecialchars(base64_decode($this->input->post('id', true)));
			
			$this->load->model($this->MainModel(), 'M_najzmi');
			$input = $this->M_najzmi->update($register_data, $_id);
		
			if ($input){
				$message = $this->title()." berhasil diupdate!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			}else{
				$message = "MAAF, ".$this->title()." gagal diupdate";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama().'/edit/'.$_id), 'refresh');
			}
			
		}
	}
	
	function hapus()
	{
		//Hanya Untuk Administrator
		$_id = base64_decode($this->uri->segment(3));
		
		$this->load->model($this->MainModel(), 'M_najzmi');
		
		if ($this->session->userdata('pdn_login') == $_id){
			$message = "Menghapus Admin ini tidak diperbolehkan!";
			$this->session->set_flashdata('error', $message);
			redirect(base_url($this->ClassNama()), 'refresh');
		}
		
		$input = $this->M_najzmi->delete($_id);
		
		if ($input){
				$message = $this->title()." berhasil dihapus!";
				$this->session->set_flashdata('success', $message);
		}else{
				$message = "MAAF, ".$this->title()." gagal dihapus";
				$this->session->set_flashdata('error', $message);
				
		}
		
		redirect(base_url($this->ClassNama()), 'refresh');
	}
	
	function reset()
	{
		//Hanya Untuk Administrator
		$_id = base64_decode($this->uri->segment(3));
		$this->load->model($this->MainModel(), 'M_najzmi');
		$def_password = '12345678';
		$reset_data['users_password'] = password_hash($def_password, PASSWORD_DEFAULT);
		$input = $this->M_najzmi->reset($reset_data,$_id);
		if ($input){
				$message = "Password berhasil direset!";
				$this->session->set_flashdata('success', $message);
		}else{
				$message = "MAAF, Password gagal direset!";
				$this->session->set_flashdata('error', $message);
				
		}
		redirect(base_url($this->ClassNama()), 'refresh');
	}
	
	function data_json()
	{
		//Hanya Untuk Administrator
		if($this->input->method(TRUE)=='POST'): // Hanya lewat metode post saja yang di izinkan melihat dan mengambil data
		
			$csrf_name = $this->security->get_csrf_token_name();
			$csrf_hash = $this->security->get_csrf_hash();
				
			$tabel = 'users';
			$column_order = array('', 'users_nama','users_email','users_nama');
			$column_search = array('users_nama','users_email');
			$order = array('id_users' => 'DESC');
			//$where = array('admin_level' => 'Operator');
				
				$this->load->model('DatatablesModel' ,'M_najzmi');
				$list = $this->M_najzmi->get_datatables($tabel,$column_order,$column_search,$order);
				$data = array();
				$no = isset($_POST['start']) 	? $_POST['start'] 	: 1;
				
				foreach ($list as $pDn) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $pDn->users_nama;
					$row[] = $pDn->users_email;
					$row[] = '<div class="btn-group">
								  <a href="'.$this->ClassNama().'/edit/'.base64_encode($pDn->id_users).'"  class="btn btn-success btn-sm">Edit</a>
								  <a href="'.$this->ClassNama().'/reset/'.base64_encode($pDn->id_users).'"  class="btn btn-info btn-sm tombol-reset">Reset</a>
								  <a href="'.$this->ClassNama().'/hapus/'.base64_encode($pDn->id_users).'" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
								</div>';
					
					$data[] = $row;
				}
				
				
				$output = array(
								"draw" => isset($_POST['draw']) 	? $_POST['draw'] 	: 'null',
								"recordsTotal" => $this->M_najzmi->count_all($tabel,$column_order,$column_search,$order),
								"recordsFiltered" => $this->M_najzmi->count_filtered($tabel,$column_order,$column_search,$order),
								"data" => $data,
						);
				$output[$csrf_name] = $csrf_hash;
				//output to json format
				header('Content-type: application/json');
				echo json_encode($output);
			// End Json
		endif;
	}
}
