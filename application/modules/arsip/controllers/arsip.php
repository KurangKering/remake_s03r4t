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
			'no_lembar_disposisi',
			'Nomor Lembar Disposisi',
			'trim|is_unique[surat_masuk.no_lembar_disposisi]',
			array(
				'is_unique' => 'No. Lembar Disposisi Yang Diinput telah terdaftar !' 
				)
			);

		$this->form_validation->set_rules('file', '', 'callback_file_check');


		if ($this->form_validation->run() == TRUE) {

			
			$tahapan_proses = $this->md_arsip->select_tahapan_proses();
			$status_id = 1;
			$file_path               = '';
			$this->load->helper(array('form', 'url'));
			$config['upload_path']   ='./uploads/surat_masuk/';
			$config['allowed_types'] = 'pdf';
			$config['max_size']      = 0;
			$config['encrypt_name']  = true;
			$this->load->library('upload');
			$this->upload->initialize($config);
			if ($this->upload->do_upload('file'))
				$file_path = $this->upload->data()['file_name'] ;

			$container = array(
				'no_lembar_disposisi' => $this->input->post('no_lembar_disposisi'),
				'tgl_masuk'           => date_converter($this->input->post('tanggal_masuk')),
				'tujuan_id'           => $this->input->post('tujuan_id'),
				'tujuan_text'			=> $this->config->item('surat_masuk')['tujuan'][$this->input->post('tujuan_id')],
				'pengirim'            => $this->input->post('pengirim'),
				'perihal'             => $this->input->post('perihal'),
				'file'                => $file_path,
				'status_id'           => $status_id,
				'status_text'           => $tahapan_proses[$status_id],
				'disposisi_tujuan_id' => $this->input->post('disposisi_tujuan_id'),
				'catatan_tambahan'    => $this->input->post('catatan_tambahan'),
				'created_by'          => currentUser('id'),
				'created_on'          => time()
				);

			$res = $this->md_Global->insert_data('surat_masuk', $container);
			if ($res) {
				$this->session->set_flashdata('message', 'Berhasil entry surat Masuk');
				redirect('surat_masuk/lihat','refresh');
			}
		} else {
			
			echo validation_errors();
			$data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));

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
		if ($id == null || !$this->md_Global->get_data_where('surat_masuk', array('id_surat_masuk' => $id))) {
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
					'no_lembar_disposisi' => $this->input->post('no_lembar_disposisi'),
					'tgl_masuk'           => date_converter($this->input->post('tanggal_masuk')),
					'tujuan_id'           => $this->input->post('tujuan_id'),
					'tujuan_text'         => $this->config->item('surat_masuk')['tujuan'][$this->input->post('tujuan_id')],
					'pengirim'            => $this->input->post('pengirim'),
					'perihal'             => $this->input->post('perihal'),
					'disposisi_tujuan_id' => $this->input->post('disposisi_tujuan_id'),
					'catatan_tambahan'    => $this->input->post('catatan_tambahan'),
					'modified_by'         => currentUser('id'),
					'modified_on'         => time()
					);

				$this->load->helper(array('form', 'url'));
				$config['upload_path'] ='./uploads/surat_masuk/';
				$config['allowed_types'] = 'pdf';
				$config['max_size'] = 0;
				$config['encrypt_name'] = true;
				$this->load->library('upload');
				$this->upload->initialize($config);
				if ($this->upload->do_upload('file')) {
					$file_path = $this->upload->data()['file_name'];
					$container['file'] = $file_path;	
				}


				$res = $this->md_Global->update_data('surat_masuk', $container, array('id_surat_masuk' => $id));
				if ($res) {
					$this->session->set_flashdata('message', 'Berhasil merubah data surat Masuk');
					redirect('surat_masuk','refresh');
				}
				else if ($this->db->error()['code'] == 1062) {
					$this->session->set_flashdata('message', 'Duplikat Nomor Lembar Disposisi terdeteksi');
					redirect('surat_masuk/ubah/' . $id,'refresh');
				}
			}
			else {
				$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				$surat_masuk = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id));
				$data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));
				$data['surat_masuk'] = $surat_masuk;
				$this->template->build('vw_ubah', $data);
			}  
				# code...
		} 
		else 
		{
			$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
			$data['surat_masuk'] = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id));
			$data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));
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
		$data = $this->md_arsip->select_detail('1');
		if($data)
		{
			$table     = '<h4>Data Arsip</h4><br/>';
			$table    .= '<table class="table table-condensed table-striped">';
			$table 	  .= "<tr><td>Nomor Arsip</td><td>".$data['nomor_arsip']."</td></tr>";	
			$table 	  .= "<tr><td>Tanggal Masuk</td><td>".$data['tanggal_masuk_arsip']."</td></tr>";	
			$table 	  .= "<tr><td>Penyerah</td><td>".$data['nama_penyerah']."</td></tr>";	
			$table 	  .= "<tr><td>Nomor Ruang</td><td>".$data['no_ruang']."</td></tr>";	
			$table 	  .= "<tr><td>Nomor Lemari</td><td>".$this->config->item('surat_arsip')['no_lemari'][$data['no_lemari']]."</td></tr>";	
			$table 	  .= "<tr><td>Nomor Rak</td><td>".$this->config->item('surat_arsip')['no_rak'][$data['no_rak']]."</td></tr>";	
			$table 	  .= "<tr><td>Nomor Berkas</td><td>".$data['no_berkas']."</td></tr>";	
			$table 	  .= "<tr><td>Penyerah</td><td>".$data['nama_penyerah']."</td></tr>";	
			$table 	  .= "<tr><td>Lengkap ? </td><td>".$data['lengkap']."</td></tr>";	
			$table 	  .= "<tr><td>Status</td><td>".$this->config->item('surat_arsip')['status'][$data['status']]."</td></tr>";	
			$table 	  .= "<tr><td>Keterangan</td><td>".$data['keterangan']."</td></tr>";	
			$table 	  .= '';
			$table    .= '</table>';
			echo $table;
		}
	}


	public function ajax_delete_file()
	{
		$id_surat_masuk = $this->input->post('id_surat_masuk');
		$file_name = $this->input->post('file');
		$upload_path = base_url('uploads/surat_masuk/');
		$bool = get_file_info('uploads/surat_masuk/'. $file_name);
		if ($bool) {
			unlink('uploads/surat_masuk/' .  $file_name);
			$this->md_Global->update_data('surat_masuk', array('file' => '' ), array('id_surat_masuk' => $id_surat_masuk ));
			echo 'OK';
		}
		else
			echo 'NO';
	}


	public function ajax_delete_surat_masuk()
	{
		$id  = $this->input->post('id_surat_masuk');
		if ($id) {
			$file_name = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id))['file'];
			$bool = get_file_info('uploads/surat_masuk/'. $file_name) && count($file_name) > 0 ;
			if ($bool) {
				unlink('uploads/surat_masuk/' .  $file_name);
			}
			$result = $this->md_Global->delete_data('surat_masuk', array('id_surat_masuk' => $id));
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