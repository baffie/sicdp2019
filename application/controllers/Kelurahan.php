<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelurahan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $kelurahan = $this->Kelurahan_model->get_all();

        $data = array(
            'kelurahan_data' => $kelurahan
        );

        $this->load->view('kelurahan/kelurahan_list', $data);
    }

    public function read($id)
    {
        $row = $this->Kelurahan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_kel' => $row->id_kel,
                'id_kec' => $row->id_kec,
                'nama_kel' => $row->nama_kel,
            );
            $this->load->view('kelurahan/kelurahan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kelurahan/create_action'),
            'id_kel' => set_value('id_kel'),
            'id_kec' => set_value('id_kec'),
            'nama_kel' => set_value('nama_kel'),
        );
        $this->load->view('kelurahan/kelurahan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kec' => $this->input->post('id_kec',TRUE),
                'nama_kel' => $this->input->post('nama_kel',TRUE),
            );

            $this->Kelurahan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelurahan'));
        }
    }

    public function update($id)
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kelurahan/update_action'),
                'id_kel' => set_value('id_kel', $row->id_kel),
                'id_kec' => set_value('id_kec', $row->id_kec),
                'nama_kel' => set_value('nama_kel', $row->nama_kel),
            );
            $this->load->view('kelurahan/kelurahan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kel', TRUE));
        } else {
            $data = array(
                'id_kec' => $this->input->post('id_kec',TRUE),
                'nama_kel' => $this->input->post('nama_kel',TRUE),
            );

            $this->Kelurahan_model->update($this->input->post('id_kel', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelurahan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $this->Kelurahan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelurahan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_kec', 'id kec', 'trim|required');
        $this->form_validation->set_rules('nama_kel', 'nama kel', 'trim|required');

        $this->form_validation->set_rules('id_kel', 'id_kel', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelurahan.php */
/* Location: ./application/controllers/Kelurahan.php */