<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Read extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news/news_model');
    }

    public function index()
    {
        $this->load->helper('string');
        $slug = $this->uri->segment(4);
        $slug OR show_404();

        $data['detail'] = $this->news_model->get_by_slug($slug);

        if(count($data['detail']) < 1){
            redirect(site_url(), 'location', 301);
        }

        /*$data_hit = array(
            'news_id'       => $data['detail']['id'],
            'category'      => $data['detail']['channel_id'],
            'hits'          => 1,
            'last_viewed'   => date("Y-m-d H:i:s")
        );
        $this->news_model->insert_hits($data_hit);*/

        $data['opengraph'] = 	array(
            'type'				=> 'article',
            'title'				=> strip_quotes($data['detail']['title']),
            'url'				=> current_url(),
            'image'				=> base_url('uploads/'.$data['detail']['images_content']),
            'description'		=> strip_quotes($data['detail']['summary'])
        );


        $data['page_title']    = strip_quotes($data['detail']['title']);
        $data['description']   = strip_quotes($data['detail']['summary']);
        $data['keywords']      = strtolower($data['detail']['keyword']);

        $data['main_menu'] = $data['detail']['channel'];
        $template['content'] = $this->load->view('v_read', $data, true);
        //$template['css'] = $this->load->view('news/css', $data, true);
        //$template['js'] = $this->load->view('news/js', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }
}