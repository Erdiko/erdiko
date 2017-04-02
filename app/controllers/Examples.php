<?php
namespace app\controllers;

class Examples extends \erdiko\controllers\Web
{
    use \erdiko\theme\traits\Controller;

    public function get($request, $response, $args)
    {
        $view = 'examples/list.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        // $themeData['args'] = $args; // optional
        $themeData['page'] = [
            'title' => "Erdiko Web Example",
            'hello' => "world"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getJohn($request, $response, $args)
    {
        $view = 'pages/example.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['args'] = $args; // optional
        $themeData['page'] = [
            'title' => "Erdiko Web Example"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getMarkup($request, $response, $args)
    {
        $view = 'examples/markup.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['args'] = $args; // optional
        $themeData['page'] = [
            'title' => "Markup Example"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getCarousel($request, $response, $args)
    {
        $view = 'examples/carousel.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getTheme($request, $response, $args)
    {
        // $view = 'examples/theme.html';
        $theme = new \erdiko\theme\Engine;
        $theme->title = "Theme Engine Example";
        $theme->description = "This page is rendered using the theme engine.  
            \\erdiko\\theme\\Engine";

        return $this->render($response, null, $theme);
    }

    public function getFlash($request, $response, $args)
    {
        $view = 'bootstrap.html';

        // Add some flash messages
        $this->container->flash->addMessage('success', 'This is a success message');
        $this->container->flash->addMessage('info', 'This is an info message');
        $this->container->flash->addMessage('warning', 'This is a warning message');
        $this->container->flash->addMessage('danger', 'This is a danger (error) message'); 

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['args'] = $args;
        $themeData['page'] = [
            'title' => "Flash Message Example"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getGrid($request, $response, $args)
    {
        $this->container->logger->debug("/controller");
        $view = 'examples/grid.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        // $this->container->logger->debug("config: ".print_r($config, true));

        // Generate data for grid
        $item = [
            'url' => "#",
            'image' => "/images/grid-item.png",
            'name' => "Item"
        ];
        $items = array();
        $max = (int)$args['param'];
        $this->container->logger->debug("param: ".$max);

        for($i = 0; $i < $max; $i++) {
            $item['name'] = "Item $i";
            $items[] = $item;
        }

        $themeData['page'] = [
            'title' => "Grid Example",
            'items' => $items
            ];
    
        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getFullpage($request, $response, $args)
    {
        $view = 'fullpage.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getException($request, $response, $args)
    {
        $view = 'fullpage.html';

        throw new \Exception("This is an exception");

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData = \erdiko\theme\Config::get();
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }
}