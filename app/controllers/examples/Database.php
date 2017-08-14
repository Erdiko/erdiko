<?php
namespace app\controllers\examples;

class Database extends \erdiko\controllers\Web
{
    use \erdiko\theme\traits\Controller; // Add theme engine suport (for convenience)
    // use \erdiko\doctrine\controllers\EntityTrait;

    public function get($request, $response, $args)
    {
        $this->getThemeEngine();
        $this->theme->title = "Database Test";

        // Inject in controller
        // $tests = $this->getRepository('app\entities\Test')->findAll();
        // $this->theme->description = "<pre>Tests: ".print_r($tests, true)."</pre>";

        // Inject EntityManager into the model
        $test = new \app\models\Test($this->container->em);
        $tests = $test->getTests();
        $this->theme->description = "<pre>Tests: ".print_r($tests, true)."</pre>";

        return $this->render($response, null, $theme);
    }

    /**
     * Test the session
     */
    public function getSession($request, $response, $args)
    {
        $this->getThemeEngine();
        $this->theme->title = "Session Test";

        $value = (isset($_GET["index"])) ? $_GET["index"] : \erdiko\session\Session::get('index');
        \erdiko\session\Session::set('index', $value);

        // $this->container->logger->debug("session::index = ".\erdiko\session\Session::get('index'));
        $this->theme->description = "Session value: ".\erdiko\session\Session::get('index');

        return $this->render($response, null, $theme);
    }

}
