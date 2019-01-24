<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_channel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_channel_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }

        $config = array(
            'field' => 'slug',
            'title' => 'name',
            'table' => 'news_channel',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
    }

    public function index()
    {
        $data['source'] = site_url('cms/news_channel/grid');
        $template['page_heading'] = 'Kanal Berita';
        $template['content'] = $this->load->view('news_channel/list', $data, true);
        $template['js'] = $this->load->view('news_channel/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->News_channel_model->grid();
    }


    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/news_channel/create_action'),
            'id' => set_value('id'),
            'name' => set_value('name'),
            'slug' => set_value('slug'),
            'parent_id' => set_value('parent_id'),
            'status' => set_value('status'),
        );

        $data['category_parent'] = $this->News_channel_model->get_parent_category(array('0' => 'Kategori Utama'));

        $template['page_heading'] = 'Kanal Berita';
        $template['content'] = $this->load->view('news_channel/form', $data, true);
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
                'parent_id' => $this->input->post('parent_id',TRUE),
                'status' => $this->input->post('status',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data);

            $this->News_channel_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/news_channel'));
        }
    }

    public function update($id)
    {
        $row = $this->News_channel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cms/news_channel/update_action'),
                'id' => set_value('id', $row->id),
                'name' => set_value('name', $row->name),
                'slug' => set_value('slug', $row->slug),
                'parent_id' => set_value('parent_id', $row->parent_id),
                'status' => set_value('status', $row->status),
            );

            $data['category_parent'] = $this->News_channel_model->get_parent_category(array('0' => 'Kategori Utama'));

            $template['page_heading'] = 'Kanal Berita';
            $template['content'] = $this->load->view('news_channel/form', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/news_channel'));
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
                'parent_id' => $this->input->post('parent_id',TRUE),
                'status' => $this->input->post('status',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data, $this->input->post('id', TRUE));

            $this->News_channel_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/news_channel'));
        }
    }

    public function delete($id)
    {
        $row = $this->News_channel_model->get_by_id($id);

        if ($row) {
            $this->News_channel_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/news_channel'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/news_channel'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('parent_id', 'parent id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}