<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Back\\AdminController::index'], null, null, null, false, false, null]],
        '/admin/client' => [[['_route' => 'customer_list_admin', '_controller' => 'App\\Controller\\Back\\AdminCustomerController::listCustomers'], null, null, null, false, false, null]],
        '/admin/client/ajouter' => [[['_route' => 'customer_add_admin', '_controller' => 'App\\Controller\\Back\\AdminCustomerController::index'], null, null, null, false, false, null]],
        '/admin/statut' => [[['_route' => 'status_list_admin', '_controller' => 'App\\Controller\\Back\\AdminStatusController::listStatus'], null, null, null, true, false, null]],
        '/admin/statut/ajouter' => [[['_route' => 'status_add_admin', '_controller' => 'App\\Controller\\Back\\AdminStatusController::addStatus'], null, null, null, false, false, null]],
        '/admin/liste-des-taches-p2/ajouter' => [[['_route' => 'task2_list_add_admin', '_controller' => 'App\\Controller\\Back\\AdminTask2Controller::index'], null, null, null, false, false, null]],
        '/admin/liste-des-taches' => [[['_route' => 'task_list_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::listTask'], null, null, null, true, false, null]],
        '/admin/liste-des-taches-p1/ajouter' => [[['_route' => 'task_list_add_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::index'], null, null, null, false, false, null]],
        '/admin/liste-des-taches/rendez-vous/ajouter' => [[['_route' => 'task_appointment_add_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::addTaskAppointment'], null, null, null, false, false, null]],
        '/admin/liste-des-taches/devis/ajouter' => [[['_route' => 'task_quote_add_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::addTaskQuote'], null, null, null, false, false, null]],
        '/admin/liste-des-taches/telecharger' => [[['_route' => 'task_list_download_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::taskDownload'], null, null, null, false, false, null]],
        '/admin/utilisateurs' => [[['_route' => 'user_admin', '_controller' => 'App\\Controller\\Back\\AdminUserController::index'], null, null, null, false, false, null]],
        '/admin/utilisateurs/ajouter' => [[['_route' => 'user_add_admin', '_controller' => 'App\\Controller\\Back\\AdminUserController::addUser'], null, null, null, false, false, null]],
        '/compte' => [[['_route' => 'account', '_controller' => 'App\\Controller\\Front\\AccountController::index'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\Front\\HomeController::index'], null, null, null, false, false, null]],
        '/compte/gestion-du-compte' => [[['_route' => 'gestion_compte', '_controller' => 'App\\Controller\\Front\\ManageAccountController::index'], null, null, null, false, false, null]],
        '/inscription' => [[['_route' => 'register', '_controller' => 'App\\Controller\\Front\\RegisterController::index'], null, null, null, false, false, null]],
        '/inscription/tu-es-bien-inscris' => [[['_route' => 'register_message_success', '_controller' => 'App\\Controller\\Front\\RegisterController::registerOk'], null, null, null, false, false, null]],
        '/connexion/reinitialiser-le-mot-de-passe' => [[['_route' => 'app_forgot_password_request', '_controller' => 'App\\Controller\\Front\\ResetPasswordController::request'], null, null, null, false, false, null]],
        '/connexion/reinitialiser-le-mot-de-passe/email-envoye' => [[['_route' => 'app_check_email', '_controller' => 'App\\Controller\\Front\\ResetPasswordController::checkEmail'], null, null, null, false, false, null]],
        '/connexion/reinitialiser-le-mot-de-passe/succes' => [[['_route' => 'reset_password_change_message_sucess', '_controller' => 'App\\Controller\\Front\\ResetPasswordController::changePasswordMessageSuccess'], null, null, null, false, false, null]],
        '/connexion' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\Front\\SecurityController::login'], null, null, null, false, false, null]],
        '/deconnexion' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\Front\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/admin/(?'
                    .'|client/([^/]++)/(?'
                        .'|supprimer(*:207)'
                        .'|modifier(*:223)'
                    .')'
                    .'|statut/([^/]++)/supprimer(*:257)'
                    .'|liste\\-des\\-taches(?'
                        .'|\\-p2/([^/]++)/(?'
                            .'|supprimer(*:312)'
                            .'|modifier(*:328)'
                        .')'
                        .'|/(?'
                            .'|([^/]++)/(?'
                                .'|supprimer(*:362)'
                                .'|modifier(*:378)'
                            .')'
                            .'|rendez\\-vous/([^/]++)/(?'
                                .'|modifier(*:420)'
                                .'|supprimer(*:437)'
                            .')'
                            .'|devis/([^/]++)/(?'
                                .'|modifier(*:472)'
                                .'|supprimer(*:489)'
                            .')'
                        .')'
                    .')'
                    .'|utilisateurs/([^/]++)/(?'
                        .'|supprimer(*:534)'
                        .'|modifier(*:550)'
                    .')'
                .')'
                .'|/delete/account/([^/]++)(*:584)'
                .'|/connexion/reinitialiser\\-le\\-mot\\-de\\-passe/changer(?:/([^/]++))?(*:658)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        207 => [[['_route' => 'customer_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminCustomerController::deleteStatut'], ['id'], null, null, false, false, null]],
        223 => [[['_route' => 'customer_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminCustomerController::modifyTask'], ['id'], null, null, false, false, null]],
        257 => [[['_route' => 'status_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminStatusController::deleteStatus'], ['id'], null, null, false, false, null]],
        312 => [[['_route' => 'task2_list_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminTask2Controller::deleteTask2'], ['id'], null, null, false, false, null]],
        328 => [[['_route' => 'task2_list_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminTask2Controller::modifyTask2'], ['id'], null, null, false, false, null]],
        362 => [[['_route' => 'task_list_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::deleteTask'], ['id'], null, null, false, false, null]],
        378 => [[['_route' => 'task_list_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::modifyTask'], ['id'], null, null, false, false, null]],
        420 => [[['_route' => 'task_appointment_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::modifyAppointment'], ['id'], null, null, false, false, null]],
        437 => [[['_route' => 'task_appointment_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::deleteQuote'], ['id'], null, null, false, false, null]],
        472 => [[['_route' => 'task_quote_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::modifyQuote'], ['id'], null, null, false, false, null]],
        489 => [[['_route' => 'task_quote_detete_admin', '_controller' => 'App\\Controller\\Back\\AdminTaskController::deleteAppointment'], ['id'], null, null, false, false, null]],
        534 => [[['_route' => 'user_admin_delete', '_controller' => 'App\\Controller\\Back\\AdminUserController::deleteUser'], ['id'], null, null, false, false, null]],
        550 => [[['_route' => 'user_modify_admin', '_controller' => 'App\\Controller\\Back\\AdminUserController::modifyUser'], ['id'], null, null, false, false, null]],
        584 => [[['_route' => 'delete_account', '_controller' => 'App\\Controller\\Front\\DeleteAccountController::deleteUserAction'], ['userId'], null, null, false, true, null]],
        658 => [
            [['_route' => 'app_reset_password', 'token' => null, '_controller' => 'App\\Controller\\Front\\ResetPasswordController::reset'], ['token'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
