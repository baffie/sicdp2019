<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
        $config = array(
            'field' => 'slug',
            'title' => 'title',
            'table' => 'news_3601',
            'id' => 'id',
        );
        $this->load->library('slug', $config);
    }

    public function index()
    {
        $data['source'] = site_url('cms/news/grid');
        $template['page_heading'] = 'Berita';
        $template['content'] = $this->load->view('news/list', $data, true);
        $template['js'] = $this->load->view('news/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->News_model->grid();
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('cms/news/create_action'),
            'id' => set_value('id'),
            'subtitle' => set_value('subtitle'),
            'title' => set_value('title'),
            'slug' => set_value('slug'),
            'summary' => set_value('summary'),
            'content' => set_value('content'),
            'images_content' => set_value('images_content'),
            'images_caption' => set_value('images_caption'),
            'keyword' => set_value('keyword'),
            'channel_id' => set_value('channel_id'),
            'source' => set_value('source'),
            'status' => set_value('status'),
            'created' => set_value('created'),
            'updated' => set_value('updated'),
        );

        $data['options_channel'] = $this->News_model->options_channel();

        $template['page_heading'] = 'Berita';
        $template['content'] = $this->load->view('news/form', $data, true);
        $template['css'] = $this->load->view('news/css', $data, true);
        $template['js'] = $this->load->view('news/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'subtitle' => $this->input->post('subtitle',TRUE),
                'title' => $this->input->post('title',TRUE),
                'summary' => $this->input->post('summary',TRUE),
                'content' => $this->input->post('content',TRUE),
                'images_caption' => $this->input->post('images_caption',TRUE),
                'keyword' => $this->input->post('keyword',TRUE),
                'channel_id' => $this->input->post('channel_id',TRUE),
                'source' => $this->input->post('source',TRUE),
                'status' => $this->input->post('status',TRUE),
                'created' => date('Y-m-d h:i:s'),
                'updated' => date('Y-m-d h:i:s'),
            );
                
            if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {

                $upload_img = FCPATH.'uploads/';
                $file_name = date("Ymd") . '-' . trim($_FILES['foto']['name']);

                if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

                $config['upload_path'] = $upload_img;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_type'] = 'image/jpeg';
                $config['file_name'] = $file_name;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(site_url('cms/news'));
                } else {
                    $this->load->library('image_lib');
                    $upload_data = $this->upload->data();

                    $this->resize_image($upload_img . $upload_data['file_name'], 750, 450,$upload_img);
                    $this->resize_image($upload_img . $upload_data['file_name'], 450, 250,$upload_img.'/thumbs/');

                    $data['images_content'] = $upload_data['raw_name'] . $upload_data['file_ext'];
                }
            }
                
            $data['slug'] = $this->slug->create_uri($data);
                
            $this->News_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('cms/news'));
        }
    }

    public function update($id)
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('cms/news/update_action'),
                'id' => set_value('id', $row->id),
                'subtitle' => set_value('subtitle', $row->subtitle),
                'title' => set_value('title', $row->title),
                'slug' => set_value('slug', $row->slug),
                'summary' => set_value('summary', $row->summary),
                'content' => set_value('content', $row->content),
                'images_content' => set_value('images_content', $row->images_content),
                'images_caption' => set_value('images_caption', $row->images_caption),
                'keyword' => set_value('keyword', $row->keyword),
                'channel_id' => set_value('channel_id', $row->channel_id),
                'source' => set_value('source', $row->source),
                'status' => set_value('status', $row->status),
                'created' => set_value('created', $row->created),
                'updated' => set_value('updated', $row->updated),
            );

            $data['options_channel'] = $this->News_model->options_channel();

            $template['page_heading'] = 'Berita';
            $template['content'] = $this->load->view('news/form', $data, true);
            $template['css'] = $this->load->view('news/css', $data, true);
            $template['js'] = $this->load->view('news/js', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/news'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'subtitle' => $this->input->post('subtitle',TRUE),
                'title' => $this->input->post('title',TRUE),
                'slug' => $this->input->post('slug',TRUE),
                'summary' => $this->input->post('summary',TRUE),
                'content' => $this->input->post('content',TRUE),
                'images_caption' => $this->input->post('images_caption',TRUE),
                'keyword' => $this->input->post('keyword',TRUE),
                'channel_id' => $this->input->post('channel_id',TRUE),
                'source' => $this->input->post('source',TRUE),
                'status' => $this->input->post('status',TRUE),
                'updated' => date('Y-m-d h:i:s'),
            );
                
            if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {
                $upload_img = FCPATH.'uploads/';
                $file_name = date("Ymd") . '-' . trim($_FILES['foto']['name']);

                if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

                $config['upload_path'] = $upload_img;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_type'] = 'image/jpeg';
                $config['file_name'] = $file_name;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(site_url('cms/news'));
                } else {
                    $this->load->library('image_lib');
                    $upload_data = $this->upload->data();

                    $this->resize_image($upload_img . $upload_data['file_name'], 750, 450,$upload_img);
                    $this->resize_image($upload_img . $upload_data['file_name'], 450, 250,$upload_img.'/thumbs/');

                    $data['images_content'] = $upload_data['raw_name'] . $upload_data['file_ext'];
                }
            }

            $data['slug'] = $this->slug->create_uri($data, $this->input->post('id', TRUE));

            $this->News_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/news'));
        }
    }

    public function delete($id)
    {
        $row = $this->News_model->get_by_id($id);

        if ($row) {
            $this->News_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('cms/news'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/news'));
        }
    }

    public function resize_image($file_path, $width, $height, $new_image)
    {
        $img_cfg['image_library'] = 'gd2';
        $img_cfg['source_image'] = $file_path;
        $img_cfg['maintain_ratio'] = TRUE;
        $img_cfg['create_thumb'] = TRUE;
        $img_cfg['thumb_marker']='';
        $img_cfg['new_image'] = $new_image;
        $img_cfg['width'] = $width;
        $img_cfg['height'] = $height;

        $this->image_lib->initialize($img_cfg);
        if (!$this->image_lib->resize()){
            $this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
        }
        $this->image_lib->clear();

    }

    public function _rules()
    {
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('summary', 'summary', 'trim|required');
        $this->form_validation->set_rules('content', 'content', 'trim|required');
        $this->form_validation->set_rules('channel_id', 'channel id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}