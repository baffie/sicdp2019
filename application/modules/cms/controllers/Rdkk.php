<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rdkk extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Rdkk_model');
		$this->load->model('Poktan_model');
		$this->load->model('Gapoktan_model');
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
        $this->load->model('Kabupaten_model');
        $this->load->model('Subsektor_model');

        $data['source'] = site_url('cms/rdkk/grid');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

		$template['page_heading'] = 'Rencana Definitif Kebutuhan Kelompok';
		$template['content'] = $this->load->view('rdkk/list', $data, true);
        $template['js'] = $this->load->view('rdkk/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Rdkk_model->grid();
    }

    function grid_filter()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        echo $this->Rdkk_model->grid_filter();
    }

	public function read($id)
	{
		$row = $this->Rdkk_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'id_penyuluh' => $row->id_penyuluh,
				'id_poktan' => $row->id_poktan,
				'nama_petani' => $row->nama_petani,
				'luas_tanam' => $row->luas_tanam,
				'urea_1' => $row->urea_1,
				'sp_1' => $row->sp_1,
				'za_1' => $row->za_1,
				'npk_1' => $row->npk_1,
				'organik_1' => $row->organik_1,
				'urea_2' => $row->urea_2,
				'sp_2' => $row->sp_2,
				'za_2' => $row->za_2,
				'npk_2' => $row->npk_2,
				'organik_2' => $row->organik_2,
				'urea_3' => $row->urea_3,
				'sp_3' => $row->sp_3,
				'za_3' => $row->za_3,
				'npk_3' => $row->npk_3,
				'organik_3' => $row->organik_3,
				'tahun' => $row->tahun,
			);

			$template['page_heading'] = 'Rencana Definitif Kebutuhan Kelompok';
			$template['content'] = $this->load->view('rdkk/read', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);

		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/rdkk'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/rdkk/create_action'),
			'id' => set_value('id'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_poktan' => set_value('id_poktan'),
			'nama_petani' => set_value('nama_petani'),
			'luas_tanam' => set_value('luas_tanam'),
			'urea_1' => set_value('urea_1'),
			'sp_1' => set_value('sp_1'),
			'za_1' => set_value('za_1'),
			'npk_1' => set_value('npk_1'),
			'organik_1' => set_value('organik_1'),
			'urea_2' => set_value('urea_2'),
			'sp_2' => set_value('sp_2'),
			'za_2' => set_value('za_2'),
			'npk_2' => set_value('npk_2'),
			'organik_2' => set_value('organik_2'),
			'urea_3' => set_value('urea_3'),
			'sp_3' => set_value('sp_3'),
			'za_3' => set_value('za_3'),
			'npk_3' => set_value('npk_3'),
			'organik_3' => set_value('organik_3'),
			'tahun' => set_value('tahun'),
		);

		$data['options_poktan']	= $this->Poktan_model->get_category_select(array('' => '-- Pilih --'));
		$data['options_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'));

		$template['page_heading'] = 'Rencana Definitif Kebutuhan Kelompok';
		$template['content'] = $this->load->view('rdkk/form', $data, true);
        $template['js'] = $this->load->view('rdkk/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_poktan' => $this->input->post('id_poktan',TRUE),
				'nama_petani' => $this->input->post('nama_petani',TRUE),
				'luas_tanam' => $this->input->post('luas_tanam',TRUE),
				'urea_1' => $this->input->post('urea_1',TRUE),
				'sp_1' => $this->input->post('sp_1',TRUE),
				'za_1' => $this->input->post('za_1',TRUE),
				'npk_1' => $this->input->post('npk_1',TRUE),
				'organik_1' => $this->input->post('organik_1',TRUE),
				'urea_2' => $this->input->post('urea_2',TRUE),
				'sp_2' => $this->input->post('sp_2',TRUE),
				'za_2' => $this->input->post('za_2',TRUE),
				'npk_2' => $this->input->post('npk_2',TRUE),
				'organik_2' => $this->input->post('organik_2',TRUE),
				'urea_3' => $this->input->post('urea_3',TRUE),
				'sp_3' => $this->input->post('sp_3',TRUE),
				'za_3' => $this->input->post('za_3',TRUE),
				'npk_3' => $this->input->post('npk_3',TRUE),
				'organik_3' => $this->input->post('organik_3',TRUE),
				'tahun' => $this->input->post('tahun',TRUE),
			);

			$this->Rdkk_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/rdkk'));
		}
	}

	public function update($id)
	{
		$row = $this->Rdkk_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/rdkk/update_action'),
				'id' => set_value('id', $row->id),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'id_poktan' => set_value('id_poktan', $row->id_poktan),
				'nama_petani' => set_value('nama_petani', $row->nama_petani),
				'luas_tanam' => set_value('luas_tanam', $row->luas_tanam),
				'urea_1' => set_value('urea_1', $row->urea_1),
				'sp_1' => set_value('sp_1', $row->sp_1),
				'za_1' => set_value('za_1', $row->za_1),
				'npk_1' => set_value('npk_1', $row->npk_1),
				'organik_1' => set_value('organik_1', $row->organik_1),
				'urea_2' => set_value('urea_2', $row->urea_2),
				'sp_2' => set_value('sp_2', $row->sp_2),
				'za_2' => set_value('za_2', $row->za_2),
				'npk_2' => set_value('npk_2', $row->npk_2),
				'organik_2' => set_value('organik_2', $row->organik_2),
				'urea_3' => set_value('urea_3', $row->urea_3),
				'sp_3' => set_value('sp_3', $row->sp_3),
				'za_3' => set_value('za_3', $row->za_3),
				'npk_3' => set_value('npk_3', $row->npk_3),
				'organik_3' => set_value('organik_3', $row->organik_3),
				'tahun' => set_value('tahun', $row->tahun),
			);

			$data['options_poktan']	= $this->Poktan_model->get_category_select(array('' => '-- Pilih --'));
			$data['options_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'));

			$template['page_heading'] = 'RDKK';
			$template['content'] = $this->load->view('rdkk/form', $data, true);
            $template['js'] = $this->load->view('rdkk/js', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/rdkk'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_poktan' => $this->input->post('id_poktan',TRUE),
				'nama_petani' => $this->input->post('nama_petani',TRUE),
				'luas_tanam' => $this->input->post('luas_tanam',TRUE),
				'urea_1' => $this->input->post('urea_1',TRUE),
				'sp_1' => $this->input->post('sp_1',TRUE),
				'za_1' => $this->input->post('za_1',TRUE),
				'npk_1' => $this->input->post('npk_1',TRUE),
				'organik_1' => $this->input->post('organik_1',TRUE),
				'urea_2' => $this->input->post('urea_2',TRUE),
				'sp_2' => $this->input->post('sp_2',TRUE),
				'za_2' => $this->input->post('za_2',TRUE),
				'npk_2' => $this->input->post('npk_2',TRUE),
				'organik_2' => $this->input->post('organik_2',TRUE),
				'urea_3' => $this->input->post('urea_3',TRUE),
				'sp_3' => $this->input->post('sp_3',TRUE),
				'za_3' => $this->input->post('za_3',TRUE),
				'npk_3' => $this->input->post('npk_3',TRUE),
				'organik_3' => $this->input->post('organik_3',TRUE),
				'tahun' => $this->input->post('tahun',TRUE),
			);

			$this->Rdkk_model->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/rdkk'));
		}
	}

	public function delete($id)
	{
		$row = $this->Rdkk_model->get_by_id($id);

		if ($row) {
			$this->Rdkk_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/rdkk'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/rdkk'));
		}
	}

    public function valid($id, $status)
    {
        $data = array('status' => $status);
        $this->Rdkk_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('cms/rdkk');
    }

	public function _rules()
	{
		$this->form_validation->set_rules('id_penyuluh', 'id penyuluh', 'trim|required');
		$this->form_validation->set_rules('id_poktan', 'id poktan', 'trim|required');
		$this->form_validation->set_rules('nama_petani', 'nama petani', 'trim|required');
		$this->form_validation->set_rules('luas_tanam', 'luas tanam', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

    public function excel()
    {
        $this->load->library('excel');
        $today = date('Y-m-d H:i:s');

        $template = 'template_excel/rdkk.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi RDKK');

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

        $data = $this->Rdkk_model->get_all();

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', ': ' . $today);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $this->user->name);

        $i	= 1;
        $n = 7;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item->nama_petani);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $this->Poktan_model->get_by_id($item->id_poktan)->nama_poktan);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item->luas_tanam);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item->urea_1 + $item->urea_2 + $item->urea_3);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item->sp_1 + $item->sp_2 + $item->sp_3);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n, $item->za_1 + $item->za_2 + $item->za_3);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item->npk_1 + $item->npk_2 + $item->npk_3);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $n, $item->organik_1 + $item->organik_2 + $item->organik_3);
            ++$n;
            ++$i;
        }

        $highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        $objPHPExcel->getActiveSheet()->getStyle('A7:' . $highestColumn . $highestRow)->applyFromArray(
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
        header('Content-Disposition: attachment;filename="Rekapitulasi_RDKK-'.$this->user->name.'-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

}

/* End of file Rdkk.php */
/* Location: ./application/controllers/Rdkk.php */