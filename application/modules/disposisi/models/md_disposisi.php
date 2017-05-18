<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Md_disposisi extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function select_cetak_disposisi($id)
	{
		$sql = '
		SELECT
		surat_masuk.*
		FROM surat_masuk
		WHERE id_surat_masuk = ?
		';
		return $this->db->query($sql, array($id))->row_array();

	}

}

/* End of file md_disposisi.php */
/* Location: ./application/modules/disposisi/models/md_disposisi.php */