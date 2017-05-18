<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_arsip');
	}

	public function index()
	{
	}


	public function lihat()
	{
		/*load css datatables*/
		$this->template->append_metadata('<link href="'. base_url("assets/plugins/datatables/media/css/jquery.dataTables.min.css").'" rel="stylesheet">');
		$this->template->append_metadata('<link href="'. base_url("assets/plugins/datatables/media/css/dataTables.bootstrap.min.css").'" rel="stylesheet">');
		/*load js datatables*/
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/datatables/media/js/jquery.dataTables.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/datatables/media/js/dataTables.bootstrap.min.js") . '"></script>');

		$this->template->build('vw_lihat');
	}

	public function tambah()
	{
		
		$this->form_validation->set_rules(
			'nomor_arsip',
			'Nomor Arsip',
			'trim|is_unique[surat_arsip.nomor_arsip]',
			array(
				'is_unique' => 'No. Arsip Yang Diinput telah terdaftar !' 
				)
			);

		if ($this->form_validation->run() == TRUE) {

			$container = array(
				'tanggal_masuk_arsip' => $this->input->post('tanggal_masuk_arsip'),
				'no_ruang'            => $this->input->post('no_ruang'),
				'no_lemari'           => $this->input->post('no_lemari'),
				'no_rak'              => $this->input->post('no_rak'),
				'no_berkas'           => $this->input->post('no_berkas'),
				'nomor_arsip'         => $this->input->post('nomor_arsip'),
				'nama_penerima'       => currentUser('id'),
				'nama_penyerah'       => $this->input->post('nama_penyerah'),
				'lengkap'             => $this->input->post('lengkap'),
				'status'              => $this->input->post('status'),
				'keterangan'          => $this->input->post('keterangan'),
				'diinput_oleh'        => currentUser('username'),
				'diinput_tanggal'     => date("Y-m-d H:i:s")
				);

			$res = $this->md_Global->insert_data('surat_arsip', $container);
			if ($res) {
				$this->session->set_flashdata('message', 'Berhasil entry Arsip');
				redirect('arsip/lihat','refresh');
			}
		} 

		else {
			
			echo validation_errors();
			$data['nomor_berkas'] = $this->md_Global->get_data_all('sys_box_name');
			$data['ref_eselon'] = $this->md_Global->get_data_all('ref_eselon');


			$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');
			$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');


			$this->template->build('vw_tambah', $data);
		}

	}


	public function ubah($id)
	{
		if ($id == null || !$this->md_Global->get_data_where('surat_arsip', array('id' => $id))) {
			show_404();
		}

		$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');
		$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$container = array(
				'id'				  => $this->input->post('id'),
				'tanggal_masuk_arsip' => $this->input->post('tanggal_masuk_arsip'),
				'no_ruang'            => $this->input->post('no_ruang'),
				'no_lemari'           => $this->input->post('no_lemari'),
				'no_rak'              => $this->input->post('no_rak'),
				'no_berkas'           => $this->input->post('no_berkas'),
				'nomor_arsip'         => $this->input->post('nomor_arsip'),
				'nama_penerima'       => currentUser('id'),
				'nama_penyerah'       => $this->input->post('nama_penyerah'),
				'lengkap'             => $this->input->post('lengkap'),
				'status'              => $this->input->post('status'),
				'keterangan'          => $this->input->post('keterangan'),
				'diperbaharui_oleh'        => currentUser('username'),
				'diperbaharui_tanggal'     => date("Y-m-d H:i:s"),
				);


			$res = $this->md_Global->update_data('surat_arsip', $container, array('id' => $id));
			if ($res) {
				$this->session->set_flashdata('message', 'Berhasil merubah Data Arsip');
				redirect('arsip/lihat','refresh');
			}
			else if ($this->db->error()['code'] == 1062) {
				$this->session->set_flashdata('message', 'Duplikat Nomor Arsip Terdeteksi');
				redirect('arsip/ubah/' . $id,'refresh');
			}
		}


		else 
		{
			echo validation_errors();

			$data['message']      = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['arsip']        = $this->md_Global->get_data_single('surat_arsip', array('id' => $id));
			$data['nomor_berkas'] = $this->md_Global->get_data_all('sys_box_name');
			$data['ref_eselon']   = $this->md_Global->get_data_all('ref_eselon');
			$this->template->build('vw_ubah', $data);
		}

	}

	public function hapus()
	{

	}



	/*start from this line is ajax request php */

	public function ajax_lihat()
	{
		$var = $this->md_arsip->json_select();
		echo $var;
	}


	public function ajax_detail()
	{
		$id = $this->input->post('id');
		$data = $this->md_arsip->select_detail($id);

		if($data)
		{
			$table     = '<h4>Data Arsip</h4><br/>';
			$table    .= '<table class="table table-condensed table-striped">';
			$table 	  .= "<tr><td>Nomor Arsip</td><td>".$data['nomor_arsip']."</td></tr>";	
			$table 	  .= "<tr><td>Tanggal Masuk</td><td>".date_converter($data['tanggal_masuk_arsip'])."</td></tr>";	
			$table 	  .= "<tr><td>Penerima</td><td>".$data['penerima']."</td></tr>";	
			$table 	  .= "<tr><td>Penyerah</td><td>".$data['nama_penyerah']."</td></tr>";	
			$table 	  .= "<tr><td>Ruang</td><td>".$data['nama_eselon']."</td></tr>";	
			$table 	  .= "<tr><td>Lemari</td><td>".$this->config->item('surat_arsip')['no_lemari'][$data['no_lemari']]."</td></tr>";	
			$table 	  .= "<tr><td>Rak</td><td>".$this->config->item('surat_arsip')['no_rak'][$data['no_rak']]."</td></tr>";	
			$table 	  .= "<tr><td>Berkas</td><td>".$data['nama_box']."</td></tr>";	
			$table 	  .= "<tr><td>Penyerah</td><td>".$data['nama_penyerah']."</td></tr>";	
			$table 	  .= "<tr><td>Lengkap</td><td>".$data['lengkap']."</td></tr>";	
			$table 	  .= "<tr><td>Status</td><td>".$this->config->item('surat_arsip')['status'][$data['status']]."</td></tr>";	
			$table 	  .= "<tr><td>Keterangan</td><td>".$data['keterangan']."</td></tr>";	
			$table 	  .= '';
			$table    .= '</table>';
			echo $table;
		}
	}



	public function ajax_delete_arsip()
	{
		$id  = $this->input->post('id');
		if ($id) {
			$result = $this->md_Global->delete_data('surat_arsip', array('id' => $id));
			if ($this->db->error()['code']) {
				echo json_encode($this->db->error());
			}
			else if($result)
			{
				echo 'YES';
			}
		}
		else {
			echo 'NO';
		}
	}
}

/* End of file arsip.php */
/* Location: ./application/modules/arsip/controllers/arsip.php */