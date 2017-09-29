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
    use \erdiko\doctrine\models\EntityTrait;

    public function getUsers()
    {
        return $this->getRepository('app\entities\User')->findAll();
    }
}
