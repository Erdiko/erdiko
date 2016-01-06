<?php
/**
 *  Please make sure to start Memcached service before running this test.
 *
 */
namespace tests\erdiko;

use erdiko\core\cache\Memcached;

require_once dirname(__DIR__).'/ErdikoTestCase.php';

class MemcachedTest extends \tests\ErdikoTestCase
{
    public $memcacheObj;


    public function setUp()
    {
        $this->memcacheObj = new Memcached;
    }

    public function tearDown()
    {
        unset($this->memcacheObj);
    }

    public function testHas()
    {
        /**
         *  Remove all data
         */
        $this->memcacheObj->forgetAll();

        /**
         *  Precondition
         *
         *  Check if there is nothing
         */

        $key = 'Test_Has_Key';
        $data = 'Test_Has_Data';
        $return =  $this->memcacheObj->has($key);
        $this->assertFalse($return);

        //Add a data
        $this->memcacheObj->put($key, $data);

        //Check if the data exists
        $return = $this->memcacheObj->has($key);
        $this->assertTrue($return);
    }

    /**
     *
     *  @depends testHas
     *
     */
    public function testPutAndGet()
    {
        /**
         *  Precondition
         *
         *  Check if there is nothing
         */
        $key = 'stringTest';
        $return = $this->memcacheObj->has($key);
        $this->assertFalse($return);
        $return = $this->memcacheObj->get('non exist');
        $this->assertEquals($return, null);

        /**
         *  String Test
         *
         *  Pass a string data to cache
         */
        $this->memcacheObj->put($key, "test");
        $return= $this->memcacheObj->get($key);
        $this->assertEquals($return, "test");

        /**
         *  Array Test
         *
         *  Pass an array data to cache
         */
        
        $arr = array(
                'index_one' => 'test_data_one',
                'index_two' => 'test_data_two'
                );

        $key = 'arrayTest';
        $this->memcacheObj->put($key, $arr);
        $return= $this->memcacheObj->get($key);
        
        $castedReturn = (array) $return;
        $this->assertEquals($castedReturn['index_one'], $arr['index_one']);
        $this->assertEquals($castedReturn['index_two'], $arr['index_two']);
        $this->assertEquals($arr, $castedReturn);

        /**
         *  Null Test
         *
         *  Pass null to cache
         */
        $key = 'nullTest';
        $this->memcacheObj->put($key, null);
        $return= $this->memcacheObj->get($key);
        $this->assertEquals($return, null);


        /**
         *  JSON Test
         *
         *  Pass a JSON data to cache
         */
        $arr = array(
                'index_one' => 'test_data_one',
                'index_two' => 'test_data_two'
                );
        $jsonArr = json_encode($arr);
        $key = 'jsonTest';
        $this->memcacheObj->put($key, $jsonArr);
        $return= $this->memcacheObj->get($key);
        //Check if the JSON return equals to the input
        $this->assertEquals($return, $jsonArr);
        //Get the original array
        $return = json_decode($return);
        $castedReturn = (array) $return;

        $this->assertEquals($castedReturn['index_one'], $arr['index_one']);
        $this->assertEquals($castedReturn['index_two'], $arr['index_two']);
        $this->assertEquals($arr, $castedReturn);


        /**
         *  Oject Test
         *
         *  Pass a Object to cache
         *  Custom class won't work
         */
        $obj = new stdClass();
        $obj->var1 = 'Test_var_one';
        $obj->var2 = 'Test_var_two';
        $key = 'objectTest';
        $this->memcacheObj->put($key, $obj);
        $return= $this->memcacheObj->get($key);
        $this->assertEquals($obj, $return);
        $this->assertEquals($obj->var1, $return->var1);
        $this->assertEquals($obj->var2, $return->var2);
    }

    /**
     *
     *  @depends testPutAndGet
     *
     */
    public function testForget()
    {
        /**
         *  Precondition
         *
         *  Check if there is nothing
         */
        $key = 'Test_Key';
        $data = 'Test_Data';
        $return = $this->memcacheObj->has($key);
        $this->assertFalse($return);

        //Add a data
        $this->memcacheObj->put($key, $data);

        //Check if the data exists
        $return = $this->memcacheObj->has($key);
        $this->assertTrue($return);

        /**
         *  Remove the data
         */
        $this->memcacheObj->forget($key);
        
        //Check if the data being removed
        $return = $this->memcacheObj->has($key);
    }
    
    /**
     *
     *  @depends testPutAndGet
     *  @depends testHas
     *  @depends testForget
     */
    public function testForgetAll()
    {
        /**
         *  Insert two data
         */
        //First Data
        $key = 'Test_Key';
        $data = 'Test_Data';
        $this->memcacheObj->put($key, $data);
        $return=$this->memcacheObj->get($key);
        $this->assertEquals($return, $data);

        /**
         *  Validate the data
         */
        $return = $this->memcacheObj->has($key);
        $this->assertTrue($return);

        //Second Data
        $key2 = 'Test_Key2';
        $data2 = 'Test_Data2';
        $this->memcacheObj->put($key2, $data2);
        $return=$this->memcacheObj->get($key2);
        $this->assertEquals($return, $data2);

        /**
         *  Validate the data
         */
        $return = $this->memcacheObj->has($key);
        $this->assertTrue($return);

        /**
         *  Check the cache in testPutAndGet
         **/
        $return = $this->memcacheObj->has('stringTest');
        $this->assertTrue($return);
        $return = $this->memcacheObj->has('arrayTest');
        $this->assertTrue($return);
        $return = $this->memcacheObj->has('nullTest');
        $this->assertTrue($return);
        $return = $this->memcacheObj->has('objectTest');
        $this->assertTrue($return);

        /**
         *  Remove all data
         */
        $this->memcacheObj->forgetAll();

        //Check if all data are removed
        $return = $this->memcacheObj->has($key);
        $this->assertFalse($return);
        $return = $this->memcacheObj->has($key2);
        $this->assertFalse($return);
        $return = $this->memcacheObj->has('stringTest');
        $this->assertFalse($return);
        $return = $this->memcacheObj->has('arrayTest');
        $this->assertFalse($return);
        $return = $this->memcacheObj->has('nullTest');
        $this->assertFalse($return);
        $return = $this->memcacheObj->has('objectTest');
        $this->assertFalse($return);
    }
}
