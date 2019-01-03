<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RegisterModel extends CI_Model
{
    private $_table = 'tbu_user';
//Belum Matang
    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'price',
            'label' => 'Price',
            'rules' => 'numeric'],
            
            ['field' => 'description',
            'label' => 'Description',
            'rules' => 'required']
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
            'hidden'        => 'hidden',
            'user_create'   => '0'
        );

        return $this->db->insert('tbu_user', $data);
    }
}