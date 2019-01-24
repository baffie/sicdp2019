<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cp_lainnya_model extends CI_Model
{

    public $table ='cp_lainnya';
    public $id = 'id_cpl';
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
        $this->datatables->select("p.id_cpl as id,
        k.nama_kab,
        p.awal_pengadaan,
        p.bulan_pengadaan, 
        p.tahun_pengadaan, ", false)
            ->from($this->table.' p')
            ->join('kabupaten k', 'k.id_kab = p.id_kabupaten','left');
        if($id){
            $this->datatables->where('p.id_penyuluh', $id);
            $this->datatables->add_column('action','<a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Rekap" href="'.site_url().'auth/cp_lainnya/rekap/$1"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/cp_lainnya/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'auth/cp_lainnya/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }else{
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/cp_lainnya/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/cp_lainnya/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }
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

/* End of file cp_lainnya_model.php */
/* Location: ./application/models/cp_lainnya_model.php */