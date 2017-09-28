<?php
/**
 * Created by PhpStorm.
 * User: mpineda
 * Date: 27/09/17
 * Time: 18:38
 */

namespace Test\Functional;

use app\models\Users;
use Slim\Container;
use Tests\Functional\BaseTestCase;

class EntityManagerTest extends BaseTestCase
{

    public function testEntityManager()
    {
        $entityManager = $this->getApp()->getContainer()->get('em');
        $user = new Users($entityManager);
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $user->getEntityManager());
    }

    /**
     * @expectedException \TypeError
     */
    public function testEntityManagerFail()
    {
        $container = new Container();
        $user = new Users($container);
        $this->assertInstanceOf('\Doctrine\ORM\EntityManager', $user->getEntityManager());
    }

    public function testRepository()
    {
        $entityManager = $this->getApp()->getContainer()->get('em');
        $user = new Users($entityManager);
        $this->assertInstanceOf('\Doctrine\ORM\EntityRepository', $user->getRepository('app\entities\User'));
    }

}
