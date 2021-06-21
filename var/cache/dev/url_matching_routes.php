<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/logout' => [[['_route' => 'app_users_logout', '_controller' => 'App\\Controller\\UsersController::logout'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api/users/(?'
                    .'|show/(?'
                        .'|([^/]++)(*:37)'
                        .'|all(*:47)'
                    .')'
                    .'|delete/([^/]++)(*:70)'
                    .'|update/(?'
                        .'|username/([^/]++)/([^/]++)(*:113)'
                        .'|password/([^/]++)/([^/]++)(*:147)'
                    .')'
                .')'
                .'|/register/([^/]++)/([^/]++)(*:184)'
                .'|/login/([^/]++)/([^/]++)(*:216)'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:252)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        37 => [[['_route' => 'app_users_list', '_controller' => 'App\\Controller\\UsersController::list'], ['id'], ['GET' => 0], null, false, true, null]],
        47 => [[['_route' => 'app_users_all', '_controller' => 'App\\Controller\\UsersController::all'], [], ['GET' => 0], null, false, false, null]],
        70 => [[['_route' => 'app_users_deleteuser', '_controller' => 'App\\Controller\\UsersController::deleteUser'], ['id'], ['POST' => 0], null, false, true, null]],
        113 => [[['_route' => 'app_users_updateusername', '_controller' => 'App\\Controller\\UsersController::updateUsername'], ['username', 'newUsername'], ['POST' => 0], null, false, true, null]],
        147 => [[['_route' => 'app_users_updatepassword', '_controller' => 'App\\Controller\\UsersController::updatePassword'], ['username', 'passwordNew'], ['POST' => 0], null, false, true, null]],
        184 => [[['_route' => 'app_users_registeruser', '_controller' => 'App\\Controller\\UsersController::registerUser'], ['username', 'password'], ['POST' => 0], null, false, true, null]],
        216 => [[['_route' => 'app_users_loginuser', '_controller' => 'App\\Controller\\UsersController::loginUser'], ['username', 'password'], ['POST' => 0], null, false, true, null]],
        252 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
