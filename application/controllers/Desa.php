<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Desa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $desa = $this->Desa_model->get_all();

        $data = array(
            'desa_data' => $desa
        );

        $this->load->view('desa/desa_list', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('desa/create_action'),
	    'id_desa' => set_value('id_desa'),
	    'nama_desa' => set_value('nama_desa'),
	    'nama_lurah' => set_value('nama_lurah'),
	);
        $this->load->view('desa/desa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_desa' => $this->input->post('nama_desa',TRUE),
		'nama_lurah' => $this->input->post('nama_lurah',TRUE),
	    );

            $this->Desa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('desa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Desa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('desa/update_action'),
		'id_desa' => set_value('id_desa', $row->id_desa),
		'nama_desa' => set_value('nama_desa', $row->nama_desa),
		'nama_lurah' => set_value('nama_lurah', $row->nama_lurah),
	    );
            $this->load->view('desa/desa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('desa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_desa', TRUE));
        } else {
            $data = array(
		'nama_desa' => $this->input->post('nama_desa',TRUE),
		'nama_lurah' => $this->input->post('nama_lurah',TRUE),
	    );

            $this->Desa_model->update($this->input->post('id_desa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('desa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Desa_model->get_by_id($id);

        if ($row) {
            $this->Desa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('desa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('desa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_desa', 'nama desa', 'trim|required');
	$this->form_validation->set_rules('nama_lurah', 'nama lurah', 'trim|required');

	$this->form_validation->set_rules('id_desa', 'id_desa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Desa.php */
/* Location: ./application/controllers/Desa.php */