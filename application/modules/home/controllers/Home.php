<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('news/news_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $template['content'] = $this->load->view('v_home', '', true);
        $this->load->view('frontend/layouts/base', $template);
    }


}
