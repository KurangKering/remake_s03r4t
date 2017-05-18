<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
//Do your magic here
		$this->load->model('md_surat_keluar');
	}

	public function index()
	{
		redirect('surat_keluar/lihat','refresh');
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
			'no_surat_keluar',
			'Nomor Surat Keluar',
			'trim|is_unique[surat_keluar.no_surat_keluar]',
			array(
				'is_unique' => 'No. Surat Keluar Yang Diinput telah terdaftar !' 
				)
			);

		$this->form_validation->set_rules('file', '', 'callback_file_check');


		if ($this->form_validation->run() == TRUE) {
			$tahapan_proses = $this->md_surat_keluar->select_tahapan_proses();
			$status_id = 1;
			$file_path               = '';
			$this->load->helper(array('form', 'url'));
			$config['upload_path']   ='./uploads/surat_keluar/';
			$config['allowed_types'] = 'pdf';
			$config['max_size']      = 0;
			$config['encrypt_name']  = true;
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file'))
				$file_path = $this->upload->data()['file_name'] ;

			$container = array(
				'no_surat_keluar'       => $this->input->post('no_surat_keluar'),
				'jenis_surat_keluar_id' => $this->input->post('jenis_surat_keluar_id'),
				'tgl_surat'             => $this->input->post('tgl_surat'),
				'tujuan_id'             => $this->input->post('tujuan_id'),
				'tujuan_text'           => $this->config->item('surat_keluar')['tujuan_id'][$this->input->post('tujuan_id')],
				'perihal'               => $this->input->post('perihal'),
				'file'                  => $file_path,
				'path_file'             => $this->input->post('path_file'),
				'dikirim_via'           => $this->input->post('dikirim_via'),
				'no_resi_pengiriman'    => $this->input->post('no_resi_pengiriman'),
				'tanggal_pengiriman'    => $this->input->post('tanggal_pengiriman'),
				'catatan_tambahan'      => $this->input->post('catatan_tambahan'),
				'status_surat_id'       => $status_id,
				'status_surat'          => $tahapan_proses[$status_id],
				'pembuat_surat_id'      => currentUser('id'),
				'pembuat_surat_text'    => currentUser('username'),
				'created_by'            => currentUser('username'),
				'created_on'            => date("Y-m-d H:i:s")
				);

			$res = $this->md_Global->insert_data('surat_keluar', $container);
			if ($res) {
				$this->session->set_flashdata('message', 'Berhasil entry surat Masuk');
				redirect('surat_keluar/lihat','refresh');
			}
		} else {
			
			echo validation_errors();
			$data['jenis_surat'] = $this->config->item('surat_keluar')['jenis_surat_keluar'];
			$data['tujuan_id']   = $this->config->item('surat_keluar')['tujuan_id'];
			$data['dikirim_via'] = $this->config->item('surat_keluar')['dikirim_via'];

			$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');

			$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');


			$this->template->build('vw_tambah', $data);
		}

	}

	/*
	* file value and type check during validation
	*/
	public function file_check($str){
		$allowed_mime_type_arr = array('application/pdf');
		if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
			$mime = get_mime_by_extension($_FILES['file']['name']);
			if(in_array($mime, $allowed_mime_type_arr)){
				return true;
			}else{
				$this->form_validation->set_message('file_check', 'Extension File Hanya Boleh PDF');
				return false;
			}
		}else{
// $this->form_validation->set_message('file_check', 'Silahkan Pilih File PDF nya.');
// return false;
			return true;
		}
	}

	public function ubah($id)
	{
		if ($id == null || !$this->md_Global->get_data_where('surat_keluar', array('id_surat_keluar' => $id))) {
			show_404();
		}

		$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');
		$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');



		$this->form_validation->set_rules('file', '', 'callback_file_check');

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if ($this->form_validation->run() == TRUE ) {

				$container = array(
					'no_surat_keluar'       => $this->input->post('no_surat_keluar'),
					'jenis_surat_keluar_id' => $this->input->post('jenis_surat_keluar_id'),
					'tgl_surat'             => $this->input->post('tgl_surat'),
					'tujuan_id'             => $this->input->post('tujuan_id'),
					'tujuan_text'           => $this->config->item('surat_keluar')['tujuan_id'][$this->input->post('tujuan_id')],
					'perihal'               => $this->input->post('perihal'),
					'path_file'             => $this->input->post('path_file'),
					'dikirim_via'           => $this->input->post('dikirim_via'),
					'no_resi_pengiriman'    => $this->input->post('no_resi_pengiriman'),
					'tanggal_pengiriman'    => $this->input->post('tanggal_pengiriman'),
					'catatan_tambahan'      => $this->input->post('catatan_tambahan'),
					// 'status_surat_id'       => $status_id,
					/*'status_surat'          => $tahapan_proses[$status_id],*/
					// 'pembuat_surat_id'      => $this->input->post('pembuat_surat_id'),
					// 'pembuat_surat_text'    => $this->input->post('pembuat_surat_text'),
					'modified_by'         => currentUser('username'),
					'modified_on'         => date("Y-m-d H:i:s")
					);

				$this->load->helper(array('form', 'url'));
				$config['upload_path'] ='./uploads/surat_keluar/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = 0;
				$config['encrypt_name'] = true;
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$file_path = $this->upload->data()['file_name'];
					$container['file'] = $file_path;	
				}


				$success = $this->md_Global->update_data('surat_keluar', $container, array('id_surat_keluar' => $id));

				if ($success) {
					$this->session->set_flashdata('message', 'Berhasil merubah data surat Keluar');
					redirect('surat_keluar/lihat','refresh');
				}
				else if ($this->db->error()['code'] == 1062) {
					$this->session->set_flashdata('message', 'Duplikat Nomor Surat Keluar Terdeteksi');
					redirect('surat_keluar/ubah/' . $id,'refresh');
				}
			}
			else {
				echo $this->session->flashdata('message');
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				$surat_keluar = $this->md_Global->get_data_single('surat_keluar', array('id_surat_keluar' => $id));
				$data['surat_keluar'] = $surat_keluar;
				$data['jenis_surat'] = $this->config->item('surat_keluar')['jenis_surat_keluar'];
				$data['tujuan_id']   = $this->config->item('surat_keluar')['tujuan_id'];
				$data['dikirim_via'] = $this->config->item('surat_keluar')['dikirim_via'];
				$this->template->build('vw_ubah', $data);
			}  
				# code...
		} 
		else 
		{
			echo $this->session->flashdata('message');
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['surat_keluar'] = $this->md_Global->get_data_single('surat_keluar', array('id_surat_keluar' => $id));
			$data['jenis_surat'] = $this->config->item('surat_keluar')['jenis_surat_keluar'];
			$data['tujuan_id']   = $this->config->item('surat_keluar')['tujuan_id'];
			$data['dikirim_via'] = $this->config->item('surat_keluar')['dikirim_via'];
			$this->template->build('vw_ubah', $data);
		}

	}

	public function hapus()
	{

	}



	/*start from this line is ajax request php */

	public function ajax_lihat()
	{
		$var = $this->md_surat_keluar->json_select();
		echo $var;
	}


	public function ajax_detail()
	{
		$id = $this->input->post('id_surat_keluar');
		$data = $this->md_surat_keluar->select_detail($id);
		if($data)
		{
			$table     = '<h4>Surat Keluar</h4><br/>';
			$table    .= '<table class="table table-condensed table-striped">';
			$table 	  .= "<tr><td>Nomor Surat Keluar</td><td>".$data['no_surat_keluar']."</td></tr>";	
			$table 	  .= "<tr><td>Tanggal Masuk Surat</td><td>".$data['tgl_surat']."</td></tr>";	
			$table 	  .= "<tr><td>Jenis Surat Keluar</td><td>".$this->config->item('surat_keluar')['jenis_surat_keluar'][$data['jenis_surat_keluar_id']]."</td></tr>";	
			$table 	  .= "<tr><td>Ditujukan Kepada</td><td>".$data['tujuan_text']."</td></tr>";	
			$table 	  .= "<tr><td>Pembuat Surat</td><td>".$data['pembuat_surat_text']."</td></tr>";	
			$table 	  .= "<tr><td>Perihal</td><td>".$data['perihal']."<td></tr>";	
			$table 	  .= "<tr><td>Status</td><td>".$data['tahap_nama']."</td></tr>";	
			$table 	  .= "<tr><td>Pengiriman Via</td><td>".$this->config->item('surat_keluar')['dikirim_via'][$data['dikirim_via']]."</td></tr>";	
			$table 	  .= "<tr><td>No Resi Pengiriman</td><td>".$data['no_resi_pengiriman']."</td></tr>";	
			$table 	  .= "<tr><td>Tanggal Pengiriman</td><td>".$data['tanggal_pengiriman']."</td></tr>";	
			$table 	  .= "<tr><td>Catatan Tambahan</td><td>".$data['catatan_tambahan']."</td></tr>";	
			$file  	   = ($data['file'] ? anchor(base_url('uploads/surat_keluar/' . $data['file']), 'Click Untuk Melihat File Ini','target="_blank"') :'..');
			$table 	  .= "<tr><td>File Scanned</td><td>".$file."</td></tr>";	
			$table 	  .= '';
			$table    .= '</table>';
			echo $table;
		}
	}


	public function ajax_delete_file()
	{
		$id_surat_keluar = $this->input->post('id_surat_keluar');
		$file_name = $this->input->post('file');
		$upload_path = base_url('uploads/surat_keluar/');
		$bool = get_file_info('uploads/surat_keluar/'. $file_name);
		if ($bool) {
			unlink('uploads/surat_keluar/' .  $file_name);
			$this->md_Global->update_data('surat_keluar', array('file' => '' ), array('id_surat_keluar' => $id_surat_keluar ));
			echo 'OK';
		}
		else
			echo 'NO';
	}


	public function ajax_delete_surat_keluar()
	{
		$id  = $this->input->post('id_surat_keluar');
		if ($id) {
			$file_name = $this->md_Global->get_data_single('surat_keluar', array('id_surat_keluar' => $id))['file'];
			$bool = get_file_info('uploads/surat_keluar/'. $file_name) && count($file_name) > 0 ;
			if ($bool) {
				unlink('uploads/surat_keluar/' .  $file_name);
			}
			$result = $this->md_Global->delete_data('surat_keluar', array('id_surat_keluar' => $id));
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

/* End of file surat_keluar.php */
/* Location: ./application/modules/surat_keluar/controllers/surat_keluar.php */