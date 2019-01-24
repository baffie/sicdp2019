<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok_ldpm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stok_ldpm_model');
        $this->load->model('Kabupaten_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $data['source'] = site_url('cms/stok_ldpm/grid');
        $this->load->model('Kabupaten_model');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        $template['page_heading'] = 'Stok Awal CPP LDPM';
        $template['content'] = $this->load->view('stok_ldpm/list', $data, true);
        $template['js'] = $this->load->view('stok_ldpm/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Stok_ldpm_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/stok_ldpm/create_action'),
            'id' => set_value('id'),
            'id_kab' => set_value('id_kab'),
            'bulan' => set_value('bulan'),
            'tahun' => set_value('tahun'),
            'stok_awal' => set_value('stok_awal'),
        );
        
        $this->load->model('Kabupaten_model');
        data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));

        $template['page_heading'] = 'Stok Awal CPP LDPM';
        $template['content'] = $this->load->view('stok_ldpm/form', $data, true);
        $template['js'] = $this->load->view('stok_ldpm/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kab' => $this->input->post('id_kab',TRUE),
                'bulan' => $this->input->post('bulan',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );

            $this->Stok_ldpm_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/stok_ldpm'));
        }
    }

    public function update($id)
    {
        $row = $this->Stok_ldpm_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/stok_ldpm/update_action'),
                'id' => set_value('id', $row->id),
                'id_kab' => set_value('id_kab', $row->id_kab),
                'bulan' => set_value('bulan', $row->bulan),
                'tahun' => set_value('tahun', $row->tahun),
                'stok_awal' => set_value('stok_awal', $row->stok_awal),
            );
            
            $this->load->model('Kabupaten_model');
            $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));


            $template['page_heading'] = 'Stok Awal Bulog';
            $template['content'] = $this->load->view('stok_ldpm/form', $data, true);
            $template['js'] = $this->load->view('stok_ldpm/js', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/stok_ldpm'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_kab' => $this->input->post('id_kab',TRUE),
                'bulan' => $this->input->post('bulan',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );

            $this->Stok_ldpm_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/stok_ldpm'));
        }
    }

    public function delete($id)
    {
        $row = $this->Stok_ldpm_model->get_by_id($id);

        if ($row) {
            $this->Stok_ldpm_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/stok_ldpm'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/stok_ldpm'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_kab', 'kabupaten', 'trim|required');
        $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('stok_awal', 'stok_awal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Stok_ldpm.php */
/* Location: ./application/controllers/Stok_ldpm.php */