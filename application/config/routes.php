<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login']     = 'auth';
$route['forgot']    = 'auth/forgot';
$route['logout']    = 'auth/logout';
$route['daftar']    = 'register';

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
