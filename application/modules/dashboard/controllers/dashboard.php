<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('md_dashboard');
	}

	public function index()
	{
		$data['total_surat_masuk'] = $this->md_dashboard->get_total_surat_masuk();
		$data['total_surat_keluar'] = $this->md_dashboard->get_total_surat_keluar();
		$data['total_pengguna'] = $this->md_dashboard->get_total_pengguna();

		$this->template->build('vw_dashboard', $data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/modules/dashboard/controllers/dashboard.php */