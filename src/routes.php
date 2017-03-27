<?php
// Routes

$app->get('/', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'slim.phtml', $args);
});

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
})->setName('theme');

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
$app->get('/examples/{action}/[{param}]', \app\controllers\Examples::class)
    ->setName('examples2');

// Web Controller
$app->get('/examples[/{action}]', \app\controllers\Examples::class)
    ->setName('examples');

// Controller
//$app->get('/controller[/{name}]', \app\controllers\Home::class)
//    ->setName('home');

// REST Controller
$app->get('/rest/{resource}[/{id}]', \app\controllers\Home::class)
    ->setName('rest');

// REST Controller, two key/value pairs
$app->get('/rest/{resource}/{id}/{sub_resource}[/{sub_id}]', \app\controllers\Home::class)
    ->setName('rest2');
