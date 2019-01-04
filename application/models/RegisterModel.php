<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegisterModel extends CI_Model
{
    private $_table = 'tbu_user';

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
            'rules' => 'required|callback_confirmCode']
        ];
    }

    public function insertRegister()
    {
        $this->load->helper('string');
        $_SESSION['token'] = random_string('alnum', 16);

        $data = array(
            'username'      => $this->input->post('username',TRUE),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'status_user'   => 'Y',
            'email'         => $this->input->post('email',TRUE),
            'username'      => $this->input->post('username',TRUE),
            'token_code'    => $_SESSION['token'],
            'id_jabatan'    => '1',
            'id_group'      => '1',
            'hidden'        => '0',
            'user_create'   => '0'
        );

        return $this->db->insert('tbu_user', $data);
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

        if($this->input->post('confirm') != $code) {
            $this->form_validation->set_message('confirmRoot', 'confirm code is incorrect');
            return false;
        }

        return true;
	}
}