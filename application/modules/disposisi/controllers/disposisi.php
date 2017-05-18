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

	public function otomatis()
	{
		$document = file_get_contents("./uploads/template/template_disposisi.rtf");
		$document = str_replace("#Indeks", '11111111af sadfs adfsd fsd111', $document);
		$document = str_replace("#tanggal", '2222222 sdfsa fs fs fsdf s2', $document);
		$document = str_replace("#urut", '3333f asdfsa fsd sa33', $document);
		$document = str_replace("#perihal", '21312 123 123 123 123 123 123 123 123 123 123 13 12', $document);
		header("Content-type: application/msword");
		header("Content-disposition: inline; filename=laporan.doc");
		header("Content-length: ".strlen($document));
		echo $document;
	}

}

/* End of file disposisi.php */
/* Location: ./application/modules/disposisi/controllers/disposisi.php */