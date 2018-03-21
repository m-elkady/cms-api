<?php
use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);
$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\Modules\Auth\Controllers', 'prefix' => 'new-auth'], function (Router $api) {
        $api->post('login', 'LoginController@login');
        $api->post('refresh', 'RefreshController@refresh');
    });

});
