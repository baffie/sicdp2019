<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ldpm extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        $this->load->model('Rdkk_model');
        $this->load->model('Poktan_model');
        $this->load->model('Gapoktan_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $this->load->model('Kabupaten_model');
        $this->load->model('Subsektor_model');

        $tahun	= $this->session->userdata("tahun_pengadaan");
        //$subsektor	= $this->session->userdata("id_subsektor");
        $kabupaten	= $this->session->userdata("kabupaten");
        $kecamatan	= $this->session->userdata("kecamatan");
        $desa		= $this->session->userdata("desa");

        //$poktan = $this->Home_model->get_search_desa($tahun, $subsektor, $kabupaten,$kecamatan, $desa);
        $poktan = $this->Home_model->get_all_by_gapoktan($poktan->id_gapoktan);
        $data = array(
            'data_poktan' => $poktan
        );

        $data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

        $template['title'] = 'Rencana Definitif Kebutuhan Kelompok Tingkat Desa';
        $template['content'] = $this->load->view('v_gapoktan', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts_2/base', $template);
    }

    public function view($id=null)
    {
        $id OR show_404();

        $gapoktan = $this->Home_model->get_by_id_gapoktan($id);

        $rdkk = $this->Home_model->get_all_by_gapoktan($id);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_gapoktan' => $gapoktan->id_gapoktan,
            'nama_gapoktan' => $this->Gapoktan_model->get_by_id($gapoktan->id_gapoktan)->nama_gapoktan,
            'nama_poktan' => $gapoktan->nama_poktan,
            'komoditas' => $gapoktan->komoditas,
            'nama_ketua' => $gapoktan->ketua_gapoktan,
            'alamat' => $gapoktan->alamat,
            'kabupaten' => $gapoktan->nama_kab,
            'kecamatan' => $gapoktan->nama_kec,
            'desa' =>  $gapoktan->nama_kel,
            'penyuluh' => $gapoktan->name,
        );

        $data['subsektor'] = $this->Home_model->get_all_subsektor_gapoktan($gapoktan->id_gapoktan);

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

        $template['title'] = 'Rencana Definitif Kebutuhan Kelompok';
        $template['content'] = $this->load->view('v_gapoktan_detail', $data, true);
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
        redirect(site_url('rdkk/gapoktan'));
    }

    public function excel($id=null)
    {
        $id OR show_404();

        $this->load->library('excel');

        $today = date('Y-m-d H:i:s');

        $template = 'template_excel/lampiran_2.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle('RDKK Tingkat Desa');

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

        $gapoktan = $this->Home_model->get_by_id_gapoktan($id);
        $data = $this->Home_model->get_all_by_gapoktan($id);
        $nama_gapoktan = $this->Gapoktan_model->get_by_id($gapoktan->id_gapoktan)->nama_gapoktan;

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $nama_gapoktan);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $gapoktan->nama_kel);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', ': ' . $gapoktan->nama_kec);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', ': ' . $gapoktan->nama_kab);

        $subsektor = $this->Home_model->get_all_subsektor_gapoktan($gapoktan->id_gapoktan);
        $sub = '';
        if ($subsektor)
        {
            foreach ($subsektor as $row) {
                $sub .= $row['name'] . ' / ';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', ': ' . trim($sub, ' / '));
        }

        $i	= 1;
        $n = 14;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['nama_poktan']);
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

        $objPHPExcel->getActiveSheet()->getStyle('A14:' . $highestColumn . $highestRow)->applyFromArray(
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
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $lastRow,'=SUM(C14:C'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $lastRow,'=SUM(D14:D'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $lastRow,'=SUM(E14:E'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $lastRow,'=SUM(F14:F'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $lastRow,'=SUM(G14:G'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $lastRow,'=SUM(H14:H'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $lastRow,'=SUM(I14:I'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $lastRow,'=SUM(J14:J'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $lastRow,'=SUM(K14:K'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $lastRow,'=SUM(L14:L'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $lastRow,'=SUM(M14:M'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $lastRow,'=SUM(N14:N'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $lastRow,'=SUM(O14:O'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $lastRow,'=SUM(P14:P'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $lastRow,'=SUM(Q14:Q'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $lastRow,'=SUM(R14:R'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $lastRow,'=SUM(S14:S'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $lastRow,'=SUM(T14:T'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('U' . $lastRow,'=SUM(U14:U'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('V' . $lastRow,'=SUM(V14:V'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('W' . $lastRow,'=SUM(W14:W'.$highestRow.')');

        $objPHPExcel->getActiveSheet()->getStyle('B' . ($lastRow + 3).':B' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 3),'Mengetahui,');
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 4),'Kepala Desa/Lurah '.$gapoktan->nama_kel);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . ($lastRow + 10), '------------------------------');

        $objPHPExcel->getActiveSheet()->getStyle('H' . ($lastRow + 3).':K' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 3).':K' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 3),'Menyetujui,');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 4).':K' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 4),'Penyuluh Pendamping');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H' . ($lastRow + 10).':K' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('H' . ($lastRow + 10), $gapoktan->name);

        $objPHPExcel->getActiveSheet()->getStyle('P' . ($lastRow + 3).':S' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 3).':S' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 3), $gapoktan->nama_kel.', '.dateformatindo(date('d M Y'),2));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 4).':S' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 4),'Ketua Gapoktan');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 10).':S' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 10), $gapoktan->ketua_gapoktan);

        // Set page orientation and size
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Rekapitulasi_RDKK_Tingkat_Desa-'.$nama_gapoktan.'-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

}