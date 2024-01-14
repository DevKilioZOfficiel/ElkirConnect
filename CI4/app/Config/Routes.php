<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
 $routes->setDefaultNamespace('App\Controllers');
 $routes->setDefaultController('Home');
 $routes->setDefaultMethod('index');
 $routes->setTranslateURIDashes(false);
 $routes->set404Override();
 $routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->add('login', 'Auth::login', ['as' => 'login']);
$routes->post('login_post', 'Auth::login_post');
$routes->post('forgot_post', 'Auth::forgot_post');
$routes->add('logout', 'Auth::logout');
$routes->add('register', 'Auth::register', ['as' => 'register']);
$routes->post('register_post', 'Auth::register_post');

$routes->add('api/(:any)/(:any)', 'Api::index/$1/$2');
$routes->post('api/(:any)/(:any)', 'Api::index/$1/$2');

$routes->add('dashboard', 'Dashboard::index');
$routes->add('dashboard/new', 'Dashboard::new');
$routes->post('dashboard/sendproject', 'Dashboard::sendproject');

$routes->post('/import/(:any)', 'Project::import/$1');
$routes->add('project/(:any)/settings', 'Project::settings/$1');
$routes->add('project/(:any)', 'Project::index/$1');


$routes->add('admin/project/(:any)', 'Admin::project/$1');
$routes->add('admin/user/(:any)', 'Admin::user/$1');
$routes->add('admin/(:any)', 'Admin::index/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
