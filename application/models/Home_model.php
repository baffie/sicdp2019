<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_search($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('p.tahun_pengadaan, p.nama_poktan, p.slug, p.luas_lahan, p.jumlah_anggota, p.alamat, p.id_kab, u.name');
        $this->db->from('poktan p');
        //$this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        //$this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('p.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_poktan');
        $this->db->order_by('p.nama_poktan', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }

        function get_search_kota_cpm_lpm ($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('g.tahun_pengadaan, p.id_kab, b.nama_kab, u.name');
        $this->db->from('lpm p');
        $this->db->join('kabupaten b', 'p.id_kab = b.id_kab');
        $this->db->join('poktan g', 'g.id_poktan = p.id_poktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('g.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_kab');
        $this->db->order_by('b.nama_kab', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }
    
        function get_search_kota_cpm_ldpm ($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('g.tahun_pengadaan, p.id_kab, b.nama_kab, u.name');
        $this->db->from('ldpm p');
        $this->db->join('kabupaten b', 'p.id_kab = b.id_kab');
        $this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('g.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_kab');
        $this->db->order_by('b.nama_kab', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }
    
        function get_search_kota_cpp_ldpm ($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('g.tahun_pengadaan, p.id_kab, b.nama_kab, u.name');
        $this->db->from('data_cpp_ldpm p');
        $this->db->join('kabupaten b', 'p.id_kab = b.id_kab');
        $this->db->join('cpp_ldpm g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('g.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_kab');
        $this->db->order_by('b.nama_kab', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }
    
        function get_search_kota_cpp_kab_detail ($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('g.tahun_pengadaan, p.id_kabupaten, b.nama_kab, u.name');
        $this->db->from('data_cppkab p');
        $this->db->join('kabupaten b', 'p.id_kabupaten = b.id_kab');
        $this->db->join('cpp_kab g', 'g.id_kabupaten = p.id_kabupaten');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('g.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kabupaten',$kabupaten);
        }

        $this->db->group_by('p.id_kabupaten');
        $this->db->order_by('b.nama_kab', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }
        
   function get_search_gapok($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('p.tahun_pengadaan, p.nama_gapoktan, p.slug, p.luas_lahan, p.jumlah_anggota, p.alamat, p.id_kab, u.name');
        $this->db->from('gapoktan p');
        //$this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        //$this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('p.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_gapoktan');
        $this->db->order_by('p.nama_gapoktan', 'asc');

        $query = $this->db->get();
        $array = $query->result_array();
        $query->free_result();
        return $array;
    }
    
       function get_search_cpp_ldpm($tahun_pengadaan=0, $kabupaten=0)
    {
        $this->load->database();
        $this->db->select('p.tahun_pengadaan, p.nama_gapoktan, p.slug, p.luas_lahan, p.jumlah_anggota, p.alamat, p.id_kab, u.name');
        $this->db->from('cpp_ldpm p');
        //$this->db->join('poktan p', 'p.id_poktan = r.id_poktan');
        //$this->db->join('gapoktan g', 'g.id_gapoktan = p.id_gapoktan');
        $this->db->join('users u', 'u.id = p.id_penyuluh');

        if ($tahun_pengadaan > 0)
        {
            $this->db->where('p.tahun_pengadaan', $tahun_pengadaan);
        }

        if($kabupaten > 0)
        {
            $this->db->where('p.id_kab',$kabupaten);
        }

        $this->db->group_by('p.id_gapoktan');
        $this->db->order_by('p.nama_gapoktan', 'asc');

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
        $this->db->select("p.*, u.name, p.tahun_pengadaan, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('poktan p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.slug', $slug);
        return $this->db->get()->row();
    }
    
        // get data poktan
    function get_by_slug_gapok($slug)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, p.tahun_pengadaan, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('gapoktan p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.slug', $slug);
        return $this->db->get()->row();
    }
    
           // get data poktan
    function get_by_slug_cpp_ldpm($slug)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, p.tahun_pengadaan, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('cpp_ldpm p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.slug', $slug);
        return $this->db->get()->row();
    }

    function get_by_id($id)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('poktan p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.id_poktan', $id);
        return $this->db->get()->row();
    }
    
    function get_by_id_pok($id)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('gapoktan p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.id_gapoktan', $id);
        return $this->db->get()->row();
    }
    
     function get_by_id_gapok($id)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('gapoktan p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.id_gapoktan', $id);
        return $this->db->get()->row();
    }
    
      function get_by_id_cpp_ldpm($id)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, b.nama_kab, c.nama_kec, d.nama_kel");
        $this->db->from('cpp_ldpm p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kab');
        $this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        $this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        $this->db->where('p.id_gapoktan', $id);
        return $this->db->get()->row();
    }
    
     function get_by_id_cppkab($id)
    {
        $this->load->database();
        $this->db->select("p.*, u.name, b.nama_kab");
        $this->db->from('cpp_kab p');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('subsektor s', 's.id = p.id_subsektor', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten');
        //$this->db->join('kecamatan c', 'c.id_kec = p.id_kecamatan');
        //$this->db->join('kelurahan d', 'd.id_kel = p.id_desa');
        //$this->db->where('p.id_kabupaten', $id);
        return $this->db->get()->row();
    }

    function get_all_by_poktan($id)
    {
        $this->load->database();
        $this->db->select("p.awal_pengadaan,u.name, l.bulan, l.tahun, l.stok_awal, l.penambahan, l.penyaluran, (l.stok_awal + l.penambahan - l.penyaluran) as akhir,");
        $this->db->from('poktan p');
        $this->db->join('lpm l', 'p.id_poktan = l.id_poktan', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        $this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_poktan', 'asc');
        return $this->db->get()->result_array();
    }
    
    function get_all_by_gapok($id)
    {
        $this->load->database();
        $this->db->select("p.*,u.name, l.bulan, l.stok_awal, l.penambahan, p.foto, l.penyaluran, l.penyusutan, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir,");
        $this->db->from('gapoktan p');
        $this->db->join('ldpm l', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        $this->db->where('p.id_gapoktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
    
        function get_all_by_cpp_ldpm($id)
    {
        $this->load->database();
        $this->db->select("p.*,u.name, l.bulan, l.stok_awal, l.lokasi, p.foto, l.penambahan, l.penyaluran, l.penyusutan, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir,");
        $this->db->from('cpp_ldpm p');
        $this->db->join('data_cpp_ldpm l', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        $this->db->where('p.id_gapoktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
       function get_all_by_cppkab($id)
    {
        $this->load->database();
        $this->db->select("p.*,u.name, b.nama_kab, l.bulan, l.stok_awal, l.penambahan, l.penyaluran, l.penyusutan, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir,");
        $this->db->from('cpp_kab p');
        $this->db->join('data_cppkab l', 'p.id_kabupaten = l.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        $this->db->where('p.id_kabupaten', $id);
        $this->db->order_by('b.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
    
       function get_all_by_bulog($id)
    {
        $this->load->database();
        $this->db->select("p.*,u.name, s.stok_awal as stok, p.tahun, p.lokasi, p.keterangan, p.penambahan, p.penyaluran, p.penyusutan, (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,");
        $this->db->from('bulog p');
        $this->db->join('stok_bulog s', 'p.tahun = s.tahun', 'left');
        //$this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        if ($id > 0)
        {
            $this->db->where('p.tahun', $id);
        }
        //$this->db->where('p.tahun', $id);
        $this->db->order_by('p.tahun', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_stok_awal_bulog($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('bulog');
        $this->db->where('tahun', $id);
        $this->db->order_by('id_bulog', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_cpp($id){
        $this->load->database();
        $this->db->select("p.id_cpp, l.stok_awal");
        $this->db->from('cpp_kab p');
        $this->db->join('data_cppkab l', 'p.id_kabupaten = l.id_kabupaten', 'left');
        $this->db->where('id_cpp', $id);
        $this->db->order_by('id_cppkab', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_cpm_ldpm($id){
        $this->load->database();
        $this->db->select("p.id_gapoktan, l.stok_awal");
        $this->db->from('gapoktan p');
        $this->db->join('ldpm l', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->where('id_gapoktan', $id);
        $this->db->order_by('id_ldpm', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_awal_pengadaan_bul($tahun){
        $this->load->database();
        $this->db->select("sum(stok_awal) as stok_awal");
        $this->db->from('stok_bulog');
        if ($tahun > 0)
        {
            $this->db->where('tahun', $tahun);
        }
        //$this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'ASC');
        //$this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_awal_pengadaan_bulog($tahun){
        $this->load->database();
        $this->db->select("sum(stok_awal) as stok_awal");
        $this->db->from('stok_bulog');
        if ($tahun > 0)
        {
            $this->db->where('tahun', $tahun);
        }
        //$this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'ASC');
        //$this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_awal_pengadaan_cbp($tahun){
        $this->load->database();
        $this->db->select("sum(stok_awal) as stok_awal");
        $this->db->from('stok_cbp');
        if ($tahun > 0)
        {
            $this->db->where('tahun', $tahun);
        }
        //$this->db->where('tahun', $tahun);
        $this->db->order_by('id', 'ASC');
        //$this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_cbp($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('data_cbp');
        $this->db->where('tahun', $id);
        $this->db->order_by('id_cbp', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_cbpkab($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('data_cbpkab');
        $this->db->where('id_cbpkab', $id);
        $this->db->order_by('id_cbpkab', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_poktan($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('lpm');
        $this->db->where('id_poktan', $id);
        $this->db->order_by('id_lpm', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_gapoktan($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('ldpm');
        $this->db->where('id_gapoktan', $id);
        $this->db->order_by('id_ldpm', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_stok_awal_cpp_ldpm($id){
        $this->load->database();
        $this->db->select("*");
        $this->db->from('data_cpp_ldpm');
        $this->db->where('id_gapoktan', $id);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $rs = $this->db->get();
        $data = $rs->result_array();
        $return = $data[0]['stok_awal'];
        
        return $return;
        }
        
        function get_all_by_cbp($id)
    {
        $this->load->database();
        $this->db->select("p.*,u.name, s.stok_awal as stok, p.tahun,  p.keterangan, p.lokasi,(p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,");
        $this->db->from('data_cbp p');
        $this->db->join('stok_cbp s', 'p.tahun = s.tahun', 'left');
        //$this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        if ($id > 0)
        {
            $this->db->where('p.tahun', $id);
        }

        //$this->db->where('p.tahun', $id);
        $this->db->order_by('p.tahun', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_all_by_cbpkab ($id)
    {
        $this->load->database();
        #Create where clause
        $this->db->select('MAX(id_cbpkab)');
        $this->db->from('data_cbpkab');
        $this->db->group_by('id_kabupaten');
        //$this->db->where('id_kab', $id);
           if ($id > 0)
        {
            $this->db->where('p.tahun', $id);
        }
        $where_clause = $this->db->get_compiled_select();

        $this->db->select("p.*,u.name, b.nama_kab, s.awal_pengadaan as stok, p.tahun,  p.keterangan, p.lokasi,(p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,");
        $this->db->from('data_cbpkab p');
        $this->db->join('cbp_kab s', 'p.id_kabupaten = s.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
     

        //$this->db->where('p.tahun', $id);
        $this->db->group_by('b.id_kab', 'asc');
        $this->db->order_by('p.tahun', 'asc');
        $this->db->where("`id_cbpkab` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
    
       function get_all_by_cpp($id)
    {
        $this->load->database();
          #Create where clause
        $this->db->select('MAX(id_cppkab)');
        $this->db->from('data_cppkab');
        $this->db->group_by('id_kabupaten');
                 if ($id > 0)
        {
            $this->db->where('tahun', $id);
        }
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select("p.*, s.awal_pengadaan as pengadaan, u.name, b.nama_kab, (p.stok_awal + p.penambahan - p.penyaluran - p.penyusutan) as akhir,");
        $this->db->from('data_cppkab p');
        $this->db->join('cpp_kab s', 'p.id_kabupaten = s.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = p.id_kabupaten', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        $this->db->group_by('p.id_kabupaten', 'asc');
        $this->db->where("`id_cppkab` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }

    // get data gapoktan
    function get_by_gapoktan()
    {
        $this->load->database();
        $this->db->select("p.*,u.name");
        $this->db->from('gapoktan p');
        //$this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
    function get_by_cpp_ldpm()
    {
        $this->load->database();
        $this->db->select("p.*,u.name");
        $this->db->from('cpp_ldpm p');
        //$this->db->join('poktan p', 'p.id_poktan = r.id_poktan', 'left');
        $this->db->join('users u', 'u.id = p.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_by_cpm_lpm()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, p.nama_poktan, (l.stok_awal + l.penambahan - l.penyaluran) as akhir");
        $this->db->from('lpm l');
        $this->db->join('poktan p', 'p.id_poktan = l.id_poktan', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_poktan', 'asc');
        return $this->db->get()->result_array();
    }
    
       function get_by_cpm_ldpm()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, p.nama_gapoktan, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir");
        $this->db->from('ldpm l');
        $this->db->join('gapoktan p', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_by_data_cpp_ldpm()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, p.nama_gapoktan, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir");
        $this->db->from('data_cpp_ldpm l');
        $this->db->join('cpp_ldpm p', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }

        function get_by_bulog()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir");
        $this->db->from('bulog l');
        //$this->db->join('gapoktan p', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('l.tahun', 'asc');
        return $this->db->get()->result_array();
    }

    function get_by_cbp()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, (l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir");
        $this->db->from('data_cbp l');
        //$this->db->join('gapoktan p', 'p.id_gapoktan = l.id_gapoktan', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('l.tahun', 'asc');
        return $this->db->get()->result_array();
    }

    function get_by_cpp_kab()
    {
        $this->load->database();
        $this->db->select("l.*,u.name, p.nama_kab,(l.stok_awal + l.penambahan - l.penyaluran - l.penyusutan) as akhir");
        $this->db->from('data_cppkab l');
        $this->db->join('kabupaten p', 'p.id_kab = l.id_kabupaten', 'left');
        $this->db->join('users u', 'u.id = l.id_penyuluh', 'left');
        //$this->db->where('p.id_poktan', $id);
        $this->db->order_by('p.nama_kab', 'asc');
        return $this->db->get()->result_array();
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
    
       // get data poktan kab
    function get_by_id_kota_cpm_lpm($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('lpm g');
        $this->db->join('poktan p', 'p.id_poktan = g.id_poktan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_kab', $id);
        return $this->db->get()->row();
    }
    
      function get_by_id_kota_cpm_ldpm($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('ldpm g');
        $this->db->join('gapoktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_kab', $id);
        return $this->db->get()->row();
    }
    
        function get_by_id_kota_cpp_ldpm($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('cpp_ldpm g');
        $this->db->join('data_cpp_ldpm p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_kab', $id);
        return $this->db->get()->row();
    }
    
        function get_by_id_kota_cpp_kab_detail($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('cpp_kab g');
        $this->db->join('data_cppkab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_kabupaten', $id);
        return $this->db->get()->row();
    }
    
       function get_by_id_kota_cpp_kab_user($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('cpp_kab g');
        $this->db->join('data_cppkab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_cpp', $id);
        return $this->db->get()->row();
    }
    
        function get_by_id_kota_cbp_kab_user($id)
    {
        $this->load->database();
        $this->db->select("p.*, g.*, b.nama_kab");
        $this->db->from('cbp_kab g');
        $this->db->join('data_cbpkab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan');
        $this->db->where('g.id_cbp', $id);
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

        function get_all_by_kota_cpm_lpm($id)
    {
        $this->load->database();
        //$this->db->select('id');
        //$this->db->from('table2');
        //$where_clause = $this->db->get_compiled_select();
        //$this->db->select('*');
        //$this->db->from('table1');
        //$this->db->where("`id` IN ($where_clause)", NULL, FALSE);
        $this->db->select(" id_lpm, g.id_kab, p.nama_poktan, b.nama_kab, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran,(g.stok_awal + g.penambahan - g.penyaluran) as akhir,
        ");
        $this->db->from('lpm g');
        $this->db->join('poktan p', 'p.id_poktan = g.id_poktan', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab', 'left');
        
        $this->db->where('g.id_kab', $id);
        $this->db->group_by('g.id_poktan');
        $this->db->order_by('p.nama_poktan', 'asc');
        $this->db->where_not_in('g.id_lpm', "SELECT MAX(g.id_lpm) as id_lpm FROM lpm g WHERE group_by = g.id_poktan");
        //$where_clause = $this->db->get_compiled_select();
        //$this->db->select_max('id_lpm');
        //$this->db->from('lpm');
        //$this->db->group_by('id_poktan');
        //$this->db->where("`id_lpm` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
    
    function get_all_by_kota_cpm_lpm_coba($id)
    {
        //$this->load->database();
        //$query =("SELECT lpm.stok_awal, poktan.nama_poktan, kabupaten.nama_kab from lpm
        //                  JOIN poktan on poktan.id_poktan = lpm.id_poktan
        //                  join kabupaten on kabupaten.id_kab = lpm.id_kab
        //                  where id_lpm IN (SELECT MAX(id_lpm) As id from lpm GROUP BY id_poktan) 
        //                  ");
        //$query_run=$this->db->select($query);
        //$query_run->join('id_lpm', $id);
        //$query_run->where('id_lpm', $id);
        //$query_run->group_by('from_id');
        
        $this->db->select('stok_awal, p.nama_poktan')->from('lpm a');
        $this->db->join('poktan p', 'p.id_poktan = a.id_poktan', 'left');
        $this->db->join('kabupaten k', 'k.id_kab = a.id_kab', 'left');
        //$this->db->where('p.id_kab', $id);
        $this->db->group_by('a.id_poktan');
        $this->db->where_not_in('id_lpm', "SELECT MAX id_lpm FROM lpm WHERE group = id_poktan");
        return $this->db->get()->result_array();

        //$result = $query_run->get('user_messages');
        //echo $this->db->last_query();
        //return $result->row();                  
        //return $this->db->get()->result_array();
        //return $this->db->query($query);
        //return $this->db->get()->result_array();
    }
    
        function get_all_by_kota_cpm_lpm_test($id)
    {
        $this->load->database();
        #Create where clause
        $this->db->select('MAX(id_lpm)');
        $this->db->from('lpm');
        $this->db->group_by('id_poktan');
        $this->db->where('id_kab', $id);
        $where_clause = $this->db->get_compiled_select();

        #Create main query
        $this->db->select('g.id_kab, p.nama_poktan, b.nama_kab, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran,(g.stok_awal + g.penambahan - g.penyaluran) as akhir,');
        $this->db->join('poktan p', 'p.id_poktan = g.id_poktan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab', 'left');
        $this->db->from('lpm g');
        $this->db->order_by('p.nama_poktan', 'asc');
        $this->db->where("`id_lpm` IN ($where_clause)", NULL, FALSE);
         
        return $this->db->get()->result_array();
    }
    
        function get_all_by_kota_cpm_lpm_test2($id)
    {
         $this->load->database();
        //$this->db->select('id');
        //$this->db->from('table2');
        //$where_clause = $this->db->get_compiled_select();
        //$this->db->select('*');
        //$this->db->from('table1');
        //$this->db->where("`id` IN ($where_clause)", NULL, FALSE);
        $this->db->select("id_lpm, g.id_kab, p.nama_poktan, b.nama_kab, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran,(g.stok_awal + g.penambahan - g.penyaluran) as akhir,
        ");
        $this->db->from('lpm g');
        $this->db->join('poktan p', 'p.id_poktan = g.id_poktan', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab', 'left');
        
        $this->db->where('g.id_kab', $id);
        $this->db->group_by('g.id_poktan');
        $this->db->order_by('p.nama_poktan', 'asc');
        $subquery="(Select max(g.id_lpm) as id_lpm from lpm g)";
        $this->db->where('g.id_lpm ='.$subquery, null,FALSE);
        //$this->db->where_not_in('g.id_lpm', "SELECT MAX(g.id_lpm) as id FROM lpm g group = g.id_poktan");
        //$where_clause = $this->db->get_compiled_select();
        //$this->db->select_max('id_lpm');
        //$this->db->from('lpm');
        //$this->db->group_by('id_poktan');
        //$this->db->where("`id_lpm` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
    
        /*function get_all_by_kota_cpm_lpm_2($id)
    {
        $this->load->database();   
        $this->db->select("id_lpm");
        $this->db->from('lpm');
        $this->db->group_by('id_poktan');
        $subQuery = $this->db->_compile_select();

        $this->db->_reset_select();
        // And now your main query
        $this->db->select("*");
        $this->db->from('lpm');
        $this->db->where_in("$subQuery");
        $this->db->where('id_lpm', '55');
        $this->db->get('lpm');
        return $this->db->get()->result_array();
    }*/
    
        function get_all_by_kota_cpp_ldpm($id)
    {
        $this->load->database();
        $this->db->select("g.id_kab, p.nama_gapoktan, b.nama_kab, g.lokasi, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran, g.penyusutan,(g.stok_awal + g.penambahan - g.penyaluran -g.penyusutan) as akhir,
        ");
        $this->db->from('data_cpp_ldpm g');
        $this->db->join('cpp_ldpm p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab', 'left');
        $this->db->where('g.id_kab', $id);
        $this->db->group_by('g.id_gapoktan');
        $this->db->order_by('p.nama_gapoktan', 'asc');
        return $this->db->get()->result_array();
    }
    
       /* function get_test($id)
    {
        $this->load->database();
        $this->load->query->('select p.* from cpp_ldpm p ')
        return $this->db->get()->result_array();
    }*/
    
        function get_all_by_kota_cpp_kab_detail($id)
    {
        $this->load->database();
        $this->db->select("g.id_kabupaten, b.nama_kab, g.tanggal, g.keterangan, g.lokasi, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran, g.penyusutan,(g.stok_awal + g.penambahan - g.penyaluran -g.penyusutan) as akhir,
        ");
        $this->db->from('data_cppkab g');
        $this->db->join('cpp_kab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->where('g.id_kabupaten', $id);
        //$this->db->group_by('g.id_kabupaten');
        $this->db->order_by('b.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_all_by_kota_cpp_kab_user($id)
    {
        $this->load->database();
        $this->db->select("g.id_kabupaten, b.nama_kab, g.tanggal, g.keterangan, g.lokasi, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran, g.penyusutan,(g.stok_awal + g.penambahan - g.penyaluran -g.penyusutan) as akhir,
        ");
        $this->db->from('data_cppkab g');
        $this->db->join('cpp_kab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->where('p.id_cpp', $id);
        //$this->db->group_by('g.id_kabupaten');
        $this->db->order_by('b.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_all_by_kota_cbp_kab_user($id)
    {
        $this->load->database();
        $this->db->select("g.id_kabupaten, b.nama_kab, g.tanggal, g.keterangan, g.lokasi, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran, g.penyusutan,(g.stok_awal + g.penambahan - g.penyaluran -g.penyusutan) as akhir,
        ");
        $this->db->from('data_cbpkab g');
        $this->db->join('cbp_kab p', 'p.id_kabupaten = g.id_kabupaten', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kabupaten', 'left');
        $this->db->where('p.id_cbp', $id);
        //$this->db->group_by('g.id_kabupaten');
        $this->db->order_by('b.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_all_by_kota_cpm_ldpm($id)
    {
        $this->load->database();
        #Create where clause
        $this->db->select('MAX(id_ldpm)');
        $this->db->from('ldpm');
        $this->db->group_by('id_gapoktan');
        $this->db->where('id_kab', $id);
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select("g.id_kab, p.nama_gapoktan, b.nama_kab, p.awal_pengadaan, g.stok_awal, g.penambahan, g.penyaluran, g.penyusutan,(g.stok_awal + g.penambahan - g.penyaluran -g.penyusutan) as akhir,
        ");
        $this->db->from('ldpm g');
        $this->db->join('gapoktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('rdkk r', 'r.id_poktan = p.id_poktan', 'left');
        //$this->db->join('kecamatan c', 'c.id_kec = g.id_kecamatan', 'left');
        $this->db->join('kabupaten b', 'b.id_kab = g.id_kab', 'left');
        $this->db->where('g.id_kab', $id);
        $this->db->group_by('g.id_gapoktan');
        $this->db->order_by('p.nama_gapoktan', 'asc');
        $this->db->where("`id_ldpm` IN ($where_clause)", NULL, FALSE);
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
    
    function get_all_by_prov_lpm($bulan, $tahun=0)
    {
        $this->load->database();
        $this->db->select('MAX(id_lpm)');
        $this->db->from('lpm r');
        $this->db->group_by('r.id_poktan');
        if ($bulan)
        {
            $this->db->where('r.bulan', $bulan);
        }
         if ($tahun > 0)
        {
            $this->db->where('r.tahun', $tahun);
        }
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select("
        r.bulan,
        r.tahun,
        c.nama_kab,
        sum(g.awal_pengadaan) as stok,
        sum(r.stok_awal) as stok_awal,
        sum(r.penambahan) as tambah,
        sum(r.penyaluran) as salur,
        ");
        $this->db->from('lpm r');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('poktan g', 'g.id_poktan = r.id_poktan', 'left');
        $this->db->join('kabupaten c', 'c.id_kab = r.id_kab', 'left');
        $this->db->group_by('r.id_kab');
        $this->db->order_by('c.nama_kab', 'asc');
        $this->db->where("`id_lpm` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
    
     function get_all_by_prov_ldpm($bulan, $tahun=0)
    {
        //$query =$this->query("select max(g.id_ldpm) as id from lpm group by g.id_poktan as B");
        $this->load->database();
        $this->db->select('MAX(id_ldpm)');
        $this->db->from('ldpm g');
        $this->db->group_by('g.id_gapoktan');
        //$this->db->where('id_kab', $id);
        if ($bulan)
        {
            $this->db->where('g.bulan', $bulan);
        }
        
         if ($tahun > 0)
        {
            $this->db->where('g.tahun', $tahun);
        }
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select("
        c.id_kab,
        g.bulan,
        g.tahun,
        c.nama_kab,
        sum(r.awal_pengadaan) as stok,
        sum(g.stok_awal) as stok_awal,
        sum(g.penambahan) as tambah,
        sum(g.penyaluran) as salur,
        sum(g.penyusutan) as susut,
        ");
        $this->db->from('ldpm g');
        //$this->db->join($query, 'inner');
        $this->db->join('gapoktan r', 'r.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('kabupaten c', 'c.id_kab = g.id_kab', 'left');

        $this->db->group_by('g.id_kab', '');
        $this->db->order_by('c.nama_kab', 'asc');
        $this->db->where("`id_ldpm` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
    
        function get_all_by_prov_cpp_ldpm($tahun_pengadaan=0)
    {
        $this->load->database();
        $this->db->select("
        c.id_kab,
        g.tahun_pengadaan,
        c.nama_kab,
        sum(g.awal_pengadaan) as stok,
        sum(r.stok_awal) as stok_awal,
        sum(r.penambahan) as tambah,
        sum(r.penyaluran) as salur,
        sum(r.penyusutan) as susut,
        ");
        $this->db->from('cpp_ldpm g');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('data_cpp_ldpm r', 'r.id_gapoktan = g.id_gapoktan', 'left');
        $this->db->join('kabupaten c', 'c.id_kab = g.id_kab', 'left');
        if ($tahun_pengadaan > 0)
        {
            $this->db->where('g.tahun_pengadaan', $tahun_pengadaan);
        }
        $this->db->group_by('g.id_kab');
        $this->db->order_by('c.nama_kab', 'asc');
        return $this->db->get()->result_array();
    }
    
        function get_by_stok_prov_lpm($tahun=0)
    {
        $this->load->database();
        $this->db->select('(id_poktan)');
        $this->db->from('poktan');
         if ($tahun > 0)
        {
            $this->db->where('tahun_pengadaan', $tahun);
        }
        $this->db->group_by('id_kab');
        $where_clause = $this->db->get_compiled_select();
        
        $this->db->select("
        c.id_kab,
        g.tahun_pengadaan,
        c.nama_kab,
        sum(g.awal_pengadaan) as pengadaan,
        ");
        $this->db->from('poktan g');
        //$this->db->join('poktan p', 'p.id_gapoktan = g.id_gapoktan', 'left');
        //$this->db->join('lpm r', 'r.id_poktan = g.id_poktan', 'left');
        $this->db->join('kabupaten c', 'c.id_kab = g.id_kab', 'left');
        $this->db->group_by('g.id_kab');
        $this->db->order_by('c.nama_kab', 'asc');
        $this->db->where("`id_poktan` IN ($where_clause)", NULL, FALSE);
        return $this->db->get()->result_array();
    }
}