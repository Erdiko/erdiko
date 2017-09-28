<?php
namespace app\controllers;

class LogCreateController extends \erdiko\controllers\Web
{
    use \erdiko\theme\traits\Controller;

    public function get($request, $response, $args)
    {

        $view = 'layouts/create.html';
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);

        $themeData['page'] = [
            'title' => "This is the Log Edit Controller",
            'description' => "This is where all the log we want are to be created",

        ];

        return $this->container->theme->render($response, $view, $themeData);
    }

    public function postCreateevent($request, $response, $args)
    {
        var_dump($_POST);
    }
}