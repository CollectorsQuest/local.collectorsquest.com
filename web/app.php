<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';
require_once __DIR__.'/../app/AppKernel.php';

if (in_array(@$_SERVER['REMOTE_ADDR'], array('172.16.183.1', '::1',))) {

    $kernel = new AppKernel('dev', true);
    $kernel->loadClassCache();

} else {

    require_once __DIR__.'/../app/AppCache.php';

    // Use APC for autoloading to improve performance
    // Change 'sf2' by the prefix you want in order to prevent key conflict with another application
    $loader = new ApcClassLoader('cq', $loader);
    $loader->register(true);

    $kernel = new AppKernel('prod', false);
    $kernel->loadClassCache();
    $kernel = new AppCache($kernel);
}

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);

