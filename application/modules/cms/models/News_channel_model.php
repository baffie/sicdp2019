<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_channel_model extends CI_Model
{

    public $table = 'news_channel';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function grid()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select('id, name, slug, status', false)
            ->from($this->table)
            ->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/news_channel/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/news_channel/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        return $this->datatables->generate();
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
        $this->db->order_by('id','ASC');
        $rs = $this->db->get();
        $data = $rs->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $tmp[$row['id']] = ucfirst($row['name']);
            }
        }
        return $tmp;
    }

    function get_parent_category($init = array())
    {
        $this->db->where('parent_id', 0);
        $this->db->where('status', 1);
        $res = $this->db->get($this->table)->result_array();

        if (!empty($init)) {
            if(count($res)>0){
                foreach($res as $row){
                    $init[$row['id']] = $row['name'];
                }
            }
            return $init;
        } else {
            return $res;
        }
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