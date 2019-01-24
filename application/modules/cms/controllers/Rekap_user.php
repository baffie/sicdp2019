<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_user extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Rekap_user_model');
		$this->load->model('Home_model');
		//$this->load->model('Data_Cbpkab_model');
		$this->load->model('Bulan_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}

		$this->user = $this->ion_auth->user()->row();
		
	}

	public function index()
	{	
		//$this->output->enable_profiler(TRUE);
        $data['source'] = site_url('cms/rekap_user/grid');
		$data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
        //$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
		$template['page_heading'] = 'Rekap Data Penyuluh';
		$template['content'] = $this->load->view('rekap_user/list', $data, true);
        $template['js'] = $this->load->view('rekap_user/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Rekap_user_model->grid();
    }
	
	function grid_filter()
	{
		if(!$this->input->is_ajax_request())
		{
			show_404();
			exit;
		}

		echo $this->Rekap_user_model->grid_filter();
	}

 	
}

/* End of file rekap_user.php */
/* Location: ./application/controllers/rekap_user.php */