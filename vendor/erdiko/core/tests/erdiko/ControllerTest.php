<?php
namespace tests\erdiko;

use erdiko\core\Controller;

require_once dirname(__DIR__).'/ErdikoTestCase.php';


class ControllerTest extends \tests\ErdikoTestCase
{
    public $controllerObj = null;

    public function setUp()
    {
        $this->controllerObj = new \erdiko\core\Controller;
    }

    public function tearDown()
    {
        unset($this->controllerObj);
    }

    public function testSetThemeName()
    {
        $themeName = 'Test theme name';
        $this->controllerObj->setThemeName($themeName);
        $return = $this->controllerObj->getResponse()->getThemeName();
        $this->assertEquals($return, $themeName);
    }

    public function testSetThemeTemplate()
    {
        $template = 'Test theme template';
        $this->controllerObj->setThemeTemplate($template);
        $return = $this->controllerObj->getResponse()->getThemeTemplate();
        $this->assertEquals($return, $template);
    }

    public function testSetResponseDataValue()
    {
        $key = 'Test_Key';
        $value = 'Test_Value';
        $this->controllerObj->setResponseDataValue($key, $value);
        $return = $this->controllerObj->getResponse()->getDataValue($key);
        $this->assertEquals($return, $value);
    }

    public function testSetPageTitle()
    {
        $title = 'Test_Page_Title';
        $this->controllerObj->setPageTitle($title);
        $return = $this->controllerObj->getResponse()->getDataValue('page_title');
        $this->assertEquals($return, $title);
    }


    public function testSetBodyTitle()
    {
        $title = 'Test_Body_Title';
        $this->controllerObj->setBodyTitle($title);
        $return = $this->controllerObj->getResponse()->getDataValue('body_title');
        $this->assertEquals($return, $title);
    }

    public function testSetTitle()
    {
        $title = 'Test_Title';
        $this->controllerObj->setTitle($title);
        $return = $this->controllerObj->getResponse()->getDataValue('page_title');
        $this->assertEquals($return, $title);

    }

    public function testSetContent()
    {
        $content = 'Test content';
        $this->controllerObj->setContent($content);
        $return = $this->controllerObj->getResponse()->getContent();
        $this->assertEquals($return, $content);
    }

    public function testAppendContent()
    {
        //Set content
        $content = 'Test content';
        $this->controllerObj->setContent($content);
        $return = $this->controllerObj->getResponse()->getContent();
        $this->assertEquals($return, $content);
        
        //Set appended content
        $appContent = 'Test appended content.....';
        $this->controllerObj->appendContent($appContent);
        $return = $this->controllerObj->getResponse()->getContent();
        $this->assertEquals($return, $content.$appContent);
    }

    public function testUrlToActionName()
    {
        //First Test
        $site = 'http://erdiko.com/';
        $return = $this->controllerObj->urlToActionName($site, 'get');
        $this->assertEquals($return, 'get'.ucfirst($site));
        
        //Second Test
        $site = 'www.erdiko.com/';
        $return = $this->controllerObj->urlToActionName($site, 'get');
        $this->assertEquals($return, 'get'.ucfirst($site));
    }

    public function testAddViewAndGetView()
    {
        $viewName = 'examples/helloworld';

        /**
         *  First Test
         *
         *  Add a view without data
         */
        $view = new \erdiko\core\View($viewName);
        $this->controllerObj->addView($viewName);
        //$return = $this->controllerObj->getResponse()->getContent();
        $return = $this->controllerObj->getView($viewName);
        $this->assertEquals($return, $view->toHtml());

        unset($this->controllerObj);
        $this->controllerObj = new \erdiko\core\Controller;
    
        /**
         *  Second Test
         *
         *  Add a view with data
         */
        $data = 'Test Data';
        $view = new \erdiko\core\View($viewName, $data);
        $this->controllerObj->addView($viewName, $data);
        //$return = $this->controllerObj->getResponse()->getContent();
        $return = $this->controllerObj->getView($viewName, $data);
        $this->assertEquals($return, $view->toHtml());

        unset($this->controllerObj);
        $this->controllerObj = new \erdiko\core\Controller;

        /**
         *  Third Test
         *
         *  Add a view, and then add another view
         */
        //Add a view
        $view = new \erdiko\core\View('examples/helloworld');
        $this->controllerObj->addView('examples/helloworld');
        $return = $this->controllerObj->getView('examples/helloworld');
        $this->assertEquals($return, $view->toHtml());
        
        //Add another view
        $data = 'Test Data';
        $view2 = new \erdiko\core\View('examples/carousel', $data);
        $this->controllerObj->addView('examples/carousel', $data);
        $return = $this->controllerObj->getResponse()->getContent();
        $this->assertEquals($return, $view->toHtml().$view2->toHtml());
        
    }

    public function testGetLayout()
    {
        //First test: Setting a theme object
        $controllerObj = new \erdiko\core\Controller;

        $theme = new \erdiko\core\Theme('bootstrap', null, 'default');
        $controllerObj->getResponse()->setTheme($theme);
        $return = $controllerObj->getLayout('1column', null);

        //Get content through file_get_contents function
        $themeFolder = $controllerObj->getResponse()->getTheme()->getThemeFolder();
        $fileName = $themeFolder.'/templates/layouts/1column.php';
        $content = file_get_contents($fileName);
        //Search for the keyword which is right before php tag
        $pos = strrpos($content, 'role="main">');
        $content = substr($content, 0, $pos);
        //Check if two content are matched
        $find = strrpos($return, $content);
        $this->assertGreaterThanOrEqual(0, $find);

        unset($controllerObj);
        

        //Second test: Setting the theme name
        $controllerObj = new \erdiko\core\Controller;
        $controllerObj->getResponse()->setThemeName('bootstrap');
        $return = $controllerObj->getLayout('1column', null);

        //Validate content
        $find = strrpos($return, $content);
        $this->assertGreaterThanOrEqual(0, $find);

        unset($controllerObj);
    }


    public function testRedirect()
    {
        //$url = 'http://erdiko.com';
        //$this->controllerObj->redirect($url);

    }
}
