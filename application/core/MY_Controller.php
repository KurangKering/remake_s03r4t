<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $full_name;
	public $groups;
	public function __construct()
	{
		
		parent::__construct();


		/*check wether logged in or no*/
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('login', 'refresh');
		}

		$this->user = $this->ion_auth->user()->row();
		$this->groups = $this->ion_auth->get_users_groups()->result();


		$this->load->model("menu_model", "menu");
		$items = $this->menu->all();
		

		$this->load->library("multi_menu");
		$groups = $this->ion_auth->get_user_groups();
		$this->multi_menu->set_items($items, $groups);


	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */