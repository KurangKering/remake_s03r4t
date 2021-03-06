<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_surat_keluar extends CI_Model {


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
		
		if ($id) 
		{
			$sql = 'SELECT 
			surat_keluar.*, 
			ref_tahapan_proses.nama as tahap_nama 
			from surat_keluar 
			join ref_tahapan_proses 
			on surat_keluar.status_surat_id = ref_tahapan_proses.id 
			where id_surat_keluar = ?'; 

			$result = $this->db->query($sql, array($id));
			if ($result->num_rows() > 0 ) {
				$data[] = $result->row_array();
				return $data[0];
			}
		}
		return '';
		
	}
	public function select_surat_masuk()
	{

		$sql = 'SELECT 
		surat_keluar.*, 
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
			id_surat_keluar, 
			no_surat_keluar, 
			DATE_FORMAT(tgl_surat, "%d/%m/%Y") as tgl_surat, 
			tujuan_text, 
			perihal, 
			file, 
			pembuat_surat_text, 
			ref_tahapan_proses.nama
			')
		->from('surat_keluar')
		->join('ref_tahapan_proses', 'surat_keluar.status_surat_id = ref_tahapan_proses.id')
		->add_column(
			'detail_perihal',
			'<a href="#" onClick="showDetails($1)">$2</a>',
			'id_surat_keluar,perihal'
			)
		->add_column('nomor_urut', '0')
		->add_column('view', 
			'<a href="'. base_url('surat_keluar/') .'ubah/$1" 
			class="btn btn-default btn-md"
			title="Ubah">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

			<button type="button" 
			class="btn btn-default btn-md" 
			data-id_surat_keluar="$1" 
			data-href="surat_keluar/hapus/$1"  
			data-toggle="modal" 
			data-target="#confirm_delete_keluar"><i class="fa fa-trash" aria-hidden="true"></i></button>', 
			'id_surat_keluar');
		return $this->datatables->generate();

		// <button class="btn btn-default btn-md"  
		// 	onClick="showDetails($1)" 
		// 	id="detail" 
		// 	data-tooltip="tooltip" 
		// 	data-placement="left" 
		// 	title="Detail">
		// 	<i class="fa fa-info" aria-hidden="true"></i></button>

	}

}

/* End of file md_surat_masuk.php */
/* Location: ./application/modules/surat_masuk/models/md_surat_masuk.php */