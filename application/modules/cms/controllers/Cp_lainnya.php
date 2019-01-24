<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cp_lainnya extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cp_lainnya_model');
        //$this->load->model('Sektor_model');
        $this->load->model('Kabupaten_model');
        $this->load->model('Home_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect(site_url('auth/login'));
        }

        $this->user = $this->ion_auth->user()->row();
    }

    public function index()
    {
        
        //$this->load->model('Kabupaten_model');

        $data['source'] = site_url('cms/cp_lainnya/grid');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
        $template['page_heading'] = 'DATA AWAL PENGADAAN CP LAINNYA';
        $template['content'] = $this->load->view('cp_lainnya/list', $data, true);
        $template['js'] = $this->load->view('cp_lainnya/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }
    
     
    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Cp_lainnya_model->grid();
    }
    
    public function rekap($id)
    {
        
        $this->load->model('Home_model');
        $id OR show_404();

        $poktan = $this->Home_model->get_by_id($id);
        //print_r($poktan);
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'komoditas' => $poktan->komoditas,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );
                
        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        

        foreach ($rdkk as $item) {
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;

        $template['page_heading'] = 'DATA Awal Pengadaan CP LAINNYA';
        $template['content'] = $this->load->view('cpm_lpm/rekap', $data, true);
        $this->load->view('layouts/dashboard', $template);
         
    }

	public function create()
        {
                $data = array(
                        'button' => 'Tambah',
                        'action' => site_url('cms/cp_lainnya/create_action'),
                        'id_cpl' => set_value('id_cpl'),
                        'id_penyuluh' => set_value('id_penyuluh',$this->user->id),
                        'id_kabupaten' => set_value('id_kabupaten',$this->user->id_kabupaten),
                        'awal_pengadaan' => set_value('awal_pengadaan'),
                        'bulan_pengadaan' => set_value('bulan_pengadaan'),
                        'tahun_pengadaan' => set_value('tahun_pengadaan'),
                );
                
                $this->load->model('Kabupaten_model');
                //$this->load->model('Kecamatan_model');
                //$this->load->model('Kelurahan_model');
                
                $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));

                $template['page_heading'] = 'Data Awal Pengadaan CP Lainnya';
                $template['content'] = $this->load->view('cp_lainnya/form', $data, true);
                $template['js'] = $this->load->view('cp_lainnya/js', $data, true);
                $template['css'] = $this->load->view('cp_lainnya/css', $data, true);
                $this->load->view('backend/layouts/dashboard', $template);
        }

        public function create_action()
        {
                //$this->output->enable_profiler(TRUE);
                $this->_rules();
                
                if ($this->form_validation->run() == FALSE) {
                        $this->create();
                } else {
                        $data = array(
                                'id_cpl' => $this->input->post('id_cpl',TRUE),
                                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
                                'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
                                'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
                                'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
                                'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
                        );
                        
                        $this->Cp_lainnya_model->insert($data);
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        redirect(site_url('cms/cp_lainnya'));
                        
                }
        }


    public function update($id)
        {
                $row = $this->Cp_lainnya_model->get_by_id($id);

                if ($row) {
                        $data = array(
                                'button' => 'Update',
                                'action' => site_url('cms/cp_lainnya/update_action'),
                                'id_cpl' => set_value('id_cpl', $row->id_cbp),
                                'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
                                'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
                                'awal_pengadaan' => set_value('awal_pengadaan', $row->awal_pengadaan),
                                'bulan_pengadaan' => set_value('bulan_pengadaan', $row->bulan_pengadaan),
                                'tahun_pengadaan' => set_value('tahun_pengadaan', $row->tahun_pengadaan),
                        );
                        
                        $this->load->model('Kabupaten_model');
                        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));

                        
                        $template['page_heading'] = 'Data Awal Pengadaan CP Lainnya';
                        $template['content'] = $this->load->view('cp_lainnya/form', $data, true);
                        $template['js'] = $this->load->view('cp_lainnya/js', $data, true);
                        $template['css'] = $this->load->view('cp_lainnya/css', $data, true);
                        $this->load->view('backend/layouts/dashboard', $template);
                } else {
                        $this->session->set_flashdata('error', 'Data tidak ditemukan');
                        redirect(site_url('cms/cp_lainnya'));
                }
        }

        public function update_action()
        {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                        $this->update($this->input->post('id_cpl', TRUE));
                } else {
                        $data = array(
                                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
                                'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
                                'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
                                'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
                                'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
                        );
        
                        $this->Cp_lainnya_model->update($this->input->post('id_cpl', TRUE), $data);
                        $this->session->set_flashdata('success', 'Data berhasil diupdate');
                        redirect(site_url('cms/cp_lainnya'));
                }
        }
        
       public function valid($id, $status)
    {
        $data = array('status' => $status);
        $this->Cp_lainnya_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('cms/cp_lainnya');
    }

        public function delete($id)
    {
        $row = $this->Cp_lainnya_model->get_by_id($id);

        if ($row) {
            $this->Cp_lainnya_model->delete($id);
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect(site_url('cms/cp_lainnya'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('cms/cp_lainnya'));
        }
    }
    
        public function _rules()
        {
                //$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|required');
                $this->form_validation->set_rules('bulan_pengadaan', 'bulan_pengadaan', 'trim|required');
                $this->form_validation->set_rules('tahun_pengadaan', 'tahun_pengadaan', 'trim|required');
                $this->form_validation->set_rules('awal_pengadaan', 'Awal Pengadaan', 'trim|required');
                //$this->form_validation->set_rules('penyusutan', 'attach_file', 'trim|required');

                $this->form_validation->set_rules('id_cpl', 'id_cpl', 'trim');
                $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        }
    
   
        public function cetak($id)
    {
        $this->load->model('Home_model');
        $id OR show_404();

        $poktan = $this->Home_model->get_by_id($id);
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'komoditas' => $poktan->komoditas,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );

        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        

        foreach ($rdkk as $item) {
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;

        $template['page_heading'] = 'DATA CPM LPM';
        $template['content'] = $this->load->view('cpm_lpm/print', $data, true);
        $this->load->view('layouts/print', $template);
    }

}

/* End of file Cp_lainnya.php */
/* Location: ./application/controllers/Cp_lainnya.php */