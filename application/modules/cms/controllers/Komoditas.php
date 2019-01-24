<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Komoditas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Komoditas_model');
        $this->load->model('Subsektor_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $data['source'] = site_url('cms/komoditas/grid');
        $template['page_heading'] = 'Komoditas';
        $template['content'] = $this->load->view('komoditas/list', $data, true);
        $template['js'] = $this->load->view('komoditas/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Komoditas_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/komoditas/create_action'),
            'id' => set_value('id'),
            'id_subsektor' => set_value('id_subsektor'),
            'name' => set_value('name'),
        );

        $data['load_subsektor']	= $this->Subsektor_model->get_category_select(array('' => '-- Pilih --'));

        $template['page_heading'] = 'Komoditas';
        $template['content'] = $this->load->view('komoditas/form', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                'name' => $this->input->post('name',TRUE),
            );

            $this->Komoditas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('cms/komoditas'));
        }
    }

    public function update($id)
    {
        $row = $this->Komoditas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/komoditas/update_action'),
                'id' => set_value('id', $row->id),
                'id_subsektor' => set_value('id_subsektor', $row->id_subsektor),
                'name' => set_value('name', $row->name),
            );

            $data['load_subsektor']	= $this->Subsektor_model->get_category_select(array('' => '-- Pilih --'));
            $template['page_heading'] = 'Komoditas';
            $template['content'] = $this->load->view('komoditas/form', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/komoditas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                'name' => $this->input->post('name',TRUE),
            );

            $this->Komoditas_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('cms/komoditas'));
        }
    }

    public function delete($id)
    {
        $row = $this->Komoditas_model->get_by_id($id);

        if ($row) {
            $this->Komoditas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('cms/komoditas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('cms/komoditas'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_subsektor', 'id subsektor', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Komoditas.php */
/* Location: ./application/controllers/Komoditas.php */