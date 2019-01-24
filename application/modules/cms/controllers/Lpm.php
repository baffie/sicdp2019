<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lpm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Lpm_model');
		$this->load->model('Poktan_model');
		$this->load->model('Bulan_model');
		$this->load->model('Stok_lpm_model');
		$this->load->model('Kabupaten_model');
		$this->load->model('Kecamatan_model');
		//$this->load->model('Gapoktan_model');
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
		//$this->load->model('Kecamatan_model');
		//$this->load->model('Subsektor_model');

		$data['source'] = site_url('cms/lpm/grid');
		$data['cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
		$data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
		//$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		//$data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
		//$data['load_bulan']	= $this->Bulan_model->select_dropdown_bulan('12');

		$template['page_heading'] = 'Data CPM LPM';
		$template['content'] = $this->load->view('lpm/list', $data, true);
		$template['js'] = $this->load->view('lpm/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	function grid()
	{
		if(!$this->input->is_ajax_request())
		{
			show_404();
			exit;
		}
		echo $this->Lpm_model->grid();
	}

	function grid_filter()
	{
		if(!$this->input->is_ajax_request($this->user->id))
		{
			show_404();
			exit;
		}

		echo $this->Lpm_model->grid_filter();
	}

	public function read($id)
	{
		$row = $this->Lpm_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_penyuluh' => $row->id_penyuluh,
				'id_kabu' => $row->id_kab,
				'id_poktan' => $row->id_poktan,
				'tanggal' => $row->tanggal,
				'bulan' => $row->bulan,
				'tahun' => $row->tahun,
				'stok_awal' => $row->stok_awal,
				'lokasi' => $row->lokasi,
				'penambahan' => $row->penambahan,
				'penyaluran' => $row->penyaluran,
				'keterangan' => $row->keterangan,
				'created' => $row->created,
			);

			$template['page_heading'] = 'Data CPM LPM';
			$template['content'] = $this->load->view('lpm/read', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/lpm'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/lpm/create_action'),
			'id_lpm' => set_value('id_lpm'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_poktan' => set_value('id_poktan'),
			'id_kab' => set_value('id_kab',$this->user->id_kabupaten),
			'stok_awal' => set_value('stok_awal'),
			'tanggal' => set_value('tanggal'),
			'bulan' => set_value('bulan'),
			'tahun' => set_value('tahun'),
			'lokasi' => set_value('lokasi'),
			'penambahan' => set_value('penambahan'),
			'penyaluran' => set_value('penyaluran'),
			'keterangan' => set_value('keterangan'),
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
		//$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		//$data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kab']);
		//$data['cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		$data['options_poktan']	= $this->Poktan_model->select_dropdown_Poktan($this->user->id_kabupaten);

		$template['page_heading'] = 'Data CPM LPM';
		$template['content'] = $this->load->view('lpm/form', $data, true);
		$template['js'] = $this->load->view('lpm/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$idkab = $this->user->id_kabupaten;
		$tgl = $this->input->post('tanggal');
		$bln = substr ($tgl, 3, -5);
		$thn = substr ($tgl,-4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_poktan' => $this->input->post('id_poktan',TRUE),
				'id_kab' => ($idkab),
				'stok_awal' => $this->input->post('stok_awal',TRUE),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'penambahan' => $this->input->post('penambahan',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				'created' => date('Y-m-d h:i:s'),
			);
			
			//print_r($data);
			//die();
			$this->Lpm_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/lpm'));
		}
	}

	public function update($id)
	{
		$row = $this->Lpm_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/lpm/update_action'),
				'id_lpm' => set_value('id_lpm', $row->id_lpm),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'id_poktan' => set_value('id_poktan', $row->id_poktan),
				'id_kab' => set_value('id_kab', $row->id_kab),
				'stok_awal' => set_value('stok_awal', $row->stok_awal),
				'tanggal' => set_value('tanggal', $row->tanggal),
				'bulan' => set_value('bulan', $row->bulan),
				'tahun' => set_value('tahun', $row->tahun),
				'lokasi' => set_value('lokasi', $row->lokasi),
				'status' => set_value('status', $row->status),
				'penambahan' => set_value('penambahan', $row->penambahan),
				'penyaluran' => set_value('penyaluran', $row->penyaluran),
				'keterangan' => set_value('keterangan', $row->keterangan),
				'created' => set_value('created', $row->created),
			);

			$data['cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
			$data['options_poktan']	= $this->Poktan_model->select_dropdown_poktan($data['id_kab']);

			$template['page_heading'] = 'Data CPM LPM';
			$template['content'] = $this->load->view('lpm/form', $data, true);
			$template['js'] = $this->load->view('lpm/js', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/lpm'));
		}
	}

	public function update_action()
	{
	   /*$bln=$this->input->post('bulan',TRUE);
	   $id_poktan = $this->input->post('id_poktan',TRUE);
	   $tahun = $this->input->post('tahun',TRUE);
	   if($bln=='Januari'){
			$bln_sblmnya = 'Desember';
			$cek = $this->Lpm_model->cek($id_poktan,'Februari',$tahun);
	   }elseif($bln=='Februari'){
			$bln_sblmnya = 'Januari';
			$cek = $this->Lpm_model->cek($id_poktan,'Maret',$tahun);
	   }elseif($bln=='Maret'){
			$bln_sblmnya = 'Februari';
			$cek = $this->Lpm_model->cek($id_poktan,'April',$tahun);
	   }elseif($bln=='April'){
			$bln_sblmnya = 'Maret';
			$cek = $this->Lpm_model->cek($id_poktan,'Mei',$tahun);
	   }elseif($bln=='Mei'){
			$bln_sblmnya = 'April';
			$cek = $this->Lpm_model->cek($id_poktan,'Februari',$tahun);
	   }elseif($bln=='Juni'){
			$bln_sblmnya = 'Mei';
			$cek = $this->Lpm_model->cek($id_poktan,'Juli',$tahun);
	   }elseif($bln=='Juli'){
			$bln_sblmnya = 'Juni';
			$cek = $this->Lpm_model->cek($id_poktan,'Agustus',$tahun);
	   }elseif($bln=='Agustus'){
			$bln_sblmnya = 'Juli';
			$cek = $this->Lpm_model->cek($id_poktan,'September',$tahun);
	   }elseif($bln=='September'){
			$bln_sblmnya = 'Agustus';
			$cek = $this->Lpm_model->cek($id_poktan,'Oktober',$tahun);
	   }elseif($bln=='Oktober'){
			$bln_sblmnya = 'September';
			$cek = $this->Lpm_model->cek($id_poktan,'November',$tahun);
	   }elseif($bln=='November'){
			$bln_sblmnya = 'Oktober';
			$cek = $this->Lpm_model->cek($id_poktan,'Desember',$tahun);
	   }elseif($bln=='Desember'){
			$bln_sblmnya = 'November';
			$cek = $this->Lpm_model->cek($id_poktan,'Januari',$tahun+1);
	   }else{
			$this->session->set_flashdata('error', 'Gagal merubah data, Bulan tidak boleh kosong');
	   }
	   
	   echo $cek;
	   
	   if($cek > 0)
	   {
			$this->session->set_flashdata('error', 'Gagal merubah data');
			redirect(site_url('cms/lpm'));
	   }
			
		$stok_awal =  $this->Lpm_model->stok_akhir($id_poktan,$bln_sblmnya,$tahun);*/
		$idkab = $this->user->id_kabupaten;
		$tgl = $this->input->post('tanggal');
		$bln = substr ($tgl, 3, -5);
		$thn = substr ($tgl,-4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_lpm', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_poktan' => $this->input->post('id_poktan',TRUE),
				'id_kab' => ($idkab),
				'tanggal' => $this->input->post('tanggal',TRUE),
				'bulan' => ($bln),
				'tahun' => ($thn),
				'lokasi' => $this->input->post('lokasi',TRUE),
				'status' => $this->input->post('status',TRUE),
				'stok_awal' => $this->input->post('stok_awal',TRUE),	
				'penambahan' => $this->input->post('penambahan',TRUE),
				'penyaluran' => $this->input->post('penyaluran',TRUE),
				'keterangan' => $this->input->post('keterangan',TRUE),
				'created' => date('Y-m-d h:i:s'),
				
			);
			
			
			//print_r($data);
			//die();
			$this->Lpm_model->update($this->input->post('id_lpm', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/lpm'));
		}
	}

	public function delete($id)
	{
		$row = $this->Lpm_model->get_by_id($id);

		if ($row) {
			$this->Lpm_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/lpm'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/lpm'));
		}
	}

	public function valid($id, $status)
	{
		$data = array('status' => $status);
		$this->Lpm_model->update($id, $data);
		$this->session->set_flashdata('success', 'Data berhasil diupdate');
		redirect('cms/lpm');
	}
	
	public function _rules()
	{
		$this->form_validation->set_rules('id_penyuluh', 'id penyuluh', 'trim|required');
		$this->form_validation->set_rules('id_poktan', 'id poktan', 'trim|required');
		//$this->form_validation->set_rules('nama_petani', 'nama petani', 'trim|required');
		//$this->form_validation->set_rules('luas_tanam', 'luas tanam', 'trim|required');
		//$this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
		//$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
		//$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		

		$this->form_validation->set_rules('id_lpm', 'id_lpm', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->library('excel');
		$today = date('Y-m-d H:i:s');

		$template = 'template_excel/lpm.xlsx';

		$objPHPExcel = PHPExcel_IOFactory::load($template);
		$objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi LPM');

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

		$data = $this->Lpm_model->get_all();

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $today);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $this->user->name);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $this->nama_kab);

		$i	= 1;
		$n = 7;
		foreach ($data as $item) {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $this->Poktan_model->get_by_id($item->id_poktan)->nama_poktan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item->bulan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->tahun);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item->stok_awal);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item->penambahan);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n, $item->penyaluran);
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item->stok_awal + $item->penambahan - $item->penyaluran);
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
		$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
		$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Rekapitulasi_LPM-'.$this->user->name.'-'.$today.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

}

/* End of file Lpm.php */
/* Location: ./application/controllers/Lpm.php */