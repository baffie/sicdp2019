<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
        $this->load->helper('string');
    }

    public function index()
    {
        $slug = $this->uri->segment(2);
        $slug OR show_404();

        $data['detail'] = $this->Page_model->get_by_slug($slug);

        if(count($data['detail']) < 1){
            redirect(site_url(), 'location', 301);
        }

        $data['page_title']    = strip_quotes($data['detail']['title']);
        $data['description']   = strip_quotes($data['detail']['summary']);
        $template['content'] = $this->load->view('v_page', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }
}