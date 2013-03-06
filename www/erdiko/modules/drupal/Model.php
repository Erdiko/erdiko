<?php
/**
 * Drupal model
 * Base model every drupal model should inherit
 * 
 * @category   Erdiko
 * @package    Modules
 * @copyright  Copyright (c) 2012, Arroyo Labs, http://www.arroyolabs.com
 * @author	John Arroyo, john@arroyolabs.com
 */
namespace erdiko\modules\drupal;
require_once __DIR__."/bootstrap.php";

use \Erdiko;

class Model extends \erdiko\core\ModelAbstract
{	
	/**
	 * Get node by nid or url key
	 * @param mixed $node, options of $nid or $urlKey
	 */
	public function getNode($node)
	{
		// return \node_view(\node_load($nid), 'teaser');
		// return \entity_load('node', array($nid));

		if(is_numeric($node))
			$nid = $node;
		else
		{
			$normal_path = \drupal_get_normal_path($node);
			$nid = str_ireplace("node/",'',$normal_path);
		}

		$node = \node_load($nid);
		// error_log("nid: $nid");
		// error_log("node: ".print_r($node, true));
		
		return $node;
	}
	
	/**
	 * @todo finish function
	 */
	public function getNodeQueue($id)
	{
		$n = 20;
		return \nodequeue_load_nodes($id, FALSE, 0, $n);
	}
	
	/**
	 * 
	 */
	public function getNodequeueView($id)
	{
		$viewName = 'nodequeue_'.$id;	
		$view = \views_get_view_result($viewName);
		$nodes = array();
		
		foreach($view as $node)
		{
			$nodes[] = $this->getNode($node->nid);
			// error_log('node: '.print_r($node->nid, true));
		}
		
		// print_r($nodes);
		
		return $nodes;
		
		// $node = node_load($rows->nid);
		// return \views_get_view($viewName);
	}	
	
	/**
	 * 
	 */
	public function getArrayFromNodeQueue($data)
	{
		// get the pertinent info from the NodeQueue object
		$formated = $data;
		
		return $formated;
	}
	
	/**
	 * 
	 */
	function getPathAlias($nid)
	{
	    $alias = $nid;
	    // Check for an alias using drupal_lookup_path()
	    if((drupal_lookup_path('alias', 'node/'.$nid)!==false))
	        $alias = drupal_lookup_path('alias', 'node/'.$nid); 
	    return $alias;
	}
	
	/**
	 * 
	 */
	public function getView($name)
	{
		
	}
	
	/**
	 * 
	 */
	public function getCategory($tid)
	{
		
	}
}