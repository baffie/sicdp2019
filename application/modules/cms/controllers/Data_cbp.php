<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_cbp extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Data_cbp_model');
		$this->load->model('Bulan_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}

		$this->user = $this->ion_auth->user()->row();
	}

	public function index()
	{
        //$this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');

        $data['source'] = site_url('cms/data_cbp/grid');
		$data['load_bulan']	= $this->Bulan_model->get_category_select(array('' => 'Bulan'));
        //$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
		$template['page_heading'] = 'Data CBP';
		$template['content'] = $this->load->view('data_cbp/list', $data, true);
        $template['js'] = $this->load->view('data_cbp/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Data_cbp_model->grid();
    }

    function grid_filter()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        echo $this->Data_cbp_model->grid_filter();
    }

	public function read($id)
	{
		$row = $this->Data_cbp_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id_cbp' => $row->id_cbp,
				'id_penyuluh' => $row->id_penyuluh,
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

			$template['page_heading'] = 'Data CBP';
			$template['content'] = $this->load->view('data_cbp/read', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cbp'));
		}
	}

	public function create()
	{
		$stok_awal = $this->Data_cbp_model->get_stok_awal();
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/data_cbp/create_action'),
			'id_cbp' => set_value('id_cbp'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'tanggal' => set_value('tanggal'),
			'bulan' => set_value('bulan'),
			'tahun' => set_value('tahun'),
			'stok_awal' => ($stok_awal),
			'penambahan' => set_value('penambahan'),
			'penyaluran' => set_value('penyaluran'),
			'lokasi' => set_value('lokasi'),
			'penyusutan' => set_value('penyusutan'),
			'attach_file' => set_value('attach_file'),
			'keterangan' => set_value('keterangan'),
		);

		$template['page_heading'] = 'Data CBP';
		$template['content'] = $this->load->view('data_cbp/form', $data, true);
        $template['js'] = $this->load->view('data_cbp/js', $data, true);
		$template['css'] = $this->load->view('data_cbp/css', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$tgl = $this-> input->post('tanggal');
		$bln = substr ($tgl,3,-5);
		$thn = substr ($tgl,-4, 4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
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
					$this->session->set_flashdata('error','file melebihi batas maks', $this->upload->display_errors());
					redirect(site_url('cms/data_cbp/update'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}

			$this->Data_cbp_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/data_cbp'));
		}
	}

	public function update($id)
	{
		$row = $this->Data_cbp_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/data_cbp/update_action'),
				'id_cbp' => set_value('id_cbp', $row->id_cbp),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'tanggal' => set_value('tanggal', $row->tanggal),
				'bulan' => set_value('bulan', $row->bulan),
				'tahun' => set_value('tahun', $row->tahun),
				'stok_awal' => set_value('stok_awal', $row->stok_awal),
				'penambahan' => set_value('penambahan', $row->penambahan),
				'penyaluran' => set_value('penyaluran', $row->penyaluran),
				'lokasi' => set_value('lokasi', $row->lokasi),
				'penyusutan' => set_value('penyusutan', $row->penyusutan),
				'attach_file' => set_value('attach_file', $row->attach_file),
				'keterangan' => set_value('keterangan', $row->keterangan),
			);

			$template['page_heading'] = 'DATA CBP';
			$template['content'] = $this->load->view('data_cbp/form', $data, true);
            $template['js'] = $this->load->view('data_cbp/js', $data, true);
			$template['css'] = $this->load->view('data_cbp/css', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cbp'));
		}
	}

	public function update_action()
	{
		$tgl = $this->input->post('tanggal');
		$bln = substr($tgl, 3,-5);
		$thn = substr($tgl, -4,4);
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_cbp', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
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
					redirect(site_url('cms/data_cbp'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					//$this->resize_image($upload_file . $upload_data['file_name'], 750, 450,$upload_file);
					//$this->resize_image($upload_file . $upload_data['file_name'], 450, 250,$upload_file.'/file/thumbs/');

					$data['attach_file'] = $upload_data['raw_name'] . $upload_data['file_ext'];
				}
			}

			$this->Data_cbp_model->update($this->input->post('id_cbp', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/data_cbp'));
		}
	}

	public function delete($id)
	{
		$row = $this->Data_cbp_model->get_by_id($id);

		if ($row) {
			$this->Data_cbp_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/data_cbp'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/data_cbp'));
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
        $this->Data_cbp_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('cms/data_cbp');
    }

	public function _rules()
	{
		//$this->form_validation->set_rules('id_penyuluh', 'id penyuluh', 'trim|required');
		//$this->form_validation->set_rules('bulan', 'bulan', 'trim|required');
		//$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
		//$this->form_validation->set_rules('penambahan', 'penambahan', 'trim|required');
		//$this->form_validation->set_rules('penyusutan', 'attach_file', 'trim|required');

		$this->form_validation->set_rules('id_cbp', 'id_cbp', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function excel()
	{
		$this->load->library('excel');
		$today = date('Y-m-d H:i:s');

		$template = 'template_excel/data_cbp.xlsx';

		$objPHPExcel = PHPExcel_IOFactory::load($template);
		$objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi CBP');

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

		$data = $this->Data_cbp_model->get_all();

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
		header('Content-Disposition: attachment;filename="Rekapitulasi_CBP-'.$this->user->name.'-'.$today.'.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}

}

/* End of file data_cbp.php */
/* Location: ./application/controllers/data_cbp.php */