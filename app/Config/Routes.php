<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/pages/shop', 'Pages::shop');
$routes->get('/pages/lookbook', 'Pages::lookbook');
$routes->get('/pages/getDetail', 'Pages::getDetail');
$routes->get('/pages/shipping', 'Pages::shipping');
$routes->get('/pages/about', 'Pages::about');
$routes->get('/pages/lookbook/(:segment)', 'Pages::detail/$1');
$routes->get('/pages/cart', 'Pages::cart');
$routes->get('/pages/profile', 'Pages::profile');
$routes->get('/auth/login', 'Auth::index');
$routes->get('/auth/register', 'Auth::register');
$routes->get('/auth/registration', 'Auth::registration');
$routes->get('/auth/klikLogin', 'Auth::klikLogin');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/menu', 'Menu::index');
$routes->get('/menu/addMenu', 'Menu::addMenu');
$routes->get('/menu/editMenu', 'Menu::editMenu');
$routes->get('/menu/getMenu', 'Menu::getMenu');
$routes->get('/menu/submenu', 'Menu::submenu');
$routes->get('/menu/deltMenu/(:segment)', 'Auth::blocked');
$routes->get('/menu/submenu/deltSubMenu/(:segment)', 'Auth::blocked');
$routes->delete('/menu/(:num)', 'Menu::deltMenu/$1');
$routes->delete('/menu/submenu/(:num)', 'Menu::deltSubMenu/$1');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/role', 'Admin::role');
$routes->get('/admin/role/deltRole/(:segment)', 'Auth::blocked');
$routes->delete('/admin/role/(:num)', 'Admin::deltRole/$1');
$routes->get('/admin/role-access', 'Admin::roleAccess');
$routes->get('/admin/role-access/(:segment)', 'Admin::roleAccess/$1');
$routes->get('/admin/item', 'Admin::item');
$routes->get('/admin/lookbook', 'Admin::lookbook');
$routes->get('/admin/deltItem/(:segment)', 'Auth::blocked');
$routes->delete('/admin/(:num)', 'Admin::deltItem/$1');
$routes->delete('/admin/lookbook/(:num)', 'Admin::deltLookbook/$1');
$routes->get('/admin/lookbook/deltLookbook/(:segment)', 'Auth::blocked');
$routes->get('/pages/editProfile', 'Pages::editProfile');
$routes->get('/pages/changeProfile', 'Pages::changeProfile');
$routes->get('/pages/addCart', 'Pages::addCart');
$routes->get('/pages/addCartShop', 'Pages::addCartShop');
$routes->get('/pages/joinMember', 'Pages::joinMember');
$routes->get('/pages/checkout', 'Pages::checkout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
