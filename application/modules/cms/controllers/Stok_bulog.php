<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok_bulog extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stok_bulog_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $data['source'] = site_url('cms/Stok_bulog/grid');
        $template['page_heading'] = 'Stok Awal Bulog';
        $template['content'] = $this->load->view('Stok_bulog/list', $data, true);
        $template['js'] = $this->load->view('Stok_bulog/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Stok_bulog_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/Stok_bulog/create_action'),
            'id' => set_value('id'),
            'bulan' => set_value('bulan'),
            'tahun' => set_value('tahun'),
            'stok_awal' => set_value('stok_awal'),
        );

        $template['page_heading'] = 'Stok Awal Bulog';
        $template['content'] = $this->load->view('Stok_bulog/form', $data, true);
        $template['js'] = $this->load->view('Stok_bulog/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'bulan' => $this->input->post('bulan',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );

            $this->Stok_bulog_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/Stok_bulog'));
        }
    }

    public function update($id)
    {
        $row = $this->Stok_bulog_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/Stok_bulog/update_action'),
                'id' => set_value('id', $row->id),
                'bulan' => set_value('bulan', $row->bulan),
                'tahun' => set_value('tahun', $row->tahun),
                'stok_awal' => set_value('stok_awal', $row->stok_awal),
            );

            $template['page_heading'] = 'Stok Awal Bulog';
            $template['content'] = $this->load->view('Stok_bulog/form', $data, true);
            $template['js'] = $this->load->view('Stok_bulog/js', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/Stok_bulog'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'bulan' => $this->input->post('bulan',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );

            $this->Stok_bulog_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/Stok_bulog'));
        }
    }

    public function delete($id)
    {
        $row = $this->Stok_bulog_model->get_by_id($id);

        if ($row) {
            $this->Stok_bulog_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/Stok_bulog'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/Stok_bulog'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('stok_awal', 'stok_awal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Stok_bulog.php */
/* Location: ./application/controllers/Stok_bulog.php */