<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	public function index()
	{
		$this->template->build('vw_akun');
	}

	

	public function login()
	{
		if ($this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('Dashboard', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{

			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('Dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$data['message'] = showNotificationInspinia('danger', validation_errors());

				redirect('login'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? showNotificationInspinia('danger', validation_errors()) : '';
			$this->data['message'] = $this->session->flashdata('message') ? showNotificationInspinia('danger', $this->session->flashdata('message')) : '';

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
				);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
				);

			$this->load->view('vw_login', $this->data);
		}

		
		
	}



	public function logout()
	{
		
		$logout = $this->ion_auth->logout();
		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('login', 'refresh');
	}


}

/* End of file akun.php */
/* Location: ./application/modules/akun/controllers/akun.php */