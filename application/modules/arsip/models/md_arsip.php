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
			sys_users.username
			FROM surat_arsip
			JOIN sys_box_name
			ON surat_arsip.no_berkas = sys_box_name.id
			JOIN sys_users 
			ON surat_arsip.nama_penerima = sys_users.id
			WHERE surat_arsip.id = 1
			';

			return	$this->db->query($sql, array($id)) ? $this->db->query($sql, array($id))->row_array() : array();
			
		}
		return array();
		
	}
	public function select_surat_masuk()
	{

		$sql = 'SELECT surat_masuk.*, ref_eselon.kode, ref_eselon.nama    FROM surat_masuk  JOIN ref_eselon ON surat_masuk.disposisi_tujuan_id = ref_eselon.id ';
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0 ) {
			return $result->result_array();
			# code...
		}
		return array();
		
	}
	public function select_disposisi_tujuan()
	{
		$sql = 'SELECT * FROM ref_eselon WHERE kode = "ESELON IV" ';
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0 ) {
			return $result->result_array();
			# code...
		}
		return array();
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
			surat_arsip.tanggal_masuk_arsip, 
			surat_arsip.nama_penerima, 
			surat_arsip.nama_penyerah, 
			surat_arsip.lengkap, 
			surat_arsip.status, 
			surat_arsip.keterangan,
			sys_box_name.nama_box,
			sys_users.username
			')
		->from('surat_arsip')
		->join('sys_box_name', 'surat_arsip.no_berkas = sys_box_name.id')
		->join('sys_users', 'surat_arsip.nama_penerima = sys_users.id')
		->add_column('nomor_urut', '0')
		->add_column('view', '<button class="btn btn-round btn-info btn-xs"  onClick="showDetails($1)" id="detail" data-tooltip="tooltip" data-placement="left" title="Lihat Detail">details</button> <a href="'. base_url('arsip/') .'ubah/$1" class="btn btn-round btn-warning btn-xs">edit</a> <button type="button" class="btn btn-round btn-danger btn-xs" data-id_arsip="$1" data-href="arsip/hapus/$1"  data-toggle="modal" data-target="#confirm-delete">delete</button>', 'id_surat_arsip');
		return $this->datatables->generate();

	}

}

/* End of file md_arsip.php */
/* Location: ./application/modules/arsip/models/md_arsip.php */