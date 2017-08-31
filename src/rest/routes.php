<?php
require_once 'vendor/autoload.php';

require_once  'routes/token.php';
require_once 'routes/users.php';
require_once 'routes/sites.php';
require_once  'routes/files.php';
require_once  'routes/other.php';
require_once  'routes/pp.php';
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://localhost')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});
