<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('news/news_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $slug = 'news';

        $this->load->library('pagination');
        $config['base_url'] = base_url($slug.'/index/');
        $config['total_rows'] = $data['detail_count'] = $this->news_model->get_news_index(0)->num_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        $config['full_tag_open'] = '<nav><ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="previous">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['detail'] = $this->news_model->get_news_index($config['per_page'], $data['page']);

        $data['pagination']	= $this->pagination->create_links();

        $data['page_title']    = 'Berita Nasional, Internasional Terkini';
        $data['keywords']      = 'nasional, internasional, hukum politik, peristiwa, kriminal';
        $template['content'] = $this->load->view('v_news', $data, true);
        //$template['js'] = $this->load->view('news/js', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }

    public function testimonial()
    {
        $data['testimonial'] = $this->news_model->get_news_list('testimonial', 0, 5);
        $this->load->view('v_testimonial', $data);
    }



}