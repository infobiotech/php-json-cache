<?php
/**
 * @package Infobiotech\JsonCache
 * @version v1.0.0-alpha
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 * @copyright (c) 2014-2017, Infobiotech S.r.l.
 * @license http://mit-license.org/
 * @uses league/flysystem
 * @uses psr/simple-cache
 */

namespace Infobiotech\JsonCache\Psr16;

/*
 *
 */

use Psr\SimpleCache\CacheInterface;
use League\Flysystem\Filesystem;
use League\Flysystem\AdapterInterface as FlysystemAdapter;
use Infobiotech\JsonCache\Psr16\InvalidArgumentException;

/**
 * A key-value JSON-based PSR-16 cache implementation.
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class Driver implements CacheInterface
{
    /*
     *
     */
    const FILED_VALUE      = 'value';
    const FILED_EXPIRATION = 'expiration';
    /*
     *
     */
    const DEFAULT_TTL      = 1200;

    /**
     *
     * @var \League\Flysystem\Filesystem
     */
    protected $filesystem;

    /**
     *
     * @var string
     */
    protected $namespace;

    /**
     *
     * @param FlysystemAdapter $filesystemAdapter
     * @param string $namespace
     * @return JsonCache
     */
    public function __construct(FlysystemAdapter $filesystemAdapter, $namespace)
    {
        /*
         *
         */
        $this->filesystem = new Filesystem($filesystemAdapter);
        /*
         *
         */
        $this->namespace  = $namespace.'.json';
        /*
         *
         */
        return $this;
    }

    /**
     * Fetches a value from the cache.
     *
     * @param string $key     The unique key of this item in the cache.
     * @param mixed  $default Default value to return if the key does not exist.
     *
     * @return mixed The value of the item from the cache, or $default in case of cache miss.
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     *
     * @todo Implement better $key validation and filtering
     */
    public function get($key, $default = null)
    {
        $value = $default;
        if (!is_string($this->filterValidateKey($key))) {
            throw new InvalidArgumentException();
        }
        $data = $this->getDataFromStorage();
        if (isset($data[$key]) && isset($data[$key][self::FILED_EXPIRATION])) {
            if ($data[$key][self::FILED_EXPIRATION] > microtime(true)) {
                $value = $data[$key][self::FILED_VALUE];
            }
        }
        return $value;
    }

    /**
     * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
     *
     * @param string                $key   The key of the item to store.
     * @param mixed                 $value The value of the item to store, must be serializable.
     * @param null|int|DateInterval $ttl   Optional. The TTL value of this item. If no value is sent and
     *                                     the driver supports TTL then the library may set a default value
     *                                     for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     *
     * @todo Implement better $key validation and filtering
     */
    public function set($key, $value, $ttl = null)
    {
        if (!is_string($this->filterValidateKey($key))) {
            throw new InvalidArgumentException();
        }
        if (empty($ttl) || !is_numeric($ttl)) {
            $ttl = self::DEFAULT_TTL;
        }
        $data       = $this->getDataFromStorage();
        $data[$key] = [
            self::FILED_VALUE      => $value,
            self::FILED_EXPIRATION => microtime(true) + (float) $ttl,
        ];
        return $this->saveDataToStorage($data);
    }

    /**
     * Delete an item from the cache by its unique key.
     *
     * @param string $key The unique cache key of the item to delete.
     *
     * @return bool True if the item was successfully removed. False if there was an error.
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function delete($key)
    {
        if (!is_string($this->filterValidateKey($key))) {
            throw new InvalidArgumentException();
        }
        $data = $this->getDataFromStorage();
        if (isset($data[$key])) {
            unset($data[$key]);
        }
        return $this->saveDataToStorage($data);
    }

    /**
     * Wipes clean the entire cache's keys.
     *
     * @return bool True on success and false on failure.
     */
    public function clear()
    {
        return $this->deleteStorage();
    }

    /**
     * Obtains multiple cache items by their unique keys.
     *
     * @param iterable $keys    A list of keys that can obtained in a single operation.
     * @param mixed    $default Default value to return for keys that do not exist.
     *
     * @return iterable A list of key => value pairs.
     *      Cache keys that do not exist or are stale will have $default as value.
     *
     * @throws InvalidArgumentException
     *      MUST be thrown if $keys is neither an array nor a Traversable,
     *      or if any of the $keys are not a legal value.
     */
    public function getMultiple($keys, $default = null)
    {
        if (!is_array($keys)) {
            throw new InvalidArgumentException();
        }
        $values = [];
        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $default);
        }
        return $values;
    }

    /**
     * Persists a set of key => value pairs in the cache, with an optional TTL.
     *
     * @param iterable              $values A list of key => value pairs for a multiple-set operation.
     * @param null|int|DateInterval $ttl    Optional. The TTL value of this item. If no value is sent and
     *                                      the driver supports TTL then the library may set a default value
     *                                      for it or let the driver take care of that.
     *
     * @return bool True on success and false on failure.
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if $values is neither an array nor a Traversable,
     *   or if any of the $values are not a legal value.
     */
    public function setMultiple($values, $ttl = null)
    {
        $failure = false;
        if (!is_array($values)) {
            throw new InvalidArgumentException();
        }
        foreach ($values as $key => $value) {
            if (!$this->set($key, $value, $ttl)) {
                $failure = true;
            }
        }
        return (bool) !$failure;
    }

    /**
     * Deletes multiple cache items in a single operation.
     *
     * @param iterable $keys A list of string-based keys to be deleted.
     *
     * @return bool True if the items were successfully removed. False if there was an error.
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if $keys is neither an array nor a Traversable,
     *   or if any of the $keys are not a legal value.
     */
    public function deleteMultiple($keys)
    {
        $failure = false;
        if (!is_array($keys)) {
            throw new InvalidArgumentException();
        }
        foreach ($keys as $key) {
            if (!$this->delete($key)) {
                $failure = true;
            }
        }
        return (bool) !$failure;
    }

    /**
     * Determines whether an item is present in the cache.
     *
     * NOTE: It is recommended that has() is only to be used for cache warming type purposes
     * and not to be used within your live applications operations for get/set, as this method
     * is subject to a race condition where your has() will return true and immediately after,
     * another script can remove it making the state of your app out of date.
     *
     * @param string $key The cache item key.
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     *   MUST be thrown if the $key string is not a legal value.
     */
    public function has($key)
    {
        $has = false;
        if (!is_string($this->filterValidateKey($key))) {
            throw new InvalidArgumentException();
        }
        $data = $this->getDataFromStorage();
        if (isset($data[$key])) {
            $has = true;
        }
        return $has;
    }

    /**
     *
     * @return array
     */
    protected function getDataFromStorage()
    {
        if (!$this->filesystem->has($this->namespace)) {
            $this->filesystem->write($this->namespace, json_encode([]));
        }
        return json_decode($this->filesystem->read($this->namespace), true);
    }

    /**
     *
     * @param array $data
     * @return boolean
     */
    protected function saveDataToStorage($data)
    {
        return (bool) $this->filesystem->put($this->namespace, json_encode($data));
    }

    /**
     *
     * @param array $data
     * @return boolean
     */
    protected function deleteStorage()
    {
        if ($this->filesystem->has($this->namespace)) {
            return (bool) $this->filesystem->delete($this->namespace);
        }
        return true;
    }

    /**
     *
     * @param string $key
     * @return string|boolean
     */
    protected function filterValidateKey($key)
    {
        if (!is_string($key)) {
            return false;
        }
        return $key;
    }
}
