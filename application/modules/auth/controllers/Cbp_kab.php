<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cbp_kab extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cbp_kab_model');
		$this->load->model('Home_model');
		$this->load->model('Data_Cbpkab_model');
		$this->load->model('Kabupaten_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in())
		{
			redirect(site_url('auth/login'));
		}
		$config = array(
			'field' => 'slug',
			'table' => 'cbp_kab',
			'id' => 'id_cbp',
		);
		$this->load->library('slug', $config);

		$this->user = $this->ion_auth->user()->row();
	}

	public function index()
	{	
        $this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');
        $data['source'] = site_url('auth/cbp_kab/grid');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
		$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/list', $data, true);
        $template['js'] = $this->load->view('cbp_kab/js', $data, true);
		$this->load->view('layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Cbp_kab_model->grid($this->user->id);
    }

 	public function rekap($id)
	{
		
		$this->load->model('Data_Cbpkab_model');
		$this->load->model('Home_model');
		$id OR show_404();
		
		$get_stok_awal = $this->Home_model->get_stok_awal_cbpkab($id);
		$poktan = $this->Home_model->get_by_id_kota_cbp_kab_user($id);
		//print_r($poktan);
		//die();
		$rdkk = $this->Home_model->get_all_by_kota_cbp_kab_user($id);
		
		$data = array(
			'rdkk_data' => $rdkk,
			'id_poktan' => $poktan->id_cbp,
			'nama_gapoktan' => $poktan->nama_gapoktan,
			'nama_poktan' => $poktan->nama_poktan,
			'subsektor' => $poktan->subsektor,
			'komoditas' => $poktan->komoditas,
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
		$total_penyusutan = 0;
		

		foreach ($rdkk as $item) {
			$get_stok_awal;
			$total_stok = $item['awal_pengadaan'];
			$total_penambahan += $item['penambahan'];
			$total_penyaluran += $item['penyaluran'];
			$total_penyusutan += $item['penyusutan'];
			$total_stok_awal += $item['stok_awal'];
			
		}

		$data['get_stok_awal'] = $get_stok_awal;
		$data['total_stok'] = $total_stok;
		$data['total_stok_awal'] = $total_stok_awal;
		$data['total_penambahan'] = $total_penambahan;
		$data['total_penyaluran'] = $total_penyaluran;
		$data['total_penyusutan'] = $total_penyusutan;

		$template['page_heading'] = 'Rekap Data CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/rekap', $data, true);
		$this->load->view('layouts/dashboard', $template);
	}

	public function cetak($id)
	{
		$this->load->model('Data_Cbpkab_model');
		$this->load->model('Home_model');
		$id OR show_404();

		$get_stok_awal = $this->Home_model->get_stok_awal_cbp($id);
		$poktan = $this->Home_model->get_by_id_kota_cbp_kab_user($id);
		$rdkk = $this->Home_model->get_all_by_kota_cbp_kab_user($id);
		//print_r($rdkk);
		//die()
		$data = array(
			'rdkk_data' => $rdkk,
			'id_poktan' => $poktan->id_cbp,
			'nama_gapoktan' => $poktan->nama_gapoktan,
			'nama_poktan' => $poktan->nama_poktan,
			'subsektor' => $poktan->subsektor,
			'komoditas' => $poktan->komoditas,
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
		$total_penyusutan = 0;
		

		foreach ($rdkk as $item) {
			$get_stok_awal;
			$total_stok += $item['awal_pengadaan'];
			$total_penambahan += $item['penambahan'];
			$total_penyaluran += $item['penyaluran'];
			$total_penyusutan += $item['penyusutan'];
			$total_stok_awal += $item['stok_awal'];
			
		}

		$data['get_stok_awal'] = $get_stok_awal;
		$data['total_stok'] += $total_stok;
		$data['total_stok_awal'] += $total_stok_awal;
		$data['total_penambahan'] += $total_penambahan;
		$data['total_penyaluran'] += $total_penyaluran;
		$data['total_penyusutan'] += $total_penyusutan;

		$template['page_heading'] = 'Rekap Data CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/print', $data, true);
		$this->load->view('layouts/print', $template);
	}

	public function read($id)
	{
		$row = $this->Cbp_kab_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_penyuluh' => $row->id_penyuluh,
				'id_kabupaten' => $row->id_kabupaten,
				'awal_pengadaan' => $row->awal_pengadaan,
				'bulan_pengadaan' => $row->bulan_pengadaan,	
				'tahun_pengadaan' => $row->tahun_pengadaan,
			);

			$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
			$template['content'] = $this->load->view('cbp_kab/read', $data, true);
			$this->load->view('layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('auth/cbp_kab'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('auth/cbp_kab/create_action'),
			'id_cbp' => set_value('id_cbp'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_kabupaten' => set_value('id_kabupaten',$this->user->id_kabupaten),
			'awal_pengadaan' => set_value('awal_pengadaan'),
			'bulan_pengadaan' => set_value('bulan_pengadaan'),
			'tahun_pengadaan' => set_value('tahun_pengadaan'),
		);
		
		$this->load->model('Kabupaten_model');
		//$this->load->model('Kecamatan_model');
		//$this->load->model('Kelurahan_model');
		
		$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		//$data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
		//$data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);

		$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/form', $data, true);
        $template['js'] = $this->load->view('cbp_kab/js', $data, true);
		$template['css'] = $this->load->view('cbp_kab/css', $data, true);
		$this->load->view('layouts/dashboard', $template);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_cbp' => $this->input->post('id_cbp',TRUE),
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
				'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
				'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
				'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
			);
		

			$this->Cbp_kab_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('auth/cbp_kab'));
		}
	}

	public function update($id)
	{
		$row = $this->Cbp_kab_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('auth/cbp_kab/update_action'),
				'id_cbp' => set_value('id_cbp', $row->id_cbp),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
				'awal_pengadaan' => set_value('awal_pengadaan', $row->awal_pengadaan),
				'bulan_pengadaan' => set_value('bulan_pengadaan', $row->bulan_pengadaan),
				'tahun_pengadaan' => set_value('tahun_pengadaan', $row->tahun_pengadaan),
			);
			
			$this->load->model('Kabupaten_model');
			$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));

			
			$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
			$template['content'] = $this->load->view('cbp_kab/form', $data, true);
            $template['js'] = $this->load->view('cbp_kab/js', $data, true);
			$template['css'] = $this->load->view('cbp_kab/css', $data, true);
			$this->load->view('layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('auth/cbp_kab'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_cbp', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
				'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
				'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
				'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
			);
	
			$this->Cbp_kab_model->update($this->input->post('id_cbp', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('auth/cbp_kab'));
		}
	}

	public function delete($id)
	{
		$row = $this->Cbp_kab_model->get_by_id($id);

		if ($row) {
			$this->Cbp_kab_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('auth/cbp_kab'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('auth/cbp_kab'));
		}
	}
	

    public function valid($id, $status)
    {
        $data = array('status' => $status);
        $this->Cbp_kab_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('auth/cbp_kab');
    }

	public function _rules()
	{
		//$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|required');
		$this->form_validation->set_rules('bulan_pengadaan', 'bulan_pengadaan', 'trim|required');
		$this->form_validation->set_rules('tahun_pengadaan', 'tahun_pengadaan', 'trim|required');
		$this->form_validation->set_rules('awal_pengadaan', 'Awal Pengadaan', 'trim|required');
		//$this->form_validation->set_rules('penyusutan', 'attach_file', 'trim|required');

		$this->form_validation->set_rules('id_cbp', 'id_cbp', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

    public function excel()
    {
        $this->load->library('excel');
        $today = date('Y-m-d H:i:s');

        $template = 'template_excel/cbp_kab_kota.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle(' DATA STOK AWAL CBP Kab');

        $styleBottom = array(
            'font' => array(
                'bold' => false,
                'size'  => 11,
                'name'  => 'Arial'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            )
        );

        $data = $this->Cbp_kab_model->get_all();
		//$data = $this->kabupaten_model->get_all();

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $today);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $this->user->name);

        $i	= 1;
        $n = 7;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $this->Kabupaten_model->get_by_id($item->id_kabupaten)->nama_kab);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item->awal_pengadaan);
			//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->bulan_pengadaan);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->tahun_pengadaan);
            ++$n;
            ++$i;
        }

        $highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        $objPHPExcel->getActiveSheet()->getStyle('A7:D' . $highestRow)->applyFromArray(
            array(
                'font' => array(
                    'bold' => false,
                    'size'  => 11,
                    'name'  => 'Arial'
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
                'borders' => array(
                    'allborders'	=> array(
                        'style'		=> PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            )
        );

        // Set page orientation and size
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_FOLIO);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data_Awal_Pengadaan_Kab-kota-'.$this->user->name.'-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }
}

/* End of file cbp_kab.php */
/* Location: ./application/controllers/cbp_kab.php */