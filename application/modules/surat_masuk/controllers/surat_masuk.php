<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
//Do your magic here
		$this->load->model('md_surat_masuk');
	}

	public function dummy()
	{
		$itemDisposisi = $this->md_surat_masuk->ref_eselon();
		debug($itemDisposisi);
	}
	public function index()
	{
		redirect('surat_masuk/lihat','refresh');
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

			
			$tahapan_proses = $this->md_surat_masuk->select_tahapan_proses();
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
				'tgl_masuk'           => $this->input->post('tanggal_masuk'),
				'tujuan_id'           => $this->input->post('tujuan_id'),
				'tujuan_text'			=> $this->config->item('surat_masuk')['tujuan'][$this->input->post('tujuan_id')],
				'pengirim'            => $this->input->post('pengirim'),
				'perihal'             => $this->input->post('perihal'),
				'file'                => $file_path,
				'status_id'           => $status_id,
				'status_text'           => $tahapan_proses[$status_id],
				'disposisi_tujuan_id' => $this->input->post('disposisi_tujuan_id'),
				'catatan_tambahan'    => $this->input->post('catatan_tambahan'),
				'created_by'          => currentUser('username'),
				'created_on'          => date("Y-m-d H:i:s")
				);

			$res = $this->md_Global->insert_data('surat_masuk', $container);
			if ($res) {
				$this->session->set_flashdata('message', showNotificationToastr('success', 'Berhasil Menambah Surat Masuk'));
				redirect('surat_masuk/lihat','refresh');
			}
		} else {
			if (validation_errors() != false) {
				$data['notificationInspinia'] = showNotificationInspinia('danger', validation_errors());
			}
			//$data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));
			$data['disposisi_tujuan'] = $this->md_surat_masuk->ref_eselon();
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
					'tgl_masuk'           => $this->input->post('tanggal_masuk'),
					'tujuan_id'           => $this->input->post('tujuan_id'),
					'tujuan_text'         => $this->config->item('surat_masuk')['tujuan'][$this->input->post('tujuan_id')],
					'pengirim'            => $this->input->post('pengirim'),
					'perihal'             => $this->input->post('perihal'),
					'disposisi_tujuan_id' => $this->input->post('disposisi_tujuan_id'),
					'catatan_tambahan'    => $this->input->post('catatan_tambahan'),
					'modified_by'         => currentUser('username'),
					'modified_on'         => date("Y-m-d H:i:s")
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

					$this->session->set_flashdata('message', showNotificationToastr('success', 'Berhasil Merubah Surat Masuk'));
					redirect('surat_masuk','refresh');
				}
				else if ($this->db->error()['code'] == 1062) {
					$this->session->set_flashdata('message', showNotificationToastr('error', 'Duplikat Nomor lembar Disposisi'));
					redirect('surat_masuk/ubah/' . $id,'refresh');
				}
			}
			else {

				$surat_masuk = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id));
				// $data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));
				$data['disposisi_tujuan'] = $this->md_surat_masuk->ref_eselon();

				$data['surat_masuk'] = $surat_masuk;
				$this->template->build('vw_ubah', $data);
			}  
				# code...
		} 
		else 
		{
			validation_errors() != false ? $data['notificationInspinia'] = showNotificationInspinia('danger', validation_errors()) : '';
			$data['surat_masuk'] = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id));
			$data['disposisi_tujuan'] = $this->md_surat_masuk->ref_eselon();
			// $data['tujuan_disposisi'] = $this->md_Global->get_data_where('ref_eselon', array('kode' =>'ESELON IV'));
			$this->template->build('vw_ubah', $data);
		}

	}

	public function hapus()
	{

	}



	/*start from this line is ajax request php */

	public function ajax_lihat()
	{

		if ($this->ion_auth->in_group(2, currentUser('id'))) {
			$var = $this->md_surat_masuk->json_select_admin();
		}
		else if ($this->ion_auth->in_group(10, currentUser('id'))) {

			$var = $this->md_surat_masuk->json_select_disposisi(1);
		}
		else if ($this->ion_auth->in_group(array(30,40), currentUser('id'))) {

			$var = $this->md_surat_masuk->json_select_disposisi(2);
		}
		else if ($this->ion_auth->in_group(array(50,60), currentUser('id'))) {

			$var = $this->md_surat_masuk->json_select_disposisi(3);
		}

		echo $var;
	}


	public function ajax_detail()
	{
		$id = $this->input->post('id_surat_masuk');
		$data = $this->md_surat_masuk->select_detail($id);
		if($data)
		{
			$table     = '<h4>Surat Masuk</h4><br/>';
			$table    .= '<table class="table table-condensed table-striped">';
			$table 	  .= "<tr><td>Nomor Lembar Disposisi</td><td>".$data['no_lembar_disposisi']."</td></tr>";	
			$table 	  .= "<tr><td>Tanggal Masuk</td><td>".date_converter($data['tgl_masuk'])."</td></tr>";	
			$table 	  .= "<tr><td>Ditujukan Kepada</td><td>".$data['tujuan_text']."</td></tr>";	
			$table 	  .= "<tr><td>Pengirim Surat</td><td>".$data['pengirim']."</td></tr>";	
			$table 	  .= "<tr><td>Perihal</td><td>".$data['perihal']."</td></tr>";	
			$table 	  .= "<tr><td>Disposisi Tujuan</td><td>".$data['name']."</td></tr>";	
			$table 	  .= "<tr><td>Status</td><td>".$data['tahap_nama']."</td></tr>";	
			
			$table 	  .= "<tr><td>Catatan Tambahan</td><td>".$data['catatan_tambahan']."</td></tr>";	
			$file  	   = ($data['file'] ? anchor(base_url('uploads/surat_masuk/' . $data['file']), 'Click Untuk Melihat File Ini','target="_blank"') :'..');
			$table 	  .= "<tr><td>File Scanned</td><td>".$file."</td></tr>";	
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






	/*start from this line is disposition*/



	public function cetak_disposisi($id)
	{
		$data['data_disposisi'] = $this->md_Global->get_data_single('surat_masuk', array('id_surat_masuk' => $id));
		$this->load->view('vw_template_disposisi', $data);
	}


	public function modalDisposisi()
	{	
		$arrData = array();
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

		$arrData['itemDisposisi'] = $this->showStatusDisposisi($id);

		

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

	public function showStatusDisposisi($id = null)
	{
		$id == null ? $id = $this->input->post('id_surat_masuk') : '';

		$data = '';
		$itemDisposisi = $this->md_surat_masuk->select_data_disposisi($id);
		foreach ($itemDisposisi as $key => $item) {

			$data .= '<div class="row">';
			$data .= '<div class="col-md-12">';
			$data .= '<form class="form-horizontal">';
			$data .= '<fieldset>';
			$data .= '<legend>Disposisi Tahap '.$item['tahapan_disposisi'].'</legend>';
			$data .= '<div class="form-group">';
			$data .= '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="disposisi_dari_text">Dari';
			$data .= '</label>';
			$data .= '<div class="col-md-6 col-sm-6 col-xs-12">';
			$data .= '<input value="'.$item['disposisi_dari_text'].'"id="disposisi_dari_text" class="form-control" name="disposisi_dari_text" readonly="" type="text">';
			$data .= '</div>';
			$data .= '</div>';
			$data .= '<div class="form-group">';
			$data .= '<label class="control-label col-md-3 col-sm-3 col-xs-12" for="isi_disposisi">Isi Disposisi</label>';
			$data .= '<div class="col-md-6 col-sm-6 col-xs-12">';
			$data .= '<textarea id="isi_disposisi" name="isi_disposisi"   readonly required="" class="form-control">'.$item['isi_disposisi'].'</textarea>';
			$data .= '</div>';
			$data .= '</div>';
			$data .= '</fieldset>';
			$data .= '</form>';
			$data .= '</div>';
			$data .= '</div>';
			$data .= '<hr>';
		}
		if ($_POST) {
			echo $data;
		}
		return $data;
	}
	public function doDisposisi()
	{
		$data_surat_disposisi = array(
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

		$data_surat_proses = array(

			'surat_id' => $this->input->post('id_surat_masuk'),
			'proses_id' => ($this->input->post('tahapan_disposisi') + 1),
			'proses_nama' => $this->md_Global->get_data_single('ref_tahapan_proses', array('Id' => ($this->input->post('tahapan_disposisi') + 1)))['nama'],
			'tanggal' => date('Y-m-d H:i:s'),
			'diinput_oleh' => currentUser('username'),
			'diinput_tanggal' =>  date('Y-m-d H:i:s')

			);
		$data_surat_masuk = array(
			'disposisi_terakhir_text' => $this->input->post('isi_disposisi'),
			'status_id' => ($this->input->post('tahapan_disposisi') + 1),
			'status_text' => $this->md_Global->get_data_single('ref_tahapan_proses', array('Id' => ($this->input->post('tahapan_disposisi') + 1)))['nama']
			);
		$this->md_Global->insert_data('surat_disposisi', $data_surat_disposisi);
		$this->md_Global->insert_data('surat_proses', $data_surat_proses);
		$this->md_Global->update_data('surat_masuk', $data_surat_masuk, array('id_surat_masuk' => $this->input->post('id_surat_masuk')));

		echo 'OK';
	}
}

/* End of file surat_masuk.php */
/* Location: ./application/modules/surat_masuk/controllers/surat_masuk.php */