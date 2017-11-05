<?php
namespace Infobiotech;
include '../vendor/autoload.php';
// Create new JsonCache instance
$jsonCache = new JsonCache(
  new \League\Flysystem\Adapter\Local(dirname(__FILE__))
);
// Setting a key
$jsonCache->set('key', 'value');
// Getting the value of key
echo $jsonCache->get('key');
