<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_pandeglang_model extends CI_Model
{

    public $table = 'settings_pandeglang';
    public $id = 'id';
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('tahun_anggaran', $q);
	$this->db->or_like('site_title', $q);
	$this->db->or_like('site_url', $q);
	$this->db->or_like('tag_line', $q);
	$this->db->or_like('site_name', $q);
	$this->db->or_like('copyright', $q);
	$this->db->or_like('keywords', $q);
	$this->db->or_like('meta_description', $q);
	$this->db->or_like('googleplus', $q);
	$this->db->or_like('facebook', $q);
	$this->db->or_like('twitter', $q);
	$this->db->or_like('youtube', $q);
	$this->db->or_like('instagram', $q);
	$this->db->or_like('site_offline', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('tahun_anggaran', $q);
	$this->db->or_like('site_title', $q);
	$this->db->or_like('site_url', $q);
	$this->db->or_like('tag_line', $q);
	$this->db->or_like('site_name', $q);
	$this->db->or_like('copyright', $q);
	$this->db->or_like('keywords', $q);
	$this->db->or_like('meta_description', $q);
	$this->db->or_like('googleplus', $q);
	$this->db->or_like('facebook', $q);
	$this->db->or_like('twitter', $q);
	$this->db->or_like('youtube', $q);
	$this->db->or_like('instagram', $q);
	$this->db->or_like('site_offline', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Settings_pandeglang_model.php */
/* Location: ./application/models/Settings_pandeglang_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-08-02 07:31:27 */
/* http://harviacode.com */