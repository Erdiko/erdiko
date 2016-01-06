<?php
namespace tests\erdiko;

use erdiko\core\Cache;

require_once dirname(__DIR__).'/ErdikoTestCase.php';


class CacheTest extends \tests\ErdikoTestCase
{

    public function setUp()
    {
        //Cache::forgetAll('memcache');
    }

    public function tearDown()
    {
        Cache::forgetALL();
    }

    public function testGetCacheObject()
    {
        $defaultObj = Cache::getCacheObject();
        Cache::forgetALL();
        /**
         *  Precondition
         *
         *  Check if there is nothing
         */
        $key = 'Test_Has_Key';
        $data = 'Test_Has_Data';
        $return = $defaultObj->has($key);
        $this->assertFalse($return);

        //Add a data
        $defaultObj->put($key, $data);

        //Check if the data exists
        $return = $defaultObj->has($key);
        $this->assertTrue($return);


        $memcache = 'memcached';
        $memcacheObj = Cache::getCacheObject($memcache)->getObject();
        Cache::forgetALL($memcache);
        /**
         *  Memcache Object
         *
         *  Precondition
         *
         *  Check if there is nothing
         */
        $key = 'Test_Has_Key';
        $data = 'Test_Has_Data';
        $return = $memcacheObj->get($key);
        $this->assertFalse($return);

        //Add a data
        $memcacheObj->set($key, $data);

        //Validate returned data
        $return = $memcacheObj->get($key);
        $this->assertEquals($data, $return);

    }

    /**
     *
     *  @depends testGetCacheObject
     *
     */
    public function testHas()
    {
        Cache::forgetAll();
        Cache::forgetAll('memcached');
        /**
         *  Precondition
         *
         *  Check if there is nothing
         */
        $key = 'Test_Has_Key';
        $data = 'Test_Has_Data';
        $return = Cache::has($key);
        $this->assertFalse($return);

        //Add a data
        Cache::put($key, $data);

        //Check if the data exists
        $return = Cache::has($key);
        $this->assertTrue($return);


        /**
         *  Memcache
         *
         *  Precondition
         *
         *  Check if there is nothing
         */
        $memcache = 'memcached';
        $key = 'Test_Has_Key';
        $data = 'Test_Has_Data';
        $return = Cache::has($key, $memcache);
        $this->assertFalse($return);

        //Add a data
        Cache::put($key, $data, $memcache);

        //Check if the data exists
        $return = Cache::has($key, $memcache);
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
        $return = Cache::has($key);
        $this->assertFalse($return);

        /**
         *  String Test
         *
         *  Pass a string data to cache
         */
        Cache::put($key, "test");
        $return=Cache::get($key);
        $this->assertEquals($return, "test");

        /**
         *  Array Test
         *
         *  Pass an array data to cache
         */
        $arr = array(
                '1' => 'test1',
                '2' => 'test2'
                );

        $key = 'arrayTest';
        Cache::put($key, $arr);
        $return=Cache::get($key);
        $this->assertEquals($return, $arr);

        /**
         *  JSON Test
         *
         *  Pass a JSON data to cache
         */
        $arr = array(
                '1' => 'test1',
                '2' => 'test2'
                );
        $arr = json_encode($arr);
        $key = 'arrayTest';
        Cache::put($key, $arr);
        $return=Cache::get($key);
        $this->assertEquals($return, $arr);

        /**
         *
         *  Memcache Test
         *
         *
         **/
        /**
         *  Precondition
         *
         *  Check if there is nothing
         */
        $memcache = 'memcached';
        $key = 'stringTest';
        $return = Cache::has($key, $memcache);
        $this->assertFalse($return);
        $return = Cache::get('non exist');
        $this->assertEquals($return, null);

        /**
         *  String Test
         *
         *  Pass a string data to cache
         */
        Cache::put($key, "test", $memcache);
        $return=Cache::get($key, $memcache);
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
        Cache::put($key, $arr, $memcache);
        $return= Cache::get($key, $memcache);
        
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
        Cache::put($key, null, $memcache);
        $return= Cache::get($key, $memcache);
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
        Cache::put($key, $jsonArr, $memcache);
        $return= Cache::get($key, $memcache);
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
        Cache::put($key, $obj, $memcache);
        $return= Cache::get($key, $memcache);
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
        $return = Cache::has($key);
        $this->assertFalse($return);

        //Add a data
        Cache::put($key, $data);

        //Check if the data exists
        $return = Cache::has($key);
        $this->assertTrue($return);

        /**
         *  Remove the data
         */
        Cache::forget($key);
        
        //Check if the data being removed
        $return = Cache::has($key);
        $this->assertFalse($return);

        /**
         *  Memcache
         *
         *  Precondition
         *
         *  Check if there is nothing
         */
        $memcache = 'memcached';
        $key = 'Test_Key';
        $data = 'Test_Data';
        $return = Cache::has($key, $memcache);
        $this->assertFalse($return);

        //Add a data
        Cache::put($key, $data, $memcache);

        //Check if the data exists
        $return = Cache::has($key, $memcache);
        $this->assertTrue($return);

        /**
         *  Remove the data
         */
        Cache::forget($key, $memcache);
        
        //Check if the data being removed
        $return = Cache::has($key, $memcache);
        $this->assertFalse($return);
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
        Cache::put($key, $data);
        $return=Cache::get($key);
        $this->assertEquals($return, $data);

        /**
         *  Validate the data
         */
        $return = Cache::has($key);
        $this->assertTrue($return);

        //Second Data
        $key2 = 'Test_Key2';
        $data2 = 'Test_Data2';
        Cache::put($key2, $data2);
        $return=Cache::get($key2);
        $this->assertEquals($return, $data2);

        /**
         *  Validate the data
         */
        $return = Cache::has($key);
        $this->assertTrue($return);

        /**
         *  Remove all data
         */
        Cache::forgetALL();

        //Check if all data are removed
        $return = Cache::has($key);
        $this->assertFalse($return);
        $return = Cache::has($key2);
        $this->assertFalse($return);


        /**
         *  Memcache
         *
         *  Insert two data
         */
        $memcache = 'memcached';
        //First Data
        $key = 'Test_Key';
        $data = 'Test_Data';
        Cache::put($key, $data, $memcache);
        $return=Cache::get($key, $memcache);
        $this->assertEquals($return, $data);

        /**
         *  Validate the data
         */
        $return = Cache::has($key, $memcache);
        $this->assertTrue($return);

        //Second Data
        $key2 = 'Test_Key2';
        $data2 = 'Test_Data2';
        Cache::put($key2, $data2, $memcache);
        $return=Cache::get($key2, $memcache);
        $this->assertEquals($return, $data2);

        /**
         *  Validate the data
         */
        $return = Cache::has($key, $memcache);
        $this->assertTrue($return);

        /**
         *  Remove all data
         */
        Cache::forgetALL($memcache);

        //Check if all data are removed
        $return = Cache::has($key, $memcache);
        $this->assertFalse($return);
        $return = Cache::has($key2, $memcache);
        $this->assertFalse($return);
    }
}
