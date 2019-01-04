<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login']     = 'auth/getLogin';
$route['daftar']    = 'register';

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
