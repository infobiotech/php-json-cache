<?php
/**
 * @package Infibiotech\JsonCache
 * @version 1.0.0-alpha
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 * @copyright (c) 2014-2017, Infobiotech S.r.l.
 * @license http://mit-license.org/
 * @uses psr/simple-cache
 */

namespace Infobiotech\JsonCache\Psr16;

/** SPL use block. */
use InvalidArgumentException as PhpInvalidArgumentException;
/** PSR-16 use block. */
use Psr\SimpleCache\InvalidArgumentException as PsrInvalidArgumentException;

/**
 * CacheInvalidArgumentException Class
 * Will be thrown if arguments given to caching functions are invalid or unacceptable.
 *
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 */
class InvalidArgumentException extends PhpInvalidArgumentException implements PsrInvalidArgumentException
{

}
