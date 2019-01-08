<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct(){
        parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		$this->load->model('AuthModel','auth');
		$this->load->model('AttemptsModel','attempt');
		$this->load->model('EmailModel','mail');
	}

    public function rules($q)
    {
        if($q=='1'){
            return [
                ['field' => 'username',
                'label' => 'Username',
                'rules' => 'required|callback_checkUsername|callback_checkRole|callback_checkBlock'],
    
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
            $this->attempt->getSuccess();
            $auth = $this->auth->getUser('username', $this->input->post('username'));
            
            $_SESSION['userId']     = encrypt_my($auth['id_user']);
            $_SESSION['loggedIn']   = true;
            
            redirect('home');
        }
	}

	public function forgot(){//Kirim konfirmasi email forgot
        $this->form_validation->set_rules($this->rules('2'));
        $this->load->model('EmailModel');

        if ($this->form_validation->run() === false) {
            $dt['mail'] = $this->EmailModel->getFrom();
            $this->load->view('auth/forgot',$dt);
        } else {
            $this->auth->getMailForgot($this->input->post('email'));
            echo 'Kode Konfirmasi Sudah dikirimkan Ke Email anda';
        }
    }

    public function resetPage(){
        $user = $this->auth->getTbUser(array('id_user'=> decrypt_my($this->uri->segment(2)),'token_code'=>$this->uri->segment(3)))->num_rows();
        if(!$user){
            echo 'Halaman Ini Kedaluarsa';
        }else{
            $this->load->view('auth/reset-page');
        }
    }

    public function resetPassword(){
        $user = $this->auth->getTbUser(array('id_user'=> decrypt_my($this->input->post('id')),'token_code'=>$this->input->post('token')))->first_row();
        if(!$user){
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $change = $this->auth->getChangePass();
            if($change){//setelah password berhasil di ubah, otomatis token ikut diubah
                $this->auth->getChangeToken($user->email);
                echo 'berhasil';
            }else{
                echo 'Gagal';
            }
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


    public function checkRole($username)
    {
        $user = $this->auth->getUser('username',$this->input->post('username'));

        if (($user['status_user'] == 'W') or ($user['status_user'] == 'N')) {
            $this->form_validation->set_message('checkRole', 'username is not activated');
            return false;
        }

        return true;
    }

    public function checkPassword($password)
    {
		$user = $this->auth->getUser('username',$this->input->post('username'));

        if($user){
            if($this->attempt->find('BLOCKED')->first_row()){
                $this->form_validation->set_message('checkPassword', '');
                return false;
            }elseif(!$this->auth->checkPassword($user['username'], $password)) {
                $this->form_validation->set_message('checkPassword', 'password is incorrect');
                $this->attempt->getFail();//memanggail fungsi fail untuk blok user naantinya
                return false;
            }
        }

        return true;

    }

    public function checkBlock()
    {
        $find = $this->attempt->getBlock();
        if(empty($find)){
            $this->form_validation->set_message('checkBlock', 'username is blocked');
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
