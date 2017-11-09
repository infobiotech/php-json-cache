<?php
/**
 * @package Infobiotech\JsonCache
 * @version v1.0.0-alpha
 * @author Alessandro Raffa, Infobiotech S.r.l. <a.raffa@infobiotech.net>
 * @copyright (c) 2014-2017, Infobiotech S.r.l.
 * @license http://mit-license.org/
 * @uses league/climate
 */
/*
 *
 */
require 'vendor/autoload.php';
/*
 *
 */
$climate           = new League\CLImate\CLImate();
$climate->backgroundBlack()->clear();
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->addArt('art');
$climate->backgroundBlack()->draw('banner-infobiotech-colored');
$climate->backgroundBlack()->lightGray()->border();
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->bold()->out('infobiotech/php-json-cache v1.0.0-alpha client example');
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->lightGray()->border();
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Creating Flysystem\Adapter\Local instance... ');
$filesystemAdapter = new League\Flysystem\Adapter\Local('.');
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->lightGreen()->bold()->inline('done');
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Creating JsonCache instance... ');
$jsonCacheDriver   = new Infobiotech\JsonCache\Psr16\Driver($filesystemAdapter, uniqid());
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->lightGreen()->bold()->inline('done');
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Generating a random value... ');
$value             = uniqid();
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($value, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Storing the value... ');
$jsonCacheDriver->set('key', $value);
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->lightGreen()->bold()->inline('done');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Getting the value... ');
$checkValue        = $jsonCacheDriver->get('key');
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($checkValue, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Verifying the value... ');
usleep(mt_rand(150000, 800000));
if ($checkValue === $value) {
    $climate->backgroundBlack()->lightGreen()->bold()->inline('verified');
} else {
    $climate->backgroundBlack()->red()->bold()->inline('FAILED');
}
unset($checkValue, $value);
usleep(mt_rand(150000, 800000));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Generating a random value... ');
$ttlValue      = uniqid();
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($ttlValue, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Generating a random TTL... ');
$ttl           = mt_rand(3, 7);
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($ttl, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Setting the value with the TTL... ');
$jsonCacheDriver->set('ttlkey', $ttlValue, $ttl);
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($ttlValue, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Getting the value before expiration... ');
$checkTtlValue = $jsonCacheDriver->get('ttlkey');
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($checkTtlValue, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Verifying the value before expiration... ');
if ($checkTtlValue === $ttlValue) {
    usleep(mt_rand(150000, 800000));
    $climate->backgroundBlack()->lightGreen()->bold()->inline('verified');
} else {
    usleep(mt_rand(150000, 800000));
    $climate->backgroundBlack()->red()->bold()->inline('FAILED');
}
unset($checkTtlValue, $ttlValue);
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->out('Wait for value expiration');
$progress = $climate->backgroundBlack()->white()->progress()->total(100);
for ($i = 0; $i <= 100; $i++) {
    $progress->current($i);
    usleep(mt_rand($ttl * 1250, $ttl * 40000));
    if (mt_rand(0, 100) > 50) {
        $i++;
    }
}
/*
 *
 */
$climate->backgroundBlack()->white()->inline('Getting the value after expiration... ');
usleep(mt_rand(150000, 800000));
$checkExpiredValue = $jsonCacheDriver->get('ttlkey');
$climate->backgroundBlack()->magenta()->bold()->inline(var_export($checkExpiredValue, true));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Verifying empty value after expiration... ');
usleep(mt_rand(150000, 800000));
if (empty($checkExpiredValue)) {
    $climate->backgroundBlack()->lightGreen()->bold()->inline('verified');
} else {
    $climate->backgroundBlack()->red()->bold()->inline('FAILED: value is '.var_export($checkExpiredValue, true));
}
unset($checkTtlValue, $ttlValue);
usleep(mt_rand(150000, 800000));
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Cleaning up JsonCache...');
$jsonCacheDriver->clear();
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->lightGreen()->bold()->inline('done');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
$climate->backgroundBlack()->white()->out('');
$climate->backgroundBlack()->white()->inline('Unsetting local variable...');
unset($jsonCacheDriver);
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->lightGreen()->bold()->inline('done');
$climate->backgroundBlack()->white()->out('');
usleep(mt_rand(150000, 800000));
$climate->backgroundBlack()->white()->out('');
/*
 *
 */
unset($climate);
/*
 *
 */
exit(1);
