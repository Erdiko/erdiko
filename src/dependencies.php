<?php
// DIC configuration
$container = $app->getContainer();

// Monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Register flash provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};

// Theme view (erdiko, twig)
$container['theme'] = function ($container) {
    $settings = $container->get('settings')['theme'];
    $view = new \Slim\Views\Twig($settings['templates'], [
        'debug' => $settings['debug'],
        'cache' => $settings['cache']
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', 
        $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension(
        $container['router'], $basePath
    ));
    $view->addExtension(new Knlv\Slim\Views\TwigMessages(
        new Slim\Flash\Messages
    ));

    if($settings['debug'] == true)
        $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

// 404 Handler
$container['notFoundHandler'] = function ($container) {
    return function ($request, $response) use ($container) {
        $themeData = \erdiko\theme\Config::get();
        return $container['theme']->render($response->withStatus(404), '404.html', $themeData);
    };
};
