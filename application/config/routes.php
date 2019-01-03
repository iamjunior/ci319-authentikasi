<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login']     = 'auth/login';
$route['daftar']    = 'auth/register';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
