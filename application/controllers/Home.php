<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->loggedIn();
	}

	public function index()
	{
		$this->load->view('home/home.php');
	}
}
