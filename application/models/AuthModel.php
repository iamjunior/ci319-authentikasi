<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    private $_tb = 'tbu_user';



    public function checkPassword($username, $password)
    {
        $hash = $this->getUser('username', $username)['password'];
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }

    public function getUser($key, $value)
    {
        $wrarray = array(
            $key            => $value);

        $q = $this->db->get_where($this->_tb, $wrarray);
            if(!empty($q->row_array())) {
                return $q->row_array();
        }

        return false;
    }

    public function getTbUser($wrarray)
    {
        return $this->db->get_where($this->_tb,$wrarray);
    }

    public function getChangeToken($email){//getMailForgot
        $this->load->helper('string');

        $dtarray = array(
            'token_code'   => random_string('alnum', 16)
        );
        $this->db->where('email',$email);
        return $this->db->update($this->_tb,$dtarray);
    }

    public function getMailForgot($email){
        $this->load->model('EmailModel');
        $this->getChangeToken($email);
        $dt = $this->getUser('email', $email);

        $subject    = 'Registrasi User';
        $link       = site_url('reset-page/'.encrypt_my($dt['id_user']).'/'.$dt['token_code']);
        $object     = 'Silahkan Klik tautan berikut ini untuk mengarahkan ke halaman reset password <a href="'.$link.'">Link</a>'; 
        
        $getMail    = $this->EmailModel->getSend($email,$subject,$object);

         return $getMail;
    }

    public function getChangePass(){
        $wrarray = array(
            'id_user'   => decrypt_my($this->input->post('id')),
            'token_code'=> $this->input->post('token')
        );
        $dtarray = array(
            'password'  => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );

        $this->db->where($wrarray);
        return $this->db->update($this->_tb,$dtarray);
    }
}