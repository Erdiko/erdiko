<?php
/**
 * Examples Controller
 * Multiple examples of how you can use erdiko.  It includes some simple use cases.
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
class Example extends \erdiko\core\Controller
{
    /**
     * Before action hook
     * Anything here gets called immediately BEFORE the Action method runs.
     * Typically used for theming, ACL and other controller wide set up code
     */
    public function _before()
    {
        /** 
         * Important notes about theming:
         * Changing your default site wide theme should be done in the default/application.json file
         *
         * If you want to switch themes in your controller uncomment out this line.
         * $this->setThemeName('my_theme_name');
         * 
         * You can also switch themes on a per action basis.  
         * This would be done by putting this code at the top of your action method
         * $this->setTheme('my_theme_name');
         */
        // $this->setThemeName('my_theme_name');

        // Run the parent beore filter to prep the theme
        parent::_before();
    }

    /** Get Hello */
    public function getHello()
    {
        $this->setTitle('Hello World');
        $this->setContent("Hello World");
    }

    /**
     * Homepage Action (index)
     */
    public function getIndex()
    {
        // Add page data
        $this->setTitle('Welcome to Erdiko');
        $this->addView('examples/home');
        $this->addMeta("description", "index page meta description");
    }

    /**
     * Advanced Action 
     */
    public function getAdvanced()
    {
        // Add page data
        $this->setTitle('Advanced use cases');
        $this->addMeta("description", "Advanced use cases and examples");

        // Add additional js and css files
        $this->addCss('my-css','/css/my-css-file.css');
        $this->addJs('my-js','/js/my-js-file.js');

        // Add additional fields to the theme
        $this->getResponse()->getTheme()->custom_var = "Booyah";
        echo $this->getResponse()->getTheme()->custom_var;

        // Add additional fields to the view
        $this->getResponse()->getTheme()->custom_var = "Booyah";
        echo $this->getResponse()->getTheme()->custom_var;

        // Get a view object
        $view = $this->getView('examples/advanced');

        // Add a field to the view that can be used directly in the view
        $view->title = $this->getTitle();

        // Add the view to the content
        $this->setContent($view);
    }

    /**
     * Examples Action
     */
    public function getExamples()
    {
        // Add page data
        $this->setTitle('Erdiko page examples');
        $this->addView('examples/list');
    }

    /**
     * Get baseline, the simplest page around town
     */
    public function getBaseline()
    {
        // Entering raw text on the page
        $this->setContent("
            <div class=\"container\"><p>
            This is the simplest page possible.</p>
            </div>");
    }

    /**
     * Get full page
     */
    public function getFullpage()
    {
        $this->setThemeTemplate('fullpage');
        $this->setContent("This is a fullpage layout (sans header/footer)");
    }

    /**
     * Get set view
     */
    public function getSetview()
    {
        $this->setTitle('Page with a single view');
        $this->addView('examples/setview');
    }

    /**
     * Get multiple views
     */
    public function getSetmultipleviews()
    {
        $this->setTitle('Page with multiple views');

        // Include multiple views directly
        $content = $this->getView('examples/one');
        $content .= $this->getView('examples/two');
        $content .= $this->getView('examples/three');

        $this->setContent($content);
    }

    /**
     * Get multiple views at
     */
    public function getSetmultipleviewsAlt()
    {
        $this->setTitle('Page with multiple views (alt)');

        // Add multiple views using api (better approach)
        $this->addView('examples/one');
        $this->addView('examples/two');
        $this->addView('examples/three');
    }

    /**
     * Get view2
     * Another way to inject views into a layout
     */
    public function getSetview2()
    {
        // Include multiple views indirectly
        $page = array(
            'content' => array(
                'view1' => $this->getView('examples/one'),
                'view2' => $this->getView('examples/two'),
                'view3' => $this->getView('examples/three')
                )
            );

        $this->setTitle('Example: Multiple views take 2');
        $this->addView('examples/setview2', $page);
    }

    /**
     * Slideshow Action
     */
    public function getCarousel()
    {
        // Add page data
        $this->setTitle('Example: Carousel');
        $this->addView('examples/carousel');

        // Inject the carousel js code
        $this->getResponse()
            ->getTheme()
            ->addJs('carousel', '/themes/bootstrap/js/carousel.js');
    }

    /**
     * Flash Messages Action
     */
    public function getFlashmessages()
    {
        \erdiko\core\helpers\FlashMessages::set("This is a success message", "success");
        \erdiko\core\helpers\FlashMessages::set("This is an info message", "info");
        \erdiko\core\helpers\FlashMessages::set("This is a warning message", "warning");
        \erdiko\core\helpers\FlashMessages::set("This is a danger/error message", "danger");
    }

    /**
     * Get php info
     */
    public function getPhpinfo()
    {
        phpinfo();
        exit;
    }

    /**
     * Get Mark Up
     *
     * @usage This is an alternate way to add page content data
     * You can load a view directly into the content.
     * This is not the preferred way to add content.
     * Use the addView() method or a Layout when possible.
     */
    public function getMarkup()
    {
        $this->setTitle('Example Mark-Up');
        
        $this->addView('examples/markup');
        $this->addView('examples/tables');
        $this->addView('examples/forms');
    }

    /**
     * Get one column layout example
     */
    public function getOnecolumn()
    {
        // Set page using a layout
        $columns = array(
            'body' => $this->getView('examples/one'),
            );
        
        $this->setTitle('1 Column Layout');
        $this->setContent($this->getLayout('1column', $columns));
    }

    /**
     * Get two column layout example
     */
    public function getTwocolumn()
    {
        // Set columns directly using a layout
        $columns = array(
            'one' => $this->getView('examples/one'),
            'two' => $this->getView('examples/nested_view')
            );
        
        $this->setTitle('2 Column Layout');
        $this->setContent($this->getLayout('2column', $columns));
    }

    /**
     * Get three column layout example
     */
    public function getThreecolumn()
    {
        // Set each column using a layout
        $columns = array(
            'one' => $this->getView('examples/one'),
            'two' => $this->getView('examples/two'),
            'three' => $this->getView('examples/three')
            );
        
        $this->setTitle('3 Column Layout');
        $this->setContent($this->getLayout('3column', $columns));
    }

    /**
     * Get grid
     */
    public function getGrid()
    {
        $data = array(
            'columns' => 4,
            'count' => 12
            );
        
        $this->setTitle('Grid');
        $this->addView('examples/grid', $data);
    }

    /* Footer Pages */

    /**
     * Get Config
     */
    public function getConfig()
    {
        $contextConfig = \Erdiko::getConfig();
        $this->setTitle('Config Data');
        $data = array(
            'context' => getenv('ERDIKO_CONTEXT'),
            'test' => $_ENV['ERDIKO_CONTEXT'],
            'test_r' => print_r($_ENV, true),
            'config file data' => $contextConfig
            );

        // Set page using a layout
        $columns = array(
            'body' => $this->getView('examples/json', $data),
            );
        $this->setContent($this->getLayout('1column', $columns));
    }

    /**
     * Get Exception
     */
    public function getException()
    {
        $this->setContent($this->getLayout('doesNotExist', null));
    }

    /**
     * Get About
     */
    public function getAbout()
    {
        $this->setTitle("About");
        $data = \Erdiko::getConfig("application", getenv('ERDIKO_CONTEXT'));
        
        $this->addView('examples/about', $data);
    }
}
