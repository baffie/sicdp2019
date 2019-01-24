<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model('news/news_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $slug = $this->uri->segment(2);
        $slug OR show_404();
        $data['detail'] = $this->news_model->get_news_by_channel($slug,10);
        $data['channel'] = $slug;
        $template['content'] = $this->load->view('v_category', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }
}
