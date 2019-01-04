<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('AuthModel','auth');
		$this->load->model('EmailModel','mail');
	}

    public function rules($q)
    {
        if($q=='1'){
            return [
                ['field' => 'username',
                'label' => 'Username',
                'rules' => 'required|callback_checkUsername'],
    
                ['field' => 'password',
                'label' => 'Password',
                'rules' => 'required|callback_checkPassword']
    
            ];
        }else{
            
            return [
                ['field' => 'email',
                'label' => 'email',
                'rules' => 'required|callback_checkEmail'],

            ];
        }
	}
	
	public function index()
	{
        if(isset($_SESSION['loggedIn'])){
            redirect('home');
        }

		$this->form_validation->set_rules($this->rules('1'));

        if ($this->form_validation->run() === false) {
            $this->load->view('auth/login');
        } else {
            $auth = $this->auth->getUser('username', $this->input->post('username'));
            
            $_SESSION['userId']     = encrypt_my($auth['id_user']);
            $_SESSION['loggedIn']   = true;
            
            redirect('home');
        }
	}

	public function forgot(){
        $this->form_validation->set_rules($this->rules('2'));

        if ($this->form_validation->run() === false) {
            $dt['mail'] = $this->mail->getMail();
            $this->load->view('auth/forgot',$dt);
        } else {
            $this->mail->getForgot($this->input->post('email'));
            echo 'Kode Konfirmasi Sudah dikirimkan Ke Email anda';
        }
    }
    public function checkUsername($username)
    {
        if (!$this->auth->getUser('username', $username)) {
            $this->form_validation->set_message('checkUsername', 'username is not on database');
            return false;
        }

        return true;
    }

    public function checkEmail($email)
    {
        if (!$this->auth->getUser('email', $email)) {
            $this->form_validation->set_message('checkEmail', 'email is not on database');
            return false;
        }

        return true;
    }

    public function checkPassword($password)
    {
		$user = $this->auth->getUser('username',$this->input->post('username'));

        if(!$this->auth->checkPassword($user['username'], $password)) {
            $this->form_validation->set_message('checkPassword', 'password is incorrect');
            return false;
        }

        return true;

    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
	
}
