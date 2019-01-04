<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('AuthModel','auth');
	}

    public function rules()
    {
        return [
            ['field' => 'username',
            'label' => 'Username',
            'rules' => 'required|callback_checkUsername'],

            ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required|callback_checkPassword']

        ];
	}
	
	public function index()
	{
        if(isset($_SESSION['loggedIn'])){
            redirect('home');
        }

		$this->form_validation->set_rules($this->rules());

        if ($this->form_validation->run() === false) {
            $this->load->view('auth/login');
        } else {
            $auth = $this->auth->getUser('username', $this->input->post('username'));
            
            $_SESSION['userId']     = $auth['id_user'];
            $_SESSION['loggedIn']   = true;
            
            redirect('home');
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

    public function checkPassword($password)
    {
		$user = $this->auth->getUser('username',$this->input->post('username'));

        if(!$this->auth->checkPassword($user['username'], $password)) {
            $this->form_validation->set_message('checkPassword', 'password is incorrect');
            return false;
        }

        return true;

	}
	
}
