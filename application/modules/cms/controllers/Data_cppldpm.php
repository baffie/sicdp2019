<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_cppldpm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_cpp_ldpm_model');
		$this->load->model('Cpp_ldpm_model');
		$this->load->model('Bulan_model');
		$this->load->model('Kabupaten_model');
		//$this->load->model('Stok_Ldpm_model');
		//$this->load->model('Cpp_ldpm_model');
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
		$this->load->model('Kabupaten_model');
		//$this->load->model('Subsektor_model');

		$data['source'] = site_url('cms/data_cppldpm/grid');
		$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
		$data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
		//$data['load_bulan']	= $this->Bulan_model->select_dropdown_bulan('12');

		$template['page_heading'] = 'Data CPM LDPM';
		$template['content'] = $this->load->view('data_cppldpm/list', $data, true);
		$template['js'] = $this->load->view('data_cppldpm/js', $data, true);
		$template['css'] = $this->load->view('data_cppldpm/css', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	function grid()
	{
		if(!$this->input->is_ajax_request())
		{
			show_404();
			exit;
		}
		echo $this->Data_cpp_ldpm_model->grid();
	}

	function grid_filter()
	{
		if(!$this->input->is_ajax_request($this->user->id))
		{
			show_404();
			exit;
		}

		echo $this->Data_cpp_ldpm->grid_filter();
	}

	public function read($id)
	{
		$row = $this->Data_cpp_ldpm->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_penyuluh' => $row->id_penyuluh,
				'id_gapoktan' => $row->id_gapoktan,
				'id_kab' => $row->id_kab,
				'bulan' => $row->bulan,
				'tahun' => $row->tahun,
				'tanggal' => $row->tanggal,
				'stok_awal' => $row->stok_awal,
				'lokasi' => $row->lokasi,
				'penambahan' => $row->penambahan,
				'penyaluran' => $row->penyaluran,
				'keterangan' => $row->keterangan,
				'attach_file' => $row->attach_file,
				'penyusutan' => $row->penyusutan,
				'status' => $row->status,
				'created' => $row->created,
			);

			$template['page_heading'] = 'Data CPM LDPM';
			$template['content'] = $this->load->view('data_cppldpm/read', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppldpm'));
		}
	}

		public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/data_cppldpm/create_action'),
			'id' => set_value('id'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_kab' => set_value('id_kab', $this->user->id_kabupaten),
			'tanggal' => set_value('tanggal'),
			'bulan' => set_value('bulan'),
			'tahun' => set_value('tahun'),
			'id_gapoktan' => set_value('id_gapoktan'),
			'penambahan' => set_value('penambahan'),
			'stok_awal' => set_value('stok_awal'),
			'lokasi' => set_value('lokasi'),
			'penyaluran' => set_value('penyaluran'),
			'penyusutan' => set_value('penyusutan'),
			'attach_file' => set_value('attach_file'),
			'keterangan' => set_value('keterangan'),
			'status' => set_value('status'),
			'created' => set_value('created'),
			
		);
		
		/*$idKab = $this->user->id_kabupaten;
		
		$temp = $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
		if ($idKab>0){
		$kota = array();
		$kota[''] = "Kabupaten / Kota";
		$kota[$idKab] = $temp[$idKab];
		
		$data['cities']=$kota;
		}
		else{
		$data['cities']=$temp;
		}*/
		
		$data['cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		$data['load_gpk']	= $this->Cpp_ldpm_model->select_dropdown_gapoktan($data['id_kab']);


		$template['page_heading'] = 'Data CPM LDPM';
		$template['content'] = $this->load->view('data_cppldpm/form', $data, true);
		$template['js'] = $this->load->view('data_cppldpm/js', $data, true);
		$template['css'] = $this->load->view('data_cppldpm/css', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	
	}

	public function create_action()
	{
		$idkab = $this->user->id_kabupaten;
		$tgl = $this->input->post('tanggal');
		$bln = substr($tgl, 3,-5);
		$thn = substr($tgl, -4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kab' => ($idkab),
				'id_gapoktan' => $this->input->post('id_gapoktan',TRUE),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'penambahan' => $this->input->post('penambahan',TRUE),
				'stok_awal' => $this->input->post('stok_awal',TRUE),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'penyusutan' => $this->input->post('penyusutan',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				'status' => $this->input->post('status',TRUE),
				'created' => date('Y-m-d h:i:s'),
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
					redirect(site_url('cms/data_cppldpm'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}
			
			$this->Data_cpp_ldpm->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/data_cppldpm'));
		}
	}

	public function update($id)
	{
		$row = $this->Data_cpp_ldpm->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/data_cppldpm/update_action'),
				'id' => set_value('id', $row->id),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'id_gapoktan' => set_value('id_gapoktan', $row->id_gapoktan),
				'id_kab' => set_value('id_kab', $row->id_kab),
				'tanggal' => set_value('tanggal', $row->tanggal),
				'bulan' => set_value('bulan', $row->bulan),
				'tahun' => set_value('tahun', $row->tahun),
				'lokasi' => set_value('lokasi', $row->lokasi),
				'penambahan' => set_value('penambahan', $row->penambahan),
				'penyaluran' => set_value('penyaluran', $row->penyaluran),
				'penyusutan' => set_value('penyusutan', $row->penyusutan),
				'keterangan' => set_value('keterangan', $row->keterangan),
				'status' => set_value('status', $row->status),
				'stok_awal' => set_value('stok_awal', $row->stok_awal),
				'created' => set_value('created', $row->created),
				'attach_file' => set_value('attach_file', $row->attach_file),
			);

			$data['cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
			$data['load_gpk']	= $this->Cpp_ldpm_model->select_dropdown_gapoktan($data['id_kab']);

			$template['page_heading'] = 'Data CPM LDPM';
			$template['content'] = $this->load->view('data_cppldpm/form', $data, true);
			$template['js'] = $this->load->view('data_cppldpm/js', $data, true);
			$template['css'] = $this->load->view('data_cppldpm/css', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppldpm'));
		}
	}

	public function update_action()
	{
	   /*$bln=$this->input->post('bulan',TRUE);
	   $id_poktan = $this->input->post('id_poktan',TRUE);
	   $tahun = $this->input->post('tahun',TRUE);
	   if($bln=='Januari'){
			$bln_sblmnya = 'Desember';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Februari',$tahun);
	   }elseif($bln=='Februari'){
			$bln_sblmnya = 'Januari';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Maret',$tahun);
	   }elseif($bln=='Maret'){
			$bln_sblmnya = 'Februari';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'April',$tahun);
	   }elseif($bln=='April'){
			$bln_sblmnya = 'Maret';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Mei',$tahun);
	   }elseif($bln=='Mei'){
			$bln_sblmnya = 'April';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Februari',$tahun);
	   }elseif($bln=='Juni'){
			$bln_sblmnya = 'Mei';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Juli',$tahun);
	   }elseif($bln=='Juli'){
			$bln_sblmnya = 'Juni';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Agustus',$tahun);
	   }elseif($bln=='Agustus'){
			$bln_sblmnya = 'Juli';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'September',$tahun);
	   }elseif($bln=='September'){
			$bln_sblmnya = 'Agustus';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Oktober',$tahun);
	   }elseif($bln=='Oktober'){
			$bln_sblmnya = 'September';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'November',$tahun);
	   }elseif($bln=='November'){
			$bln_sblmnya = 'Oktober';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Desember',$tahun);
	   }elseif($bln=='Desember'){
			$bln_sblmnya = 'November';
			$cek = $this->Data_cpp_ldpm->cek($id_poktan,'Januari',$tahun+1);
	   }else{
			$this->session->set_flashdata('error', 'Gagal merubah data, Bulan tidak boleh kosong');
	   }
	   
	   echo $cek;
	   
	   if($cek > 0)
	   {
			$this->session->set_flashdata('error', 'Gagal merubah data');
			redirect(site_url('cms/ldpm'));
	   }
			
		$stok_awal =  $this->Data_cpp_ldpm->stok_akhir($id_poktan,$bln_sblmnya,$tahun);*/
		$idkab = $this->user->id_kabupaten;
		$tgl = $this->input->post('tanggal');
		$bln = substr($tgl, 3,-5);
		$thn = substr($tgl, -4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_gapoktan' => $this->input->post('id_gapoktan',TRUE),
				'id_kab' => ($idkab),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'penambahan' => $this->input->post('penambahan',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'penyusutan' => $this->input->post('penyusutan',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				'status' => $this->input->post('status',TRUE),
				//'attach_file' => $this->input->post('attach_file',TRUE),
				'stok_awal' => $this->input->post('stok_awal',TRUE),
				//'stok_awal' => $stok_awal,
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
					redirect(site_url('cms/data_cppldpm'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}
			
			//print_r($data);
			//die();
			$this->Data_cpp_ldpm->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/data_cppldpm'));
		}
	}

	public function delete($id)
	{
		$row = $this->Data_cpp_ldpm->get_by_id($id);

		if ($row) {
			$this->Data_cpp_ldpm->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/data_cppldpm'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cppldpm'));
		}
	}

	public function valid($id, $status)
	{
		$data = array('status' => $status);
		$this->Data_cpp_ldpm->update($id, $data);
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect('cms/data_cppldpm');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_penyuluh', 'id penyuluh', 'trim|required');
		$this->form_validation->set_rules('id_gapoktan', 'gapoktan', 'trim|required');
		//$this->form_validation->set_rules('nama_petani', 'nama petani', 'trim|required');
		//$this->form_validation->set_rules('luas_tanam', 'luas tanam', 'trim|required');
		//$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
		//$this->form_validation->set_rules('lampiran', 'lampiran', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
		

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
		{
			$this->load->library('excel');
			$today = date('Y-m-d H:i:s');

			$template = 'template_excel/ldpm.xlsx';

			$objPHPExcel = PHPExcel_IOFactory::load($template);
			$objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi CPM LDPM'. $item->nama_kab);

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

			$data = $this->Data_cpp_ldpm->get_all();

			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $today);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $this->user->name);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $n, $this->Cpp_ldpm_model->get_by_id($item->id_gapoktan)->nama_gapoktan);

			$i	= 1;
			$n = 7;
			foreach ($data as $item) {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $this->Cpp_ldpm_model->get_by_id($item->id_gapoktan)->nama_gapoktan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item->bulan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->tahun);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item->stok_awal);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item->penambahan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n, $item->penyaluran);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item->penyusutan);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $n, $item->stok_awal + $item->penambahan - $item->penyaluran - $item->penyusutan);
				++$n;
				++$i;
			}

			$highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
			$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

			$objPHPExcel->getActiveSheet()->getStyle('A7:I' . $highestRow)->applyFromArray(
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
			$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
			$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Rekapitulasi_CPM_LDPM-'.$this->user->name.'-'.$today.'.xlsx"');
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
		}

}

/* End of file ldpm.php */
/* Location: ./application/controllers/ldpm.php */