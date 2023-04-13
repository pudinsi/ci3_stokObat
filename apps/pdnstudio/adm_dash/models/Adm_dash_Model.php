<?php  if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/**
*
* Author:  Pudin S I
* 		   najzmitea@gmail.com
*
*/

class Adm_dash_Model extends CI_Model
{
	function __construct(){
		parent::__construct();
			$this->admin_bo->pdn_is_login();
	}
	/* nama database */
	//protected 
	private $_dtable 	= 'users';
	private $_dtable_id = 'id_users';
	
	/**
     * return _retval
     *
     * @var Boolean
     **/
    private $_retval = NULL;

    /**
     * return _result
     *
     * @var Boolean
     **/
    private $_result = FALSE;

    /**
     * return _retarr
     *
     * @var Array
     **/
    private $_retarr = array();
	
	function getObat(){
		//$this->db->select('kode_obat, obat_nama, obat_stok');
		$query = $this->db->get('v_obat')->result();
		return $query;
	}
}