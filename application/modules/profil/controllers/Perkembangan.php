<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perkembangan extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rdkk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Kabupaten_model');
        $this->load->model('Subsektor_model');

        $data['start']	    = $this->session->userdata('start');
        $data['end']	    = $this->session->userdata("end");
        $data['subsektor']	= $this->session->userdata("id_subsektor");
        $data['kabupaten']	= $this->session->userdata("kabupaten");
        $kecamatan  = $this->session->userdata("kecamatan");
        $desa		= $this->session->userdata("desa");

        $data['stat'] = $this->Rdkk_model->get_statistic($data['start'],$data['end'],$data['subsektor'],$data['kabupaten'],$kecamatan,$desa);
        $data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

        $template['title'] = 'Grafik Rencana Definitif Kebutuhan Kelompok';
        $template['content'] = $this->load->view('v_perkembangan', $data, true);
        $template['css'] = $this->load->view('css', $data, true);
        $template['js'] = $this->load->view('js_graph', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }

    public function set()
    {
        $sess['start'] = $this->input->post("start");
        $sess['end'] = $this->input->post("end");
        $sess['id_subsektor'] = $this->input->post("id_subsektor");
        $sess['kabupaten'] = $this->input->post("id_kabupaten");
        $sess['kecamatan'] = $this->input->post("id_kecamatan");
        $sess['desa'] = $this->input->post("id_desa");
        $this->session->unset_userdata('start');
        $this->session->unset_userdata('end');
        $this->session->unset_userdata('id_subsektor');
        $this->session->unset_userdata('kabupaten');
        $this->session->unset_userdata('kecamatan');
        $this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        redirect(site_url('rdkk/perkembangan'));
    }
}