<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lpm extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Home_model');
        //$this->load->model('Rdkk_model');
        $this->load->model('Poktan_model');
        //$this->load->model('Gapoktan_model');
        $this->load->library('form_validation');

    }

    public function index()
    {
        $this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');

        $tahun_pengadaan	= $this->session->userdata("tahun_pengadaan");
        //$subsektor	        = $this->session->userdata("id_subsektor");
        $kabupaten	        = $this->session->userdata("kabupaten");
        //$kecamatan	        = $this->session->userdata("kecamatan");
        //$desa		        = $this->session->userdata("desa");

        $poktan = $this->Home_model->get_search($tahun_pengadaan, $kabupaten);
        //$poktan = $this->Home_model->get_all_by_poktan($tahun_pengadaan, $kabupaten);
        $data = array(
            'data_poktan' => $poktan
        );
       
        

        $data['options_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');

        $template['title'] = 'Profil CPM LPM';
        $template['content'] = $this->load->view('v_poktan', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/base', $template);
    }

    public function view($slug=null)
    {
        $slug OR show_404();
                
        $poktan = $this->Home_model->get_by_slug($slug);
        $get_stok_awal = $this->Home_model->get_stok_awal_poktan($poktan->id_poktan);
        //print_r($get_stok_awal);
        //print_r($poktan->id_poktan);
        //die();
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);
                
        if(count($rdkk) < 1){
            redirect(site_url(), 'location', 301);
        }

        $data = array(
            'rdkk_data' => $rdkk,
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

        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        

        foreach ($rdkk as $item) {
            $get_stok_awal;
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan += $item['penambahan'];
            $total_penyaluran += $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }
        
        $data['get_stok_awal'] = $get_stok_awal;
        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;
 

        $template['title'] = 'PROFIL CPM LPM';
        $template['content'] = $this->load->view('v_poktan_detail', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }
    
    public function data($slug=null)
    {
        $slug OR show_404();
                
        $poktan = $this->Home_model->get_by_slug($slug);
        
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);
                
        if(count($rdkk) < 1){
            redirect(site_url(), 'location', 301);
        }

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            'tahun_berdiri' => $poktan->tahun_berdiri,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'luas_lahan' => $poktan->luas_lahan,
            'jumlah_anggota' => $poktan->jumlah_anggota,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'lokasi' =>  $poktan->lokasi,
            'foto' =>  $poktan->foto,
            'awal_pengadaan' =>  $poktan->awal_pengadaan,
            'keterangan' =>  $poktan->keterangan,
            'penyuluh' => $poktan->name,
        );

        $total_stok  = 0;
        $total_stok_awal  = 0;
        $total_penambahan = 0;
        $total_penyaluran = 0;
        

        foreach ($rdkk as $item) {
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;
 

        $template['title'] = 'PROFIL CPM LPM';
        $template['content'] = $this->load->view('v_poktan_profil', $data, true);
        $template['js'] = $this->load->view('js', $data, true);
        $this->load->view('frontend/layouts/print', $template);
    }

    public function set()
    {
        //print_r(); 
        $sess['tahun_pengadaan'] = $this->input->post("tahun_pengadaan");
        //$sess['id_subsektor'] = $this->input->post("id_subsektor");
        $sess['kabupaten'] = $this->input->post("id_kab");
        //$sess['kecamatan'] = $this->input->post("id_kecamatan");
        //$sess['desa'] = $this->input->post("id_desa");
        $this->session->unset_userdata('tahun_pengadaan');
        //$this->session->unset_userdata('id_subsektor');
        $this->session->unset_userdata('kabupaten');
        //$this->session->unset_userdata('kecamatan');
        //$this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        redirect(site_url('profil/lpm'));
       
    }
    
    public function set_detail()
    {
        //print_r(); 
        $poktan = $this->Home_model->get_by_slug($slug);
        print_r($poktan);
        $sess['tahun_pengadaan'] = $this->input->post("tahun_pengadaan");
        $sess['id_poktan'] = $this->input->post("id_poktan");
        //$sess['kabupaten'] = $this->input->post("id_kab");
        //$sess['kecamatan'] = $this->input->post("id_kecamatan");
        //$sess['desa'] = $this->input->post("id_desa");
        $this->session->unset_userdata('tahun_pengadaan');
        //$this->session->unset_userdata('id_subsektor');
        //$this->session->unset_userdata('kabupaten');
        //$this->session->unset_userdata('kecamatan');
        //$this->session->unset_userdata('desa');
        $this->session->set_userdata($sess);
        //print_r($sess);
        //die();
        redirect(site_url('profil/lpm/view'));
       
    }
    

    public function excel($id=null)
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

        $styleRowBorder = array(
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
       
        $template = 'template_excel/lampiran_1.xlsx';

        $objPHPExcel = PHPExcel_IOFactory::load($template);
        $objPHPExcel->getActiveSheet()->setTitle('Rekapitulasi Kelompok Tani');
        
        $poktan = $this->Home_model->get_by_id($id);
        $data = $this->Home_model->get_all_by_poktan($id);
       
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $poktan->nama_poktan);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $poktan->nama_kel);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', ': ' . $poktan->nama_kec);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', ': ' . $poktan->nama_kab);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', ': ' . $poktan->tahun_pengadaan);


        $i	= 1;
        $n = 12;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['bulan']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item['awal_pengadaan']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item['stok_awal']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item['penambahan']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item['penyaluran']);
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
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $lastRow, $item['akhir']);
        


        $objPHPExcel->getActiveSheet()->getStyle('A' . ($lastRow + 3).':C' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 3).':C' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 3),'Mengetahui,');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 4).':C' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 4),'Penyuluh Pendamping');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A' . ($lastRow + 10).':C' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('A' . ($lastRow + 10), $poktan->name);

        $objPHPExcel->getActiveSheet()->getStyle('E' . ($lastRow + 3).':G' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 3).':G' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 3), $poktan->nama_kel.', '.dateformatindo(date('d M Y'),2));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 4).':G' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 4),'Ketua Kelompok Tani');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . ($lastRow + 10).':G' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('E' . ($lastRow + 10), $poktan->nama_ketua);

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

    }

}