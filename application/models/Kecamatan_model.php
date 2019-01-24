<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan_model extends CI_Model
{

    public $table = 'kecamatan';
    public $id = 'id_kec';
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

    public function get_list_kecamatan($id_kab){
        $this->db->where('id_kab', $id_kab);
        return $this->db->get($this->table)->result_array();
    }

    public function select_dropdown_kecamatan($id_kab)
    {
        $return = array();
        if($id_kab)
        {
            $this->db->select("*");
            $this->db->from($this->table);
            $this->db->where('id_kab', $id_kab);
            $this->db->order_by('nama_kec','ASC');
            $rs = $this->db->get();
            $data = $rs->result_array();
            if(count($data)>0){
                $return[] = '-- Pilih Kecamatan --';
                foreach($data as $row){
                    $return[$row['id_kec']] = ucfirst($row['nama_kec']);
                }
            }
        } else {
            $return[] = '-- Pilih Kecamatan --';
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

/* End of file Kecamatan_model.php */
/* Location: ./application/models/Kecamatan_model.php */