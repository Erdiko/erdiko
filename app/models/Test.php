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
    use \erdiko\doctrine\models\EntityTrait; // This adds some convenience methods

    public function getTests()
    {
        return $this->getRepository('app\entities\Test')->findAll(); // The easy (convenient) way
    }
}
