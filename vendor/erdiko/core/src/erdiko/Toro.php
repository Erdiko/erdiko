<?php

class Toro
{
    public static function serve($routes)
    {
        ToroHook::fire('before_request', compact('routes'));
        
        // Determine action (and set default)
        if (empty($_SERVER['REQUEST_METHOD'])) {
            $_SERVER['REQUEST_METHOD'] = 'GET';
        }
        $action = strtolower($_SERVER['REQUEST_METHOD']); // e.g. get, put, post, delete

        $path_info = '/';
        if (!empty($_SERVER['PATH_INFO'])) {
            $path_info = $_SERVER['PATH_INFO'];
        } elseif (!empty($_SERVER['ORIG_PATH_INFO']) && $_SERVER['ORIG_PATH_INFO'] !== '/index.php') {
            $path_info = $_SERVER['ORIG_PATH_INFO'];
        } else {
            if (!empty($_SERVER['REQUEST_URI'])) {
                $path_info = (strpos($_SERVER['REQUEST_URI'], '?') > 0) ?
                    strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI'];
            }
        }
        
        $discovered_handler = null;
        $regex_matches = array();
        $arguments = array();

        if (isset($routes[$path_info])) {
            $discovered_handler = $routes[$path_info];
        } elseif ($routes) {
            $tokens = array(
                ':string' => '([a-zA-Z]+)',
                ':number' => '([0-9]+)',
                ':alpha'  => '([a-zA-Z0-9-_]+)',
                ':action'  => '([a-zA-Z0-9-_/]+)'
            );

            // Search through routes and find first match
            foreach ($routes as $pattern => $handler_name) {
                $pattern = strtr($pattern, $tokens);
                if (preg_match('#^/?' . $pattern . '/?$#', $path_info, $matches)) {
                    $discovered_handler = $handler_name;
                    $regex_matches = $matches;
                    $params = isset($regex_matches[1]) ? explode("/", $regex_matches[1]) : array();

                    // Determine action and arguments
                    if (count($params) > 1) {
                    // @todo add different parsers here...possibly pass route function in routes.json
                        $action .= ucfirst($params[0]);
                        unset($params[0]);
                        // $int = 1;

                        foreach ($params as $param) {
                            $arguments[] = $param;
                            /*
                            // if even param
                            if($int % 2 == 0)
                                $action .= ucfirst($param);
                            else
                                $arguments[] = $param;
                            $int++;
                            */
                        }
                    } else {
                        unset($regex_matches[0]);
                        $arguments = $regex_matches; // Toro compatible
                    }

                    // error_log("regex_matches: ".print_r($regex_matches, true));
                    // error_log("action: $action");
                    // error_log("arguments: ".print_r($arguments, true));

                    break;
                }
            }
        }

        $result = null;
        $handler_instance = null;

        if ($discovered_handler) {
            if (is_string($discovered_handler)) {
                $handler_instance = new $discovered_handler();
            } elseif (is_callable($discovered_handler)) {
                $handler_instance = $discovered_handler();
            }
        }

        if ($handler_instance) {
            if (self::is_xhr_request() && method_exists($handler_instance, $action . '_xhr')) {
                header('Content-type: application/json'); // @todo support xml
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
                header('Cache-Control: no-store, no-cache, must-revalidate');
                header('Cache-Control: post-check=0, pre-check=0', false);
                header("Access-Control-Allow-Origin: *"); // @todo make this a parameter?
                header('Pragma: no-cache');
                $action .= '_xhr';
                $handler_instance->setIsXhrRequest(1);
            }

            if (method_exists($handler_instance, $action)) {
                try {
                    $handler_instance->setPathInfo($path_info);
                    ToroHook::fire('before_handler', compact('routes', 'discovered_handler', 'action', 'arguments'));
                    $handler_instance->_before();

                    // Action call
                    call_user_func_array(array($handler_instance, $action), $arguments);

                    $handler_instance->_after();
                    $handler_instance->send(); // render the response and return the data
                    ToroHook::fire(
                        'after_handler',
                        compact('routes', 'discovered_handler', 'action', 'arguments', 'result')
                    );

                } catch (\Exception $e) {
                    ToroHook::fire('500', array('error' => $e->getMessage(), 'path_info' => $path_info));
                }
            } else {
                ToroHook::fire('404', compact('discovered_handler', 'action', 'arguments', 'path_info'));
            }
        } else {
            ToroHook::fire('404', compact('discovered_handler', 'action', 'arguments', 'path_info'));
        }

        ToroHook::fire('after_request', compact('routes', 'discovered_handler', 'action', 'arguments', 'result'));
    }

    private static function is_xhr_request()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}

class ToroHook
{
    private static $instance;

    private $hooks = array();

    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function add($hook_name, $fn)
    {
        $instance = self::get_instance();
        $instance->hooks[$hook_name][] = $fn;
    }

    public static function fire($hook_name, $params = null)
    {
        $instance = self::get_instance();
        if (isset($instance->hooks[$hook_name])) {
            foreach ($instance->hooks[$hook_name] as $fn) {
                call_user_func_array($fn, array(&$params));
            }
        }
    }

    public static function get_instance()
    {
        if (empty(self::$instance)) {
            self::$instance = new ToroHook();
        }
        return self::$instance;
    }
}
