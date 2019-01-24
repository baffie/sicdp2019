<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_cpp_ldpm extends CI_Controller
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
        $tahun_pengadaan	= $this->session->userdata("tahun_pengadaan");
        //print_r ($tahun_pengadaan);
        //die();
        //$stok = $this->Home_model->get_by_stok_prov_ldpm($tahun_pengadaan);
        $rdkk = $this->Home_model->get_all_by_prov_cpp_ldpm($tahun_pengadaan);
        //print_r($stok);
        //die();        
        $data = array(
            'rdkk_data' => $rdkk,
        );

        //$data['subsektor'] = $this->Home_model->get_subsektor_by_prov();

        $data = array(
            'rdkk_data' => $rdkk,
            //'nama_poktan' => $this->poktan_model->get_by_id($poktan->id_poktan)->nama_poktan,
            'pengadaan' => $stok->pengadaan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            //'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'tahun_pengadaan' => $poktan->tahun_pengadaan,
            //'nama_ketua' => $poktan->nama_ketua,
            //'alamat' => $poktan->alamat,
            //'luas_lahan' => $poktan->luas_lahan,
            //'jumlah_anggota' => $poktan->jumlah_anggota,
            //'kabupaten' => $poktan->nama_kab,
            //'kecamatan' => $poktan->nama_kec,
            //'desa' =>  $poktan->nama_kel,
            //'penyuluh' => $poktan->name,
        );
        
                 
        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        //$total_penyusutan = 0;
        

        foreach ($rdkk as $item) {
            $total_stok += $item['stok'];
            $total_penambahan += $item['tambah'];
            $total_penyaluran += $item['salur'];
            $total_penyusutan += $item['susut'];
            $total_stok_awal += $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;
        $data['total_penyusutan'] = $total_penyusutan;


        $template['title'] = 'Rencana Definitif Kebutuhan Kelompok';
        $template['content'] = $this->load->view('v_provinsi_ldpm', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function excel()
    {
        $this->load->library('excel');
        $this->load->model('Kabupaten_model');

        $today = date('Y-m-d H:i:s');

        $template = 'template_excel/lampiran_5.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle('RDKK Provinsi');

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

        $tahun	= $this->session->userdata("tahun");
        $data = $this->Home_model->get_all_by_prov($tahun);
        $subsektor = $this->Home_model->get_subsektor_by_prov();

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': Banten');
        $sub = '';
        if ($subsektor)
        {
            foreach ($subsektor as $row) {
                $sub .= $row['name'] . ' / ';
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . trim($sub, ' / '));
        }

        $i	= 1;
        $n = 11;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['nama_kab']);
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

        $objPHPExcel->getActiveSheet()->getStyle('A11:W' . $highestRow)->applyFromArray(
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

        $objPHPExcel->getActiveSheet()->getStyle('C' . ($lastRow + 3).':F' . ($lastRow + 10))->applyFromArray($styleBottom);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 3).':F' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 3), 'Diketahui,');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 4).':F' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 4), 'Kepala Sekretariat Bakorluh/');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 5).':F' . ($lastRow + 5));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 5), 'Kelembagaan Penyuluhan');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 6).':F' . ($lastRow + 6));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 6), 'Provinsi Banten');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 10).':F' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 10), '-----------------------------');

        $objPHPExcel->getActiveSheet()->getStyle('P' . ($lastRow + 3).':S' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 3).':S' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 3), 'Provinsi Banten, '.dateformatindo(date('d M Y'),2));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 4).':S' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 4),'Kepala Dinas Tanaman Pangan/Perkebunan/');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 5).':S' . ($lastRow + 5));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 5), 'Peternakan/ Perikanan *)');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 6).':S' . ($lastRow + 6));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 6), 'Provinsi Banten,');
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
        header('Content-Disposition: attachment;filename="RDKK_Provinsi_Banten-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    public function set()
    {
        $sess['tahun_pengadaan'] = $this->input->post("tahun_pengadaan");
        $this->session->unset_userdata('tahun_pengadaan');
        $this->session->set_userdata($sess);
        redirect(site_url('cpp/provinsi_cpp_ldpm'));
    }
}