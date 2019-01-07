<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('RegisterModel','register');
	}
	
	
    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required|is_unique[tbu_user.username]'],

            ['field' => 'email',
            'label' => 'Email',
            'rules' => 'required|is_unique[tbu_user.email]'],
            
            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required'],

            ['field' => 'password2',
            'label' => 'Konfirmasi Password',
            'rules' => 'required|matches[password]'],

            ['field' => 'confirm',
            'label' => 'Konfirmasi Kode',
            'rules' => 'required|callback_confirmCode'] //rules yang bersifat callback tetap harus di taruh controller
        ];
	}
	
	public function index()
    {
        
		$this->form_validation->set_rules($this->rules());

        if ($this->form_validation->run() === false) {
			$d['code']	= $this->register->confirmCode();
            $this->load->view('auth/register',$d);
        } else {
            $this->register->put();
            $id = $this->db->insert_id();
            $this->register->getMail($id);
			echo 'Yey Berhasil';
        }
	}
    
    public function konfirmasi(){
        $getUser = $this->register->getUser(array('id_user'=>decrypt_my($this->uri->segment(2)),'status_user'=>'W'))->num_rows();
        if($getUser){
            if($this->register->confirm()){
                echo 'Berhasil Di Aktifasi, Silahkan Login';
            }
        }else{
                echo 'Tautan Kedaluarsa';
        }

    }
	public function confirmCode()
	{
		if($this->input->post('confirm') != $this->register->confirmCode()) {
            $this->form_validation->set_message('confirmCode', 'confirm code is incorrect');
            return false;
        }

        return true;
	}
}
