<?php
/**
 * Users Model
 *
 * Service model for the users table
 * 
 * @category    app
 * @package     models
 * @copyright   Copyright (c) 2016, Arroyo Labs, http://www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\models;

class Users 
{
    use \erdiko\doctrine\EntityTraits; // This adds some convenience methods

    public function getUsers()
    {
        return $this->getRepository('app\entities\User')->findAll(); // The easy (convenient) way
    }

    public function getUsersOld()
    {
        // The old fashioned way (typical doctrine use)
        $entityManager = \erdiko\doctrine\EntityManager::getEntityManager();
        return $entityManager->getRepository('app\entities\User')->findAll();
    }
}