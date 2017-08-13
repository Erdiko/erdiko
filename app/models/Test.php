<?php
/**
 * Test Model
 *
 * Model for Tests
 *
 * @category    app
 * @package     models
 * @copyright   Copyright (c) 2017, Arroyo Labs, http://www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 */
namespace app\models;

class Test
{
    use \erdiko\doctrine\EntityTraits; // This adds some convenience methods

    public function getTests()
    {
        return $this->getRepository('app\entities\Test')->findAll(); // The easy (convenient) way
    }

    public function getUsersOld()
    {
        // The old fashioned way (typical doctrine use)
        $entityManager = \erdiko\doctrine\EntityManager::getEntityManager();
        return $entityManager->getRepository('app\entities\User')->findAll();
    }
}
