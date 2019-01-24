<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cpp_kab_detail extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        //$this->load->model('Rdkk_model');
        $this->load->model('Data_cppkab_model');
        //$this->load->model('Kabupaten_model');
        //$this->load->model('Gapoktan_model');
        $this->load->library('form_validation');

    }

    /*public function index()
    {
        $this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');

        $tahun_pengadaan	= $this->session->userdata("tahun_pengadaan");
        //$subsektor	        = $this->session->userdata("id_subsektor");
        $kabupaten	        = $this->session->userdata("kabupaten");
        //$kecamatan	        = $this->session->userdata("kecamatan");
        //$desa		        = $this->session->userdata("desa");
     
        $poktan = $this->Home_model->get_search_kota_cpp_kab_detail($tahun_pengadaan, $kabupaten);
        //print_r($poktan);
        //die();
        $data = array(
            'data_poktan' => $poktan
        );

        $data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

        $template['title'] = 'Data CPP Kabupaten/Kota Detail';
        $template['content'] = $this->load->view('v_cpp_kab_detail', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }*/

    public function index()
    {
                $this->load->model('Data_Cppkab_model');
                //$this->load->model('Subsektor_model');
                //$id OR show_404();
                $tahun	= $this->session->userdata("tahun");
                $poktan = $this->Home_model->get_by_id_kota_cpp_kab_detail_cms($tahun);
                //print_r($poktan);
                //die();
                $rdkk = $this->Home_model->get_all_by_kota_cpp_kab_detail_cms($tahun);
                //print_r($rdkk);
          
        $data = array(
            'rdkk_data' => $rdkk,
            //'nama_poktan' => $this->poktan_model->get_by_id($poktan->id_poktan)->nama_poktan,
            //'id_gapoktan' => $poktan->id_gapoktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'tanggal' => $poktan->tanggal,
            //'subsektor' => $poktan->subsektor,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'luas_lahan' => $poktan->luas_lahan,
            'jumlah_anggota' => $poktan->jumlah_anggota,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );
        
                 
        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        $total_penyusutan = 0;
        

        foreach ($rdkk as $item) {
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_penyusutan = $item['penyusutan'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;
        $data['total_penyusutan'] = $total_penyusutan;


        $template['title'] = 'Data CPM LDPM';
        $template['content'] = $this->load->view('cpp_kab/v_kabupaten_cppkab_detail', $data, true);
        $template['js'] = $this->load->view('cpp_kab/js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function set()
    {
         $sess['tahun'] = $this->input->post("tahun");
        //$sess['id_subsektor'] = $this->input->post("id_subsektor");
        //$sess['kabupaten'] = $this->input->post("id_kabupaten");
        //$sess['kecamatan'] = $this->input->post("id_kecamatan");
        //$sess['desa'] = $this->input->post("id_desa");
        $this->session->unset_userdata('tahun');
        //$this->session->unset_userdata('id_subsektor');
        //$this->session->unset_userdata('kabupaten');
        //$this->session->unset_userdata('kecamatan');
        //$this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        redirect(site_url('cms/cpp/cpp_kab_detail'));
    }
}