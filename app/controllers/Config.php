<?php
namespace app\controllers;

class Config extends \erdiko\Controller
{
	public function __invoke($request, $response, $args)
	{
        $this->container->logger->debug("route: /config");
   	    $view = 'pages/config.html';

        $config['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $config['page']['title'] = "Dump Theme Config";

   		return $this->container->theme->render($response, $view, $config);
  	}
}
