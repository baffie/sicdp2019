<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper(array('url','language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        
        $this->lang->load('auth');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in() && !$this->ion_auth->is_admin())
        {
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            redirect(site_url('cms/dashboard'));
        }
    }

    function in()
    {
        
        //validate form input
        $this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
        $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
        
        if ($this->form_validation->run() == true)
        {
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect(site_url('cms/dashboard'));
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url('cms/log/in'));
            }
        }
        else
        {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->load->view('backend/layouts/login', $this->data);
        }

    }
    
     public function register()
    {
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        //$this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('id_kabupaten', 'Kabupaten / Kota Binaan', 'required');
        $this->form_validation->set_rules('id_kecamatan', 'Kecamatan Binaan', 'required');
        $this->form_validation->set_rules('id_desa[]', 'Kelurahan / Desa Binaan', 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity', 'Username','required|is_unique['.$tables['users_3601'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users_3601'] . '.email]');
        }
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            $relateds = @implode(",", $this->input->post('id_desa'));
            $additional_data = array(
                'name' => $this->input->post('name'),
                'nip' => $this->input->post('nip'),
                'gender' => $this->input->post('gender'),
                'id_kabupaten' =>$this->input->post('id_kabupaten'),
                'id_kecamatan' => $this->input->post('id_kecamatan'),
                'id_desa' => $relateds,
                'gender' => $this->input->post('gender'),
                'phone'      => $this->input->post('phone'),
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
        {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect(site_url('cms/log'));
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data = array(
                'identity' => set_value('identity'),
                'password' => set_value('password'),
                'password_confirm' => set_value('password_confirm'),
                'email' => set_value('email'),
                'active' => set_value('active'),
                'name' => set_value('name'),
                'nip' => set_value('nip'),
                'gender' => set_value('gender'),
                'id_kabupaten' =>set_value('id_kabupaten'),
                'id_kecamatan' => set_value('id_kecamatan'),
                'id_desa' => set_value('id_desa'),
                'gender' => set_value('gender'),
                'phone' => set_value('phone'),
            );

            $this->load->model('Kabupaten_model');
            $this->load->model('Kecamatan_model');
            $this->load->model('Kelurahan_model');

            $this->data['load_cities']	= $this->Kabupaten_model->get_category_select(array('' => '-- Pilih Kabupaten/Kota --'));
            $this->data['load_kecamatan']	= $this->Kecamatan_model->select_dropdown_kecamatan($this->data['id_kabupaten']);
            $this->data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($this->data['id_kecamatan']);

            $template['title'] = 'Daftar';
            $this->load->view('cms/register', $this->data);
        }
    }

    function profile()
    {
        $id = $this->session->userdata('user_id');

        if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
        {
            redirect(site_url('auth'));
        }

        $user = $this->ion_auth->user($id)->row();
        $groups=$this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required');
        //$this->form_validation->set_rules('id_desa', 'Wilayah Binaan', 'required');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error($this->lang->line('error_csrf'));
            }

            // update the password if it was posted
            if ($this->input->post('password'))
            {
                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
            }

            if ($this->form_validation->run() === TRUE)
            {
                $relateds = @implode(",", $this->input->post('id_desa', TRUE));
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'nip' => $this->input->post('nip', TRUE),
                    'gender' => $this->input->post('gender', TRUE),
                    'phone' => $this->input->post('phone', TRUE),
                    'id_desa' => $relateds,
                );

                // update the password if it was posted
                if ($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                // check to see if we are updating the user
                if($this->ion_auth->update($user->id, $data))
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('success', $this->ion_auth->messages() );
                    redirect(site_url('auth'));

                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
                    $this->session->set_flashdata('error', $this->ion_auth->errors() );
                    redirect(site_url('auth/profile'));

                }

            }
        }

        // display the edit user form
        $this->data['csrf'] = $this->_get_csrf_nonce();

        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass the user to the view
        $this->data['user'] = $user;
        $this->data['groups'] = $groups;
        $this->data['currentGroups'] = $currentGroups;
        $this->data['email'] = set_value('email', $user->email);
        $this->data['name'] = set_value('name', $user->name);
        $this->data['nip'] = set_value('nip', $user->nip);
        $this->data['gender'] = set_value('nip', $user->gender);
        $this->data['phone'] = set_value('phone', $user->phone);
        $this->data['id_kecamatan'] = set_value('id_kecamatan', $user->id_kecamatan);
        $this->data['id_desa'] = set_value('id_desa', explode(",", $user->id_desa));

        $this->load->model('Kelurahan_model');
        $this->data['load_kelurahan']	= $this->Kelurahan_model->select_dropdown_kelurahan($this->data['id_kecamatan']);

        $template['page_heading'] = 'Profil Anda';
        $template['content'] = $this->load->view('profile', $this->data, true);
        $this->load->view('layouts/dashboard', $template);
    }


    function change_password()
        {
                $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
                $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
                $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

                if (!$this->ion_auth->logged_in())
                {
                        redirect(site_url('auth/login'));
                }

                $user = $this->ion_auth->user()->row();

                if ($this->form_validation->run() == false)
                {
                        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                        $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                        $this->data['old_password'] = array(
                                'name' => 'old',
                                'id'   => 'old',
                                'type' => 'password',
                        );
                        $this->data['new_password'] = array(
                                'name' => 'new',
                                'id'   => 'new',
                                'type' => 'password',
                                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                        );
                        $this->data['new_password_confirm'] = array(
                                'name' => 'new_confirm',
                                'id'   => 'new_confirm',
                                'type' => 'password',
                                'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                        );
                        $this->data['user_id'] = array(
                                'name'  => 'user_id',
                                'id'    => 'user_id',
                                'type'  => 'hidden',
                                'value' => $user->id,
                        );

                        $this->_render_page('auth/change_password', $this->data);
                }
                else
                {
                        $identity = $this->session->userdata('identity');

                        $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

                        if ($change)
                        {
                                $this->session->set_flashdata('message', $this->ion_auth->messages());
                                $this->logout();
                        }
                        else
                        {
                                $this->session->set_flashdata('message', $this->ion_auth->errors());
                                redirect(site_url('auth/change_password'));
                        }
                }
        }

    // forgot password
    public function forgot_password()
    {
        // setting validation rules by checking whether identity is username or email
        if($this->config->item('identity', 'ion_auth') != 'email' )
        {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        }
        else
        {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false)
        {
            $this->data['type'] = $this->config->item('identity','ion_auth');
            // setup the input
            $this->data['identity'] = array('name' => 'identity',
                'id' => 'identity',
            );

            if ( $this->config->item('identity', 'ion_auth') != 'email' ){
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            }
            else
            {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $template['content'] = $this->load->view('auth/forgot_password', $this->data, true);
            $this->load->view('frontend/layouts/base', $template);
        }
        else
        {
            $identity_column = $this->config->item('identity','ion_auth');
            $identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

            if(empty($identity)) {

                if($this->config->item('identity', 'ion_auth') != 'email')
                {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                }
                else
                {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url('auth/forgot_password'));
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten)
            {
                // if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(site_url('auth/login')); //we should display a confirmation page here instead of the login page
            }
            else
            {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect(site_url('auth/forgot_password'));
            }
        }
    }

    // reset password - final step for forgotten password
    public function reset_password($code = NULL)
    {
        if (!$code)
        {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user)
        {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false)
            {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['new_password'] = array(
                    'name' => 'new',
                    'id'   => 'new',
                    'type' => 'password',
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['new_password_confirm'] = array(
                    'name'    => 'new_confirm',
                    'id'      => 'new_confirm',
                    'type'    => 'password',
                    'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
                );
                $this->data['user_id'] = array(
                    'name'  => 'user_id',
                    'id'    => 'user_id',
                    'type'  => 'hidden',
                    'value' => $user->id,
                );
                $this->data['csrf'] = $this->_get_csrf_nonce();
                $this->data['code'] = $code;

                // render
                $this->_render_page('auth/reset_password', $this->data);
            }
            else
            {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
                {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));

                }
                else
                {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change)
                    {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("auth/login", 'refresh');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('auth/reset_password/' . $code, 'refresh');
                    }
                }
            }
        }
        else
        {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("auth/forgot_password", 'refresh');
        }
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

        function _render_page($view, $data=null, $render=false)
        {

                $this->viewdata = (empty($data)) ? $this->data: $data;

                $view_html = $this->load->view($view, $this->viewdata, $render);

                if (!$render) return $view_html;
        }

    function out() {
        $logout = $this->ion_auth->logout();

        $this->session->set_flashdata('success', $this->ion_auth->messages());
        redirect(site_url('cms/log/in'));
    }

};