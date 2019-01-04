<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('RegisterModel','register');
	}
	
	public function index()
	{
		$this->load->view('auth/login');
	}

	public function register()
    {
        
		$this->form_validation->set_rules($this->register->rules());

        if ($this->form_validation->run() === false) {
			$d['code']	= $this->confirmCode();
            $this->load->view('auth/register',$d);
        } else {
            $this->register->insertRegister();//save user
            // $this->send_email_verification($this->input->post('email'), $_SESSION['token']); //verifikasi email
			// redirect('login');
			echo 'Yey Berhasil';
        }
	}
	
	public function confirmRoot()
    {
        if($this->input->post('confirm') != $this->confirmCode()) {
            $this->form_validation->set_message('confirmRoot', 'confirm code is incorrect');
            return false;
        }

        return true;
	}
	
	public function confirmCode()
	{
		$y = date('y');
		$m = date('m');
		$d = date('d');
		
		$h = date('H');
		$i = date('i');


		$c1 = ($y + $m + $d) * 3;

		$c2 = $h + 7;
		$c3 = $c2 + $i;

		$code = $c1.''.$c2.''.$c3;

		return $code;
	}
}
