<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bulan_model extends CI_Model
{

    public $table = 'bulan';
    public $id = 'id_bulan';
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

    function get_category_select($init = array())
    {
        $tmp = array();
        if(is_array($init) AND count($init)>0) $tmp = $init;
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->order_by('id_bulan','ASC');
        $rs = $this->db->get();
        $data = $rs->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $tmp[$row['bulan']] = ucfirst($row['bulan']);
            }
        }
        return $tmp;
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

/* End of file Bulan_model.php */
/* Location: ./application/models/Bulan_model.php */