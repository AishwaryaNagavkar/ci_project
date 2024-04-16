<?php

use CodeIgniter\Router\RouteCollection;


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Employee');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Employee::index');
$routes->get('employee', 'Employee::index');
$routes->match(['get', 'post'], 'employee/create', 'Employee::create');
$routes->match(['get', 'post'], 'employee/save_employee', 'Employee::save_employee');
$routes->match(['get', 'post'], 'employee/edit/(:segment)', 'Employee::edit/$1');
$routes->get('employee/delete/(:segment)', 'Employee::delete/$1');