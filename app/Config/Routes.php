<?php


use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// ── Home ────────────────────────────────────────────────────
$routes->get('/', 'Home::index');

// ── Registration (Auth) ─────────────────────────────────────
$routes->get( 'register',           'Auth::register');
$routes->post('register',           'Auth::store');

// ── Student Directory (paginated + search) ──────────────────
$routes->get('students',            'Students::index');
$routes->get('students/(:num)',     'Students::show/$1');

// ── File Upload ─────────────────────────────────────────────
$routes->get( 'upload',             'Upload::index');
$routes->post('upload',             'Upload::store');
$routes->get( 'upload/success/(:any)', 'Upload::success/$1');

// ── Email Test ───────────────────────────
$routes->get('email-test',          'EmailTest::index');
