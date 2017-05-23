<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_Surat_masuk extends CI_Model {



	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}	
	public function data_cetak_disposisi($id)
	{
		$sql = 'SELECT surat_masuk.*, 
		surat_disposisi.tahapan_disposisi, 
		surat_disposisi.isi_disposisi 
		FROM surat_masuk  
		join surat_disposisi 
		on surat_masuk.id_surat_masuk = surat_disposisi.id_surat_masuk 
		WHERE surat_masuk.id_surat_masuk = ?
		GROUP BY tahapan_disposisi 
		ORDER BY  tahapan_disposisi
		';
		return $this->db->query($sql, array($id)) ? $this->db->query($sql, array($id))->result_array() : array();
	}
	public function ref_eselon()
	{
		$this->db->select('name');
		$this->db->select('id');
		$this->db->from('sys_groups');
		$this->db->where_in('id', array('70','80','90','100', '110', '120', '130', '140'));
		return $this->db->get()->result_array() ;

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
			sys_groups.name
			FROM surat_masuk 
			join ref_tahapan_proses on surat_masuk.status_id = ref_tahapan_proses.id 
			join sys_groups on surat_masuk.disposisi_tujuan_id = sys_groups.id 
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

	public function json_select_admin()
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
			'detail_perihal',
			'<a href="#" 
			class=""
			onClick="showDetails($1)">$2</a>',
			'id_surat_masuk,perihal'
			)
		->add_column(
			'status',
			'<a 
			href="#"
			onClick="showStatusDisposisi($1)" 
			id="detail" 
			data-keyboard="false" 
			data-backdrop="static"
			title="Status Disposisi">
			$2</a>',
			'id_surat_masuk,status_nama'
			)
		->add_column(
			'view', 
			'
			<button 
			class="btn btn-default btn-md" 
			onClick="loadAnoterPage($1)" 
			id="detail" 
			data-tooltip="tooltip" 
			data-placement="left" 
			title="Cetak Disposisi">
			<i class="fa fa-print" aria-hidden="true"></i></button>

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
			title="Hapus Data"
			><i class="fa fa-trash" aria-hidden="true"></i></button>', 
			'id_surat_masuk');
		return $this->datatables->generate();

		/*this is detail button*/
		// <button 
		// 	class="btn btn-default btn-md" 
		// 	onClick="showDetails($1)" 
		// 	id="detail" 
		// 	data-tooltip="tooltip" 
		// 	data-placement="left" 
		// 	title="Detail">
		// 	<i class="fa fa-info" aria-hidden="true"></i></button>
	}


	public function json_select_disposisi($status = null)
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
		->like('status_id', $status)
		->add_column('nomor_urut', '0')
		->add_column(
			'detail_perihal',
			'<a href="#" onClick="showDetails($1)">$2</a>',
			'id_surat_masuk,perihal'
			)
		->add_column(
			'status',
			'<button 
			class="btn btn-default btn-md" 
			onClick="showStatusDisposisi($1)" 
			id="detail" 
			data-keyboard="false" 
			data-backdrop="static"
			title="Detail">
			$2</button>',
			'id_surat_masuk,status_nama'
			)
		->add_column(
			'view', 
			'
			<button 
			class="btn btn-default btn-md" 
			onClick="showDisposisi($1)" 
			id="detail" 
			data-keyboard="false" 
			data-backdrop="static"
			title="Detail">
			Disposisi</button>
			', 
			'id_surat_masuk');

		return $this->datatables->generate();

	}


	public function select_data_disposisi($id)
	{
		
		$sql = 'SELECT
		surat_disposisi.*,
		sys_users.id as userid,
		sys_users.fullname,
		sys_groups.name as group_name
		FROM surat_disposisi
		JOIN sys_users on surat_disposisi.disposisi_dari_id = sys_users.id
		JOIN sys_user_group ON  sys_users.id = sys_user_group.userid
		JOIN sys_groups ON sys_user_group.groupid = sys_groups.id
		WHERE id_surat_masuk = ?
		ORDER BY tahapan_disposisi
		';
		return $this->db->query($sql, array($id))->result_array();
	}



	public function json_select_sudah_disposisi( $id_user = null)
	{
		
		$this->datatables->select('
			surat_masuk.id_surat_masuk, 
			no_lembar_disposisi, 
			DATE_FORMAT(tgl_masuk, "%d/%m/%Y") as tgl_masuk, 
			pengirim, 
			perihal, 
			tujuan_text, 
			ref_tahapan_proses.nama as status_nama
			')
		->from('surat_masuk')
		->join('ref_tahapan_proses', 'surat_masuk.status_id = ref_tahapan_proses.id')
		->join('surat_disposisi', 'surat_disposisi.id_surat_masuk = surat_masuk.id_surat_masuk')
		//->where('surat_disposisi.disposisi_dari_id', $id_user )
		->group_by('surat_masuk.id_surat_masuk')
		->add_column('nomor_urut', '0')
		->add_column(
			'detail_perihal',
			'<a href="#" onClick="showDetails($1)">$2</a>',
			'id_surat_masuk,perihal'
			)
		->add_column(
			'status',
			'<button 
			class="btn btn-default btn-md" 
			onClick="showStatusDisposisi($1)" 
			id="detail" 
			data-keyboard="false" 
			data-backdrop="static"
			title="Detail">
			$2</button>',
			'id_surat_masuk,status_nama'
			)
		->add_column(
			'view', 
			'
			<button 
			class="btn btn-default btn-md" 
			onClick="loadAnoterPage($1)" 
			id="detail" 
			data-tooltip="tooltip" 
			data-placement="left" 
			title="Cetak Disposisi">
			<i class="fa fa-print" aria-hidden="true"></i></button>', 
			'id_surat_masuk');

		return $this->datatables->generate();
	}


}

/* End of file md_surat_masuk.php */
/* Location: ./application/modules/surat_masuk/models/md_surat_masuk.php */