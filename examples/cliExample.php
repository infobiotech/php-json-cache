<?php
/*
 * For this example `composer require league/climate`
 */
require 'vendor/autoload.php';
$climate = new League\CLImate\CLImate();
$climate->clear();
$climate->out('');
$climate->bold()->out('infobiotech/php-json-cache client example');
$climate->out('');

function fakeProcessTime()
{
    usleep(mt_rand(150000, 800000));
}
/*
 *
 */
$climate->out('');
$climate->out('Creating JsonCache instance...');
$jsonCache  = new Infobiotech\JsonCache(
        new League\Flysystem\Adapter\Local('cache'), uniqid()
);
fakeProcessTime();
/*
 *
 */
$climate->out('');
$climate->inline('Setting a value... ');
fakeProcessTime();
$value      = uniqid();
$jsonCache->set('key', $value);
$climate->inline($value);
fakeProcessTime();
/*
 *
 */
$climate->out('');
$climate->inline('Getting the value... ');
fakeProcessTime();
$checkValue = $jsonCache->get('key');
$climate->inline($checkValue);
/*
 *
 */
$climate->out('');
$climate->inline('Verifying the value... ');
fakeProcessTime();
if ($checkValue === $value) {
    $climate->inline('VERIFIED');
} else {
    $climate->red()->bold()->inline('FAILED');
}
fakeProcessTime();
/*
 *
 */
$climate->out('');
$climate->out('Cleaning up JsonCache...');
$climate->out('');
$jsonCache->clear();
fakeProcessTime();
