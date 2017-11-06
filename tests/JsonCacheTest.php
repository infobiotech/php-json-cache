<?php

namespace Infobiotech;

/**
 * JsonCacheTest Class
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class JsonCacheTest extends \PHPUnit_Framework_TestCase
{

  public function testSet()
  {
    $cache = new JsonCache(
        new \League\Flysystem\Adapter\Local(dirname(__FILE__)), 'myNamespace'
    );
    $this->assertTrue($cache->set('key', 'value'));
  }
}