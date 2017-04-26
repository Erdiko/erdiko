<?php
namespace app\controllers;

class Config extends \erdiko\Controller
{  
	public function __invoke($request, $response, $args) 
	{
        $this->container->logger->debug("route: /config");
   	    $view = 'pages/config.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $config = \erdiko\theme\Config::get();
        $config['page']['title'] = "Dump Config";

        // $theme = new \erdiko\theme\Object;
        // $theme->title = "Dump Config";
        // (array)$theme; Config::get(), ['page'] = array();

   		return $this->container->theme->render($response, $view, $config);
  	}
}