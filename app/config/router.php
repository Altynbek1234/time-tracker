<?php
$router = $di->getRouter();
$router->add('/user', [
        'controller' => 'user',
        'action'     => 'index',
    ]
);
$router->add('/login', [
        'controller' => 'session',
        'action'     => 'login',
    ]
);
$router->add('/profiles', [
        'controller' => 'profiles',
        'action'     => 'index',
    ]
);

$router->add('/holidays', [
    'controller' => 'holidays',
    'action' => 'index',
]);

$router->handle();