<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok_lpm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Stok_lpm_model');
        $this->load->model('poktan_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $data['source'] = site_url('cms/stok_lpm/grid');
        $template['page_heading'] = 'Stok Awal Lembaga Pangan Masyarakat';
        $template['content'] = $this->load->view('stok_lpm/list', $data, true);
        $template['js'] = $this->load->view('stok_lpm/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Stok_lpm_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/stok_lpm/create_action'),
            'id' => set_value('id'),
            'id_poktan' => set_value('id_poktan'),
            'bulan' => set_value('bulan'),
            'stok_awal' => set_value('stok_awal'),
        );
        
        $data['options_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'));

        $template['page_heading'] = 'Stok Awal Lembaga Pangan Masyarakat';
        $template['content'] = $this->load->view('stok_lpm/form', $data, true);
        $template['js'] = $this->load->view('stok_lpm/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_poktan' => $this->input->post('id_poktan',TRUE),
                'bulan' => $this->input->post('bulan',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );
            
            

            $this->Stok_lpm_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/stok_lpm'));
        }
    }

    public function update($id)
    {
        $row = $this->Stok_lpm_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('cms/stok_lpm/update_action'),
                'id' => set_value('id', $row->id),
                'id_poktan' => set_value('id_poktan', $row->id_poktan),
                'bulan' => set_value('bulan', $row->bulan),
                'stok_awal' => set_value('stok_awal', $row->stok_awal),
            );

            $template['page_heading'] = 'Stok Awal Lembaga Pangan Masyarakat';
            $template['content'] = $this->load->view('stok_lpm/form', $data, true);
            $template['js'] = $this->load->view('stok_lpm/js', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/stok_lpm'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_poktan' => $this->input->post('id_poktan',TRUE),
                'bulan' => $this->input->post('bulan',TRUE),
                'stok_awal' => $this->input->post('stok_awal',TRUE),
            );

            $this->Stok_lpm_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/stok_lpm'));
        }
    }

    public function delete($id)
    {
        $row = $this->Stok_lpm_model->get_by_id($id);

        if ($row) {
            $this->Stok_lpm_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/stok_lpm'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/stok_lpm'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
        $this->form_validation->set_rules('stok_awal', 'stok_awal', 'trim|required');
        $this->form_validation->set_rules('id_poktan', 'id_poktan', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file stok_lpm.php */
/* Location: ./application/controllers/Stok_lpm.php */