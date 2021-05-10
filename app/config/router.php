<?php

$router = $di->getRouter();
//$router->add(
//    '/test',
//    [
//        'controller' => 'signup',
//        'action'     => 'register',
//    ]
//);
$router->handle();
