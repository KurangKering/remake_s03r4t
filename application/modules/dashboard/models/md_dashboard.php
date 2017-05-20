<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_dashboard extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function get_total_surat_masuk()
	{
		$sql = '
		SELECT 
		COUNT(id_surat_masuk) 
		from surat_masuk
		';
		$this->db->select('COUNT(id_surat_masuk) as total_surat_masuk');
		$this->db->from('surat_masuk');
		$result = $this->db->get()->row_array()['total_surat_masuk'];
		return $result;

	}

	public function get_total_surat_keluar()
	{
		$sql = '
		SELECT 
		COUNT(id_surat_keluar) 
		from surat_keluar
		';
		$this->db->select('COUNT(id_surat_keluar) as total_surat_keluar');
		$this->db->from('surat_keluar');
		$result = $this->db->get()->row_array()['total_surat_keluar'];
		return $result;

	}
	public function get_total_pengguna()
	{
		$sql = '
		SELECT 
		COUNT(id) 
		from sys_users
		';
		$this->db->select('COUNT(id) as total_pengguna');
		$this->db->from('sys_users');
		$result = $this->db->get()->row_array()['total_pengguna'];
		return $result;

	}

}

/* End of file md_dashboard.php */
/* Location: ./application/modules/dashboard/models/md_dashboard.php */