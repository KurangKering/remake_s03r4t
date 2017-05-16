<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_groups extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		$this->lihat();
	}

	public function lihat()
	{
		$this->template->title('Lihat Groups');
		$this->template->build('manage_groups/vw_lihat');
	}

	public function tambah()
	{

	}

	public function ubah()
	{

	}

	public function hapus()
	{

	}
}

/* End of file manage_users.php */
/* Location: ./application/modules/manage_users/controllers/manage_users.php */