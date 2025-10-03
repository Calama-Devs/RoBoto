<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/view-verify-phone', 'Home::viewVerificaContato');
$routes->post('/verify-phone', 'Home::verifyPhone');

//Rota Webhook
$routes->post('webhook/response', 'WebhookController::response');

$routes->group('faiss-loader', function($routes) {
    $routes->get('add', 'FaissLoader::addDoc');
    $routes->get('query', 'FaissLoader::queryDoc');
});

$routes->group('faiss-test', function($routes) {
    $routes->get('add', 'FaissTest::add');
    $routes->get('query', 'FaissTest::query');
    $routes->get('list', 'FaissTest::list');
    $routes->get('delete/(:num)', 'FaissTest::delete/$1');
});

$routes->group('faiss-meta', function($routes) {
    $routes->get('add', 'FaissMetaTest::add');
    $routes->get('query', 'FaissMetaTest::query');
});

