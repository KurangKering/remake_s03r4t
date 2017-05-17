<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_Surat_masuk extends CI_Model {



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
			surat_masuk.*, 
			ref_tahapan_proses.*, 
			ref_tahapan_proses.nama as tahap_nama , 
			ref_eselon.*, 
			ref_eselon.nama as eselon_nama 
			FROM surat_masuk 
			join ref_tahapan_proses on surat_masuk.status_id = ref_tahapan_proses.id 
			join ref_eselon on surat_masuk.disposisi_tujuan_id = ref_eselon.id 
			where id_surat_masuk = ?
			';
			return $this->db->query($sql, array($id))->row_array();
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
		JOIN ref_eselon ON surat_masuk.disposisi_tujuan_id = ref_eselon.id ';

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
			id_surat_masuk, 
			no_lembar_disposisi, 
			DATE_FORMAT(tgl_masuk, "%d/%m/%Y") as tgl_masuk, 
			pengirim, 
			perihal, 
			tujuan_text, 
			ref_tahapan_proses.nama as status_nama
			')
		->from('surat_masuk')
		->join('ref_tahapan_proses', 'surat_masuk.status_id = ref_tahapan_proses.id')
		->add_column('nomor_urut', '0')
		->add_column(
			'view', 
			'<button 
			class="btn btn-default btn-md" 
			onClick="showDetails($1)" 
			id="detail" 
			data-tooltip="tooltip" 
			data-placement="left" 
			title="Detail">
			<i class="fa fa-info" aria-hidden="true"></i></button>

			<a href="'. base_url('surat_masuk/') .'ubah/$1" 
			class="btn btn-default btn-md"
			title="Ubah">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

			<button type="button" 
			class="btn btn-default btn-md" 
			data-id_surat_masuk="$1" 
			data-href="surat_masuk/hapus/$1"  
			data-toggle="modal" 
			data-target="#confirm-delete"
			><i class="fa fa-trash" aria-hidden="true"></i></button>', 
			'id_surat_masuk');

		return $this->datatables->generate();

	}

}

/* End of file md_surat_masuk.php */
/* Location: ./application/modules/surat_masuk/models/md_surat_masuk.php */