<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class AttemptsModel extends CI_Model{

    public $_tb  = "tbu_attempt";

    /*
        Fungsi Jika User mencoba menebak-nebak pwd/username
        percobaan kali alamat akan di blokir

        Rule getFail:
        1. Jika data belum ada, eksekusi Put
        2. Jika sudah ada +1 pada total_attempt
        3. Jika total_attempt >=2, ubah status_attempt = BLOCKED dan total_attempt +1

    */

    function getFail(){
        if($this->find('BLOCKED')->first_row()){
            $q = true;
        }elseif($this->find('OPEN')->first_row()){    
            $find = $this->find('OPEN')->first_row();
            if($find->total_attempt >=2){
                $this->db->where('id_attempt',$find->id_attempt);
                $q = $this->db->update($this->_tb,array('total_attempt'=> $find->total_attempt+1,'status_attempt'=> 'BLOCKED','time_attempt'=>date('Y-m-d H:i:s')));
            }else{
                $this->db->where('id_attempt',$find->id_attempt);
                $q = $this->db->update($this->_tb,array('total_attempt'=> $find->total_attempt+1,'time_attempt'=>date('Y-m-d H:i:s')));
            }
        }else{
            $q = $this->Put();
        }
        return $q;
    }
    /*
        Rule getBlock:
        1. Jika waktu skrg >= time_attempt+1 status_attempt jadi close blokir sudah dibuka
        2. Jika masih dalam masa blokir tetap mencoba login, update waktu sekarang
    */
    function getBlock(){
        if($this->find('BLOCKED')->first_row()){
            $find = $this->find('BLOCKED')->first_row();
            $tglclose = (new DateTime($find->time_attempt))->modify("+1 minutes")->format("Y-m-d H:i:s");
            if(strtotime(date('Y-m-d H:i:s')) >= strtotime($tglclose)){
                $this->db->where('id_attempt',$find->id_attempt);
                $this->db->update($this->_tb,array('status_attempt'=> 'CLOSE'));
                $q = true;
            }else{
                $q = false;
            }
        }else{
            $q = true;
        }
        return $q;
    }
    /**
        Rule getSuccess
        1. Jika berhasil lakukan edit status_attempt yang tadinya OPEN/BLOCKED menjadi CLOSE
     */
    function getSuccess(){
        if($this->find('OPEN')->first_row()){
            $open   = $this->find('OPEN')->first_row();
            $this->db->where('id_attempt',$open->id_attempt);
            $this->db->update($this->_tb,array('status_attempt'=> 'CLOSE'));
            $q = true;
        }elseif($this->find('BLOCKED')->first_row()){
            $close  = $this->find('BLOCKED')->first_row();
            $this->db->where('id_attempt',$close->id_attempt);
            $this->db->update($this->_tb,array('status_attempt'=> 'CLOSE'));
            $q = true;
        }else{
            $q = true;
        }
        return $q;
    }

    function find($status){
        $wrarray = array(
            'username'        => $this->input->post('username'),
            'date_attempt'    => date('Y-m-d'),
            'status_attempt'  => $status
        );

        return $this->db->get_where($this->_tb,$wrarray);
    }

    function Put(){
        $dtarray = array(
            'username'        => $this->input->post('username'),
            'time_attempt'    => date('Y-m-d H:i:s'),
            'date_attempt'    => date('Y-m-d'),
            'total_attempt'   => '1'
        );
       return $this->db->insert($this->_tb,$dtarray);
    }



}