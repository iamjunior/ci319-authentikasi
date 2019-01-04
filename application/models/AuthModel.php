<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AuthModel extends CI_Model
{
    private $_tb = 'tbu_user';


    public function getUser($key, $value)
    {
        $wrarray = array(
            $key            => $value,
            'status_user'   => 'Y');

        $q = $this->db->get_where($this->_tb, $wrarray);
            if(!empty($q->row_array())) {
                return $q->row_array();
        }

        return false;
    }

    public function checkPassword($username, $password)
    {
        $hash = $this->getUser('username', $username)['password'];
        if (password_verify($password, $hash)) {
            return true;
        }

        return false;
    }

}