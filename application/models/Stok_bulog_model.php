<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok_bulog_model extends CI_Model
{

    public $table = 'stok_bulog';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get($this->table)->result();
    }

    function grid()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select('id, bulan, tahun, stok_awal', false)
            ->from($this->table)
            ->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/stok_bulog/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/stok_bulog/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        return $this->datatables->generate();
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
        $this->db->order_by('bulan','ASC');
        $rs = $this->db->get();
        $data = $rs->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $tmp[$row['id']] = ucfirst($row['bulan']);
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

/* End of file Stok_bulog_model.php */
/* Location: ./application/models/Stok_bulog_model.php */