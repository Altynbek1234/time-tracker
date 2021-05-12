<?php

$router = $di->getRouter();
$router->add(
//    '/test',
//    [
//        'controller' => 'signup',
//        'action'     => 'register',
//    ],
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
