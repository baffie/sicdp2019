<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_total extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Rekap_total_model');
		$this->load->model('Home_model');
		//$this->load->model('Data_Cbpkab_model');
		$this->load->model('Bulan_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}

		$this->user = $this->ion_auth->user()->row();
		
	}

	public function index()
	{	
	
		//CP Lainnya
		$bulan	= $this->session->userdata("bulan");
		$tahun	= $this->session->userdata("tahun");
		$get_stok_awal = $this->Home_model->get_stok_awal_cp_lainnya3601($tahun);
		$get_awal_pengadaan = $this->Home_model->get_awal_pengadaan_cp_lainnya3601($tahun);
		$rdkk = $this->Home_model->get_all_by_cp_lainnya3601($tahun);
		$cp_lainnya = array(
			'rdkk_data' => $rdkk,
		);
		$total_stok  = 0;
		$total_stok_awal  = 0;
		$total_penambahan = 0;
		$total_penyaluran = 0;
		$total_penyusutan = 0;
		
		foreach ($rdkk as $item) {
			$get_stok_awal;
			$get_awal_pengadaan;
			$total_stok = $item['stok'];
			$total_penambahan += $item['penambahan'];
			$total_penyaluran += $item['penyaluran'];
			$total_penyusutan += $item['penyusutan'];
			$total_stok_awal = $get_awal_pengadaan;	
		}
		$cp_lainnya['get_stok_awal'] = $get_stok_awal;
		$cp_lainnya['total_stok_awal'] = $total_stok_awal;
		$cp_lainnya['total_stok_awal'] = $total_stok_awal;
		$cp_lainnya['total_penambahan'] = $total_penambahan;
		$cp_lainnya['total_penyaluran'] = $total_penyaluran;
		$cp_lainnya['total_penyusutan'] = $total_penyusutan;
		
		//data CBP
		$get_stok_awal_cbp = $this->Home_model->get_stok_awal_cbpkab3601($tahun);
		$get_awal_pengadaan_cbp = $this->Home_model->get_awal_pengadaan_cbpkab3601($tahun);
		$cbp = $this->Home_model->get_all_by_cbpkab3601($tahun);
		$cbp = array(
			'rdkk_data2' => $cbp,
		);
		$t_stok  = 0;
		$t_stok_awal  = 0;
		$t_penambahan = 0;
		$t_penyaluran = 0;
		$t_penyusutan = 0;
		
		foreach ($cbp as $item) {
			$get_stok_awal_cbp;
			$get_awal_pengadaan_cbp;
			$t_stok = $item['stok'];
			$t_penambahan += $item['penambahan'];
			$t_penyaluran += $item['penyaluran'];
			$t_penyusutan += $item['penyusutan'];
			$t_stok_awal = $get_awal_pengadaan_cbp;
		}
		$data_2['get_stok_awal_cbp'] = $get_stok_awal_cbp;
		$data_2['t_stok_awal'] = $t_stok_awal;
		$data_2['t_stok_awal'] = $t_stok_awal;
		$data_2['t_penambahan'] = $t_penambahan;
		$data_2['t_penyaluran'] = $t_penyaluran;
		$data_2['t_penyusutan'] = $t_penyusutan;
		
		//DATA CPP Kabupaten
		$poktan = $this->Home_model->get_by_id_kota_cpp_kab_detail_cms($tahun);
		$cppkab = $this->Home_model->get_all_by_kota_cpp_kab_detail_cms($tahun);
		 $cpp_kab = array(
			'cppkab_data' => $cppkab,
			'tahun_pengadaan' => $poktan->tahun_pengadaan,
		);
		$to_stok  = 0;
		$to_stok_awal  = 0;
		$to_penambahan = 0;
		$to_penyaluran = 0;
		$to_penyusutan = 0;
		
		foreach ($cppkab as $item) {
			$to_stok = $item['awal_pengadaan'];
			$to_penambahan = $item['penambahan'];
			$to_penyaluran = $item['penyaluran'];
			$to_penyusutan = $item['penyusutan'];
			$to_stok_awal = $item['stok_awal'];
			
		}

		$cpp_kab['to_stok'] = $to_stok;
		$cpp_kab['to_stok_awal'] = $to_stok_awal;
		$cpp_kab['to_penambahan'] = $to_penambahan;
		$cpp_kab['to_penyaluran'] = $to_penyaluran;
		$cpp_kab['to_penyusutan'] = $to_penyusutan;
		
		//rekap cpp desa
		$pok = $this->Home_model->get_by_id_cpp_desa_by_kecamatan($id);     
		$desa = $this->Home_model->get_all_by_cpp_desa_kabupaten($tahun);
		$data = array(
			'desa_data' => $desa,
			'kecamatan' => $pok->nama_kec,
			'kelurahan' => $pok->nama_kel,
		);
			
		$tot_stok  = 0;
		$tot_stok_awal  = 0;
		$tot_penambahan = 0;
		$tot_penyaluran = 0;
		$tot_penyusutan = 0;
		

		foreach ($desa as $item) {
			$tot_stok += $item['pengadaan'];
			$tot_penambahan += $item['penambahan'];
			$tot_penyaluran += $item['penyaluran'];
			$tot_penyusutan += $item['penyusutan'];
			$tot_stok_awal += $item['stok_awal'];
			
		}

		$desa['tot_stok'] += $tot_stok;
		$desa['tot_stok_awal'] += $tot_stok_awal;
		$desa['tot_penambahan'] += $tot_penambahan;
		$desa['tot_penyaluran'] += $tot_penyaluran;
		$desa['tot_penyusutan'] += $tot_penyusutan;
		
		//REKAP LDPM
		$stok = $this->Home_model->get_by_stok_prov_lpm($tahun);
		$ldpm = $this->Home_model->get_all_by_prov_ldpm($bulan, $tahun);
		$data = array(
			'rdkk_data4' => $ldpm,
			'pengadaan' => $stok->pengadaan,
		);
		$tota_stok  = 0;
		$tota_stok_awal  = 0;
		$tota_penambahan = 0;
		$tota_penyaluran = 0;
		
		foreach ($ldpm as $item) {
			$tota_stok += $item['stok'];
			$tota_penambahan += $item['tambah'];
			$tota_penyaluran += $item['salur'];
			$tota_stok_awal += $item['stok_awal'];		
		}

		$ldpm['tota_stok'] = $tota_stok;
		$ldpm['tota_stok_awal'] = $tota_stok_awal;
		$ldpm['tota_penambahan'] = $tota_penambahan;
		$ldpm['tota_penyaluran'] = $tota_penyaluran;
		
		//rekap lpm
		$stok2 = $this->Home_model->get_by_stok_prov_lpm($tahun);
		$lpm = $this->Home_model->get_all_by_prov_lpm($bulan, $tahun);
		 $data = array(
			'rdkk_data5' => $lpm,
		);
		$totall_stok  = 0;
		$totall_stok_awal  = 0;
		$totall_penambahan = 0;
		$totall_penyaluran = 0;
		
		foreach ($lpm as $item) {
			$totall_stok += $item['stok'];
			$totall_penambahan += $item['tambah'];
			$totall_penyaluran += $item['salur'];
			$totall_stok_awal += $item['stok_awal'];
			
		}

		$lpm['totall_stok'] = $totall_stok;
		$lpm['totall_stok_awal'] = $totall_stok_awal;
		$lpm['totall_penambahan'] = $totall_penambahan;
		$lpm['totall_penyaluran'] = $totall_penyaluran;
		
		$data= $cp_lainnya + $data_2 + $cpp_kab + $desa + $ldpm +$lpm;
		$template['page_heading'] = 'Rekap Data Cadangan Pangan Kabupaten Pandeglang';
		$template['content'] = $this->load->view('rekap_total/v_total', $data, true);
        $template['js'] = $this->load->view('rekap_total/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}
 	
}

/* End of file rekap_user.php */
/* Location: ./application/controllers/rekap_user.php */