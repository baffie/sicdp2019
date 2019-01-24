<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gapoktan_model extends CI_Model
{

    public $table = 'gapoktan';
    public $id = 'id_gapoktan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all($id=null)
    {
        $this->db->select('g.*, b.nama_kab, c.nama_kec, d.nama_kel');
        $this->db->from('gapoktan g');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');

        if(!empty($id)){
            $this->db->where('g.id_penyuluh', $id);
        }
        $this->db->order_by('g.id_gapoktan', $this->order);
        return $this->db->get()->result();
    }

    function grid($id=null)
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select('g.id_gapoktan as id, g.nama_gapoktan, g.ketua_gapoktan, g.jumlah_anggota, g.luas_lahan, b.nama_kab', false)
            ->from($this->table.' g')
            ->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left')
            ->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left')
            ->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');
        if($id){
            $this->datatables->where('g.id_penyuluh', $id);
            $this->datatables->add_column('action','<a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Rekap" href="'.site_url().'auth/gapoktan/rekap/$1"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/gapoktan/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.site_url().'auth/gapoktan/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }else{
            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/gapoktan/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/gapoktan/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        }
        return $this->datatables->generate();
    }

    function grid_filter()
    {
        $this->load->database();
        $this->load->library("datatables");
        $this->datatables->select('g.id_gapoktan as id, g.nama_gapoktan, g.ketua_gapoktan, g.jumlah_anggota, g.luas_lahan, b.nama_kab', false)
            ->from($this->table.' g')
            ->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left')
            ->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left')
            ->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left')
            ->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left')
            ->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');

        if($this->input->get('id_kabupaten')!='')
        {
            $this->datatables->where('g.id_kabupaten',$this->input->get('id_kabupaten'));
        }

        if($this->input->get('id_kecamatan')!='0')
        {
            $this->datatables->where('g.id_kecamatan',$this->input->get('id_kecamatan'));
        }

        if($this->input->get('id_desa')!='0')
        {
            $this->datatables->where('g.id_desa',$this->input->get('id_desa'));
        }

        if($this->input->get('id_subsektor')!='0')
        {
            $this->datatables->where('p.id_subsektor',$this->input->get('id_subsektor'));
        }

        if($this->input->get('tahun')!='0')
        {
            $this->datatables->where('r.tahun',$this->input->get('tahun'));
        }

        $this->datatables->group_by('g.id_gapoktan');
        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/gapoktan/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/gapoktan/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');
        return $this->datatables->generate();
    }

    function get_total($id=null)
    {
        if($id){
            $this->db->where('id_penyuluh', $id);
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_category_select($init = array(),$id=null)
    {
        $tmp = array();
        if(is_array($init) AND count($init)>0) $tmp = $init;
        $this->db->select("*");
        $this->db->from($this->table);
        if($id){
            $this->db->where('id_penyuluh',$id);
        }
        $this->db->order_by('nama_gapoktan','ASC');
        $rs = $this->db->get();
        $data = $rs->result_array();
        if(count($data)>0){
            foreach($data as $row){
                $tmp[$row['id_gapoktan']] = ucfirst($row['nama_gapoktan']);
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

/* End of file Gapoktan_model.php */
/* Location: ./application/models/Gapoktan_model.php */