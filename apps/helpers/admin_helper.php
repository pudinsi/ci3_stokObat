<?php if ( ! defined('__NAJZMI_PUDINTEA__')) exit('No direct script access allowed');
/*
* Pudin S I
* najzmitea@gmail.com
* Ciamis, Jawa Barat
* https://t.me/pudin_ira
* https://instagram.com/pudin.ira
* https://www.pdn.my.id
*/

if ( ! function_exists('pdn_adm_sess_nama_user'))
{
	function pdn_adm_sess_nama_user()
	{	
		$nama_tb = 'users';
		$CI = get_instance();
		$auth_id = $CI->session->userdata('pdn_login');
		$CI->db->select('users_nama');
		$CI->db->where('id_users', $auth_id);
		$datatb = $CI->db->get($nama_tb)->row();
		return $datatb->users_nama;
	}
}
// Pemanggilanya : pdn_adm_sess_nama_user()

if ( ! function_exists('pdn_adm_sess_email_user'))
{
	function pdn_adm_sess_email_user()
	{	
		$nama_tb = 'users';
		$CI = get_instance();
		$auth_id = $CI->session->userdata('pdn_login');
		$CI->db->select('users_email');
		$CI->db->where('id_users', $auth_id);
		$datatb = $CI->db->get($nama_tb)->row();
		return $datatb->users_email;
	}
}

