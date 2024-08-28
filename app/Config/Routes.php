<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->setAutoRoute('/');

$routes->group('', ['filter' => 'authCheck'], function($routes) {
    $routes->get('/', 'Home::index');

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