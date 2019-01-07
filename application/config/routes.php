<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['login']                     = 'auth';
$route['forgot']                    = 'auth/forgot';
$route['logout']                    = 'auth/logout';
$route['reset-page/(:any)/(:any)']  = 'auth/resetPage';
$route['reset-get']                 = 'auth/resetPassword';

$route['daftar']                    = 'register';
$route['confirm/(:any)/(:any)']     = 'register/konfirmasi';

$route['default_controller']    = 'auth';
$route['404_override']          = '';
$route['translate_uri_dashes'] = FALSE;
