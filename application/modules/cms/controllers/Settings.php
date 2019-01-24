<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        $this->lang->load('auth');
        $this->load->helper('language');

        if (!$this->ion_auth->is_admin())
        {
            redirect(site_url('cms/log/in'));
        }
    }

    public function index()
    {
        $row = $this->Settings_model->get_by_id(1);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('cms/settings/update_action'),
                'id' => set_value('id', $row->id),
                'tahun_anggaran' => set_value('tahun_anggaran', $row->tahun_anggaran),
                'site_title' => set_value('site_title', $row->site_title),
                'site_url' => set_value('site_url', $row->site_url),
                'tag_line' => set_value('tag_line', $row->tag_line),
                'site_name' => set_value('site_name', $row->site_name),
                'copyright' => set_value('copyright', $row->copyright),
                'keywords' => set_value('keywords', $row->keywords),
                'meta_description' => set_value('meta_description', $row->meta_description),
                'googleplus' => set_value('googleplus', $row->googleplus),
                'facebook' => set_value('facebook', $row->facebook),
                'twitter' => set_value('twitter', $row->twitter),
                'youtube' => set_value('youtube', $row->youtube),
                'instagram' => set_value('instagram', $row->instagram),
                'site_offline' => set_value('site_offline', $row->site_offline),
                'lockscreen' => set_value('lockscreen', $row->lockscreen),
                'lockscreen_time' => set_value('lockscreen_time', $row->lockscreen_time),
            );

            $template['page_heading'] = 'Pengaturan';
            $template['content'] = $this->load->view('settings/form', $data, true);
            $this->load->view('backend/layouts/dashboard', $template);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('cms/settings'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = array(
                'tahun_anggaran' => $this->input->post('tahun_anggaran',TRUE),
                'site_title' => $this->input->post('site_title',TRUE),
                'site_url' => $this->input->post('site_url',TRUE),
                'tag_line' => $this->input->post('tag_line',TRUE),
                'site_name' => $this->input->post('site_name',TRUE),
                'copyright' => $this->input->post('copyright',TRUE),
                'keywords' => $this->input->post('keywords',TRUE),
                'meta_description' => $this->input->post('meta_description',TRUE),
                'googleplus' => $this->input->post('googleplus',TRUE),
                'facebook' => $this->input->post('facebook',TRUE),
                'twitter' => $this->input->post('twitter',TRUE),
                'youtube' => $this->input->post('youtube',TRUE),
                'instagram' => $this->input->post('instagram',TRUE),
                'site_offline' => $this->input->post('site_offline',TRUE),
                'lockscreen' => $this->input->post('lockscreen',TRUE),
                'lockscreen_time' => $this->input->post('lockscreen_time',TRUE),
            );

            $this->Settings_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('cms/settings'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('tahun_anggaran', 'tahun anggaran', 'trim|required');
        $this->form_validation->set_rules('site_title', 'site title', 'trim|required');
        $this->form_validation->set_rules('site_url', 'site url', 'trim|required');
        $this->form_validation->set_rules('site_name', 'site name', 'trim|required');
        $this->form_validation->set_rules('site_offline', 'site offline', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Settings.php */
/* Location: ./application/controllers/Settings.php */