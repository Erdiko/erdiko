<?php
/**
 * Log Model
 *
 * Model for Logs
 *
 * @category    app
 * @package     models
 * @copyright   Copyright (c) 2017, Arroyo Labs, http://www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\models;

class Log
{
    use \erdiko\doctrine\EntityTraits; // This adds some convenience methods

    ///Users/kenneth/Client/mywu-global/www/vendor/erdiko/doctrine/src/EntityTraits.php

    public function getEvents()
    {
        // $entityManager = \erdiko\doctrine\EntityManager::getEntityManager();
        // $results = $entityManager->getRepository('app\entities\Log')->findAll();
        $results = $this->getRepository('app\entities\Log')->findAll();
        //var_dump($results); die();

        return $results; // The easy (convenient) way
    }
}
