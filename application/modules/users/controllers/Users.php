<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('md_users');
	}

	public function index()
	{
		redirect('users/lihat','refresh');
	}


	public function lihat()
	{
		/*load css datatables*/
		$this->template->append_metadata('<link href="'. base_url("assets/plugins/datatables/media/css/jquery.dataTables.min.css").'" rel="stylesheet">');
		$this->template->append_metadata('<link href="'. base_url("assets/plugins/datatables/media/css/dataTables.bootstrap.min.css").'" rel="stylesheet">');
		/*load js datatables*/
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/datatables/media/js/jquery.dataTables.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/datatables/media/js/dataTables.bootstrap.min.js") . '"></script>');
		$this->template->title('Lihat | Users');
		$this->template->build('users/vw_lihat');
	}

	public function tambah()
	{

		$this->template->title('Tambah | Users');
		$this->form_validation->set_rules(
			'email',
			'email',
			'trim|is_unique[sys_users.email]',
			array(
				'is_unique' => 'Email Telah Terdaftar !' 
				)
			);
		$this->form_validation->set_rules(
			'username',
			'Username',
			'trim|is_unique[sys_users.username]',
			array(
				'is_unique' => 'Username Telah Terdaftar !' 
				)
			);

		if ($this->form_validation->run() == true)
		{
			$email    = strtolower($this->input->post('email'));
			$identity = $this->input->post('username');
			$password = $this->input->post('password');

			$additional_data = array(
				'fullname' => $this->input->post('fullname'),
				'phone'      => $this->input->post('phone'),
				'active'      => $this->input->post('active'),
				);
		}


		else {

			echo validation_errors();

			$data['groups'] =$this->ion_auth->groups()->result_array();
			$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');
			$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
			$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');


			$this->template->build('users/vw_tambah', $data);
		}


		if ($this->form_validation->run() == true && $id_user = $this->ion_auth->register($identity, $password, $email, $additional_data))
		{

//Update the groups user belongs to
			$groupData = $this->input->post('groups');

			if (isset($groupData) && !empty($groupData)) {

				$this->ion_auth->remove_from_group('', $id_user);
				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id_user);
				}

			}


// check to see if we are creating the user
// redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("users/lihat", 'refresh');
		}




	}


	public function ubah($id = null)
	{
		$this->template->title("Ubah | Users");
		$this->template->append_metadata('<link href="'. base_url("themes/inspinia/css/plugins/iCheck/custom.css").'" rel="stylesheet">');
		$this->template->append_metadata('<script src="'. base_url("themes/inspinia/js/plugins/iCheck/icheck.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
		$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');


		if ($id == null || !$this->md_Global->get_data_where('sys_users', array('id' => $id))) {
			show_404();
		}
		$data['user'] = $this->ion_auth->user($id)->row_array();
		$data['groups'] =$this->ion_auth->groups()->result_array();
		$data['currentGroups'] = $this->ion_auth->get_users_groups($id)->result();

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$container = array(

				'id'				  => $this->input->post('id'),
				'fullname' => $this->input->post('fullname'),
				'phone'      => $this->input->post('phone'),
				'active'      => $this->input->post('active'),

				'username' => 	$this->input->post('username'),
				'email' => 	$this->input->post('email')
				);


// update the password if it was posted
			if ($this->input->post('password'))
			{
				$container['password'] = $this->input->post('password');
			}

//Update the groups user belongs to
			$groupData = $this->input->post('groups');

			if (isset($groupData) && !empty($groupData)) {

				$this->ion_auth->remove_from_group('', $id);

				foreach ($groupData as $grp) {
					$this->ion_auth->add_to_group($grp, $id);
				}

			}


			$res = $this->ion_auth->update($data['user']['id'], $container);
			if ($res) {
				$this->session->set_flashdata('message', 'Berhasil merubah Data User');
				redirect('users/lihat','refresh');
			}

			else if ($this->db->error()['code'] == 1062) {
				$this->session->set_flashdata('message', 'Duplikat Terdeteksi');
				redirect('users/ubah/' . $id,'refresh');
			}
			else {
				$this->session->set_flashdata('message', 'Gagal Merubah User, Cek username / email' );
				redirect('users/ubah/' . $id,'refresh');
			}
		}


		else 
			{	echo $this->session->flashdata('message');
		echo validation_errors();

		$data['message']      = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

		$this->template->build('users/vw_ubah', $data);
	}

}

public function hapus()
{

}




public function ajax_lihat()
{
	$var = $this->md_users->json_select();
	echo $var;
}


public function ajax_detail()
{
	$id = $this->input->post('id');
	$data = $this->md_users->select_detail($id);
	$groups = $this->ion_auth->get_users_groups($id)->result_array();
	if($data)
	{
		$table     = '<h4>Data Diri User</h4><br/>';
		$table    .= '<table class="table table-condensed table-striped">';
		$table 	  .= "<tr><td>User Id</td><td>".$data['userid']."</td></tr>";	
		$table 	  .= "<tr><td>Username</td><td>".$data['username']."</td></tr>";	
		$table 	  .= "<tr><td>Nama Lengkap</td><td>".$data['fullname']."</td></tr>";	
		$table 	  .= "<tr><td>Email</td><td>".$data['email']."</td></tr>";	
		$table 	  .= "<tr><td>Active</td><td>".$data['active']."</td></tr>";	
		$table 	  .= "<tr><td>Nomor HP</td><td>".$data['phone']."</td></tr>";	
		$table 	  .= "<tr><td>Terakhir Login</td><td>".$data['last_login']."</td></tr>";	
		$table 	  .= "<tr><td>Groups</td><td>";
		foreach ($groups as $key => $group) {
			$table .= $group['name'] . "<br>";
		}	
		$table 	  .= '</td>';
		$table    .= '</table>';
		echo $table;
	}
}



public function ajax_delete_users()
{

	$id  = $this->input->post('id');
	if ($id == currentUser('id')) {
		echo 'NO';
		exit();
	}

	if ($id) {
		$result = $this->md_Global->delete_data('sys_users', array('id' => $id));
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


public function profile()
{


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$id = $this->input->post('id');
		$container = array(

			
			'fullname' => $this->input->post('fullname'),
			'phone'      => $this->input->post('phone'),
			'email' => 	$this->input->post('email')
			);


// update the password if it was posted
		if ($this->input->post('password'))
		{
			$container['password'] = $this->input->post('password');
		}

		$res = $this->ion_auth->update($id, $container);
		if ($res) {
			$this->session->set_flashdata('message', 'Berhasil merubah Data User');
			
		}

		else if ($this->db->error()['code'] == 1062) {
			$this->session->set_flashdata('message', 'Duplikat Terdeteksi');
			
		}
		else {
			$this->session->set_flashdata('message', 'Gagal Merubah User, Cek email' );
			
		}
		redirect('profile','refresh');
	}


	else 
		{	echo $this->session->flashdata('message');
	echo validation_errors();

	$data['message']      = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

	$userid = currentUser('id');
	$data['user'] = $this->md_Global->get_data_single('sys_users', array('id' => $userid));
	$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/parsley.min.js") . '"></script>');
	$this->template->append_metadata('<script src="'. base_url("assets/plugins/parsleyjs/dist/i18n/id.js") . '"></script>');
	$this->template->build('vw_profile', $data);
}




}
}

/* End of file arsip.php */
/* Location: ./application/modules/arsip/controllers/arsip.php */