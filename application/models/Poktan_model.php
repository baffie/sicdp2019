<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Poktan_model extends CI_Model

{



    public $table = 'poktan';

    public $id = 'id_poktan';

    public $order = 'DESC';



    function __construct()

    {

        parent::__construct();

    }



    // get all

    function get_all($id=null)

    {

        $this->db->select("p.*, u.name, g.nama_gapoktan, b.nama_kab, c.nama_kec, d.nama_kel");

        $this->db->from($this->table.' p');

        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');

        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');

        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab', 'left');

        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left');

        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');

        if($id){

            $this->db->where('p.id_penyuluh', $id);

        }

        $this->db->order_by($this->id, $this->order);

        return $this->db->get()->result();

    }



    function grid($id=null)

    {

        $this->load->database();

        $this->load->library("datatables");

        $this->datatables->select("p.id_poktan as id, p.nama_poktan, p.nama_ketua, p.alamat as alamat, p.jumlah_anggota, p.luas_lahan, c.nama_kec, d.nama_kel, p.lokasi ", false)

            ->from($this->table.' p')

            //->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left')

            ->join('kabupaten b', 'b.id_kab = p.id_kab', 'left')

            ->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')

            ->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');

        if($id){

            $this->datatables->where('p.id_penyuluh', $id);

            $this->datatables->add_column('action','<a class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Rekap" href="'.site_url().'auth/cpm_lpm/rekap/$1"><i class="fa fa-eye"></i></a> <a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'auth/cpm_lpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'auth/Cpm_lpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');

            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');

        }else{

            $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/cpm_lpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/cpm_lpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');

            $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');

        }

        return $this->datatables->generate();

    }



    function grid_filter()

    {

        $this->load->database();

        $this->load->library("datatables");

        $this->datatables->select("p.id_poktan as id, p.nama_poktan, p.nama_ketua, p.alamat as alamat, p.jumlah_anggota, p.luas_lahan, c.nama_kec, d.nama_kel,p.lokasi ", false)

            ->from($this->table.' p')

            //->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left')

            //->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left')

            ->join('kabupaten b', 'b.id_kab = p.id_kab', 'left')

            ->join('kecamatan c', 'c.id_kec = p.id_kecamatan', 'left')

            ->join('kelurahan d', 'd.id_kel = p.id_desa', 'left');



        if($this->input->get('id_kabupaten')!='')

        {

            $this->datatables->where('p.id_kab',$this->input->get('id_kabupaten'));

        }



        if($this->input->get('id_kecamatan')!='0')

        {

            $this->datatables->where('p.id_kecamatan',$this->input->get('id_kecamatan'));

        }



        if($this->input->get('id_desa')!='0')

        {

            $this->datatables->where('p.id_desa',$this->input->get('id_desa'));

        }



        if($this->input->get('tahun')!='0')

        {

            $this->datatables->where('p.tahun_berdiri',$this->input->get('tahun_berdiri'));

        }



        $this->datatables->add_column('action','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.site_url().'cms/cpm_lpm/update/$1"><i class="fa fa-edit"></i></a> <button onclick="return confirmModal(\''.base_url().'cms/cpm_lpm/delete/$1\')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button>','id');

        $this->datatables->add_column('lokasi','<a class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="lokasi" href="https://www.google.co.id/maps/place/$1" target="_blank"><i class="fa fa-map"></i></button>','lokasi');

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

    

    public function select_dropdown_poktan($id_kab)

    {

        $return = array();

        if($id_kab)

        {

            $this->db->select("*");

            $this->db->from($this->table);

            $this->db->where('id_kab', $id_kab);

            $this->db->order_by('nama_poktan','ASC');

            $rs = $this->db->get();

            $data = $rs->result_array();

            if(count($data)>0){

                $return[] = '-- Pilih --';

                foreach($data as $row){

                    $return[$row['id_poktan']] = ucfirst($row['nama_poktan']);

                }

            }

        } else {

            $return[] = '-- Pilih --';

        }

        return $return;

    }

    

    

    public function get_list_poktan($id_kab){

        $this->db->where('id_kab', $id_kab);

        return $this->db->get($this->table)->result_array();

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

        $this->db->order_by('nama_poktan','ASC');

        $rs = $this->db->get();

        $data = $rs->result_array();

        if(count($data)>0){

            foreach($data as $row){

                $tmp[$row['id_poktan']] = ucfirst($row['nama_poktan']);

            }

        }

        return $tmp;

    }



    function get_search($id_penyuluh=null)

    {

        $this->db->select('p.*,g.*, b.nama_kab, c.nama_kec, d.nama_kel');

        $this->db->from('gapoktan g');

        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');

        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');

        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');

        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');



        if($id_penyuluh)

        {

            $this->db->where('g.id_penyuluh',$id_penyuluh);

        }



        $this->db->group_by('g.id_gapoktan');

        $this->db->order_by('g.nama_gapoktan', 'asc');



        $query = $this->db->get();

        return $query->result_array();

    }



    function get_by_slug($slug)

    {

        $this->db->select("p.*, g.*, s.name");

        $this->db->from('gapoktan g');

        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');

        $this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');

        $this->db->where('p.slug', $slug);

        return $this->db->get()->row();

    }



    function get_all_by_poktan($id)

    {

        $this->db->select("r.*, p.*, g.*");

        $this->db->from('rdkk r');

        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');

        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');

        $this->db->where('r.id_poktan', $id);

        $this->db->order_by('r.nama_petani', 'asc');

        return $this->db->get()->result_array();

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



/* End of file Poktan_model.php */

/* Location: ./application/models/Poktan_model.php */