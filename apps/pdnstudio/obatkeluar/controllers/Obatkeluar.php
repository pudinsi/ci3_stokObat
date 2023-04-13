<?php defined('__NAJZMI_PUDINTEA__') or exit('No direct script access allowed');

class Obatkeluar extends CI_Controller
{
	function __construct()
	{
		$this->data = [];
		parent::__construct();
		$this->admin_bo->pdn_is_login();
		date_default_timezone_set('Asia/Jakarta');
	}
	public function nameApp()
	{ 
		return 'Stok Obat'; 
	}
	public function title()
	{
		return 'Obat Keluar';
	}
	public function author()
	{
		return 'Pudin S I';
	}
	public function MainModel()
	{
		return 'ObatkeluarModel';
	}
	public function contact()
	{
		return 'najzmitea@gmail.com';
	}
	public function ClassNama()
	{
		return 'obatkeluar';
	}

	public function index()
	{
		//Hanya Untuk Administrator
		$this->data[$this->ClassNama()] = 'active';
		$this->data['pdn_title'] 		= $this->nameApp().' | '.$this->title();
		$this->data['pdn_info'] 		= $this->title();
		$this->data['pdn_url'] 			= $this->ClassNama();
		$this->template->pdn_load('template/admin', 'konten', 'konten_kode', $this->data);
	}

