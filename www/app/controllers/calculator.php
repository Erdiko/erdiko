<?php
namespace app\controllers;

use Erdiko;
use erdiko\core\Config;

class Calculator extends \erdiko\core\Controller
{

        public function bmiAction()
        {
              $this->setTitles('BMI Example');
              $this->setView('/calculator/bmi.php');
              $this->addJs('/themes/hello/js/example.js');
        }

        public function bmi_version2Action($arguments = null)
        {
            $this->setTitles('BMI Example');
            //$this->setBodyContent("Welcome to Erdiko.");
            $this->setView('/calculator/bmi_version2.php');
        }

        public function bmi_postAction($arguments = null)
        {
            $this->setTitles('BMI Post');
            //$this->setBodyContent("Welcome to Erdiko.");
            $this->setView('/calculator/bmi_post.php');
        }
			
}

    