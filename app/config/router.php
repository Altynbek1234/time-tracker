<?php

$router = $di->getRouter();
$router->add(
    '/user',
    [
        'controller' => 'user',
        'action'     => 'index',
    ]


);
$router->add(
    '/userid/{id}',
    [
        'controller' => 'tracker',
        'action'     => 'times',
    ]
);
$router->handle();
