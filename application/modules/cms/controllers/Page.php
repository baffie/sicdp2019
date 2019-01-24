<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
        $config = array(
            'field' => 'slug',
            'title' => 'title',
            'table' => 'page_3601',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
    }

    public function index()
    {
        $data['source'] = site_url('cms/page/grid');
        $template['page_heading'] = 'Halaman';
        $template['content'] = $this->load->view('page/list', $data, true);
        $template['js'] = $this->load->view('page/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Page_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/page/create_action'),
            'id' => set_value('id'),
            'title' => set_value('title'),
            'summary' => set_value('summary'),
            'description' => set_value('description'),
            'slug' => set_value('slug'),
            'created' => set_value('created'),
            'updated' => set_value('updated'),
            'status' => set_value('status'),
        );

        $template['page_heading'] = 'Halaman';
        $template['content'] = $this->load->view('page/form', $data, true);
        $template['css'] = $this->load->view('page/css', $data, true);
        $template['js'] = $this->load->view('page/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'title' => $this->input->post('title',TRUE),
                'summary' => $this->input->post('summary',TRUE),
                'description' => $this->input->post('description',TRUE),
                'created' => date('Y-m-d h:i:s'),
                'updated' => date('Y-m-d h:i:s'),
                'status' => $this->input->post('status',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data);

            $this->Page_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/page'));
        }
    }

    public function update($id)
    {
        $row = $this->Page_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cms/page/update_action'),
                'id' => set_value('id', $row->id),
                'title' => set_value('title', $row->title),
                'summary' => set_value('summary', $row->summary),
                'description' => set_value('description', $row->description),
                'slug' => set_value('slug', $row->slug),
                'created' => set_value('created', $row->created),
                'updated' => set_value('updated', $row->updated),
                'status' => set_value('status', $row->status),
            );

            $template['page_heading'] = 'Halaman';
            $template['content'] = $this->load->view('page/form', $data, true);
            $template['css'] = $this->load->view('page/css', $data, true);
            $template['js'] = $this->load->view('page/js', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);

        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('page'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'title' => $this->input->post('title',TRUE),
                'summary' => $this->input->post('summary',TRUE),
                'description' => $this->input->post('description',TRUE),
                'slug' => $this->input->post('slug',TRUE),
                'updated' => date('Y-m-d h:i:s'),
                'status' => $this->input->post('status',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data, $this->input->post('id', TRUE));

            $this->Page_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/page'));
        }
    }

    public function delete($id)
    {
        $row = $this->Page_model->get_by_id($id);

        if ($row) {
            $this->Page_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/page'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/page'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('summary', 'summary', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}