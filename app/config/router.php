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

$router->add('/latecomers', [
    'controller' => 'latecomers',
    'action' => 'index',
]);

$router->add('/tracker', [
    'controller' => 'tracker',
    'action' => 'index',
]);

$router->add('/update/{time_id}', [
    'controller' => 'users',
    'action' => 'update',
]);

$router->add('/time/{user_id}', [
    'controller' => 'users',
    'action' => 'time',
]);

$router->handle();