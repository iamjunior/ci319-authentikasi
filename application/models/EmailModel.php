<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class EmailModel extends CI_Model
{
    private $_tb = 'tbm_email';


        function getMail(){
            $mail = $this->db->get_where($this->_tb, array('id_email' => '1'))->first_row();
            return $mail;
        }
        
        function getSendmail($emailtujuan,$subject_email,$isi_email){
        // Konfigurasi email.
        $mail = $this->getMail();
        $config = [
                'useragent' => 'CodeIgniter',
                'protocol'  => 'smtp',
                'mailpath'  => '/usr/sbin/sendmail',
                'smtp_host' => 'ssl://'.$mail->smtp_host,
                'smtp_user' => $mail->smtp_user,   // Ganti dengan email gmail Anda.
                'smtp_pass' => $mail->smtp_password,             // Password gmail Anda.
                'smtp_port' => $mail->smtp_port,
                'smtp_keepalive' => TRUE,
                'smtp_crypto' => 'SSL',
                'wordwrap'  => TRUE,
                'wrapchars' => 80,
                'mailtype'  => 'html',
                'charset'   => 'utf-8',
                'validate'  => TRUE,
                'crlf'      => "\r\n",
                'newline'   => "\r\n",
            ];
        // $config = [
        //             'protocol' => 'smtp',
        //             'smtp_host' => 'smtp.mailtrap.io',
        //             'smtp_port' => 2525,
        //             'smtp_user' => '047b67b78ee8cd',
        //             'smtp_pass' => '4950e0e467f680',
        //             'crlf' => "\r\n",
        //             'newline' => "\r\n"
        // ];

        // Load library email dan konfigurasinya.
        $this->load->library('email', $config);

        // Pengirim dan penerima email.
        $this->email->from($mail->smtp_user, $mail->sending_name);    // Email dan nama pegirim.
        $this->email->to($emailtujuan);                       // Penerima email.

        // Subject email.
        $this->email->subject($subject_email);

        // Isi email. Bisa dengan format html.
        $this->email->message($isi_email);

        return $this->email->send();

    }


    /*
        Masuk Ke Bagian FrontEnd
    */

    function getForgot($email){
        $mail     = $this->getMail();
        
        $getMail  ='';
        if ($mail->status_aktif != 'Y'){
            $getMail = 'N';
        }else{
            $subject    = 'Ini Email Percobaan';
            $object     = 'Berhasil Di Reset Silahkan Klik Tahutan Ini'; 
            $mailTo = $this->getSendmail($email,$subject,$object);

            $getMail = $mailTo;
        }
         return $getMail;
        }
}