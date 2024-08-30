<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->setAutoRoute('/');
$routes->get('auth/forbidden', 'Auth::forbidden');
$routes->match(['get', 'post'], 'auth/login', 'Auth::login');
$routes->match(['get', 'post'], 'auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

//filter
$routes->group('', ['filter' => 'authCheck'], function($routes) {
    $routes->get('home', 'Home::index');
    $routes->get('user', 'User::index');
    $routes->get('item', 'Item::index');
    $routes->get('transaction', 'Transaction::index');

    $routes->match(['get', 'post'], 'user/update/(:num)', 'User::updateUser/$1');
    $routes->get('user/delete/(:num)', 'User::deleteUser/$1');

    //untuk crud transaksi barang
    $routes->match(['get', 'post'], 'transaction/add', 'Transaction::addTransaction');
    $routes->match(['get', 'post'], 'transaction/update/(:num)', 'Transaction::updateTransaction/$1');
    $routes->get('transaction/delete/(:num)', 'Transaction::deleteTransaction/$1');

    //untuk crud barang 
    $routes->match(['get', 'post'], 'item/add', 'Item::addItem');
    $routes->match(['get', 'post'], 'item/update/(:num)', 'Item::updateItem/$1');
    $routes->get('item/delete/(:num)', 'Item::deleteItem/$1');
});