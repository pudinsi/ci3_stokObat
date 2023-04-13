<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash extends CI_Controller {

	function __construct(){
		$this->data = [];
		parent::__construct();
			$this->admin_bo->pdn_is_login();
			date_default_timezone_set ('Asia/Jakarta');
	}
	
	public function title()       	{ return 'Dashboard'; }
    public function author()      	{ return 'Pudin S I'; }
	public function MainModel()   	{ return 'Dash_Model'; }
    public function contact()     	{ return 'najzmitea@gmail.com'; }
	public function ClassNama()   	{ return 'dash'; }
	
	public function index()
	{
		
		$this->data[$this->ClassNama()] = 'active';
		if ( $this->session->userdata('pdn_level') == 'Admin'){
			//Hanya Untuk Administrator
			$this->template->pdn_load('template/admin','konten','konten_kode',$this->data);
		};
	}
}
