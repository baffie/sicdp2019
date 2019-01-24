<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Page_model extends CI_Model
{
    public $table = 'page';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_slug($slug)
    {
        $this->load->database();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('slug', $slug);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $array = $query->row_array();
        $query->free_result();
        return $array;
    }

}