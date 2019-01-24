<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cpm_lpm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Poktan_model');
        //$this->load->model('Sektor_model');
        //$this->load->model('Subsektor_model');
        $this->load->model('Home_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect(site_url('auth/login'));
        }
        $config = array(
            'field' => 'slug',
            'title' => 'nama_poktan',
            'table' => 'poktan',
            'id' => 'id_poktan',
        );
        $this->load->library('slug', $config);

        $this->user = $this->ion_auth->user()->row();
    }

    public function index()
    {
    //$this->output->enable_profiler(TRUE);
        $this->load->model('Kabupaten_model');

        $data['source'] = site_url('auth/cpm_lpm/grid');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
        $template['page_heading'] = 'Data CPM LPM';
        $template['content'] = $this->load->view('cpm_lpm/list', $data, true);
        $template['js'] = $this->load->view('cpm_lpm/js', $data, true);
        $this->load->view('layouts/dashboard', $template);
    }
    
     
    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Swadaya_model->grid($this->user->id);
    }
    
    public function rekap($id)
    {
        
        $this->load->model('Home_model');
        $id OR show_404();

        $poktan = $this->Home_model->get_by_id($id);
        //print_r($poktan);
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'komoditas' => $poktan->komoditas,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
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
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;

        $template['page_heading'] = 'DATA CPM LPM';
        $template['content'] = $this->load->view('cpm_lpm/rekap', $data, true);
        $this->load->view('layouts/dashboard', $template);
         
    }


    public function create()
    {        
    //$this->output->enable_profiler(TRUE);
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('auth/cpm_lpm/create_action'),
            'id_poktan' => set_value('id_poktan'),
            //'id_gapoktan' => set_value('id_gapoktan'),
            //'id_sektor' => set_value('id_sektor'),
            //'id_subsektor' => set_value('id_subsektor'),
            //'komoditas' => set_value('komoditas'),
            'nama_poktan' => set_value('nama_poktan'),
            'nama_ketua' => set_value('nama_ketua'),
            'alamat' => set_value('alamat'),
            'tahun_berdiri' => set_value('tahun_berdiri'),
            'jumlah_anggota' => set_value('jumlah_anggota'),
            'luas_lahan' => set_value('luas_lahan'),
            'lokasi' => set_value('lokasi'),
            'awal_pengadaan' => set_value('awal_pengadaan'),
            //'bulan_pengadaan' => set_value('bulan_pengadaan'),
            //'tahun_pengadaan' => set_value('tahun_pengadaan'),
            'tanggal' => set_value('tanggal'),
            'foto' => set_value('foto'),
            'keterangan' => set_value('keterangan'),
            'id_kabupaten' =>set_value('id_kab',$this->user->id_kabupaten),
            'id_kecamatan' => set_value('id_kecamatan'),
            'id_desa' => set_value('id_desa'),
            'id_penyuluh' => set_value('id_penyuluh',$this->user->id),
        );

        //$this->load->model('Gapoktan_model');
        $this->load->model('Kabupaten_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('Kelurahan_model');

        //$data['load_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'));
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
        $data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
        $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);
        //$data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor($data['id_sektor']);

        $template['page_heading'] = 'Data CPM LPM';
        $template['content'] = $this->load->view('cpm_lpm/form', $data, true);
        $template['css'] = $this->load->view('cpm_lpm/css', $data, true);
        $template['js'] = $this->load->view('cpm_lpm/js', $data, true);
        $this->load->view('layouts/dashboard', $template);
        
    }

    public function create_action()
    {
        $tgl    = $this->input->post('tanggal');
        $bln    = substr ($tgl, 3,-5);
        $thn     = substr ($tgl, -4,4);
        $idcab = $this->user->id_kabupaten;            
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                //'id_gapoktan' => $this->input->post('id_gapoktan',TRUE),
                //'id_sektor' => $this->input->post('id_sektor',TRUE),
                //'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                //'komoditas' => $this->input->post('komoditas',TRUE),
                'nama_poktan' => $this->input->post('nama_poktan',TRUE),
                'nama_ketua' => $this->input->post('nama_ketua',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'tahun_berdiri' => $this->input->post('tahun_berdiri',TRUE),
                'jumlah_anggota' => $this->input->post('jumlah_anggota',TRUE),
                'luas_lahan' => $this->input->post('luas_lahan',TRUE),
                'lokasi' => $this->input->post('lokasi',TRUE),
                'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
                'tanggal' => $this->input->post('tanggal',TRUE),
                'bulan_pengadaan' => ($bln),
                'tahun_pengadaan' => ($thn),
                'keterangan' => $this->input->post('keterangan',TRUE),
                //'foto' => $this->input->post('foto',TRUE),
                'id_kab' => ($idcab),
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'id_desa' => $this->input->post('id_desa',TRUE),
                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
            );
            
             if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {

                $upload_img = FCPATH.'uploads/';
                $file_name = date("Ymd") . '-' . trim($_FILES['foto']['name']);

                if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

                $config['upload_path'] = $upload_img;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_type'] = 'image/jpeg';
                $config['file_name'] = $file_name;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(site_url('auth/cpm_lpm'));
                } else {
                    $this->load->library('image_lib');
                    $upload_data = $this->upload->data();

                    $this->resize_image($upload_img . $upload_data['file_name'], 750, 450,$upload_img);
                    $this->resize_image($upload_img . $upload_data['file_name'], 450, 250,$upload_img.'/thumbs/');

                    $data['foto'] = $upload_data['raw_name'] . $upload_data['file_ext'];
                }
            }
            

            $data['slug'] = $this->slug->create_uri($data);

            $this->Swadaya_model->insert($data);
            $this->session->set_flashdata('sukses', 'Data berhasil disimpan');
            redirect(site_url('auth/cpm_lpm'));
            
        }
    }

    public function update($id)
    {
    
        $row = $this->Swadaya_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('auth/cpm_lpm/update_action'),
                'id_poktan' => set_value('id_poktan', $row->id_poktan),
                //'id_gapoktan' => set_value('id_gapoktan', $row->id_gapoktan),
                //'id_sektor' => set_value('id_sektor', $row->id_sektor),
                //'id_subsektor' => set_value('id_subsektor', $row->id_subsektor),
                //'komoditas' => set_value('komoditas', $row->komoditas),
                'nama_poktan' => set_value('nama_poktan', $row->nama_poktan),
                'nama_ketua' => set_value('nama_ketua', $row->nama_ketua),
                'alamat' => set_value('alamat', $row->alamat),
                'tahun_berdiri' => set_value('tahun_berdiri', $row->tahun_berdiri),
                'jumlah_anggota' => set_value('jumlah_anggota', $row->jumlah_anggota),
                'luas_lahan' => set_value('luas_lahan', $row->luas_lahan),
                'lokasi' => set_value('lokasi', $row->lokasi),
                'awal_pengadaan' => set_value('awal_pengadaan', $row->awal_pengadaan),
                'bulan_pengadaan' => set_value('bulan_pengadaan', $row->bulan_pengadaan),
                'tahun_pengadaan' => set_value('tahun_pengadaan', $row->tahun_pengadaan),
                'tanggal' => set_value('tanggal', $row->tanggal),
                'foto' => set_value('foto', $row->foto),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'id_kabupaten' => set_value('id_kab', $row->id_kab),
                'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
                'id_desa' => set_value('id_desa', $row->id_desa),
                'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
            );

            //$this->load->model('Gapoktan_model');
            $this->load->model('Kabupaten_model');
            $this->load->model('Kecamatan_model');
            $this->load->model('Kelurahan_model');

            //$data['load_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'));
            $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
            $data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
            $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);
            //$data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));
            //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor($data['id_sektor']);

            $template['page_heading'] = 'Data CPM LPM';
            $template['content'] = $this->load->view('cpm_lpm/form', $data, true);
            $template['css'] = $this->load->view('cpm_lpm/css', $data, true);
            $template['js'] = $this->load->view('cpm_lpm/js', $data, true);
            $this->load->view('layouts/dashboard', $template);

        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('auth/cpm_lpm'));
        }
    }

    public function update_action()
    {
        $tgl    = $this->input->post('tanggal');
        $bln    = substr ($tgl, 3,-5);
        $thn     = substr ($tgl, -4,4);   
        $idcab = $this->user->id_kabupaten; 
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_poktan', TRUE));
        } else {
            $data = array(
                'id_poktan' => $this->input->post('id_poktan',TRUE),
                //'id_sektor' => $this->input->post('id_sektor',TRUE),
                //'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                //'komoditas' => $this->input->post('komoditas',TRUE),
                'nama_poktan' => $this->input->post('nama_poktan',TRUE),
                'nama_ketua' => $this->input->post('nama_ketua',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'tahun_berdiri' => $this->input->post('tahun_berdiri',TRUE),
                'jumlah_anggota' => $this->input->post('jumlah_anggota',TRUE),
                'luas_lahan' => $this->input->post('luas_lahan',TRUE),
                'lokasi' => $this->input->post('lokasi',TRUE),
                'tanggal' => $this->input->post('tanggal',TRUE),
                'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
                'bulan_pengadaan' => ($bln),
                'tahun_pengadaan' => ($thn),
                'keterangan' => $this->input->post('keterangan',TRUE),
                //'foto' => $this->input->post('foto',TRUE),
                'id_kab' => ($idcab),
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'id_desa' => $this->input->post('id_desa',TRUE),
                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
            );
            
             if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {

                $upload_img = FCPATH.'uploads/';
                $file_name = date("Ymd") . '-' . trim($_FILES['foto']['name']);

                if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

                $config['upload_path'] = $upload_img;
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['file_type'] = 'image/jpeg';
                $config['file_name'] = $file_name;
                $config['overwrite'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect(site_url('auth/cpm_lpm'));
                } else {
                    $this->load->library('image_lib');
                    $upload_data = $this->upload->data();

                    $this->resize_image($upload_img . $upload_data['file_name'], 750, 450,$upload_img);
                    $this->resize_image($upload_img . $upload_data['file_name'], 450, 250,$upload_img.'/thumbs/');

                    $data['foto'] = $upload_data['raw_name'] . $upload_data['file_ext'];
                }
            }

            $data['slug'] = $this->slug->create_uri($data, $this->input->post('id_poktan', TRUE));
                //print_r($data);
                //die();
            $this->Poktan_model->update($this->input->post('id_poktan', TRUE), $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate');
            redirect(site_url('auth/cpm_lpm'));
        }
    }

    public function delete($id)
    {
        $row = $this->Poktan_model->get_by_id($id);

        if ($row) {
            $this->Poktan_model->delete($id);
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect(site_url('auth/cpm_lpm'));
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('auth/cpm_lpm'));
        }
    }
    
    public function resize_image($file_path, $width, $height, $new_image)
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

        public function cetak($id)
    {
        $this->load->model('Home_model');
        $id OR show_404();

        $poktan = $this->Home_model->get_by_id($id);
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            //'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            //'subsektor' => $poktan->subsektor,
            //'komoditas' => $poktan->komoditas,
            'tahun_pengadaan' => $poktan->tahun_pengadaan,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
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
            $total_stok = $item['awal_pengadaan'];
            $total_penambahan = $item['penambahan'];
            $total_penyaluran = $item['penyaluran'];
            $total_stok_awal = $item['stok_awal'];
            
        }

        $data['total_stok'] = $total_stok;
        $data['total_stok_awal'] = $total_stok_awal;
        $data['total_penambahan'] = $total_penambahan;
        $data['total_penyaluran'] = $total_penyaluran;

        $template['page_heading'] = 'DATA CPM LPM';
        $template['content'] = $this->load->view('cpm_lpm/print', $data, true);
        $this->load->view('layouts/print', $template);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_poktan', 'Nama Kelompok Tani', 'trim|required');
        $this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('id_desa', 'Desa', 'trim|required');
        //$this->form_validation->set_rules('id_penyuluh', 'Penyuluh', 'trim|required');
        $this->form_validation->set_rules('awal_pengadaan', 'awal_pengadaan', 'trim|required');
        //$this->form_validation->set_rules('id_subsektor', 'Sub Sektor', 'trim|required');
        //$this->form_validation->set_rules('komoditas', 'Komoditas', 'trim');

        $this->form_validation->set_rules('id_poktan', 'id_poktan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Cpm_lpm.php */
/* Location: ./application/controllers/Cpm_lpm.php */