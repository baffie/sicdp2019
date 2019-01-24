<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Poktan extends Frontend_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Poktan_model');
        $this->load->model('Sektor_model');
        $this->load->model('Subsektor_model');
        $this->load->library('form_validation');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->is_admin())
                {
                        redirect(site_url('cms/log/in'));
                }

                $this->user = $this->ion_auth->user()->row();
        $config = array(
            'field' => 'slug',
            'title' => 'nama_poktan',
            'table' => 'poktan',
            'id' => 'id_poktan',
        );
        $this->load->library('slug', $config);
    }

    public function index()
    {
        $data['source'] = site_url('cms/poktan/grid');
        $template['page_heading'] = 'Kelompok Tani';
        $template['content'] = $this->load->view('poktan/list', $data, true);
        $template['js'] = $this->load->view('poktan/js', $data, true);
        $this->load->view('backend/layouts/dashboard', $template);
    }

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Poktan_model->grid($this->user->id);
    }

    public function rekap($id)
    {
        $this->load->model('Home_model');
        $id OR show_404();

        $poktan = $this->Home_model->get_by_id($id);
        
        $rdkk = $this->Home_model->get_all_by_poktan($poktan->id_poktan);

        $data = array(
            'rdkk_data' => $rdkk,
            'id_poktan' => $poktan->id_poktan,
            'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            'subsektor' => $poktan->subsektor,
            'komoditas' => $poktan->komoditas,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );

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
            $total_luas += $item['luas_tanam'];
            $total_urea_1 += $item['urea_1'];
            $total_urea_2 += $item['urea_2'];
            $total_urea_3 += $item['urea_3'];
            $total_sp_1 += $item['sp_1'];
            $total_sp_2 += $item['sp_2'];
            $total_sp_3 += $item['sp_3'];
            $total_za_1 += $item['za_1'];
            $total_za_2 += $item['za_2'];
            $total_za_3 += $item['za_3'];
            $total_npk_1 += $item['npk_1'];
            $total_npk_2 += $item['npk_2'];
            $total_npk_3 += $item['npk_3'];
            $total_organik_1 += $item['organik_1'];
            $total_organik_2 += $item['organik_2'];
            $total_organik_3 += $item['organik_3'];
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

        $template['page_heading'] = 'RDKK Pupuk Bersubsidi';
        $template['content'] = $this->load->view('poktan/rekap', $data, true);
        $this->load->view('layouts/dashboard', $template);
    }

    public function create()
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('auth/poktan/create_action'),
            'id_poktan' => set_value('id_poktan'),
            'id_gapoktan' => set_value('id_gapoktan'),
            'id_sektor' => set_value('id_sektor'),
            'id_subsektor' => set_value('id_subsektor'),
            'komoditas' => set_value('komoditas'),
            'nama_poktan' => set_value('nama_poktan'),
            'nama_ketua' => set_value('nama_ketua'),
            'alamat' => set_value('alamat'),
            'id_kabupaten' =>set_value('id_kabupaten',$this->user->id_kabupaten),
            'id_kecamatan' => set_value('id_kecamatan',$this->user->id_kecamatan),
            'id_desa' => set_value('id_desa'),
            'id_penyuluh' => set_value('id_penyuluh',$this->user->id),
        );

        $this->load->model('Gapoktan_model');
        $this->load->model('Kelurahan_model');

        $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($this->user->id_kecamatan, $this->user->id_desa);
        $data['load_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'),$data['id_penyuluh']);
        $data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));
        $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor($data['id_sektor']);

        $template['page_heading'] = 'Kelompok Tani';
        $template['content'] = $this->load->view('poktan/form', $data, true);
        $this->load->view('layouts/dashboard', $template);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_gapoktan' => $this->input->post('id_gapoktan',TRUE),
                'id_sektor' => $this->input->post('id_sektor',TRUE),
                'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                'komoditas' => $this->input->post('komoditas',TRUE),
                'nama_poktan' => $this->input->post('nama_poktan',TRUE),
                'nama_ketua' => $this->input->post('nama_ketua',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'id_desa' => $this->input->post('id_desa',TRUE),
                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data);

            $this->Poktan_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('auth/poktan'));
        }
    }

    public function update($id)
    {
        $row = $this->Poktan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('auth/poktan/update_action'),
                'id_poktan' => set_value('id_poktan', $row->id_poktan),
                'id_gapoktan' => set_value('id_gapoktan', $row->id_gapoktan),
                'id_sektor' => set_value('id_sektor', $row->id_sektor),
                'id_subsektor' => set_value('id_subsektor', $row->id_subsektor),
                'komoditas' => set_value('komoditas', $row->komoditas),
                'nama_poktan' => set_value('nama_poktan', $row->nama_poktan),
                'nama_ketua' => set_value('nama_ketua', $row->nama_ketua),
                'alamat' => set_value('alamat', $row->alamat),
                'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
                'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
                'id_desa' => set_value('id_desa', $row->id_desa),
                'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
            );

            $this->load->model('Gapoktan_model');
            $this->load->model('Kelurahan_model');

            $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($row->id_kecamatan,$this->user->id_desa);
            $data['load_gapoktan']	= $this->Gapoktan_model->get_category_select(array('' => '-- Pilih --'),$data['id_penyuluh']);
            $data['load_sector']	= $this->Sektor_model->get_category_select(array('' => '-- Pilih --'));
            $data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor($data['id_sektor']);

            $template['page_heading'] = 'Kelompok Tani';
            $template['content'] = $this->load->view('poktan/form', $data, true);
            $this->load->view('layouts/dashboard', $template);

        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('auth/poktan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_poktan', TRUE));
        } else {
            $data = array(
                'id_gapoktan' => $this->input->post('id_gapoktan',TRUE),
                'id_sektor' => $this->input->post('id_sektor',TRUE),
                'id_subsektor' => $this->input->post('id_subsektor',TRUE),
                'komoditas' => $this->input->post('komoditas',TRUE),
                'nama_poktan' => $this->input->post('nama_poktan',TRUE),
                'nama_ketua' => $this->input->post('nama_ketua',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
                'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
                'id_desa' => $this->input->post('id_desa',TRUE),
                'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
            );

            $data['slug'] = $this->slug->create_uri($data, $this->input->post('id_poktan', TRUE));

            $this->Poktan_model->update($this->input->post('id_poktan', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('auth/poktan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Poktan_model->get_by_id($id);

        if ($row) {
            $this->Poktan_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('auth/poktan'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('auth/poktan'));
        }
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
            'nama_gapoktan' => $poktan->nama_gapoktan,
            'nama_poktan' => $poktan->nama_poktan,
            'subsektor' => $poktan->subsektor,
            'komoditas' => $poktan->komoditas,
            'nama_ketua' => $poktan->nama_ketua,
            'alamat' => $poktan->alamat,
            'kabupaten' => $poktan->nama_kab,
            'kecamatan' => $poktan->nama_kec,
            'desa' =>  $poktan->nama_kel,
            'penyuluh' => $poktan->name,
        );

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
            $total_luas += $item['luas_tanam'];
            $total_urea_1 += $item['urea_1'];
            $total_urea_2 += $item['urea_2'];
            $total_urea_3 += $item['urea_3'];
            $total_sp_1 += $item['sp_1'];
            $total_sp_2 += $item['sp_2'];
            $total_sp_3 += $item['sp_3'];
            $total_za_1 += $item['za_1'];
            $total_za_2 += $item['za_2'];
            $total_za_3 += $item['za_3'];
            $total_npk_1 += $item['npk_1'];
            $total_npk_2 += $item['npk_2'];
            $total_npk_3 += $item['npk_3'];
            $total_organik_1 += $item['organik_1'];
            $total_organik_2 += $item['organik_2'];
            $total_organik_3 += $item['organik_3'];
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

        $template['page_heading'] = 'RDKK Pupuk Bersubsidi';
        $template['content'] = $this->load->view('poktan/print', $data, true);
        $this->load->view('layouts/print', $template);
    }


    public function excel($id=null)
    {
        $id OR show_404();

        $this->load->library('excel');
        $this->load->model('Home_model');

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
        $objPHPExcel->getActiveSheet()->setTitle('RDKK Kelompok Tani');

        $poktan = $this->Home_model->get_by_id($id);
        $data = $this->Home_model->get_all_by_poktan($id);

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', ': ' . $poktan->nama_poktan);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', ': ' . $poktan->nama_gapoktan);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', ': ' . $poktan->nama_kel);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C7', ': ' . $poktan->nama_kec);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C8', ': ' . $poktan->nama_kab);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9', ': ' . $poktan->subsektor);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C10', ': ' . $poktan->komoditas);

        $i	= 1;
        $n = 16;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $n, $i);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $n, $item['nama_petani']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $n, $item['luas_tanam']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $n, $item['urea_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $n, $item['urea_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F' . $n, $item['urea_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G' . $n,'=SUM(D'.$n.':F'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H' . $n, $item['sp_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I' . $n, $item['sp_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $n, $item['sp_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K' . $n,'=SUM(H'.$n.':J'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L' . $n, $item['za_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M' . $n, $item['za_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N' . $n, $item['za_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O' . $n,'=SUM(L'.$n.':N'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P' . $n, $item['npk_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q' . $n, $item['npk_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R' . $n, $item['npk_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S' . $n,'=SUM(P'.$n.':R'.$n.')');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T' . $n, $item['organik_1']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U' . $n, $item['organik_2']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V' . $n, $item['organik_3']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W' . $n,'=SUM(T'.$n.':V'.$n.')');
            ++$n;
            ++$i;
        }

        $highestColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
        $highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

        $objPHPExcel->getActiveSheet()->getStyle('A16:' . $highestColumn . $highestRow)->applyFromArray($styleRowBorder);

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
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $lastRow,'=SUM(C16:C'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $lastRow,'=SUM(D16:D'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('E' . $lastRow,'=SUM(E16:E'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('F' . $lastRow,'=SUM(F16:F'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('G' . $lastRow,'=SUM(G16:G'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('H' . $lastRow,'=SUM(H16:H'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('I' . $lastRow,'=SUM(I16:I'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('J' . $lastRow,'=SUM(J16:J'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('K' . $lastRow,'=SUM(K16:K'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('L' . $lastRow,'=SUM(L16:L'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('M' . $lastRow,'=SUM(M16:M'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('N' . $lastRow,'=SUM(N16:N'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('O' . $lastRow,'=SUM(O16:O'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('P' . $lastRow,'=SUM(P16:P'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('Q' . $lastRow,'=SUM(Q16:Q'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('R' . $lastRow,'=SUM(R16:R'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('S' . $lastRow,'=SUM(S16:S'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('T' . $lastRow,'=SUM(T16:T'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('U' . $lastRow,'=SUM(U16:U'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('V' . $lastRow,'=SUM(V16:V'.$highestRow.')');
        $objPHPExcel->getActiveSheet()->setCellValue('W' . $lastRow,'=SUM(W16:W'.$highestRow.')');


        $objPHPExcel->getActiveSheet()->getStyle('C' . ($lastRow + 3).':F' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 3).':F' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 3),'Mengetahui,');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 4).':F' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 4),'Penyuluh Pendamping');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C' . ($lastRow + 10).':F' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('C' . ($lastRow + 10), $poktan->name);

        $objPHPExcel->getActiveSheet()->getStyle('P' . ($lastRow + 3).':S' . ($lastRow + 10))->applyFromArray($styleBottom);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 3).':S' . ($lastRow + 3));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 3), $poktan->nama_kel.', '.dateformatindo(date('d M Y'),2));
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 4).':S' . ($lastRow + 4));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 4),'Ketua Kelompok Tani');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P' . ($lastRow + 10).':S' . ($lastRow + 10));
        $objPHPExcel->getActiveSheet()->setCellValue('P' . ($lastRow + 10), $poktan->nama_ketua);

        // Set page orientation and size
        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.75);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RDKK_Kelompok_Tani-'.$poktan->nama_poktan.'-'.$today.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');

    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_poktan', 'Nama Kelompok Tani', 'trim|required');
        $this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('id_desa', 'Desa', 'trim|required');
        $this->form_validation->set_rules('id_penyuluh', 'Penyuluh', 'trim|required');
        $this->form_validation->set_rules('id_gapoktan', 'Gapoktan', 'trim|required');
        $this->form_validation->set_rules('id_sektor', 'Sektor', 'trim|required');
        $this->form_validation->set_rules('id_subsektor', 'Sub Sektor', 'trim|required');
        $this->form_validation->set_rules('komoditas', 'Komoditas', 'trim|required');

        $this->form_validation->set_rules('id_poktan', 'id_poktan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Poktan.php */
/* Location: ./application/controllers/Poktan.php */