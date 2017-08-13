<?php
namespace app\controllers\examples;

class Session extends \erdiko\controllers\Web
{
    use \erdiko\theme\traits\Controller; // Add theme engine suport (for convenience)

    public function get($request, $response, $args)
    {
        // $this->container->logger->debug("examples");
        $view = 'examples/list.html';

        // Get erdiko config, this gets application.json and loads the theme specified
        // $themeData = \erdiko\theme\Config::get();
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        // $themeData['args'] = $args; // optional

        $themeData['page'] = [
            'title' => "Erdiko Web Example",
            'hello' => "world"
            ];

        return $this->container->theme->render($response, $view, $themeData);
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

    public function getFlash($request, $response, $args)
    {
        $view = 'page.html';

        // Add some flash messages
        $this->container->flash->addMessage('success', 'This is a success message');
        $this->container->flash->addMessage('info', 'This is an info message');
        $this->container->flash->addMessage('warning', 'This is a warning message');
        $this->container->flash->addMessage('danger', 'This is a danger (error) message');

        // Get erdiko config, this gets application.json and loads the theme specified
        $themeData['theme'] = \erdiko\theme\Config::get($this->container->get('settings')['theme']);
        $themeData['args'] = $args;
        $themeData['page'] = [
            'title' => "Flash Message Example"
            ];

        return $this->container->theme->render($response, $view, $themeData);
    }

}
