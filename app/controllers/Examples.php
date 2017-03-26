<?php
namespace app\controllers;

class Examples extends \erdiko\controllers\Web
{
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
}