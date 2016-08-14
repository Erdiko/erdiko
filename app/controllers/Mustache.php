<?php
/**
 * Mustache Controller
 * Some test routes for mustache
 * This is only for testing Mustache
 *
 * @category    app
 * @package     controllers
 * @copyright   Copyright (c) 2016, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\controllers;


/**
 * Example Controller Class
 */
class Mustache extends \erdiko\core\Controller
{
    public function getMustacheTest($name)
    {
        return "[[{$name}]]";
    }

    public function getMustacheTest2()
    {
        return $this->getView('examples/one');
    }

    /** 
     * Example playing with mustache templates
     * the $string variable would really be a view, but it's good to see here.
     */
    public function getMustache()
    {
        $string = "Hello, {{ planet }}!
            {{# get_region }}two{{/ get_region }}
            {{# get_region }}'three'{{/ get_region }}
            {{# index }}four{{/ index }}
            {{# getMustacheTest2 }}five{{/ getMustacheTest2 }}
            ";

        $m = new \Mustache_Engine;
        $data = array(
            'planet' => 'world',
            'get_region' => function($name) { 
                return $this->getMustacheTest($name); 
                },
            'index' => function() {
                return $this->getMustacheTest2();
                }
            );
        $content = $m->render($string, $data);

        $this->setTitle('Mustache');
        $this->setContent($content);
    }

    /** 
     * Example playing with mustache templates
     * the $string variable would really be a view, but it's good to see here.
     */
    public function getMustacheview()
    {
        // Send data and attach a function to mustache
        $data = array(
            'planet' => 'world',
            'get_region' => function($name) { 
                return $this->getMustacheTest($name); 
                }
            );

        $this->setTitle('Mustache View');
        $this->addView('examples/mustache', $data);
    }

    /** 
     * Example playing with mustache templates
     * the $string variable would really be a view, but it's good to see here.
     */
    public function getMustachelayout()
    {
        // You can add other views (containers) or text
        $columns = array(
            'one' => new \erdiko\core\View('examples/one'),
            'two' => $this->getView('examples/two') . $this->getView('examples/three')
            );
        
        $this->setContent($this->getLayout('mustache/2column-mustache', $columns));

        $this->setTitle('Mustache Template');
    }

    /**
     * Homepage Action (index)
     */
    public function getIndex()
    {
        // Add page data
        $this->setTitle('Examples');
        $this->addView('examples/examples');
    }
}