	function add()
	{
		//Hanya Untuk Administrator
		$this->form_validation->set_rules('jumlah', 'Jumlah Obat', 'required|trim');
		$this->form_validation->set_rules('kode', 'Kode Obat', 'required|trim');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
		//LOAD MODEL
		$this->load->model($this->MainModel(), 'M_najzmi');
		$this->data['dtobat'] = $this->M_najzmi->db_get();
		if ($this->form_validation->run() == FALSE) {
			$this->data['tanggal'] = [
				'name' 			=> 'tanggal',
				'id' 			=> 'tanggal',
				'type' 			=> 'date',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Tanggal',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('tanggal'),
			];
			$this->data['omjumlah'] = [
				'name' 			=> 'jumlah',
				'id' 			=> 'jumlah',
				'type' 			=> 'number',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Jumlah',
				'required' 		=> 'required',
				'value' 		=> $this->form_validation->set_value('jumlah'),
			];
			$this->data['pdn_title'] 		= $this->nameApp().' | Tambah - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Tambah';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/add';
			$this->data[$this->ClassNama()] = 'active';
			$this->template->load('template/admin', 'add', $this->data);
		} else {
			$kode_obat = htmlspecialchars($this->input->post('kode', true));
			$register_data['ok_tanggal'] 		= htmlspecialchars($this->input->post('tanggal', true));
			$register_data['ok_jumlah'] 		= htmlspecialchars($this->input->post('jumlah', true));
			$register_data['ok_obatkode'] 		= str_replace(' ', '', $kode_obat);
			$register_data['ok_create'] 		= date('Y-m-d H:i:s');

			$input = $this->M_najzmi->save($register_data);

			if ($input) {
				$message = $this->title() . " berhasil ditambah!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			} else {
				$message = "MAAF, " . $this->title() . " tidak bisa ditambah";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama() . '/add'), 'refresh');
			}
		}
	}

	function edit()
	{
		//Hanya Untuk Administrator
		$this->form_validation->set_rules('jumlah', 'Jumlah Obat', 'required|trim');
		$this->form_validation->set_rules('kode', 'Kode Obat', 'required|trim');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');

		$this->load->model($this->MainModel(), 'M_najzmi');
		if ($this->form_validation->run() == FALSE) {
			$_id = base64_decode($this->uri->segment(3));
			$this->data['dtobat'] = $this->M_najzmi->db_get();
			$ok = $this->M_najzmi->edit($_id);
			$this->data['kode_obat'] = $ok->ok_obatkode;
			$this->data['nama_obat'] = $ok->obat_nama;
			$this->data['id'] = [
				'name' 			=> 'id',
				'id' 			=> 'id',
				'type' 			=> 'hidden',
				'required' 		=> 'required',
				'value' 		=> base64_encode($ok->id_ok),
			];
			$this->data['tanggal'] = [
				'name' 			=> 'tanggal',
				'id' 			=> 'tanggal',
				'type' 			=> 'date',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Tanggal',
				'required' 		=> 'required',
				'value' 		=> $ok->ok_tanggal,
			];
			$this->data['omjumlah'] = [
				'name' 			=> 'jumlah',
				'id' 			=> 'jumlah',
				'type' 			=> 'number',
				'class' 		=> 'form-control',
				'placeholder' 	=> 'Jumlah',
				'required' 		=> 'required',
				'value' 		=> $ok->ok_jumlah,
			];
			$this->data[$this->ClassNama()] = 'active';
			$this->data['pdn_title'] 		= $this->nameApp().' | Edit - '.$this->title();
			$this->data['pdn_info'] 		= $this->title();
			$this->data['pdn_url'] 			= $this->ClassNama();
			$this->data['pdn_page'] 		= 'Edit';
			$this->data['pdn_uform'] 		= $this->ClassNama().'/edit';
			$this->template->load('template/admin', 'edit', $this->data);
		} else {
			$kode_obat = htmlspecialchars($this->input->post('kode', true));
			$register_data['ok_tanggal'] 		= htmlspecialchars($this->input->post('tanggal', true));
			$register_data['ok_jumlah'] 		= htmlspecialchars($this->input->post('jumlah', true));
			$register_data['ok_obatkode'] 		= str_replace(' ', '', $kode_obat);
			$_id 								= htmlspecialchars(base64_decode($this->input->post('id', true)));

			$this->load->model($this->MainModel(), 'M_najzmi');
			$input = $this->M_najzmi->update($register_data, $_id);

			if ($input) {
				$message = $this->title() . " berhasil diupdate!";
				$this->session->set_flashdata('success', $message);
				redirect(base_url($this->ClassNama()), 'refresh');
			} else {
				$message = "MAAF, " . $this->title() . " gagal diupdate";
				$this->session->set_flashdata('error', $message);
				redirect(base_url($this->ClassNama() . '/edit/' . $_id), 'refresh');
			}
		}
	}

	function hapus()
	{
		//Hanya Untuk Administrator
		$_id = base64_decode($this->uri->segment(3));

		$this->load->model($this->MainModel(), 'M_najzmi');

		$input = $this->M_najzmi->delete($_id);

		if ($input) {
			$message = $this->title() . " berhasil dihapus!";
			$this->session->set_flashdata('success', $message);
		} else {
			$message = "MAAF, " . $this->title() . " gagal dihapus";
			$this->session->set_flashdata('error', $message);
		}

		redirect(base_url($this->ClassNama()), 'refresh');
	}

	function data_json()
	{
		//Hanya Untuk Administrator
		if ($this->input->method(TRUE) == 'POST') : // Hanya lewat metode post saja yang di izinkan melihat dan mengambil data

		$csrf_name = $this->security->get_csrf_token_name();
		$csrf_hash = $this->security->get_csrf_hash();

		$tabel = 'v_j_obatkeluar';
		$column_order = array('', 'ok_obatkode', 'ok_tanggal', 'ok_jumlah');
		$column_search = array('ok_obatkode', 'ok_tanggal', 'ok_jumlah');
		$order = array('id_ok' => 'DESC');
		//$where = array('admin_level' => 'Operator');

		$this->load->model('DatatablesModel', 'M_najzmi');
		$list = $this->M_najzmi->get_datatables($tabel, $column_order, $column_search, $order);
		$data = array();
		$no = isset($_POST['start']) 	? $_POST['start'] 	: 1;

		foreach ($list as $pDn) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pDn->ok_obatkode;
			$row[] = $pDn->obat_nama;
			$row[] = $pDn->ok_tanggal;
			$row[] = $pDn->ok_jumlah.' '.$pDn->obat_satuan;
			$row[] = '<div class="btn-group">
								  <a href="'.$this->ClassNama().'/edit/' . base64_encode($pDn->id_ok) . '"  class="btn btn-success btn-sm">Edit</a>
								  <a href="'.$this->ClassNama().'/hapus/' . base64_encode($pDn->id_ok) . '" class="btn btn-danger btn-sm tombol-hapus">Hapus</a>
								</div>';

			$data[] = $row;
		}


		$output = array(
			"draw" => isset($_POST['draw']) 	? $_POST['draw'] 	: 'null',
			"recordsTotal" => $this->M_najzmi->count_all($tabel, $column_order, $column_search, $order),
			"recordsFiltered" => $this->M_najzmi->count_filtered($tabel, $column_order, $column_search, $order),
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
