<?php if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/**
*
* Author:  Pudin S Ilham
* 		   https;//t.me/pudin_ira
*
*
*/

class DatatablesModel extends CI_Model
{
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
	
	/**
     * Datatables server side
     *
     * 
     **/
	 
	private function _get_datatables_query($tabel,$column_order,$column_search,$order)
	{
		$this->db->from($tabel);
		$i = 0;
	
		foreach ($column_search as $item)
		{
			if( !empty($this->input->post('search')['value']))
			{
				
				if($i===0)
				{
					$this->db->group_start();
					$this->db->like($item, $this->input->post('search')['value']);
				}
				else
				{
					$this->db->or_like($item, $this->input->post('search')['value']);
				}

				if(count($column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($tabel,$column_order,$column_search,$order)
	{
		$this->_get_datatables_query($tabel,$column_order,$column_search,$order);
		if(isset($_POST['length']) 	? $_POST['length'] 	: '' != -1)
		$this->db->limit( isset($_POST['length']) 	? $_POST['length'] 	: '10', isset($_POST['start']) 	? $_POST['start'] 	: '');
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($tabel,$column_order,$column_search,$order)
	{
		
		$this->_get_datatables_query($tabel,$column_order,$column_search,$order);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($tabel,$column_order,$column_search,$order)
	{
		
		$this->db->from($tabel,$column_order,$column_search,$order);
		return $this->db->count_all_results();
	}
	/* End datatables Server Side */
	
}