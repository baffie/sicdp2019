<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Gapoktan_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $this->load->model('Kabupaten_model');
        $this->load->model('Subsektor_model');

        $tahun	= $this->session->userdata("tahun");
        $subsektor	= $this->session->userdata("id_subsektor");
        $kabupaten	= $this->session->userdata("kabupaten");
        $kecamatan	= $this->session->userdata("kecamatan");
        $desa		= $this->session->userdata("desa");

        $poktan = $this->Home_model->get_search_kecamatan($tahun, $subsektor, $kabupaten,$kecamatan, $desa);

        $data = array(
            'data_poktan' => $poktan
        );

        $data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

        $template['title'] = 'Rencana Definitif Kebutuhan Kelompok Tingkat Kecamatan';
        $template['content'] = $this->load->view('v_kecamatan', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }

    public function view($id=null)
    {
        $id OR show_404();

        $gapoktan = $this->Home_model->get_by_id_kecamatan($id);

        $rdkk = $this->Home_model->get_all_by_kecamatan($id);

        $data = array(
            'rdkk_data' => $rdkk,
            'nama_gapoktan' => $this->Gapoktan_model->get_by_id($gapoktan->id_gapoktan)->nama_gapoktan,
            'id_kecamatan' => $id,
            'komoditas' => $gapoktan->komoditas,
            'kabupaten' => $gapoktan->nama_kab,
            'kecamatan' => $gapoktan->nama_kec,
        );

        $data['subsektor'] = $this->Home_model->get_subsektor_by_kecamatan($id);

        $total_luas  = 0;
        $total_urea_1 = 0;
        $total_urea_2 = 0;
        $total_urea_3 = 0;
        $total_sp_1 = 0;
        $total_sp_2 = 0;
        $total_sp_3 = 0;
        $total_za_1 = 0;
        $total_za_2 = 0;
        $total_za_3 = 0;
        $total_npk_1 = 0;
        $total_npk_2 = 0;
        $total_npk_3 = 0;
        $total_organik_1 = 0;
        $total_organik_2 = 0;
        $total_organik_3 = 0;

        foreach ($rdkk as $item) {
            $total_luas += $item['total_luas'];
            $total_urea_1 += $item['total_urea_1'];
            $total_urea_2 += $item['total_urea_2'];
            $total_urea_3 += $item['total_urea_3'];
            $total_sp_1 += $item['total_sp_1'];
            $total_sp_2 += $item['total_sp_2'];
            $total_sp_3 += $item['total_sp_3'];
            $total_za_1 += $item['total_za_1'];
            $total_za_2 += $item['total_za_2'];
            $total_za_3 += $item['total_za_3'];
            $total_npk_1 += $item['total_npk_1'];
            $total_npk_2 += $item['total_npk_2'];
            $total_npk_3 += $item['total_npk_3'];
            $total_organik_1 += $item['total_organik_1'];
            $total_organik_2 += $item['total_organik_2'];
            $total_organik_3 += $item['total_organik_3'];
        }

        $data['total_luas'] = $total_luas;
        $data['total_urea_1'] = $total_urea_1;
        $data['total_urea_2'] = $total_urea_2;
        $data['total_urea_3'] = $total_urea_3;
        $data['total_sp_1'] = $total_sp_1;
        $data['total_sp_2'] = $total_sp_2;
        $data['total_sp_3'] = $total_sp_3;
        $data['total_za_1'] = $total_za_1;
        $data['total_za_2'] = $total_za_2;
        $data['total_za_3'] = $total_za_3;
        $data['total_npk_1'] = $total_npk_1;
        $data['total_npk_2'] = $total_npk_2;
        $data['total_npk_3'] = $total_npk_3;
        $data['total_organik_1'] = $total_organik_1;
        $data['total_organik_2'] = $total_organik_2;
        $data['total_organik_3'] = $total_organik_3;

        $template['title'] = 'Rencana Definitif Kebutuhan Kelompok Tingkat Kecamatan';
        $template['content'] = $this->load->view('v_kecamatan_detail', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function set()
    {
        $sess['tahun'] = $this->input->post("tahun");
        $sess['id_subsektor'] = $this->input->post("id_subsektor");
        $sess['kabupaten'] = $this->input->post("id_kabupaten");
        $sess['kecamatan'] = $this->input->post("id_kecamatan");
        $sess['desa'] = $this->input->post("id_desa");
        $this->session->unset_userdata('tahun');
        $this->session->unset_userdata('id_subsektor');
        $this->session->unset_userdata('kabupaten');
        $this->session->unset_userdata('kecamatan');
        $this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        redirect(site_url('rdkk/kecamatan'));
    }

    public function excel($id=null)
    {
        $id OR show_404();

        $this->load->library('excel');

        $today = date('Y-m-d H:i:s');

        $template = 'template_excel/lampiran_3.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle('RDKK Kecamatan');

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

        $gapoktan = $this->Home_model->get_by_id_kecamatan($id);
        $data = $this->Home_model->get_all_by_kecamatan($id);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $gapoktan->nama_kec);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $gapoktan->nama_kab);

        $subsektor = $this->Home_model->get_subsektor_by_kecamatan($id);
        $sub = '';
        if ($subsektor)
        {
            foreach ($subsektor as $row) {
                $sub .= $row['name'] . ' / ';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', ': ' . trim($sub, ' / '));
        }

        $i	= 1;
        $n = 12;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['nama_gapoktan']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item['total_luas']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item['total_urea_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item['total_urea_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item['total_urea_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n,'=SUM(D'.$n.':F'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item['total_sp_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $n, $item['total_sp_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $n, $item['total_sp_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $n,'=SUM(H'.$n.':J'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . $n, $item['total_za_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $n, $item['total_za_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . $n, $item['total_za_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . $n,'=SUM(L'.$n.':N'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P' . $n, $item['total_npk_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q' . $n, $item['total_npk_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R' . $n, $item['total_npk_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S' . $n,'=SUM(P'.$n.':R'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T' . $n, $item['total_organik_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U' . $n, $item['total_organik_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V' . $n, $item['total_organik_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W' . $n,'=SUM(T'.$n.':V'.$n.')');
            ++$n;
            ++$i;
        }

        $highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        $objPHPExcel->getActiveSheet()->getStyle('A12:' . $highestColumn . $highestRow)->applyFromArray(
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

        $lastRow = $highestRow + 1;

        $objPHPExcel->getActiveSheet()->getStyle('A'.$lastRow.':' . $highestColumn . $lastRow)->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $lastRow, 'Total');
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $lastRow,'=SUM(C12:C'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $lastRow,'=SUM(D12:D'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $lastRow,'=SUM(E12:E'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $lastRow,'=SUM(F12:F'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $lastRow,'=SUM(G12:G'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $lastRow,'=SUM(H12:H'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $lastRow,'=SUM(I12:I'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $lastRow,'=SUM(J12:J'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $lastRow,'=SUM(K12:K'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $lastRow,'=SUM(L12:L'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $lastRow,'=SUM(M12:M'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $lastRow,'=SUM(N12:N'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $lastRow,'=SUM(O12:O'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $lastRow,'=SUM(P12:P'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $lastRow,'=SUM(Q12:Q'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $lastRow,'=SUM(R12:R'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $lastRow,'=SUM(S12:S'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $lastRow,'=SUM(T12:T'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('U' . $lastRow,'=SUM(U12:U'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('V' . $lastRow,'=SUM(V12:V'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('W' . $lastRow,'=SUM(W12:W'.$highestRow.')');

        $objPHPExcel->getActiveSheet()->getStyle('B' . ($lastRow + 3).':B' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 3),'Mengetahui,');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 4),'Camat '.$gapoktan->nama_kec);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 10), '------------------------------');

        $objPHPExcel->getActiveSheet()->getStyle('H' . ($lastRow + 3).':K' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 3).':K' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 3),'Menyetujui,');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 4).':K' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 4),'Kepala Balai Penyuluhan');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 10).':K' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 10), '------------------------------');

        $objPHPExcel->getActiveSheet()->getStyle('P' . ($lastRow + 3).':S' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 3).':S' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 3), $gapoktan->nama_kec.', '.dateformatindo(date('d M Y'),2));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 4).':S' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 4),'Kepala UPTD');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 10).':S' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 10), '------------------------------');

        // Set page orientation and size
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RDKK_Kecamatan-'.$gapoktan->nama_kec.'-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

}