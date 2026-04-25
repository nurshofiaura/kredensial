<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Default
*/
$route['default_controller'] = 'landing';

/*
| Auth
*/
/*$route['login']  = 'masuk/index';
$route['login']  = 'masuk/index';*/
$route['logout'] = 'masuk/logout';

/*
| 404
*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;