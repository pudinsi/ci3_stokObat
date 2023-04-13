<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); 

class Obat extends CI_Controller {
	function __construct(){
		$this->data = [];
		parent::__construct();
			$this->admin_bo->pdn_is_login();
			date_default_timezone_set ('Asia/Jakarta');
	}
	
	public function nameApp()       { return 'Stok Obat'; }
	public function title()       	{ return 'Obat'; }
    public function author()      	{ return 'Pudin S I'; }
	public function MainModel()   	{ return 'ObatModel'; }
    public function contact()     	{ return 'najzmitea@gmail.com'; }
	public function ClassNama()   	{ return 'obat'; }
	
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
		$this->form_validation->set_rules('nama', 'Nama Obat', 'required|trim');
		$this->form_validation->set_rules('satuan', 'Satuan Obat', 'required|trim');
		$this->form_validation->set_rules('kode', 'Kode Obat', 'required|trim|is_unique[obat.obat_kode]',[
			'is_unique' => 'Kode obat sudah ada',
		]);
		//LOAD MODEL
		$this->load->model($this->MainModel(), 'M_najzmi');
		if($this->form_validation->run() == FALSE){
			$this->data['kode'] = [
				'name' 			=> 'kode',
				'id' 			=> 'kode',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Kode Obat',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('kode'),
			];
			$this->data['nama'] = [
				'name' 			=> 'nama',
				'id' 			=> 'nama',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Nama Obat',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('nama'),
			];
			$this->data['satuan'] = [
				'name' 			=> 'satuan',
				'id' 			=> 'satuan',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Satuan (Pcs, Pak)',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('satuan'),
			];
			
			$this->data[$this->ClassNama()] = 'active';
			$this->data['pdn_title'] 		= $this->nameApp().' | Tambah - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Tambah';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/add';
			$this->template->load('template/admin','add',$this->data);
		}else{
			$kode_obat = htmlspecialchars($this->input->post('kode', true));
			$register_data['obat_nama'] 		= htmlspecialchars($this->input->post('nama', true));
			$register_data['obat_kode'] 		= str_replace(' ', '', $kode_obat);
			$register_data['obat_satuan'] 		= htmlspecialchars($this->input->post('satuan', true));
			$register_data['obat_create'] 		= date('Y-m-d H:i:s');
			
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
		$this->form_validation->set_rules('nama', 'Nama Obat', 'required|trim');
		$this->form_validation->set_rules('satuan', 'Satuan Obat', 'required|trim');
		$this->form_validation->set_rules('kode', 'Kode Obat', 'required|trim');
		
		$this->load->model($this->MainModel(), 'M_najzmi');
		if($this->form_validation->run() == FALSE){
			$_id = base64_decode($this->uri->segment(3));
			$dt_obat= $this->M_najzmi->edit($_id);
			$this->data['id'] = [
				'name' 			=> 'id',
				'id' 			=> 'id',
				'type' 			=> 'hidden',
				'value' 		=> base64_encode($dt_obat->id_obat),
			];
			$this->data['kode'] = [
				'name' 			=> 'kode',
				'id' 			=> 'kode',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Kode Obat',
				'required' 		=> 'required',
				'value' 		=> $dt_obat->obat_kode,
			];
			$this->data['nama'] = [
				'name' 			=> 'nama',
				'id' 			=> 'nama',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Nama Obat',
				'required' 		=> 'required',
				'value' 		=> $dt_obat->obat_nama,
			];
			$this->data['satuan'] = [
				'name' 			=> 'satuan',
				'id' 			=> 'satuan',
				'type' 			=> 'text',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Satuan (Pcs, Pak)',
				'required' 		=> 'required',
				'value' 		=> $dt_obat->obat_satuan,
			];
			
			$this->data[$this->ClassNama()] = 'active';
			$this->data['pdn_title'] 		= $this->nameApp().' | Edit - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Edit';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/edit';
			$this->template->load('template/admin','edit',$this->data);
		}else{
			$kode_obat = htmlspecialchars($this->input->post('kode', true));
			$register_data['obat_nama'] 		= htmlspecialchars($this->input->post('nama', true));
			$register_data['obat_satuan'] 		= htmlspecialchars($this->input->post('satuan', true));
			$register_data['obat_kode'] 		= str_replace(' ', '', $kode_obat);
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
	
	function data_json()
	{
		//Hanya Untuk Administrator
		if($this->input->method(TRUE)=='POST'): // Hanya lewat metode post saja yang di izinkan melihat dan mengambil data
		
			$csrf_name = $this->security->get_csrf_token_name();
			$csrf_hash = $this->security->get_csrf_hash();
				
			$tabel = 'v_obat';
			$column_order = array('', 'obat_kode','obat_nama','obat_stok','om_jml','ok_jml');
			$column_search = array('obat_kode','obat_nama','obat_stok');
			$order = array('id_obat' => 'DESC');
			//$where = array('admin_level' => 'Operator');
				
				$this->load->model('DatatablesModel' ,'M_najzmi');
				$list = $this->M_najzmi->get_datatables($tabel,$column_order,$column_search,$order);
				$data = array();
				$no = isset($_POST['start']) 	? $_POST['start'] 	: 1;
				
				foreach ($list as $pDn) {
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $pDn->obat_kode;
					$row[] = $pDn->obat_nama;
					$row[] = $pDn->om_jml;
					$row[] = $pDn->ok_jml;
					$row[] = $pDn->obat_stok.' '.$pDn->obat_satuan;
					$row[] = '<div class="btn-group">
								  <a href="'.$this->ClassNama().'/edit/'.base64_encode($pDn->id_obat).'"  class="btn btn-success btn-sm">Edit</a>
								  <a href="'.$this->ClassNama().'/hapus/'.base64_encode($pDn->id_obat).'" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
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
