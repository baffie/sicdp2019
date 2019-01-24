<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kabupaten_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kabupaten/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kabupaten/index.html';
            $config['first_url'] = base_url() . 'kabupaten/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kabupaten_model->total_rows($q);
        $kabupaten = $this->Kabupaten_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kabupaten_data' => $kabupaten,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('kabupaten/kabupaten_list', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kabupaten/create_action'),
	    'id_kab' => set_value('id_kab'),
	    'id_prov' => set_value('id_prov'),
	    'nama_kab' => set_value('nama_kab'),
	);
        $this->load->view('kabupaten/kabupaten_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_prov' => $this->input->post('id_prov',TRUE),
		'nama_kab' => $this->input->post('nama_kab',TRUE),
	    );

            $this->Kabupaten_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kabupaten/update_action'),
		'id_kab' => set_value('id_kab', $row->id_kab),
		'id_prov' => set_value('id_prov', $row->id_prov),
		'nama_kab' => set_value('nama_kab', $row->nama_kab),
	    );
            $this->load->view('kabupaten/kabupaten_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kab', TRUE));
        } else {
            $data = array(
		'id_prov' => $this->input->post('id_prov',TRUE),
		'nama_kab' => $this->input->post('nama_kab',TRUE),
	    );

            $this->Kabupaten_model->update($this->input->post('id_kab', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kabupaten_model->get_by_id($id);

        if ($row) {
            $this->Kabupaten_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kabupaten'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_prov', 'id prov', 'trim|required');
	$this->form_validation->set_rules('nama_kab', 'nama kab', 'trim|required');

	$this->form_validation->set_rules('id_kab', 'id_kab', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */