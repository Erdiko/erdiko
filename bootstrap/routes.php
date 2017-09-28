<?php
// Application Routes

$app->get('/', function ($request, $response, $args) {
    // Render index view
    return $this->theme->render($response, 'slim.phtml', $args);
});

// Controller
//$app->get('/controller[/{name}]', \app\controllers\Home::class)
//    ->setName('home');

// Render Twig template in route
// $app->any('/render/[{name}]', function ($request, $response, $args) {
//     // Erdiko setup (load configs)
//     // $erdiko = \erdiko\App;
//     // $erdiko->load('application');
//     $this->logger->debug("/render");
//     $config = \erdiko\Config::get('application');
//     if (isset($appConfig['theme']['namespace'])) {
//         $themeConfig = new \erdiko\theme\Config;
//         $themeConfigArr = $themeConfig->getThemeConfig($appConfig['theme']['namespace']);
//     }

//     $view = 'views/invoke.html';

//     return $this->theme->render($response, $view, [
//         'name' => $args['name'],
//         'title' => "Erdiko Theme",
//         'application' => $appConfig,
//         'theme' => $themeConfigArr
//     ]);
// })->setName('invoke');

// Render Twig template in route
$app->get('/examples/config', \app\controllers\Config::class);

// Session Tests
$app->get('/examples/session', \app\controllers\examples\Session::class);

// Doctrine (database) Tests
$app->get('/examples/database', \app\controllers\examples\Database::class);

// Web Controller
$app->any('/examples/{action}/[{param}]', \app\controllers\Examples::class)
    ->setName('examples');

// Web Controller
$app->any('/examples[/{action}]', \app\controllers\Examples::class)
    ->setName('examples2');

// REST Controller
$app->any('/rest/{resource}[/{id}]', \app\controllers\Rest::class)
    ->setName('rest');

// REST Controller, two key/value pairs
$app->any('/rest/{resource}/{id}/{sub_resource}[/{sub_id}]', \app\controllers\Rest::class)
    ->setName('rest2');

// Web Controller

$app->any('/log[/{action}]', \app\controllers\LogController::class)
    ->setName('logaction');

// // Web Controller
$app->any('/log/{action}/[{param}]', \app\controllers\LogController::class)
    ->setName('logactionparam');

// Web Controller

$app->any('/create[/{action}]', \app\controllers\LogCreateController::class)
    ->setName('createevent');