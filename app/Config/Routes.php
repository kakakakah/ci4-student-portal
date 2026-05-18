<?php


use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');


$routes->get( 'register',           'Auth::register');
$routes->post('register',           'Auth::store');


$routes->get('students',            'Students::index');
$routes->get('students/(:num)',     'Students::show/$1');


$routes->get( 'upload',             'Upload::index');
$routes->post('upload',             'Upload::store');
$routes->get( 'upload/success/(:any)', 'Upload::success/$1');
