<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sektor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sektor_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $data['source'] = site_url('cms/sektor/grid');
        $template['page_heading'] = 'Sektor';
        $template['content'] = $this->load->view('sektor/list', $data, true);
        $template['js'] = $this->load->view('sektor/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Sektor_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/sektor/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
        );

        $template['page_heading'] = 'Sektor';
        $template['content'] = $this->load->view('sektor/form', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'name' => $this->input->post('name',TRUE),
            );

            $this->Sektor_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/sektor'));
        }
    }

    public function update($id)
    {
        $row = $this->Sektor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/sektor/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
            );

            $template['page_heading'] = 'Sektor';
            $template['content'] = $this->load->view('sektor/form', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/sektor'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'name' => $this->input->post('name',TRUE),
            );

            $this->Sektor_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/sektor'));
        }
    }

    public function delete($id)
    {
        $row = $this->Sektor_model->get_by_id($id);

        if ($row) {
            $this->Sektor_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/sektor'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/sektor'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Sektor.php */
/* Location: ./application/controllers/Sektor.php */