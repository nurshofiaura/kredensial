<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$route['(:any)'] = 'login/$1';
$route['logout'] = 'masuk/logout';
//$route['default_controller'] = 'login';
$route['default_controller'] = 'landing';
$route['404_override'] = 'masuk';
$route['translate_uri_dashes'] = FALSE;
