<?php
namespace app\controllers;

use Erdiko;
use erdiko\core\Config;

class Calculator extends \erdiko\core\Controller
{

     public function bmi_version2Action()
        {
            $this->setTitles('BMI Example');
            //$this->setBodyContent("Welcome to Erdiko.");
            $this->setView('/examples/bmi.php');
        }

        public function bmi_postAction()
        {
            $this->setTitles('BMI Post');
            //$this->setBodyContent("Welcome to Erdiko.");
            $this->setView('/examples/bmi_post.php');
        }
			
}

    