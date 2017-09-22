<?php

namespace Tests\Functional;

/**
 * Class HomepageTest
 *
 * @package Tests\Functional
 * @group deprecated
 */
class HomepageTest extends BaseTestCase
{

    public function testHomePage()
    {
        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Erdiko', (string)$response->getBody());
        $this->assertContains('Hello', (string)$response->getBody());
    }

    public function testExamplePage()
    {
        $response = $this->runApp('GET', '/examples');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Erdiko Web Examples', (string)$response->getBody());
    }

    public function testThemePage()
    {
        $response = $this->runApp('GET', '/examples/theme');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Theme Engine Example', (string)$response->getBody());
    }

}
