<?php
namespace app\controllers;

class Home extends \erdiko\Controller
{
	protected $container;
   
	public function __invoke($request, $response, $args) 
	{
        $this->container->logger->debug("/controller");
   		$view = 'views/controller.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $config = \erdiko\theme\Config::get();        

        // $this->container->logger->debug("config: ".print_r($config, true));
        $config['name'] = $args['name'];
        $config['title'] = "Erdiko Controller Example";
        $config['args'] = $args;

   		return $this->container->theme->render($response, $view, $config);
  	}
}