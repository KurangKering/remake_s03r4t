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

	public function tahap_satu()
	{

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
		$arrData['pemberi_disposisi'] = $this->ion_auth->user()->row();
		echo json_encode($arrData);
	}
}

/* End of file disposisi.php */
/* Location: ./application/modules/disposisi/controllers/disposisi.php */