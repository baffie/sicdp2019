<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subsektor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Subsektor_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $this->load->model('Sektor_model');
        $subsektor = $this->Subsektor_model->get_all();

        $data = array(
            'subsektor_data' => $subsektor
        );

        $data['source'] = site_url('cms/subsektor/grid');
        $template['page_heading'] = 'Sub Sektor';
        $template['content'] = $this->load->view('subsektor/list', $data, true);
        $template['js'] = $this->load->view('subsektor/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
          show_404();
          exit;
        }
        echo $this->Subsektor_model->grid();
    }

    public function create()
    {
        $this->load->model('Sektor_model');

        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/subsektor/create_action'),
            'id' => set_value('id'),
            'id_sektor' => set_value('id_sektor'),
            'name' => set_value('name'),
        );

        $data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));

        $template['page_heading'] = 'Sub Sektor';
        $template['content'] = $this->load->view('subsektor/form', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_sektor' => $this->input->post('id_sektor',TRUE),
                'name' => $this->input->post('name',TRUE),
            );

            $this->Subsektor_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect(site_url('cms/subsektor'));
        }
    }

    public function update($id)
    {
        $this->load->model('Sektor_model');

        $row = $this->Subsektor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/subsektor/update_action'),
                'id' => set_value('id', $row->id),
                'id_sektor' => set_value('id_sektor', $row->id_sektor),
                'name' => set_value('name', $row->name),
            );

            $data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));

            $template['page_heading'] = 'Sub Sektor';
            $template['content'] = $this->load->view('subsektor/form', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('cms/subsektor'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_sektor' => $this->input->post('id_sektor',TRUE),
                'name' => $this->input->post('name',TRUE),
            );

            $this->Subsektor_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect(site_url('cms/subsektor'));
        }
    }

    public function delete($id)
    {
        $row = $this->Subsektor_model->get_by_id($id);

        if ($row) {
            $this->Subsektor_model->delete($id);
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect(site_url('cms/subsektor'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('cms/subsektor'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_sektor', 'id sektor', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Subsektor.php */
/* Location: ./application/controllers/Subsektor.php */