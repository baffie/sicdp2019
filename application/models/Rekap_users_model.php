<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_users_model extends CI_Model
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
        $this->datatables->select("p.id,
        p.name as penyuluh,
        a.created as list1,
        b.created as list2,
        c.created as list3,
        ", false)
            ->from($this->table.' p')
            ->join('data_cppdesa a', 'a.id_penyuluh = p.id','left outer')
            ->join('lpm b', 'b.id_penyuluh = p.id','left outer')
            ->join('ldpm c', 'c.id_penyuluh = p.id','left outer');
 
        return $this->datatables->generate();
    }
    

}

/* End of file rekap_users_model.php */
/* Location: ./application/models/rekap_users_model.php */