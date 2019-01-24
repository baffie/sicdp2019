<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_cppdesa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_cppdesa_model');
		$this->load->model('Bulan_model');
		$this->load->model('Home_model');
		$this->load->model('Kabupaten_model');
		$this->load->model('Kecamatan_model');
		$this->load->model('Kelurahan_model');
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
        //$this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');

        $data['source'] = site_url('cms/data_cppdesa/grid');
		$data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
		$template['page_heading'] = 'Data CPP Desa';
		$template['content'] = $this->load->view('data_cppdesa/list', $data, true);
        $template['js'] = $this->load->view('data_cppdesa/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Data_cppdesa_model->grid();
    }

    function grid_filter()
    {
        if(!$this->input->is_ajax_request($this->user->id))
        {
            show_404();
            exit;
        }

        echo $this->Data_cppdesa_model->grid_filter();
    }

	public function read($id)
	{
		$row = $this->Data_cppdesa_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_cppdesa' => $row->id_cppdesa,
				'id_penyuluh' => $row->id_penyuluh,
				'id_kabupaten' => $row->id_kabupaten,
				'tanggal' => $row->tanggal,
				'bulan' => $row->bulan,	
				'tahun' => $row->tahun,
				'stok_awal' => $row->stok_awal,
				'penambahan' => $row->penambahan,
				'penyaluran' => $row->penyaluran,
				'lokasi' => $row->lokasi,
				'penyusutan' => $row->penyusutan,
				'attach_file' => $row->attach_file,
				'keterangan' => $row->keterangan,
			);
			
			$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
			$template['page_heading'] = 'Data CPP Desa';
			$template['content'] = $this->load->view('data_cppdesa/read', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppdesa'));
		}
	}
	
	public function rekap($id=null)
	{
		//$id OR show_404();

		$this->load->model('Home_model');
		
		$id = $this->user->id_kabupaten;
		//print_r ($id);
		//die();
		$poktan = $this->Home_model->get_by_id_cppdesa($id);

		$rdkk = $this->Home_model->get_all_by_cppkab($id);
		//$kab =substr ($kabupaten, 2);
		$data = array(
			'rdkk_data' => $rdkk,
			'id_cpp' => $poktan->id_cpp,
			//'nama_gapoktan' => $this->Gapoktan_model->get_by_id($gapoktan->id_gapoktan)->nama_gapoktan,
			//'nama_kab' => $poktan->nama_kab,
			'tahun_pengadaan' => $poktan->tahun_pengadaan,
			//'komoditas' => $gapoktan->komoditas,
			//'nama_ketua' => $poktan->ketua_gapoktan,
			//'alamat' => $poktan->alamat,
			//'luas_lahan' => $poktan->luas_lahan,
			//'jumlah_anggota' => $poktan->jumlah_anggota,
			'kabupaten' => $poktan->nama_kab,
			//'kabu'=> $kab,
			//'kecamatan' => $poktan->nama_kec,
			//'desa' =>  $poktan->nama_kel,
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

		$template['page_heading'] = 'DATA CPP KABUPATEN/KOTA';
		$template['content'] = $this->load->view('data_cppdesa/rekap', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}
	
	 public function cetak($id=null)
	{
		//$id OR show_404();

		$this->load->model('Home_model');
		$id = $this->user->id_kabupaten;
		$poktan = $this->Home_model->get_by_id_cppdesa($id);
		$rdkk = $this->Home_model->get_all_by_cppkab($id);
		//$rdkk = $this->Home_model->get_all_by_gapok($poktan->id_kabupaten);

		$data = array(
			'rdkk_data' => $rdkk,
			'id_cpp' => $poktan->id_cpp,
			//'nama_gapoktan' => $this->Gapoktan_model->get_by_id($gapoktan->id_gapoktan)->nama_gapoktan,
			//'nama_kab' => $poktan->nama_kab,
			'tahun_pengadaan' => $poktan->tahun_pengadaan,
			//'komoditas' => $gapoktan->komoditas,
			//'nama_ketua' => $poktan->ketua_gapoktan,
			//'alamat' => $poktan->alamat,
			//'luas_lahan' => $poktan->luas_lahan,
			//'jumlah_anggota' => $poktan->jumlah_anggota,
			'kabupaten' => $poktan->nama_kab,
			//'kabu'=> $kab,
			//'kecamatan' => $poktan->nama_kec,
			//'desa' =>  $poktan->nama_kel,
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

		$template['page_heading'] = 'DATA CPM LDPM';
		$template['content'] = $this->load->view('data_cppdesa/print', $data, true);
		$this->load->view('layouts/print', $template);
	}
	
	/*public function excel($id=null)
	{
		$id OR show_404();

		$this->load->library('excel');
		
		$styleBorderAll = array(
			'borders' => array(
				'allborders'	=> array(
					'style'		=> PHPExcel_Style_Border::BORDER_THIN
				)
			)
		);

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

		styleRowBorder = array(
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
		);

		$today = date('Y-m-d H:i:s');
	   
		$template = 'template_excel/data_cpp_kab.xlsx';
		
		$objPHPExcel = PHPExcel_IOFactory::load($template);
		$objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi Cadangan Pangan Tingkat Kabupaten/kota');
		
		
		//$poktan = $this->Home_model->get_by_id($id);
		//$data = $this->Home_model->get_all_by_poktan($id);
	   	$id = $this->user->id_kabupaten;
		$poktan = $this->Home_model->get_by_id_cppdesa($id);
		$data = $this->Home_model->get_all_by_cppkab($id);
		
		//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $poktan->nama_poktan);
		//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $poktan->nama_kel);
		//$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', ': ' . $poktan->nama_kec);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $poktan->nama_kab);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $poktan->tahun_pengadaan);


		$i	= 1;
		$n = 8;
		foreach ($data as $item) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['bulan']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item['awal_pengadaan']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item['stok_awal']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item['penambahan']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item['penyaluran']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item['penyusutan']);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n, $item['akhir']);
			++$n;
			++$i;
		}

		$highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$objPHPExcel->getActiveSheet()->getStyle('A12:G' . $highestRow)->applyFromArray($styleRowBorder);

		$lastRow = $highestRow + 1;

		$objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow.':G'. $lastRow)->applyFromArray(
			array(
				'font' => array(
					'bold' => true,
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

		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . $lastRow.':B' . $lastRow);
		$objPHPExcel->getActiveSheet(0)->setCellValue('A' . $lastRow, 'Total');
		$objPHPExcel->getActiveSheet()->setCellValue('C' . $lastRow,$item['awal_pengadaan']);
		$objPHPExcel->getActiveSheet()->setCellValue('D' . $lastRow, $item['stok_awal']);
		$objPHPExcel->getActiveSheet()->setCellValue('E' . $lastRow, $item['penambahan']);
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $lastRow, $item['penyaluran']);
		$objPHPExcel->getActiveSheet()->setCellValue('F' . $lastRow, $item['penyusutan']);
		$objPHPExcel->getActiveSheet()->setCellValue('G' . $lastRow, $item['akhir']);
		


		$objPHPExcel->getActiveSheet()->getStyle('A' . ($lastRow + 3).':C' . ($lastRow + 10))->applyFromArray($styleBottom);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 3).':C' . ($lastRow + 3));
		$objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 3),'Mengetahui,');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 4).':C' . ($lastRow + 4));
		$objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 4),'');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 10).':C' . ($lastRow + 10));
		$objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 10), );

		$objPHPExcel->getActiveSheet()->getStyle('E' . ($lastRow + 3).':G' . ($lastRow + 10))->applyFromArray($styleBottom);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 3).':G' . ($lastRow + 3));
		$objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 3), $poktan->nama_kel.', '.dateformatindo(date('d M Y'),2));
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 4).':G' . ($lastRow + 4));
		$objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 4),'Operator');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 10).':G' . ($lastRow + 10));
		$objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 10), $poktan->name);

		// Set page orientation and size
		$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Rekapitulasi_CPM_LPM-'.$poktan->nama_poktan.'-'.$today.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');

	}*/

	public function create()
	{
		$stok_awal = $this->Data_cppdesa_model->get_stok_cppdesa();
		//die($stok_awal);
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/data_cppdesa/create_action'),
			'id_cppdesa' => set_value('id_cppdesa'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_kabupaten' => set_value('id_kabupaten'),
			'id_kecamatan' => set_value('id_kecamatan'),
			'id_desa' => set_value('id_desa'),
			'tanggal' => set_value('tanggal'),
			'bulan' => set_value('bulan'),
			'tahun' => set_value('tahun'),
			'stok_awal' => set_value ('stok_awal'),
			'penambahan' => set_value('penambahan'),
			'penyaluran' => set_value('penyaluran'),
			'lokasi' => set_value('lokasi'),
			'penyusutan' => set_value('penyusutan'),
			'attach_file' => set_value('attach_file'),
			'keterangan' => set_value('keterangan'),
			'created' => set_value('created'),
		);
		$idKab = $this->user->id_kabupaten;
		
		$temp = $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
		if ($idKab>0){
		$kota = array();
		$kota[''] = "Kabupaten / Kota";
		$kota[$idKab] = $temp[$idKab];
		
		$data['load_cities']=$kota;
		}
		else{
		$data['load_cities']=$temp;
		}
		
		//print_r ($data['load_cities']);
		
		$template['page_heading'] = 'Data CPP Desa';
		$template['content'] = $this->load->view('data_cppdesa/form', $data, true);
        $template['js'] = $this->load->view('data_cppdesa/js', $data, true);
		$template['css'] = $this->load->view('data_cppdesa/css', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$idKab = $this->user->id_kabupaten;
		$tgl = $this->input->post('tanggal');
		$bln = substr($tgl, 3,-5);
		$thn = substr($tgl, -4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kabupaten' => ($idKab),
				'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
				'id_desa' => $this->input->post('id_desa',TRUE),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'stok_awal' => $this->input->post('stok_awal',TRUE),
				'penambahan' => $this->input->post('penambahan',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'penyusutan' => $this->input->post('penyusutan',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				//'attach_file' => $this->input->post('attach_file',TRUE),
				'created' => date('Y-m-d h:i:s'),
			);
			
			if (!empty($_FILES['attach_file']) && !empty($_FILES['attach_file']['name'])) {

				$upload_file = FCPATH.'uploads/file/';
				$file_name = date("Ymd") . '-' . trim($_FILES['attach_file']['name']);

				if (!is_dir($upload_file) && !is_writeable($upload_file)) mkdir($upload_file, 0777, true);

				$config['upload_path'] = $upload_file;
				$config['allowed_types'] = 'pdf';
				$config['file_type'] = 'pdf';
				$config['file_name'] = $file_name;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('attach_file')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('cms/data_cppdesa'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}

			print_r ($data);
			//die();
			$this->Data_cppdesa_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/data_cppdesa'));
		}
	}

	public function update($id)
	{
		$row = $this->Data_cppdesa_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/data_cppdesa/update_action'),
				'id_cppdesa' => set_value('id_cppdesa', $row->id_cppdesa),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				//'bulan' => set_value('bulan', $row->bulan),
				//'tahun' => set_value('tahun', $row->tahun),
				'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
				'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
				'id_desa' => set_value('id_desa', $row->id_desa),
				'tanggal' => set_value('tanggal', $row->tanggal),
				'stok_awal' => set_value('stok_awal', $row->stok_awal),
				'penambahan' => set_value('penambahan', $row->penambahan),
				'penyaluran' => set_value('penyaluran', $row->penyaluran),
				'lokasi' => set_value('lokasi', $row->lokasi),
				'status' => set_value('status', $row->status),
				'penyusutan' => set_value('penyusutan', $row->penyusutan),
				'attach_file' => set_value('attach_file', $row->attach_file),
				'keterangan' => set_value('keterangan', $row->keterangan),
				//'created' => set_value('created', $row->created),
			);

			$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
			$data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
			$data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);
			$template['page_heading'] = 'Data CPP Desa';
			$template['content'] = $this->load->view('data_cppdesa/form', $data, true);
            $template['js'] = $this->load->view('data_cppdesa/js', $data, true);
			$template['css'] = $this->load->view('data_cppdesa/css', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppdesa'));
		}
	}

	public function update_action()
	{
		$tgl = $this->input->post('tanggal');
		$bln = substr($tgl, 3,-5);
		$thn = substr($tgl, -4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_cppdesa', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
				'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
				'id_desa' => $this->input->post('id_desa',TRUE),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'stok_awal' => $this->input->post('stok_awal',TRUE),
				'penambahan' => $this->input->post('penambahan',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'status' => $this->input->post('status',TRUE),
				'penyusutan' => $this->input->post('penyusutan',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				//'attach_file' => $this->input->post('attach_file',TRUE),
			);
			
			if (!empty($_FILES['attach_file']) && !empty($_FILES['attach_file']['name'])) {

				$upload_file = FCPATH.'uploads/file/';
				$file_name = date("Ymd") . '-' . trim($_FILES['attach_file']['name']);

				if (!is_dir($upload_file) && !is_writeable($upload_file)) mkdir($upload_file, 0777, true);

				$config['upload_path'] = $upload_file;
				$config['allowed_types'] = 'pdf';
				$config['file_type'] = 'pdf';
				$config['file_name'] = $file_name;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('attach_file')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('cms/data_cppdesa'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}
			//print_r ($data);
			//die();
			$this->Data_cppdesa_model->update($this->input->post('id_cppdesa', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/data_cppdesa'));
		}
	}

	public function delete($id)
	{
		$row = $this->Data_cppdesa_model->get_by_id($id);

		if ($row) {
			$this->Data_cppdesa_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/data_cppdesa'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppdesa'));
		}
	}
	
	/*public function resize_image($file_path, $width, $height, $new_image)
	{
		$img_cfg['image_library'] = 'gd2';
		$img_cfg['source_image'] = $file_path;
		$img_cfg['maintain_ratio'] = TRUE;
		$img_cfg['create_thumb'] = TRUE;
		$img_cfg['thumb_marker']='';
		$img_cfg['new_image'] = $new_image;
		$img_cfg['width'] = $width;
		$img_cfg['height'] = $height;

		$this->image_lib->initialize($img_cfg);
		if (!$this->image_lib->resize()){
			$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
		}
		$this->image_lib->clear();

	}*/

    public function valid($id, $status)
    {
        $data = array('status' => $status);
        $this->Data_cppdesa_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('cms/data_cppdesa');
    }

	public function _rules()
	{
		$this->form_validation->set_rules('id_penyuluh', 'id penyuluh', 'trim|required');
		//$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
		//$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		//$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
		//$this->form_validation->set_rules('penambahan', 'penambahan', 'trim|required');
		//$this->form_validation->set_rules('penyusutan', 'attach_file', 'trim|required');

		$this->form_validation->set_rules('id_cppdesa', 'id_cppdesa', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
	
	public function excel()
	{
		$this->load->library('excel');
		$today = date('Y-m-d H:i:s');

		$template = 'template_excel/data_cpp_kab_kota.xlsx';

		$objPHPExcel = PHPExcel_IOFactory::load($template);
		$objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi CPP Kab Kota');

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

		//$data = $this->data_cppdesa_model->get_all_by_cppkab($id_kabupaten);
		$id = $this->user->id_kabupaten;
		$poktan = $this->Home_model->get_by_id_cppdesa($id);
		$data = $this->Home_model->get_all_by_cppkab($id);
		print_r($data);
		//die();
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $today);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $this->user->name);

		$i	= 1;
		$n = 7;
		foreach ($data as $item) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item->bulan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item->tahun);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->stok_awal);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item->penambahan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item->penyaluran);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n, $item->penyusutan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item->stok_awal + $item->penambahan - $item->penyaluran - $item->penyusutan);
			++$n;
			++$i;
		}

		$highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
		$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$objPHPExcel->getActiveSheet()->getStyle('A7:H' . $highestRow)->applyFromArray(
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
		header('Content-Disposition: attachment;filename="Rekapitulasi_Data_CPP_kab-kota-'.$this->user->name.'-'.$today.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}
}

/* End of file data_cppdesa.php */
/* Location: ./application/controllers/data_cppdesa.php */