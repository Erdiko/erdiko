<?php
/** 
 * appstrap: 
 * Add any application defined bootstrap items here
 */
ini_set('display_errors', '1');

// Turn on Session (uncomment line below)
// require_once ERDIKO.'/core/session.php';

/**
 * Hooks
 */
ToroHook::add("404", function($msg = null) {
	Erdiko::log('404 Error', null, 'system');
    // Simple text only page
    // echo "Sorry, we cannot find that URL";
    // die; // don't let the calling controller continue

    if($msg == null)
    	$msg = "Sorry, we cannot find that URL";

	// Themed page
	$theme = new \erdiko\core\Theme('bootstrap');
	$theme->addCss('//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
	$theme->addCss('/themes/bootstrap/css/font-awesome-animation.css');

	$response = new \erdiko\core\Response($theme);
	$response->setContent( \Erdiko::getView('404', array("message" => $msg)) );
	$response->send();
});

ToroHook::add("500", function($msg = "") {
	Erdiko::log('500 Error', 'Exception', 'exception');
    echo "Sorry, something went wrong";
});
