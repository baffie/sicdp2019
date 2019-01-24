<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rdkk_model extends CI_Model
{

    public $table = 'rdkk';
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
        $this->datatables->select("
        r.id, 
        r.nama_petani, 
        p.nama_poktan, 
        r.luas_tanam, 
        (r.urea_1 + r.urea_2 + r.urea_3) as urea,
        ( r.sp_1 +  r.sp_2 +  r.sp_3 ) as sp,
        (r.za_1 +  r.za_2 + r.za_3) as za,
        (r.npk_1 + r.npk_2 + r.npk_3) as npk,
        (r.organik_1 + r.organik_2 + r.organik_3) as organik
        ")
            ->from('rdkk r')
            ->join('poktan p', 'p.id_poktan = r.id_poktan', 'left')
            ->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');
        if($id){
            $this->datatables->where('r.id_penyuluh', $id);
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/rdkk/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'auth/rdkk/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }else{
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/rdkk/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/rdkk/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }
        return $this->datatables->generate();
    }

    function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("
        r.id, 
        r.nama_petani, 
        p.nama_poktan, 
        r.luas_tanam, 
        (r.urea_1 + r.urea_2 + r.urea_3) as urea,
        ( r.sp_1 +  r.sp_2 +  r.sp_3 ) as sp,
        (r.za_1 +  r.za_2 + r.za_3) as za,
        (r.npk_1 + r.npk_2 + r.npk_3) as npk,
        (r.organik_1 + r.organik_2 + r.organik_3) as organik
        ")
            ->from('rdkk r')
            ->join('poktan p', 'p.id_poktan = r.id_poktan', 'left')
            ->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');

        if($this->input->get('id_kabupaten')!='')
        {
            $this->datatables->where('g.id_kabupaten',$this->input->get('id_kabupaten'));
        }

        if($this->input->get('id_kecamatan')!='0')
        {
            $this->datatables->where('g.id_kecamatan',$this->input->get('id_kecamatan'));
        }

        if($this->input->get('id_desa')!='0')
        {
            $this->datatables->where('g.id_desa',$this->input->get('id_desa'));
        }

        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('r.tahun',$this->input->get('tahun'));
        }

        if($this->input->get('id_subsektor')!='0')
        {
            $this->datatables->where('p.id_subsektor',$this->input->get('id_subsektor'));
        }

        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/rdkk/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/rdkk/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        return $this->datatables->generate();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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

/* End of file Rdkk_model.php */
/* Location: ./application/models/Rdkk_model.php */