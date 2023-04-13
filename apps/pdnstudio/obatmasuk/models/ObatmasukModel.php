<?php if (!defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/**
 *
 * Author:  Pudin S I
 * 		   najzmitea@gmail.com
 *
 */

class ObatmasukModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->admin_bo->pdn_is_login();
    }
    /* nama database */
    //protected 
    private $_dtable     = 'obatmasuk';
    private $_dtable_id = 'id_om';

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

    function db_get()
    {
        $this->db->select('id_obat, obat_nama, obat_kode');
        $this->_result = $this->db->get('obat')->result();
        if ($this->_result) {
            return $this->_result;
        }
    }

    /**
     * SAVE
     **/

    function save($save_data)
    {
        if (empty($save_data['om_obatkode'])) {
            return false;
        }

        $this->_result = $this->db->insert($this->_dtable, $save_data);

        if ($this->_result) {
            return $this->_result;
        }
    }

    /**
     * EDIT
     **/

    function edit($_id)
    {
        if (empty($_id)) {
            return false;
        }

        $this->db->where($this->_dtable_id, $_id);
        $this->_result = $this->db->get('v_j_obatmasuk')->row();

        if ($this->_result) {
            return $this->_result;
        }
    }

    /**
     * UPDATE
     **/

    function update($data, $_id_)
    {
        if (empty($_id_)) {
            return false;
        }

        $this->db->where($this->_dtable_id, $_id_);
        $this->_result = $this->db->update($this->_dtable, $data);

        if ($this->_result) {
            return $this->_result;
        }
    }


    /**
     * DELETE
     **/

    function delete($_id_)
    {
        if (empty($_id_)) {
            return false;
        }

        $this->db->where($this->_dtable_id, $_id_);
        $this->_result = $this->db->delete($this->_dtable);

        if ($this->_result) {
            return $this->_result;
        }
    }

}
