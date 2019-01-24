<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan_model extends CI_Model
{

    public $table = 'kelurahan';
    public $id = 'id_kel';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    public function get_list_desa($id_kec){
        $this->db->where('id_kec', $id_kec);
        return $this->db->get($this->table)->result_array();
    }

    public function select_dropdown_kelurahan($id_kec, $id_kel=null)
    {
        $return = array();
        if($id_kec)
        {
            $this->db->select("id_kel,nama_kel");
            $this->db->from($this->table);
            $this->db->where('id_kec', $id_kec);
            if($id_kel)	{
                $excepts = explode(',', $id_kel);
                $this->db->where_in('id_kel',$excepts);
            }
            $this->db->order_by('nama_kel','ASC');
            $rs = $this->db->get();
            $data = $rs->result_array();
            if(count($data)>0){
                $return[] = '-- Pilih Desa --';
                foreach($data as $row){
                    $return[$row['id_kel']] = ucfirst($row['nama_kel']);
                }
            }
        } else {
            $return[] = '-- Pilih Desa --';
        }
        return $return;
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

/* End of file Kelurahan_model.php */
/* Location: ./application/models/Kelurahan_model.php */