<?php

namespace Infobiotech;

/**
 * JsonCacheTest Class.
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class JsonCacheTest extends \PHPUnit\Framework\TestCase
{
    const TEST_NAMESPACE_1 = 'myNamespace';
    const TEST_NAMESPACE_2 = 'phpJsonCache';
    const TEST_STRING_VALUE = 'value';
    const TEST_INT_VALUE = 19;

    public function testInstance()
    {
        $cache = new JsonCache(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)),
                static::TEST_NAMESPACE_1
        );
        $this->assertInstanceOf('Infobiotech\\JsonCache', $cache);
    }

    public function testAll()
    {
        $cache = new JsonCache(
                new \League\Flysystem\Adapter\Local(dirname(__FILE__)),
                self::TEST_NAMESPACE_2
        );
        $this->assertTrue($cache->set('key', static::TEST_STRING_VALUE));
        $this->assertEquals(static::TEST_STRING_VALUE, $cache->get('key'));
        $this->assertNull($cache->get('missing'));
        $this->assertTrue($cache->clear());
        $this->assertNull($cache->get('key'));
        $this->assertTrue($cache->set('key', static::TEST_STRING_VALUE, 1));
        $this->assertEquals(static::TEST_STRING_VALUE, $cache->get('key'));
        $this->assertEquals(0, sleep(2));
        $this->assertNull($cache->get('key'));
        $this->assertTrue($cache->set('int', static::TEST_INT_VALUE));
        $this->assertEquals(static::TEST_INT_VALUE, $cache->get('int'));
        $this->assertNull($cache->get('key'));
        $this->assertTrue($cache->clear());
        $this->assertNull($cache->get('int'));
        $this->assertTrue($cache->set('int', static::TEST_INT_VALUE, 1));
        $this->assertEquals(static::TEST_INT_VALUE, $cache->get('int'));
        $this->assertTrue($cache->delete('int'));
        $this->assertNull($cache->get('int'));
        $this->assertTrue($cache->clear());
    }
}
