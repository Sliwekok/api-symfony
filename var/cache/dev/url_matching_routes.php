<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\AuthController::logout'], null, ['POST' => 0], null, false, false, null]],
        '/api/users/list' => [[['_route' => 'list_all_users', '_controller' => 'App\\Controller\\UsersController::list'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/register/([^/]++)/([^/]++)(*:34)'
                .'|/login/([^/]++)/([^/]++)(*:65)'
                .'|/api/users/(?'
                    .'|show/([^/]++)(*:99)'
                    .'|delete/([^/]++)(*:121)'
                    .'|update/password/([^/]++)/([^/]++)(*:162)'
                .')'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:199)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        34 => [[['_route' => 'register_user', '_controller' => 'App\\Controller\\AuthController::registerUser'], ['username', 'password'], ['POST' => 0], null, false, true, null]],
        65 => [[['_route' => 'login_user', '_controller' => 'App\\Controller\\AuthController::loginUser'], ['username', 'password'], ['POST' => 0], null, false, true, null]],
        99 => [[['_route' => 'show_user', '_controller' => 'App\\Controller\\UsersController::show'], ['id'], ['POST' => 0], null, false, true, null]],
        121 => [[['_route' => 'delete_user', '_controller' => 'App\\Controller\\UsersController::deleteUser'], ['id'], ['POST' => 0], null, false, true, null]],
        162 => [[['_route' => 'update_username', '_controller' => 'App\\Controller\\UsersController::updatePassword'], ['username', 'passwordNew'], ['POST' => 0], null, false, true, null]],
        199 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
