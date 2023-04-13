<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_dash extends CI_Controller {

	function __construct(){
		$this->data = [];
		parent::__construct();
			$this->admin_bo->pdn_is_login();
			date_default_timezone_set ('Asia/Jakarta');
	}
	
	public function nameApp()       { return 'Stok Obat'; }
	public function title()       	{ return 'Dashboard'; }
    public function author()      	{ return 'Pudin S I'; }
	public function MainModel()   	{ return 'Adm_dash_Model'; }
    public function contact()     	{ return 'najzmitea@gmail.com'; }
	public function ClassNama()   	{ return 'adm_dash'; }
	
	public function index()
	{
		$this->data[$this->ClassNama()] = 'active';
		$this->data['pdn_title'] 		= $this->nameApp().' | '.$this->title();
		$this->data['pdn_info'] 		= $this->title();
		$this->data['pdn_url'] 			= $this->ClassNama();
		$this->template->pdn_load('template/admin','konten','konten_kode',$this->data);
	}
	
	function data_json()
	{
		//if($this->input->method(TRUE)=='POST'): // Hanya lewat metode post saja yang di izinkan melihat dan mengambil data
			$this->load->model($this->MainModel(), 'M_najzmi');
			$dttp = $this->M_najzmi->getObat();
			$row = array();
			foreach ($dttp as $pDn) {
				$row[] = array(
					'isi_label'		=> $pDn->obat_kode.'-'.$pDn->obat_nama,
					'isi_data' 		=> $pDn->obat_stok,
				);
			}
			header('Content-Type: application/json');
			echo json_encode($row,TRUE);
		//endif;
	}
}
