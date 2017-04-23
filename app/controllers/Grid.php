<?php
namespace app\controllers;

class Grid extends \erdiko\Controller
{   
	public function __invoke($request, $response, $args) 
	{
        $this->container->logger->debug("/controller");
   		$view = 'pages/grid.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        $config = \erdiko\theme\Config::get();        

        // $this->container->logger->debug("config: ".print_r($config, true));
        $config['name'] = $args['name'];
        $config['title'] = "Erdiko Controller Example";
        $config['args'] = $args;

        $item = [
            'url' => "#",
            'image' => "/images/grid-item.png",
            'name' => "Item"
        ];

        $items = array();
        for($i = 0; $i < $args['count']; $i++) {
            $item['name'] = "Item $i";
            $items[] = $item;
        }
        $config['items'] = $items;

   		return $this->container->theme->render($response, $view, $config);
  	}
}