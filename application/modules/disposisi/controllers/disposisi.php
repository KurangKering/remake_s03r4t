<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_disposisi');
	}

	public function index()
	{
		$this->load->view('vw_template_disposisi');
	}


	public function cetak($id)
	{
		$data['data_disposisi'] = $this->md_disposisi->select_cetak_disposisi($id);

		$this->load->view('vw_template_disposisi', $data);
	}

	public function modalDisposisi()
	{	
		$arrData = array();
		$this->load->model('surat_masuk/md_surat_masuk');
		$id = $this->input->post('id_surat_masuk');
		$data = $this->md_surat_masuk->select_detail($id);
		if($data)
		{
			$arrData['table']    = '<table class="table table-condensed table-striped">';
			$arrData['table'] 	  .= "<tr><td>Nomor Lembar Disposisi</td><td>".$data['no_lembar_disposisi']."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Tanggal Masuk</td><td>".date_converter($data['tgl_masuk'])."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Ditujukan Kepada</td><td>".$data['tujuan_text']."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Pengirim Surat</td><td>".$data['pengirim']."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Perihal</td><td>".$data['perihal']."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Disposisi Tujuan</td><td>".$data['eselon_nama']."</td></tr>";	
			$arrData['table'] 	  .= "<tr><td>Status</td><td>".$data['tahap_nama']."</td></tr>";	
			
			$arrData['table'] 	  .= "<tr><td>Catatan Tambahan</td><td>".$data['catatan_tambahan']."</td></tr>";	
			$file  	   = ($data['file'] ? anchor(base_url('uploads/surat_masuk/' . $data['file']), 'Click Untuk Melihat File Ini','target="_blank"') :'..');
			$arrData['table'] 	  .= "<tr><td>File Scanned</td><td>".$file."</td></tr>";	
			$arrData['table'] 	  .= '';
			$arrData['table']    .= '</table>';

		}
		$arrData['id_surat_masuk'] = $id;
		$arrData['pemberi_disposisi'] = currentUser('id');
		$arrData['disposisi_dari_text'] = $this->ion_auth->get_users_groups()->result()[0]->name;

		if (!empty(array_intersect($this->ion_auth->get_user_groups(), $this->config->item('disposisi')['tahap']['1']))) {
			$arrData['tahapan_disposisi'] = '1';
		}
		else if (!empty(array_intersect($this->ion_auth->get_user_groups(), $this->config->item('disposisi')['tahap']['2']))) {
			$arrData['tahapan_disposisi'] = '2';
			# code...
		}
		else if (!empty(array_intersect($this->ion_auth->get_user_groups(), $this->config->item('disposisi')['tahap']['3']))) {
			$arrData['tahapan_disposisi'] = '3';
			# code...
		}
		else if (!empty(array_intersect($this->ion_auth->get_user_groups(), $this->config->item('disposisi')['tahap']['4']))) {
			$arrData['tahapan_disposisi'] = '4';
			# code...
		}


		echo json_encode($arrData);
	}

	public function dummy()
	{
		$isExist = (bool)
		$this->md_Global->get_data_single(
			'surat_disposisi', 
			array(
				'id_surat_masuk' => 1,
				'tahapan_disposisi' => 1
				));

		debug( $isExist);
	}

	public function doDisposisi()
	{
		$container = array(
			'id_surat_masuk' => $this->input->post('id_surat_masuk'),
			'tahapan_disposisi' => $this->input->post('tahapan_disposisi'),
			'disposisi_dari_id' => $this->input->post('disposisi_dari_id'),
			'disposisi_dari_text' => $this->input->post('disposisi_dari_text'),
			'isi_disposisi' => $this->input->post('isi_disposisi'),
			'disposisi_ke_id' => '',
			'disposisi_ke_text' => '',
			'tanggal_disposisi' => date("Y-m-d H:i:s"),
			'created_by' => currentUser('username'),
			'created_on' => date("Y-m-d H:i:s"),
			);

		
	}



	public function tahap_satu()
	{

	}

	public function tahap_dua()
	{

	}


	public function tahap_tiga()
	{

	}
}

/* End of file disposisi.php */
/* Location: ./application/modules/disposisi/controllers/disposisi.php */