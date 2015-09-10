<?php
/**
 * appstrap:
 * Add any application defined bootstrap items here
 */
ini_set('display_errors', '1');

// To turn on Session (uncomment line below)
// require_once ERDIKO.'/core/session.php';

/**
 * Hooks
 */
ToroHook::add("404", function ($vars = array()) {
    // error_log("vars: ".print_r($vars, true));
    
    if (empty($vars['message'])) {
        $vars['message'] = "Sorry, we cannot find that page.";
    }
    if (empty($vars['error'])) {
        $vars['error'] = $vars['message'];
    }
    if (!isset($vars['path_info'])) {
        $vars['path_info'] = "";
    }

    Erdiko::log(\Psr\Log\LogLevel::ERROR, "404 {$vars['path_info']} {$vars['error']}");

    // For a simple text only 404 page use this...
    // echo "Sorry, we cannot find that URL";
    // die; // don't let the calling controller continue

    // For a themed 404 page...
    $theme = new \erdiko\core\Theme('bootstrap');
    $theme->addCss('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
    $theme->addCss('/themes/bootstrap/css/font-awesome-animation.css');

    $response = new \erdiko\core\Response($theme);
    $response->setContent(\Erdiko::getView('404', $vars));
    $response->send();
});

ToroHook::add("500", function ($vars = array()) {
    // error_log("vars: ".print_r($vars, true));
    Erdiko::log(\Psr\Log\LogLevel::ERROR, "500 {$vars['path_info']} {$vars['error']}");
    echo "Sorry, something went wrong";
});
