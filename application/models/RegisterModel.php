<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegisterModel extends CI_Model
{
    private $_tb = 'tbu_user';

    public function put()
    {
        $this->load->helper('string');
        $_SESSION['token'] = random_string('alnum', 16);

        $data = array(
            'username'      => $this->input->post('username',TRUE),
            'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'status_user'   => 'W',
            'email'         => $this->input->post('email',TRUE),
            'username'      => $this->input->post('username',TRUE),
            'token_code'    => $_SESSION['token'],
            'id_jabatan'    => '1',
            'id_group'      => '1',
            'hidden'        => '0',
            'user_create'   => '0'
        );

        return $this->db->insert($this->_tb, $data);
    }

    public function confirm()
    {
        $dtarray = array(
            'status_user'   => 'Y'
        );

        $wrarray = array(
            'id_user'       => decrypt_my($this->uri->segment(2)),
            'token_code'    => $this->uri->segment(3),
            'status_user'   => 'W'
        );
        $this->db->where($wrarray);
        return $this->db->update($this->_tb, $dtarray);

    }
    public function confirmCode()
	{
		date_default_timezone_set("Asia/Jakarta");
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

    function getUser($wrarray){
        return $this->db->get_where($this->_tb,$wrarray);
    }

    function getMail($id){
        $this->load->model('EmailModel');
        $dt = $this->getUser(array('id_user'=>$id))->first_row();

        $subject    = 'Registrasi User';
        $link       = site_url('confirm/'.encrypt_my($id).'/'.$dt->token_code);
        $object     = 'Email '.$dt->email.'berhasil di registrasikan, klik tautan berikut ini untuk melakukan aktivasi <a href="'.$link.'">Link</a>'; 
        
        $getMail    = $this->EmailModel->getSend($dt->email,$subject,$object);

         return $getMail;
    }

}