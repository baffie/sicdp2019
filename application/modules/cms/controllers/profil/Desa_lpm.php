<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desa_lpm extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
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
        //$this->load->model('Kabupaten_model');
        //$this->load->model('Kecamatan_model');
        
        //$tahun_pengadaan	= $this->session->userdata("tahun_pengadaan");
        //$subsektor	        = $this->session->userdata("id_subsektor");
        $desa   	        = $this->session->userdata("desa");
        //$kecamatan	        = $this->session->userdata("kecamatan");
        //$desa		        = $this->session->userdata("desa");
        //print_r($kabupaten);
        //die();
        $poktan = $this->Home_model->get_search_kecamatan_cpm_lpm_cms_by_desa($desa);
        
        $data = array(
            'data_poktan' => $poktan
        );

        //$data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
        
        $template['page_heading'] = 'REKAP CPM LPM BY Desa/kelurahan';
        $template['content'] = $this->load->view('profile/v_desa_kelompok', $data, true);
        $template['js'] = $this->load->view('profile/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    public function view($id=null)
    {
                $this->load->model('Poktan_model');
                $id OR show_404();

                $poktan = $this->Home_model->get_by_id_desa_cpm_lpm_cms($id);
                //$poktan = $this->Home_model->get_stok_kabupaten_poktan($id);      
                $rdkk = $this->Home_model->get_all_by_desa_cpm_lpm_cms($id);
                //$rdkkd = $this->Home_model->get_all_by_kota_cpm_lpm_test($id);
                //print_r($poktan);
                //die();
                
        $data = array(
            'rdkk_data' => $rdkk,
            //'nama_poktan' => $this->poktan_model->get_by_id($poktan->id_poktan)->nama_poktan,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'luas_lahan' => $poktan->luas_lahan,
            'jumlah_anggota' => $poktan->jumlah_anggota,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );
        //print_r ($data);
       //       die();
                 
        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        

        foreach ($rdkk as $item) {
            $total_stok += $item['awal_pengadaan'];
            $total_penambahan += $item['penambahan'];
            $total_penyaluran += $item['penyaluran'];
            $total_stok_awal += $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;


        $template['title'] = 'Data CPM LPM';
        $template['content'] = $this->load->view('profile/v_lpm_desa_detail', $data, true);
        $template['js'] = $this->load->view('profile/js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function set()
    {
        //$sess['tahun_pengadaan'] = $this->input->post("tahun_pengadaan");
        //$sess['id_subsektor'] = $this->input->post("id_subsektor");
        //$sess['kabupaten'] = $this->input->post("id_kab");
        $sess['kecamatan'] = $this->input->post("id_kecamatan");
        //$sess['desa'] = $this->input->post("id_desa");
        //$this->session->unset_userdata('tahun_pengadaan');
        //$this->session->unset_userdata('id_subsektor');
        //$this->session->unset_userdata('kabupaten');
        $this->session->unset_userdata('kecamatan');
        //$this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        redirect(site_url('cpm/kecamatan'));
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