<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ldpm_model extends CI_Model
{

    public $table = 'ldpm';
    public $id = 'id_ldpm';
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
        $this->datatables->select("p.id_ldpm as id,
        b.nama_kab,
        g.nama_gapoktan,
        p.bulan,
        p.tahun, 
        p.stok_awal, 
        p.penambahan, 
        p.penyaluran,
        p.penyusutan,
        p.lokasi,  
        (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,
        p.created, ", false)
            ->from($this->table.' p')
            //->join('stok_ldpm f', 'f.bulan = p.bulan','left')
            ->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left')
            ->join('kabupaten b', 'b.id_kab = p.id_kab', 'left');
            //->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')
            //->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');
        if($id){
            $this->datatables->where('p.id_penyuluh', $id);
            $this->datatables->add_column('action',' <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/ldpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'auth/ldpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        }else{
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/ldpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/ldpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        }
        return $this->datatables->generate();
    }
    
     function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("p.id_ldpm as id,
         k.nama_kab,
         g.nama_gapoktan, 
         p.bulan,
         p.tahun,
         p.id_kab,
         p.stok_awal,
         p.penambahan, 
         p.penyaluran,
         p.penyusutan,
         p.lokasi, 
         (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,
         p.created ", false)
            ->from($this->table.' p')
            //->join('stok_ldpm f', 'f.bulan = p.bulan','left')
            ->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left')
            ->join('bulan b', 'b.bulan = p.bulan', 'left')
            ->join('kabupaten k', 'k.id_kab = p.id_kab', 'left');
            //->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')
            //->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');

        if($this->input->get('id_kab')!='')
        {
            $this->datatables->where('p.id_kab',$this->input->get('id_kab'));
        }

        if($this->input->get('bulan')!='')
        {
            $this->datatables->where('p.bulan',$this->input->get('bulan'));
        }

        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('p.tahun',$this->input->get('tahun'));
        }

        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/ldpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/ldpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');
        return $this->datatables->generate();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
      function get_category_select($init = array(),$id=null)
    {
        $tmp = array();
        if(is_array($init) AND count($init)>0) $tmp = $init;
        $this->db->select("*");
        $this->db->from($this->table);
        if($id){
            $this->db->where('id_penyuluh',$id);
        }
        $this->db->order_by('nama_gapoktan','ASC');
        $rs = $this->db->get();
        $data = $rs->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $tmp[$row['id_gapoktan']] = ucfirst($row['nama_gapoktan']);
            }
        }
        return $tmp;
    }
    
    public function get_stok_ldpm($id_gapoktan)
    {
        $return = $id_gapoktan ;
        if($id_gapoktan)
        {
            //$this->output->enable_profiler(TRUE);
            $this->db->select("*");    
            //$this->db->select("stok_awal");
            $this->db->from($this->table);
            $this->db->where('id_gapoktan', $id_gapoktan);
            $this->db->order_by('id_ldpm','DESC');
            $this->db->limit(1);
            $rs = $this->db->get();
            $data = $rs->result_array();
            $return = $data[0]['stok_awal']+ $data[0]['penambahan'] - $data[0]['penyaluran'] - $data[0]['penyusutan'];
        } 
        return $return;
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
    
   /* function cek($id_poktan,$bulan,$tahun)
    {
        $this->db->where('id_poktan',$id_poktan);
        $this->db->where('bulan',$bulan);
        $this->db->where('tahun',$tahun);
        return $this->db->get($this->table)->num_rows();
    }
    function stok_akhir($id_poktan,$bulan,$tahun)
    {
        if($bulan=='Januari'){
            $tahun--;
        }
        $this->db->where('id_poktan',$id_poktan);
        $this->db->where('bulan',$bulan);
        $this->db->where('tahun',$tahun);
        $this->db->select('(stok_awal+penambahan-penyaluran) AS stok_akhir');
        $row = $this->db->get($this->table)->row();
        
        if($row->stok_akhir){
             return $row->stok_akhir;
        }else{
            return 0;
        }
       
    }*/

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

/* End of file ldpm_model.php */
/* Location: ./application/models/ldpm_model.php */