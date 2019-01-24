<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    
    //get cpp gapoktan json
    public function get_json_cpp_gapoktan(){
        $this->load->model('cpp_ldpm_model');
        $kabupaten = $this->input->post('id_kab');
        $gapoktan = $this->cpp_ldpm_model->get_list_gapoktan($kabupaten);

        echo json_encode($gapoktan);
    }
    
    //get gapoktan json
    public function get_json_gapoktan(){
        $this->load->model('gapoktan_model');
        $kabupaten = $this->input->post('id_kab');
        $gapoktan = $this->gapoktan_model->get_list_gapoktan($kabupaten);

        echo json_encode($gapoktan);
    }
    
     //get poktan json
    public function get_json_poktan(){
        $this->load->model('poktan_model');
        $kabupaten = $this->input->post('id_kab');
        $poktan = $this->poktan_model->get_list_poktan($kabupaten);

        echo json_encode($poktan);
    }

    //get kecamatan json
    public function get_json_kecamatan(){
        $this->load->model('kecamatan_model');
        $kabupaten = $this->input->post('id_kabupaten');
        $kecamatan = $this->kecamatan_model->get_list_kecamatan($kabupaten);

        echo json_encode($kecamatan);
    }

    //get desa json
    public function get_json_desa(){
        $this->load->model('kelurahan_model');
        $kecamatan = $this->input->post('id_kecamatan');
        $desa = $this->kelurahan_model->get_list_desa($kecamatan);

        echo json_encode($desa);
    }

    //get sub sektor json
    public function get_json_subsektor(){
        $this->load->model('subsektor_model');
        $id = $this->input->post('id_sektor');
        $subsektor = $this->subsektor_model->get_list_subsektor($id);

        echo json_encode($subsektor);
    }
    
        //get stok_awal_lpm
    public function get_stok_awal(){
        $this->load->model('Lpm_model');
        $poktan = $this->input->post('id_poktan');
        //$poktan= 6 ;
        $stok_awal = $this->Lpm_model->get_stok_awal($poktan);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    
     //get stok_awal_ldpm
    public function get_stok_ldpm(){
        $this->load->model('Ldpm_model');
        $gapoktan = $this->input->post('id_gapoktan');
        //$poktan= 6 ;
        $stok_awal = $this->Ldpm_model->get_stok_ldpm($gapoktan);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    
     //get stok_awal_cppkab
    public function get_stok_cppkab(){
        $this->load->model('Data_cppkab_model');
        $kabupaten = $this->input->post('id_kabupaten');
        //$poktan= 6 ;
        $stok_awal = $this->Data_cppkab_model->get_stok_cppkab($kabupaten);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    
       //get stok_awal_cppdesa
    public function get_stok_cppdesa(){
        $this->load->model('Data_cppdesa_model');
        $kabupaten = $this->input->post('id_kabupaten');
        //$poktan= 6 ;
        $stok_awal = $this->Data_cppdesa_model->get_stok_cppdesa($kabupaten);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    
      //get stok_awal_cbpkab
    public function get_stok_cbpkab(){
        $this->load->model('Data_cbpkab_model');
        $kabupaten = $this->input->post('id_kabupaten');
        //$poktan= 6 ;
        $stok_awal = $this->Data_cbpkab_model->get_stok_cbpkab($kabupaten);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    
    //get stok_awal_cpp_ldpm
    public function get_stok_cpp_ldpm(){
        $this->load->model('Data_cpp_ldpm_model');
        $id_gapoktan = $this->input->post('id_gapoktan');
        //$poktan= 6 ;
        $stok_awal = $this->Data_cpp_ldpm_model->get_stok_cpp_ldpm($id_gapoktan);
        //echo $poktan; 
        echo ($stok_awal*1);
    }
    

 
}