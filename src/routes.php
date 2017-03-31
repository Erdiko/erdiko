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
$app->get('/theme/{name}', function ($request, $response, $args) {
    // Erdiko setup (load configs)
    // $erdiko = \erdiko\App;
    // $erdiko->load('application');
    $this->logger->info("/theme");
    $config = \erdiko\Config::get('application');
    if (isset($appConfig['theme']['namespace']))
    {
        $themeConfig = new \erdiko\theme\Config;
        $themeConfigArr = $themeConfig->getThemeConfig($appConfig['theme']['namespace']);
    }

    $view = 'views/page.html';
    
    return $this->theme->render($response, $view, [
        'name' => $args['name'],
        'title' => "Erdiko Theme",
        'application' => $appConfig,
        'theme' => $themeConfigArr
    ]);
});

// Render Twig template in route
$app->any('/render/[{name}]', function ($request, $response, $args) {
    // Erdiko setup (load configs)
    // $erdiko = \erdiko\App;
    // $erdiko->load('application');
    $this->logger->debug("/render");
    $config = \erdiko\Config::get('application');
    if (isset($appConfig['theme']['namespace'])) {
        $themeConfig = new \erdiko\theme\Config;
        $themeConfigArr = $themeConfig->getThemeConfig($appConfig['theme']['namespace']);
    }
    
    $view = 'views/invoke.html';
    
    return $this->theme->render($response, $view, [
        'name' => $args['name'],
        'title' => "Erdiko Theme",
        'application' => $appConfig,
        'theme' => $themeConfigArr
    ]);
})->setName('invoke');

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
