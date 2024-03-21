<?php

include_once './src/config/Request.php';
include_once './src/config/Router.php';
include_once './src/controllers/TicketController.php';

$router = new Router(new Request);

$router->get('/', function () {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});


$router->get('/ticket/get', function ($request) {
  $lib = new TicketController();
  return $lib->getById($request->getBody());
});

$router->post('/ticket/update', function ($request) {
  $lib = new TicketController();
  return $lib->update($request->getBody());
});
