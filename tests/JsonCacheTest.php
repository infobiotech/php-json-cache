<?php
/**
 * @package Infobiotech\JsonCache
 * @version 1.0.0-alpha
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 * @copyright (c) 2014-2017, Infobiotech S.r.l.
 * @license http://mit-license.org/
 * @uses phpunit/phpunit
 */

namespace Infobiotech\JsonCache\Psr16;

use Infobiotech\JsonCache\Psr16\Driver;

/**
 * JsonCacheTest Class
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class JsonCacheTest extends \PHPUnit\Framework\TestCase
{
    const TEST_NAMESPACE_1  = 'myNamespace';
    const TEST_NAMESPACE_2  = 'phpJsonCache';
    const TEST_STRING_VALUE = 'value';
    const TEST_INT_VALUE    = 19;

    protected $multipleValues = [
        'key1' => 'value1',
        'key2' => 'value2',
        'key3' => 'value3',
        'key4' => 'value4',
        'key5' => 'value5',
        'key6' => 'value6',
        'key7' => 'value7',
    ];

    public function testInstance()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_1
        );
        /*
         * Check if the instance was created and returned
         */
        $this->assertInstanceOf('Infobiotech\\JsonCache\\Psr16\\Driver', $cache);
        /*
         * Garbage collection
         */
        $this->assertTrue($cache->clear());
    }

    public function testInvalidArgumentException1()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_2
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->set(null, static::TEST_STRING_VALUE);
    }

    public function testInvalidArgumentException2()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_1
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->get(null);
    }

    public function testInvalidArgumentException3()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_2
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->delete(null);
    }

    public function testInvalidArgumentException4()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_1
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->getMultiple(null);
    }

    public function testInvalidArgumentException5()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_2
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->setMultiple(null);
    }

    public function testInvalidArgumentException6()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_1
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->deleteMultiple(null);
    }

    public function testInvalidArgumentException7()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), static::TEST_NAMESPACE_2
        );
        /*
         * Expecting an InvalidArgumentException
         */
        $this->expectException('InvalidArgumentException');
        $cache->has(null);
    }

    public function testAll()
    {
        /*
         * Create instance
         */
        $cache = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), self::TEST_NAMESPACE_1
        );
        /*
         *
         */
        $this->assertTrue($cache->set('key', static::TEST_STRING_VALUE));
        /*
         *
         */
        $this->assertEquals(static::TEST_STRING_VALUE, $cache->get('key'));
        /*
         *
         */
        $this->assertNull($cache->get('missing'));
        /*
         *
         */
        $this->assertTrue($cache->clear());
        /*
         *
         */
        $this->assertNull($cache->get('key'));
        /*
         *
         */
        $this->assertTrue($cache->set('key', static::TEST_STRING_VALUE, 1));
        /*
         *
         */
        $this->assertEquals(static::TEST_STRING_VALUE, $cache->get('key'));
        /*
         *
         */
        $this->assertEquals(0, sleep(2));
        /*
         *
         */
        $this->assertNull($cache->get('key'));
        /*
         *
         */
        $this->assertTrue($cache->set('int', static::TEST_INT_VALUE));
        /*
         *
         */
        $this->assertEquals(static::TEST_INT_VALUE, $cache->get('int'));
        /*
         *
         */
        $this->assertNull($cache->get('key'));
        /*
         *
         */
        $this->assertTrue($cache->clear());
        /*
         *
         */
        $this->assertNull($cache->get('int'));
        /*
         *
         */
        $this->assertTrue($cache->set('int', static::TEST_INT_VALUE, 1));
        /*
         *
         */
        $this->assertEquals(static::TEST_INT_VALUE, $cache->get('int'));
        /*
         *
         */
        $this->assertTrue($cache->delete('int'));
        /*
         *
         */
        $this->assertNull($cache->get('int'));
        /*
         *
         */
        $this->assertTrue($cache->clear());
        /*
         *
         */
        $this->assertTrue($cache->setMultiple($this->multipleValues));
        /*
         *
         */
        $this->assertTrue($cache->has('key1'));
        /*
         *
         */
        $this->assertEquals($this->multipleValues, $cache->getMultiple(array_keys($this->multipleValues)));
        /*
         *
         */
        $this->assertTrue($cache->deleteMultiple(array_keys($this->multipleValues)));
        /*
         *
         */
        $this->assertTrue($cache->clear());
    }

    public function testClear()
    {
        /*
         * Create instance
         */
        $cache1 = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), self::TEST_NAMESPACE_1
        );
        /*
         *
         */
        $this->assertTrue($cache1->clear());
        /*
         * Create instance
         */
        $cache2 = new Driver(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)), self::TEST_NAMESPACE_2
        );
        /*
         *
         */
        $this->assertTrue($cache2->clear());
    }
}
