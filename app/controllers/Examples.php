<?php
namespace app\controllers;

class Examples extends \erdiko\controllers\Web
{
    use \erdiko\theme\traits\Controller; // Add theme engine suport (for convenience)

    public function get($request, $response, $args)
    {
        // $this->container->logger->debug("examples");
        $view = 'examples/list.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        // $themeData = \erdiko\theme\Config::get();
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        // $themeData['args'] = $args; // optional

        $themeData['page'] = [
            'title' => "Erdiko Web Examples",
            'hello' => "world"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getOnecolumn($request, $response, $args)
    {   
        $this->container->logger->debug("route: /config");
        $view = 'layouts/1column.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page']['title'] = "1 Column Layout";

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getTwocolumn($request, $response, $args)
    {
        $this->container->logger->debug("route: /config");
        $view = 'layouts/2column.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page']['title'] = "2 Column Layout";

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getThreecolumn($request, $response, $args)
    {
        $this->container->logger->debug("route: /config");
        $view = 'layouts/3column.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page']['title'] = "3 Column Layout";

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getFourcolumn($request, $response, $args)
    {
        $this->container->logger->debug("route: /config");
        $view = 'layouts/4column.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page']['title'] = "4 Column Layout";

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getJohn($request, $response, $args)
    {
        $view = 'pages/example.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
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
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
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
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    /**
     * Leverage the theme trait to easily add content to an action
     */
    public function getTheme($request, $response, $args)
    {
        $this->getThemeEngine();
        $this->theme->title = "Theme Engine Example";
        $this->theme->description = "This page is rendered using the erdiko theme engine.
            \\erdiko\\theme\\Engine";

        return $this->render($response, null, $theme);
    }

    /**
     * Alternative way to use the theme Engine (explicit)
     * In this approach it does not rely on the theme trait
     */
    public function getTheme2($request, $response, $args)
    {
        $theme = new \erdiko\theme\Engine( $this->container->get('settings')['theme'] );
        $theme->title = "Theme Engine Example";
        $theme->description = "This page is rendered with the erdiko theme engine.
            It does not leverage the erdiko theme trait.
            \\erdiko\\theme\\Engine";

        return $this->container->theme->render($response, $theme->getDefaultView(), $theme->toArray());
        // return $this->render($response, null, $theme);
    }

    /**
     * Leverage the theme trait to easily add content to an action
     */
    public function getAbout($request, $response, $args)
    {
        $this->getThemeEngine();
        $this->theme->title = "About";
        $this->theme->description = "Erdiko is a framework and set of open source packages for lean php development.
            Created by Arroyo Labs and community contributors with the help of Slim and Symfony components";

        return $this->render($response, null, $theme);
    }

    /**
     * Test the session
     */
    public function getSession($request, $response, $args)
    {
        $this->getThemeEngine();
        $this->theme->title = "Session Test";

        $value = (isset($_GET["index"])) ? $_GET["index"] : \erdiko\session\Session::get('index');
        \erdiko\session\Session::set('index', $value);

        // $this->container->logger->debug("session::index = ".\erdiko\session\Session::get('index'));
        $this->theme->description = "Session value: ".\erdiko\session\Session::get('index');

        return $this->render($response, null, $theme);
    }

    public function getFlash($request, $response, $args)
    {
        $view = 'page.html';

        // Add some flash messages
        $this->container->flash->addMessage('success', 'This is a success message');
        $this->container->flash->addMessage('info', 'This is an info message');
        $this->container->flash->addMessage('warning', 'This is a warning message');
        $this->container->flash->addMessage('danger', 'This is a danger (error) message');

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
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
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
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
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function getException($request, $response, $args)
    {
        $view = 'page.html';

        throw new \Exception("This is an exception");

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['page'] = [
            'title' => "Fullpage Example",
            'description' => "This is the description of the page."
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }
}
