<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_users extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	

	public function select_tahapan_proses()
	{
		$tahapan_proses = $this->md_Global->get_data_all('ref_tahapan_proses');
		$tahap = array();
		foreach ($tahapan_proses as $key => $value) {
			$tahap[$value['Id']] = $value['nama'];
		}
		return $tahap;
	}

	public function select_detail($id)
	{
		
		if ($id) {
			$sql = 'SELECT 
			sys_users.id as userid,
			sys_users.username,
			sys_users.fullname,
			sys_users.email,
			sys_users.active,
			sys_users.phone,
			FROM_UNIXTIME(sys_users.last_login, "%d/%m/%Y") as last_login
			FROM sys_users
			WHERE sys_users.id = ?
			';

			return	$this->db->query($sql, array($id)) ? $this->db->query($sql, array($id))->row_array() : array();
			
		}
		return array();
		
	}
	public function select_surat_masuk()
	{

		$sql = 'SELECT 
		surat_masuk.*, 
		ref_eselon.kode, 
		ref_eselon.nama    
		FROM surat_masuk  
		JOIN ref_eselon 
		ON surat_masuk.disposisi_tujuan_id = ref_eselon.id ';

		return $this->db->query($sql)->result_array();

	}
	public function select_disposisi_tujuan()
	{
		$sql = 'SELECT 
		* 
		FROM ref_eselon 
		WHERE kode = "ESELON IV" ';
		return $this->db->query($sql)->result_array();
	} 

	public function json_select()
	{
		$this->datatables->select('
			sys_users.id,
			sys_users.username,
			FROM_UNIXTIME(sys_users.last_login, "%d/%m/%Y") as last_login,
			sys_users.fullname,
			sys_users.first_name,
			sys_users.last_name,
			sys_users.email,
			sys_users.phone
			')
		->from('sys_users')
		->add_column('nomor_urut', '0')
		->add_column(
			'view', 
			'<button class="btn btn-default btn-md"
			onClick="showDetails($1)"
			id="detail"
			data-tooltip="tooltip"
			data-placement="left"
			title="Detail">
			<i class="fa fa-info" aria-hidden="true"></i></button>

			<a href="'. base_url('manage/users/') .'ubah/$1" 
			class="btn btn-default btn-md" 
			title="Ubah">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

			<button type="button" 
			class="btn btn-default btn-md" 
			data-id="$1" 
			data-href="'. base_url('manage/users/') . 'hapus/$1" 
			data-toggle="modal" 	
			data-target="#confirm-delete"><i class="fa fa-trash" aria-hidden="true"></i></button>', 
			'id');
		return $this->datatables->generate();

	}

}

/* End of file md_arsip.php */
/* Location: ./application/modules/arsip/models/md_arsip.php */