<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_arsip extends CI_Model {

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
			surat_arsip.id as id_surat_arsip, 
			surat_arsip.no_ruang,
			surat_arsip.no_lemari, 
			surat_arsip.no_rak, 
			surat_arsip.no_berkas, 
			surat_arsip.nomor_arsip, 
			surat_arsip.tanggal_masuk_arsip, 
			surat_arsip.nama_penerima, 
			surat_arsip.nama_penyerah, 
			surat_arsip.lengkap, 
			surat_arsip.status, 
			surat_arsip.keterangan,
			sys_box_name.nama_box,
			sys_users.fullname as penerima,
			ref_eselon.nama as nama_eselon
			FROM surat_arsip
			JOIN sys_box_name
			ON surat_arsip.no_berkas = sys_box_name.id
			JOIN sys_users 
			ON surat_arsip.nama_penerima = sys_users.id
			JOIN ref_eselon
			ON surat_arsip.no_ruang = ref_eselon.id
			WHERE surat_arsip.id = ?
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
			surat_arsip.id as id_surat_arsip, 
			surat_arsip.no_ruang,
			surat_arsip.no_lemari, 
			surat_arsip.no_rak, 
			surat_arsip.no_berkas, 
			surat_arsip.nomor_arsip, 
			DATE_FORMAT(surat_arsip.tanggal_masuk_arsip, "%d/%m/%Y") as tanggal_masuk_arsip, 
			surat_arsip.nama_penerima, 
			surat_arsip.nama_penyerah, 
			surat_arsip.lengkap, 
			surat_arsip.status, 
			surat_arsip.keterangan,
			sys_box_name.nama_box,
			ref_eselon.nama as nama_ruang
			')
		->from('surat_arsip')
		->join('sys_box_name', 'surat_arsip.no_berkas = sys_box_name.id')
		->join('ref_eselon', 'surat_arsip.no_ruang = ref_eselon.id')
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

			<a href="'. base_url('arsip/') .'ubah/$1" 
			class="btn btn-default btn-md" 
			title="Ubah">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

			<button type="button" 
			class="btn btn-default btn-md" 
			data-id="$1" 
			data-href="arsip/hapus/$1" 
			data-toggle="modal" 	
			data-target="#confirm-delete"><i class="fa fa-trash" aria-hidden="true"></i></button>', 
			'id_surat_arsip');
		return $this->datatables->generate();

	}

}

/* End of file md_arsip.php */
/* Location: ./application/modules/arsip/models/md_arsip.php */