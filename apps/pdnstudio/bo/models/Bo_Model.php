<?php  if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/**
*
* Author:  Pudin S I
* 		   najzmitea@gmail.com
*
*/

class Bo_Model extends CI_Model
{
	/* nama database */
	//protected 
	private $_dtable 	= 'users';
	private $_vtable 	= 'v_admin_unit';
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
	
	function db_get_where($data_array){
		$this->_result = $this->db->get_where($this->_dtable, $data_array)->row_array();
		if ($this->_result) {
            return $this->_result;
        }
	}

    function update_token($data, $where)
    {
        $this->db->where($where);
        $this->_result = $this->db->update($this->_dtable, $data);

        if ($this->_result) {
            return $this->_result;
        }
    }
	
		/**
     * Ganti Password
     **/

    function c_pass($data, $_id_)
    {
        if (empty ($_id_)) {
            return false;
        }

        $this->db->where($this->_dtable_id, $_id_);
        $this->_result = $this->db->update($this->_dtable, $data);

        if ($this->_result) {
            return $this->_result;
        }
    }

	
}