<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		if (!$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}
	}

	public function index()
	{
		//print_r($this->ion_auth->is_admin());
        $this->load->model('Bulog_model');
		$this->load->model('Data_cbp_model');
		$this->load->model('Rdkk_model');
		$this->load->model('Lpm_model');
		$this->load->model('Ldpm_model');
		$this->load->model('Cpp_kab_model');
		$this->load->model('Data_cppkab_model');
		$this->load->model('Cpp_ldpm_model');
		$this->load->model('Data_cpp_ldpm_model');
        $this->load->model('Poktan_model');
        $this->load->model('Gapoktan_model');
        $this->load->model('Users_model');
		
        
        $data['total_user'] = $this->Users_model->get_total($this->user->id);
        $data['incoming'] = $this->Rdkk_model->get_statistic_created();
        $data['data_penyuluh'] = $this->Rdkk_model->get_all_created();
        //$data['stat'] = $this->Rdkk_model->get_statistic();
		//print_r($this->user->id);
		//die();
		$template['page_heading'] = 'Dashboard';
		$template['content'] = $this->load->view('backend/dashboard/home', $data, true);
        $template['js'] = $this->load->view('backend/dashboard/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}
}
