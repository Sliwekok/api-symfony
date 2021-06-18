<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/users' => [[['_route' => 'list_all_users', '_controller' => 'App\\Controller\\UsersController::all'], null, ['GET' => 0], null, false, false, null]],
        '/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\UsersController::logout'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/users/(?'
                    .'|([^/]++)(*:64)'
                    .'|delete/([^/]++)(*:86)'
                    .'|update/(?'
                        .'|username/([^/]++)/([^/]++)(*:129)'
                        .'|password/([^/]++)/([^/]++)/([^/]++)(*:172)'
                    .')'
                .')'
                .'|/register/([^/]++)/([^/]++)(*:209)'
                .'|/login/([^/]++)/([^/]++)(*:241)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        64 => [[['_route' => 'list_user', '_controller' => 'App\\Controller\\UsersController::list'], ['id'], ['GET' => 0], null, false, true, null]],
        86 => [[['_route' => 'delete_user', '_controller' => 'App\\Controller\\UsersController::deleteUser'], ['id'], ['POST' => 0], null, false, true, null]],
        129 => [[['_route' => 'update_username', '_controller' => 'App\\Controller\\UsersController::updateUsername'], ['username', 'newUsername'], ['POST' => 0], null, false, true, null]],
        172 => [[['_route' => 'update_password', '_controller' => 'App\\Controller\\UsersController::updatePassword'], ['username', 'password', 'newPassword'], ['POST' => 0], null, false, true, null]],
        209 => [[['_route' => 'register_user', '_controller' => 'App\\Controller\\UsersController::registerUser'], ['username', 'password'], ['POST' => 0], null, false, true, null]],
        241 => [
            [['_route' => 'login', '_controller' => 'App\\Controller\\UsersController::loginUser'], ['username', 'password'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
