<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_total_model extends CI_Model
{

    public $table ='users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($id=null)
    {
        if($id){
            $this->db->where('id', $id);
        }

        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    
       function grid($id=null)
       {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("p.id as id,
        p.name,
        IFNULL(DATE_FORMAT(r.created,'%d-%m-%Y'),0) as tanggal,
        IFNULL(DATE_FORMAT(s.created,'%d-%m-%Y'),0) as tanggal1, 
        IFNULL(DATE_FORMAT(t.created,'%d-%m-%Y'),0) as tanggal2, ", false)
            ->from($this->table.' p')
            ->join('data_cppdesa t', 't.id_penyuluh = p.id','left outer')
            ->join('lpm r', 'r.id_penyuluh = p.id','left outer')
            ->join('ldpm s', 's.id_penyuluh = p.id','left outer');
        $this->datatables->where('p.id !=', '26');
        $this->db->group_by('p.id');    

        return $this->datatables->generate();
    }
    
    function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select("p.id as id,
        p.name,r.bulan, t.bulan, s.bulan, r.tahun, t.tahun, s.tahun,
        IFNULL(DATE_FORMAT(t.created,'%d-%m-%Y'),0) as tanggal,
        IFNULL(DATE_FORMAT(r.created,'%d-%m-%Y'),0) as tanggal1, 
        IFNULL(DATE_FORMAT(s.created,'%d-%m-%Y'),0) as tanggal2, ", false)
            ->from($this->table.' p')
            ->join('data_cppdesa t', 't.id_penyuluh = p.id','left outer')
            ->join('lpm r', 'r.id_penyuluh = p.id','left outer')
            ->join('ldpm s', 's.id_penyuluh = p.id','left outer');
        //$this->datatables->where('p.id !=', '26');
        if($this->input->get('bulan')!='')
        {
            $this->datatables->where('r.bulan',$this->input->get('bulan'))->where('t.bulan',$this->input->get('bulan'))->where('s.bulan',$this->input->get('bulan'));
        }

        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('r.tahun',$this->input->get('tahun'))->where('t.tahun',$this->input->get('tahun'))->where('s.tahun',$this->input->get('tahun'));
        }
        $this->db->group_by('p.id');
        return $this->datatables->generate();
    }

    

}

/* End of file rekap_user_model.php */
/* Location: ./application/models/rekap_user_model.php */