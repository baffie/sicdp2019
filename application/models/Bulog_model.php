<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulog_model extends CI_Model
{

    public $table ='bulog';
    public $id = 'id_bulog';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($id=null)
    {
        if($id){
            $this->db->where('id_penyuluh', $id);
        }

        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       function grid($id=null)
       {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("p.id_bulog as id,
        p.bulan,
        p.tahun, 
        p.stok_awal, 
        p.penambahan, 
        p.penyaluran, 
        p.lokasi,
        p.penyusutan, 
        (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir, ", false)
            ->from($this->table.' p');
            //->join('stok_bulog f', 'f.bulan = p.bulan','left')
            //->join('bulan b', 'b.bulan = p.bulan', 'left');
            //->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left')
            //->join('kabupaten b', 'b.id_kab = p.id_kabupaten', 'left')
            //->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')
            //->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');
        if($id){
            $this->datatables->where('p.id_penyuluh', $id);
            $this->datatables->add_column('action','<a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Rekap" href="'.site_url().'auth/bulog/rekap/$1"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/bulog/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'auth/bulog/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        }else{
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/bulog/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/bulog/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        }
        return $this->datatables->generate();
    }
    
     function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("p.id_bulog as id,
         p.bulan,
         p.tahun,
         p.stok_awal,
         p.penambahan,
         p.penyaluran,
         p.lokasi,
         p.penyusutan, 
         (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir, ", false)
            ->from($this->table.' p');
            //->join('stok_bulog f', 'f.bulan = p.bulan','left')
            //->join('bulan b', 'b.bulan = p.bulan', 'left');
            //->join('kabupaten b', 'b.id_kab = p.id_kabupaten', 'left')
            //->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')
            //->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');

        if($this->input->get('bulan')!='')
        {
            $this->datatables->where('p.bulan',$this->input->get('bulan'));
        }

        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('p.tahun',$this->input->get('tahun'));
        }

        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/bulog/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/bulog/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        return $this->datatables->generate();
    }


    /*function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("
        id, 
        bulan, 
        penambahan, 
        penyaluran,
        penyusutan,
        attach_file
        ")
            ->from('bulog');
            //->join('poktan p', 'p.id_poktan = r.id_poktan', 'left')
            //->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');

        if($this->input->get('bulan')!='')
        {
            $this->datatables->where('bulan',$this->input->get('bulan'));
        }
        
        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('tahun',$this->input->get('tahun'));
        }

        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/bulog/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/bulog/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        return $this->datatables->generate();
    }*/

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    function get_stok_awal()
    {
        //$this->output->enable_profiler(TRUE);
        $this->db->select("*");    
        //$this->db->select("stok_awal");
        $this->db->from($this->table);
        //$this->db->where('stok_awal', $stok_awal);
        $this->db->order_by('id_bulog','DESC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $stok_awal = $data[0]['stok_awal']+ $data[0]['penambahan'] - $data[0]['penyaluran']- $data[0]['penyusutan'];
    
        return $stok_awal;
    }

    function get_total($id=null)
    {
        if($id){
            $this->db->where('id_penyuluh', $id);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_statistic($start=null, $end=null, $id_subsektor=0, $kabupaten=0,$kecamatan=0,$desa=0){

        $this->load->database();
        $this->db->select("
        r.tahun,
        sum(r.luas_tanam) as total_luas,
        (sum(r.urea_1) + sum(r.urea_2) + sum(r.urea_3)) as total_urea,
        (sum(r.sp_1) + sum(r.sp_2) + sum(r.sp_3)) as total_sp,
        (sum(r.za_1) + sum(r.za_2) + sum(r.za_3)) as total_za,
        (sum(r.npk_1) + sum(r.npk_2) + sum(r.npk_3)) as total_npk,
        (sum(r.organik_1) + sum(r.organik_2) + sum(r.organik_3)) as total_organik,
        b.nama_kab, 
        c.nama_kec, 
        d.nama_kel
        ");
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');
        if(!empty($start) && !empty($end))
        {
            $this->db->where("r.tahun >= ",$start);
            $this->db->where("r.tahun <= ",$end);
        }
        if ($id_subsektor > 0)
        {
            $this->db->where('p.id_subsektor', $id_subsektor);
        }

        if($kabupaten > 0)
        {
            $this->db->where('g.id_kabupaten',$kabupaten);
        }

        if($kecamatan > 0)
        {
            $this->db->where('g.id_kecamatan',$kecamatan);
        }

        if($desa > 0)
        {
            $this->db->where('g.id_desa',$desa);
        }
        $this->db->group_by('r.tahun');
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_statistic_created(){
        $data_points = array();
        $this->db->select('
            created,
            DATE_FORMAT(created, "%Y%m%d") as tanggal,
            COUNT("id") as total
        ');
        $this->db->group_by('tanggal');
        $this->db->order_by('created', 'DESC');
        $this->db->limit('7');
        $query = $this->db->get($this->table);
        $data = $query->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $point = array(
                    "label" => $row['tanggal'],
                    "value" => $row['total']
                );
                array_push($data_points, $point);
            }
        }
        $query->free_result();
        return $data_points;
    }

    function get_all_created()
    {
        $this->db->select('
            r.created,
            u.name,
            DATE_FORMAT(r.created, "%Y%m%d") as tanggal,
            COUNT("r.id") as total
        ');
        $this->db->join('users u', 'u.id = r.id_penyuluh');
        $this->db->group_by('tanggal');
        $this->db->order_by('r.created', 'DESC');
        $this->db->limit('10');
        $query = $this->db->get($this->table.' r');
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Bulog_model.php */
/* Location: ./application/models/Bulog_model.php */