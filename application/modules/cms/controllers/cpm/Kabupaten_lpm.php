<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_lpm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Poktan_model');
        $this->load->model('Bulan_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $bulan	= $this->session->userdata("bulan");
        $tahun	= $this->session->userdata("tahun");
        //print_r ($tahun);
        //die();
        $stok = $this->Home_model->get_by_stok_prov_lpm($tahun);
        $rdkk = $this->Home_model->get_all_by_prov_lpm($bulan, $tahun);
        //print_r($stok);
        //die();        
        $data = array(
            'rdkk_data' => $rdkk,
        );

        //$data['subsektor'] = $this->Home_model->get_subsektor_by_prov();

        $data = array(
            'rdkk_data' => $rdkk,
            //'nama_poktan' => $this->poktan_model->get_by_id($poktan->id_poktan)->nama_poktan,
            'pengadaan' => $stok->pengadaan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            //'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'tahun_pengadaan' => $poktan->tahun_pengadaan,
            //'nama_ketua' => $poktan->nama_ketua,
            //'alamat' => $poktan->alamat,
            //'luas_lahan' => $poktan->luas_lahan,
            //'jumlah_anggota' => $poktan->jumlah_anggota,
            //'kabupaten' => $poktan->nama_kab,
            //'kecamatan' => $poktan->nama_kec,
            //'desa' =>  $poktan->nama_kel,
            //'penyuluh' => $poktan->name,
        );
        //print_r($data);
        //die();
                 
        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        //$total_penyusutan = 0;
        

        foreach ($rdkk as $item) {
            $total_stok += $item['stok'];
            $total_penambahan += $item['tambah'];
            $total_penyaluran += $item['salur'];
            //$total_penyusutan += $item['penyusutan'];
            $total_stok_awal += $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;
        //$data['total_penyusutan'] = $total_penyusutan;
        //print_r($rdkk);
        //die();
        $data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
        $template['title'] = 'Rekapitulasi CPM LPM';
        $template['content'] = $this->load->view('cpm/v_kab', $data, true);
        $template['js'] = $this->load->view('cpm/js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function set()
    {
        $sess['bulan'] = $this->input->post("bulan");
        $sess['tahun'] = $this->input->post("tahun");
        $this->session->unset_userdata('bulan');
        $this->session->unset_userdata('tahun');
        $this->session->set_userdata($sess);
        redirect(site_url('cms/cpm/kabupaten_lpm'));
    }
}