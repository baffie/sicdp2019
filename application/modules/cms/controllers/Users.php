<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->load->library('form_validation');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->is_admin())
		{
			redirect(site_url('cms/log/in'));
		}

		$this->user = $this->ion_auth->user()->row();
	}


	public function index()
	{
		$data['users_data'] = $this->ion_auth->users()->result();
		foreach ($data['users_data'] as $k => $user)
		{
			$data['users_data'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		
		$template['page_heading'] = 'Operator';
		$template['content'] = $this->load->view('users/list', $data, true);
        $template['js'] = $this->load->view('users/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function read($id)
	{
		
		$row = $this->Users_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'ip_address' => $row->ip_address,
				'username' => $row->username,
				'password' => $row->password,
				'salt' => $row->salt,
				'email' => $row->email,
				'activation_code' => $row->activation_code,
				'forgotten_password_code' => $row->forgotten_password_code,
				'forgotten_password_time' => $row->forgotten_password_time,
				'remember_code' => $row->remember_code,
				'created_on' => $row->created_on,
				'last_login' => $row->last_login,
				'active' => $row->active,
				'name' => $row->name,
				'nip' => $row->nip,
				'phone' => $row->phone,
				'id_kabupaten' => $row->id_kabupaten,
			);
			$this->load->view('users/users_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('cms/users'));
		}
	}

	public function create()
	{
		$data = array(
			'button' => 'Tambah',
			'action' => site_url('cms/users/create_action'),
			'id' => set_value('id'),
			'identity' => set_value('identity'),
			'password' => set_value('password'),
			'password_confirm' => set_value('password_confirm'),
			'email' => set_value('email'),
			'active' => set_value('active'),
			'name' => set_value('name'),
			'nip' => set_value('nip'),
			'foto' => set_value('foto'),
            'gender' => set_value('gender'),
            'id_kabupaten' =>set_value('id_kabupaten',$this->user->id_kabupaten),
            'id_kecamatan' => set_value('id_kecamatan'),
            'id_desa' => set_value('id_desa'),
            'gender' => set_value('gender'),
			'phone' => set_value('phone'),
		);

        $this->load->model('Kabupaten_model');
        $this->load->model('Kecamatan_model');
        $this->load->model('Kelurahan_model');

        $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
        $data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
        $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);


        $template['page_heading'] = 'Operator';
		$template['content'] = $this->load->view('users/form_add', $data, true);
        $template['js'] = $this->load->view('users/js', $data, true);
		$this->load->view('backend/layouts/dashboard', $template);
	}

	public function create_action()
	{
		$idkab = $this->user->id_kabupaten;
		
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        //$this->data['identity_column'] = $identity_column;

		//validate form input
		$this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');


		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $relateds = @implode(",", $this->input->post('id_desa'));
			$additional_data = array(
				'name' => $this->input->post('name'),
                'nip' => $this->input->post('nip'),
                'gender' => $this->input->post('gender'),
                'id_kabupaten' =>($idkab),
                'id_kecamatan' => $this->input->post('id_kecamatan'),
                'id_desa' => $relateds,
                'gender' => $this->input->post('gender'),
				'phone'      => $this->input->post('phone'),
			);
			
			//upload foto
				if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {

				$upload_img = FCPATH.'uploads/users/';
				$file_name = date("Ymd") . '_' . trim($_FILES['foto']['name']);

				if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

				$config['upload_path'] = $upload_img;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['file_type'] = 'image/jpeg';
				$config['file_name'] = $file_name;
				$config['overwrite'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('cms/users'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					$this->resize_image($upload_img . $upload_data['file_name'], 400, 400,$upload_img);
					$this->resize_image($upload_img . $upload_data['file_name'], 125, 125,$upload_img.'thumbs/');

					$additional_data['foto'] = $upload_data['raw_name'] . $upload_data['file_ext'];
					}
				}
			//print_r ($additional_data);
			//die();
			$this->ion_auth->register($identity, $password, $email, $additional_data);
			$this->session->set_flashdata('success', 'Create Record Success');
			redirect(site_url('cms/users'));
		}
	}

	public function update($id)
	{
        $row = $this->ion_auth->user($id)->row();
		//$row = $this->Users_model->get_by_id($id);

		if ($row) {
			$data = array(
				'button' => 'Edit',
				'action' => site_url('cms/users/update_action'),
				'id' => set_value('id', $row->id),
				'email' => set_value('email', $row->email),
				'active' => set_value('active', $row->active),
				'name' => set_value('name', $row->name),
				'nip' => set_value('nip', $row->nip),
                'gender' => set_value('nip', $row->gender),
				'foto' => set_value('foto', $row->foto),
                'id_kabupaten' =>set_value('id_kabupaten', $row->id_kabupaten),
                'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
                'id_desa' => set_value('id_desa', explode(",", $row->id_desa)),
				'phone' => set_value('phone', $row->phone),
			);

            $this->load->model('Kabupaten_model');
            $this->load->model('Kecamatan_model');
            $this->load->model('Kelurahan_model');

            $data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
            $data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($data['id_kabupaten']);
            $data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($data['id_kecamatan']);

            $user = $this->ion_auth->user($id)->row();
            $groups=$this->ion_auth->groups()->result_array();
            $currentGroups = $this->ion_auth->get_users_groups($id)->result();

            $data['user'] = $user;
            $data['groups'] = $groups;
            $data['currentGroups'] = $currentGroups;
		
            $template['page_heading'] = 'Operator';
			$template['content'] = $this->load->view('users/form', $data, true);
            $template['js'] = $this->load->view('users/js', $data, true);
			$template['css'] = $this->load->view('users/css', $data, true);
			$this->load->view('backend/layouts/dashboard', $template);
		} else {
			$this->session->set_flashdata('success', 'Record Not Found');
			redirect(site_url('cms/users'));
		}
	}

	public function update_action()
	{
		$idkab = $this->user->id_kabupaten;
	
	    $id = $this->input->post('id', TRUE);

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
        {
            redirect(site_url('cms/log/in'));
        }

        $user = $this->ion_auth->user($id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if (isset($_POST) && !empty($_POST)) {

            // update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() == TRUE) {
                $relateds = @implode(",", $this->input->post('id_desa'));

                $data = array(
                    //'username' => $this->input->post('username', TRUE),
                    //'email' => $this->input->post('email', TRUE),
                    'active' => $this->input->post('active', TRUE),
                    'name' => $this->input->post('name', TRUE),
                    'nip' => $this->input->post('nip', TRUE),
					//'foto' => $this->input->post('foto', TRUE),
                    'gender' => $this->input->post('gender', TRUE),
                    'id_kabupaten' => ($idkab),
                    'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
                    'id_desa' => $relateds,
                    'phone' => $this->input->post('phone', TRUE),
                );
				
				//upload foto
				if (!empty($_FILES['foto']) && !empty($_FILES['foto']['name'])) {

				$upload_img = FCPATH.'uploads/users/';
				$file_name = date("Ymd") . '-' . trim($_FILES['foto']['name']);

				if (!is_dir($upload_img) && !is_writeable($upload_img)) mkdir($upload_img, 0777, true);

				$config['upload_path'] = $upload_img;
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['file_type'] = 'image/jpeg';
				$config['file_name'] = $file_name;
				$config['overwrite'] = TRUE;
				
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect(site_url('cms/users'));
				} else {
					$this->load->library('image_lib');
					$upload_data = $this->upload->data();

					$this->resize_image($upload_img . $upload_data['file_name'], 400, 400,$upload_img);
					$this->resize_image($upload_img . $upload_data['file_name'], 125, 125,$upload_img.'/thumbs/');

					$data['foto'] = $upload_data['raw_name'] . $upload_data['file_ext'];
					}
				}
				
                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin())
                {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }
				
                // check to see if we are updating the user
                if($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('success', $this->ion_auth->messages() );
                    if ($this->ion_auth->is_admin())
                    {
                        redirect(site_url('cms/users'));
                    }
                    else
                    {
                        redirect(site_url('cms/log/in'));
                    }

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('error', $this->ion_auth->errors() );
                    if ($this->ion_auth->is_admin())
                    {
                        redirect(site_url('cms/users'));
                    }
                    else
                    {
                        redirect(site_url('cms/log/in'));
                    }

                }

            }
        }
		
		$this->update($this->input->post('id', TRUE));
	}

	public function delete($id)
	{
		$row = $this->Users_model->get_by_id($id);

		if ($row) {
            $this->ion_auth->delete_user($id);
			$this->session->set_flashdata('success', 'Delete Record Success');
			redirect(site_url('cms/users'));
		} else {
			$this->session->set_flashdata('error', 'Record Not Found');
			redirect(site_url('cms/users'));
		}
	}
	
	public function resize_image($file_path, $width, $height, $new_image)
	{
		$img_cfg['image_library'] = 'gd2';
		$img_cfg['source_image'] = $file_path;
		$img_cfg['maintain_ratio'] = TRUE;
		$img_cfg['create_thumb'] = TRUE;
		$img_cfg['thumb_marker']='';
		$img_cfg['new_image'] = $new_image;
		$img_cfg['width'] = $width;
		$img_cfg['height'] = $height;

		$this->image_lib->initialize($img_cfg);
		if (!$this->image_lib->resize()){
			$this->session->set_flashdata('error', $this->image_lib->display_errors('', ''));
		}
		$this->image_lib->clear();

	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */