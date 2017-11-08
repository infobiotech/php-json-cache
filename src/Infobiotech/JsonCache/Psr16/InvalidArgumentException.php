<?php
/**
 * @package Infibiotech\JsonCache
 * @version 1.0.0-alpha
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 * @copyright (c) 2014-2017, Infobiotech S.r.l.
 * @license http://mit-license.org/
 * @uses psr/simple-cache
 */
declare(strict_types = 1);

namespace Infobiotech\JsonCache\Psr16;

/** SPL use block. */
use Throwable;
/** PSR-16 use block. */
use Psr\SimpleCache\CacheException as PsrCacheException;
use Psr\SimpleCache\InvalidArgumentException as PsrInvalidArgumentException;

/**
 * CacheInvalidArgumentException Class
 * Will be thrown if arguments given to caching functions are invalid or unacceptable.
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class InvalidArgumentException extends PsrCacheException implements PsrInvalidArgumentException
{

    /**
     * Creates the exception object.
     *
     * @param string         $message
     * @param Throwable|null $previous
     */
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
