<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_search($tahun=0, $id_subsektor=0, $kabupaten=0,$kecamatan=0,$desa=0,$gapoktan=0)
    {
        $this->load->database();
        $this->db->select('r.tahun, p.nama_poktan, p.slug, p.id_subsektor, p.alamat, g.nama_gapoktan, u.name');
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }

        if ($id_subsektor > 0)
        {
            $this->db->where('p.id_subsektor', $id_subsektor);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kabupaten',$kabupaten);
        }

        if($kecamatan > 0)
        {
            $this->db->where('p.id_kecamatan',$kecamatan);
        }

        if($desa > 0)
        {
            $this->db->where('p.id_desa',$desa);
        }

        if($gapoktan > 0)
        {
            $this->db->where('p.id_gapoktan',$gapoktan);
        }

        $this->db->group_by('p.id_poktan');
        $this->db->order_by('p.nama_poktan', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_search_desa($tahun=0, $id_subsektor=0, $kabupaten=0,$kecamatan=0,$desa=0)
    {
        $this->load->database();
        $this->db->select('r.tahun, g.nama_gapoktan, g.id_gapoktan, p.id_subsektor, b.nama_kab, c.nama_kec, d.nama_kel');
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');

        if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }

        if ($id_subsektor > 0)
        {
            $this->db->where('p.id_subsektor', $id_subsektor);
        }

        if($kabupaten > 0)
        {
            $this->db->where('g.id_kabupaten',$kabupaten);
        }

        if($kecamatan > 0)
        {
            $this->db->where('g.id_kecamatan',$kecamatan);
        }

        if($desa > 0)
        {
            $this->db->where('g.id_desa',$desa);
        }

        $this->db->group_by('g.id_gapoktan');
        $this->db->order_by('g.nama_gapoktan', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_search_kecamatan($tahun=0, $id_subsektor=0, $kabupaten=0,$kecamatan=0,$desa=0)
    {
        $this->load->database();
        $this->db->select('g.id_kecamatan, b.nama_kab, c.nama_kec');
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');

        if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }

        if ($id_subsektor > 0)
        {
            $this->db->where('p.id_subsektor', $id_subsektor);
        }

        if($kabupaten > 0)
        {
            $this->db->where('g.id_kabupaten',$kabupaten);
        }

        if($kecamatan > 0)
        {
            $this->db->where('g.id_kecamatan',$kecamatan);
        }

        if($desa > 0)
        {
            $this->db->where('g.id_desa',$desa);
        }

        $this->db->group_by('g.id_kecamatan');
        $this->db->order_by('c.nama_kec', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_search_kota($tahun=0, $id_subsektor=0, $kabupaten=0,$kecamatan=0,$desa=0)
    {
        $this->load->database();
        $this->db->select('g.id_kabupaten, b.nama_kab');
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa', 'left');

        if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }

        if ($id_subsektor > 0)
        {
            $this->db->where('p.id_subsektor', $id_subsektor);
        }

        if($kabupaten > 0)
        {
            $this->db->where('g.id_kabupaten',$kabupaten);
        }

        if($kecamatan > 0)
        {
            $this->db->where('g.id_kecamatan',$kecamatan);
        }

        if($desa > 0)
        {
            $this->db->where('g.id_desa',$desa);
        }

        $this->db->group_by('g.id_kabupaten');
        $this->db->order_by('b.nama_kab', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    // get data poktan
    function get_by_slug($slug)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, s.name as subsektor, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = g.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa');
        $this->db->where('p.slug', $slug);
        return $this->db->get()->row();
    }

    function get_by_id($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, s.name as subsektor, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = g.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa');
        $this->db->where('p.id_poktan', $id);
        return $this->db->get()->row();
    }

    function get_all_by_poktan($id)
    {
        $this->load->database();
        $this->db->select("r.*, p.*, g.*");
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');
        $this->db->where('r.id_poktan', $id);
        $this->db->order_by('r.nama_petani', 'asc');
        return $this->db->get()->result_array();
    }

    // get data gapoktan
    function get_by_id_gapoktan($id)
    {
        $this->load->database();
        $this->db->select('p.*, g.*, u.name, b.nama_kab, c.nama_kec, d.nama_kel');
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = g.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = g.id_desa');
        $this->db->where('g.id_gapoktan', $id);
        return $this->db->get()->row();
    }

    function get_all_subsektor_gapoktan($id)
    {
        $this->load->database();
        $this->db->select('p.*, s.name');
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan');
        $this->db->join('subsektor s', 's.id = p.id_subsektor');
        $this->db->where('g.id_gapoktan', $id);
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_all_by_gapoktan($id)
    {
        $this->load->database();
        $this->db->select("
        r.*, 
        sum(luas_tanam) as total_luas,
        sum(urea_1) as total_urea_1,
        sum(urea_2) as total_urea_2,
        sum(urea_3) as total_urea_3,
        sum(sp_1) as total_sp_1,
        sum(sp_2) as total_sp_2,
        sum(sp_3) as total_sp_3,
        sum(za_1) as total_za_1,
        sum(za_2) as total_za_2,
        sum(za_3) as total_za_3,
        sum(npk_1) as total_npk_1,
        sum(npk_2) as total_npk_2,
        sum(npk_3) as total_npk_3,
        sum(organik_1) as total_organik_1,
        sum(organik_2) as total_organik_2,
        sum(organik_3) as total_organik_3,
         p.*, g.*");
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');
        $this->db->where('p.id_gapoktan', $id);
        $this->db->group_by('p.id_poktan');
        $this->db->order_by('p.nama_poktan', 'asc');
        return $this->db->get()->result_array();
    }

    // get data poktan kecamatan
    function get_by_id_kecamatan($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab, c.nama_kec");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_kecamatan', $id);
        return $this->db->get()->row();
    }

    function get_subsektor_by_kecamatan($id)
    {
        $this->load->database();
        $this->db->select('p.*, s.name');
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan');
        $this->db->join('subsektor s', 's.id = p.id_subsektor');
        $this->db->where('p.id_kecamatan', $id);
        $this->db->group_by('p.id_subsektor');
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_all_by_kecamatan($id)
    {
        $this->load->database();
        $this->db->select("
        r.*, 
        sum(luas_tanam) as total_luas,
        sum(urea_1) as total_urea_1,
        sum(urea_2) as total_urea_2,
        sum(urea_3) as total_urea_3,
        sum(sp_1) as total_sp_1,
        sum(sp_2) as total_sp_2,
        sum(sp_3) as total_sp_3,
        sum(za_1) as total_za_1,
        sum(za_2) as total_za_2,
        sum(za_3) as total_za_3,
        sum(npk_1) as total_npk_1,
        sum(npk_2) as total_npk_2,
        sum(npk_3) as total_npk_3,
        sum(organik_1) as total_organik_1,
        sum(organik_2) as total_organik_2,
        sum(organik_3) as total_organik_3,
         p.*, g.*");
        $this->db->from('rdkk r');
        $this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan', 'left');
        $this->db->where('g.id_kecamatan', $id);
        $this->db->group_by('g.id_gapoktan');
        $this->db->order_by('g.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }

    // get data poktan kabupaten/kota
    function get_by_id_kota($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->where('g.id_kabupaten', $id);
        return $this->db->get()->row();
    }

    function get_subsektor_by_kota($id)
    {
        $this->load->database();
        $this->db->select('p.*, s.name');
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan');
        $this->db->join('subsektor s', 's.id = p.id_subsektor');
        $this->db->where('p.id_kabupaten', $id);
        $this->db->group_by('p.id_subsektor');
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_all_by_kota($id)
    {
        $this->load->database();
        $this->db->select("
        c.nama_kec,
        sum(r.luas_tanam) as total_luas,
        sum(r.urea_1) as total_urea_1,
        sum(r.urea_2) as total_urea_2,
        sum(r.urea_3) as total_urea_3,
        sum(r.sp_1) as total_sp_1,
        sum(r.sp_2) as total_sp_2,
        sum(r.sp_3) as total_sp_3,
        sum(r.za_1) as total_za_1,
        sum(r.za_2) as total_za_2,
        sum(r.za_3) as total_za_3,
        sum(r.npk_1) as total_npk_1,
        sum(r.npk_2) as total_npk_2,
        sum(r.npk_3) as total_npk_3,
        sum(r.organik_1) as total_organik_1,
        sum(r.organik_2) as total_organik_2,
        sum(r.organik_3) as total_organik_3
        ");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        $this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->where('g.id_kabupaten', $id);
        $this->db->group_by('g.id_kecamatan');
        $this->db->order_by('c.nama_kec', 'asc');
        return $this->db->get()->result_array();
    }

    function get_subsektor_by_prov()
    {
        $this->load->database();
        $this->db->select('p.*, s.name');
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan');
        $this->db->join('subsektor s', 's.id = p.id_subsektor');
        //$this->db->where('p.id_kabupaten', $id);
        $this->db->group_by('p.id_subsektor');
        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

    function get_all_by_prov($tahun=0)
    {
        $this->load->database();
        $this->db->select("
        c.nama_kab,
        sum(r.luas_tanam) as total_luas,
        sum(r.urea_1) as total_urea_1,
        sum(r.urea_2) as total_urea_2,
        sum(r.urea_3) as total_urea_3,
        sum(r.sp_1) as total_sp_1,
        sum(r.sp_2) as total_sp_2,
        sum(r.sp_3) as total_sp_3,
        sum(r.za_1) as total_za_1,
        sum(r.za_2) as total_za_2,
        sum(r.za_3) as total_za_3,
        sum(r.npk_1) as total_npk_1,
        sum(r.npk_2) as total_npk_2,
        sum(r.npk_3) as total_npk_3,
        sum(r.organik_1) as total_organik_1,
        sum(r.organik_2) as total_organik_2,
        sum(r.organik_3) as total_organik_3
        ");
        $this->db->from('gapoktan g');
        $this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        $this->db->join('kabupaten c', 'c.id_kab = g.id_kabupaten', 'left');
        if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }
        $this->db->group_by('g.id_kabupaten');
        $this->db->order_by('c.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
}