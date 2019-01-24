<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cbp_kab extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Cbp_kab_model');
		//$this->load->model('Home_model');
		//$this->load->model('Data_Cbpkab_model');
		$this->load->model('Kabupaten_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}

		$this->user = $this->ion_auth->user()->row();
	}

	public function index()
	{	
		//print_r($this->ion_auth->user()->row());
        //$this->load->model('Kabupaten_model');
        //$this->load->model('Subsektor_model');
        $data['source'] = site_url('cms/cbp_kab/grid');
        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => 'Kabupaten / Kota'));
        //$data['load_subsektor']	= $this->Subsektor_model->select_dropdown_subsektor('5');
		$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/list', $data, true);
        $template['js'] = $this->load->view('cbp_kab/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

    function grid()
    {
        if(!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        echo $this->Cbp_kab_model->grid();
    }

	public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/cbp_kab/create_action'),
			'id_cbp' => set_value('id_cbp'),
			'id_penyuluh' => set_value('id_penyuluh', $this->user->id),
			'id_kabupaten' => set_value('id_kabupaten',$this->user->id_kabupaten),
			'awal_pengadaan' => set_value('awal_pengadaan'),
			'bulan_pengadaan' => set_value('bulan_pengadaan'),
			'tahun_pengadaan' => set_value('tahun_pengadaan'),
		);
		
		$this->load->model('Kabupaten_model');
		//$this->load->model('Kecamatan_model');
		//$this->load->model('Kelurahan_model');
		
		$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
		//$data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
		//$data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);

		$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
		$template['content'] = $this->load->view('cbp_kab/form', $data, true);
        $template['js'] = $this->load->view('cbp_kab/js', $data, true);
		$template['css'] = $this->load->view('cbp_kab/css', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'id_cbp' => $this->input->post('id_cbp',TRUE),
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
				'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
				'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
				'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
			);
		

			$this->Cbp_kab_model->insert($data);
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect(site_url('cms/cbp_kab'));
		}
	}

	public function update($id)
	{
		$row = $this->Cbp_kab_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('cms/cbp_kab/update_action'),
				'id_cbp' => set_value('id_cbp', $row->id_cbp),
				'id_penyuluh' => set_value('id_penyuluh', $row->id_penyuluh),
				'id_kabupaten' => set_value('id_kabupaten', $row->id_kabupaten),
				'awal_pengadaan' => set_value('awal_pengadaan', $row->awal_pengadaan),
				'bulan_pengadaan' => set_value('bulan_pengadaan', $row->bulan_pengadaan),
				'tahun_pengadaan' => set_value('tahun_pengadaan', $row->tahun_pengadaan),
			);
			
			$this->load->model('Kabupaten_model');
			$data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));

			
			$template['page_heading'] = 'Data Awal Pengadaan CBP Kab/kota';
			$template['content'] = $this->load->view('cbp_kab/form', $data, true);
            $template['js'] = $this->load->view('cbp_kab/js', $data, true);
			$template['css'] = $this->load->view('cbp_kab/css', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/cbp_kab'));
		}
	}

	public function update_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update($this->input->post('id_cbp', TRUE));
		} else {
			$data = array(
				'id_penyuluh' => $this->input->post('id_penyuluh',TRUE),
				'id_kabupaten' => $this->input->post('id_kabupaten',TRUE),
				'awal_pengadaan' => $this->input->post('awal_pengadaan',TRUE),
				'bulan_pengadaan' => $this->input->post('bulan_pengadaan',TRUE),
				'tahun_pengadaan' => $this->input->post('tahun_pengadaan',TRUE),
			);
	
			$this->Cbp_kab_model->update($this->input->post('id_cbp', TRUE), $data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate');
			redirect(site_url('cms/cbp_kab'));
		}
	}

	public function delete($id)
	{
		$row = $this->Cbp_kab_model->get_by_id($id);

		if ($row) {
			$this->Cbp_kab_model->delete($id);
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
			redirect(site_url('cms/cbp_kab'));
		} else {
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
			redirect(site_url('cms/cbp_kab'));
		}
	}
	

    public function valid($id, $status)
    {
        $data = array('status' => $status);
        $this->Cbp_kab_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate');
        redirect('cms/cbp_kab');
    }

	public function _rules()
	{
		//$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'trim|required');
		$this->form_validation->set_rules('bulan_pengadaan', 'bulan_pengadaan', 'trim|required');
		$this->form_validation->set_rules('tahun_pengadaan', 'tahun_pengadaan', 'trim|required');
		$this->form_validation->set_rules('awal_pengadaan', 'Awal Pengadaan', 'trim|required');
		//$this->form_validation->set_rules('penyusutan', 'attach_file', 'trim|required');

		$this->form_validation->set_rules('id_cbp', 'id_cbp', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

}

/* End of file cbp_kab.php */
/* Location: ./application/controllers/cbp_kab.php */