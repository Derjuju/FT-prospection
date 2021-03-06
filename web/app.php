<?php

// use statement ApcClassLoader must be placed here.
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Enable APC for autoloading to improve performance.
// You should change the ApcClassLoader first argument to a unique prefix
// in order to prevent cache key conflicts with other applications
// also using APC.
// must be placed here.

require_once __DIR__.'/../app/AppKernel.php';
// Call to AppCache.php must be placed here.

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
// definition of kernel AppCache must be placed here.

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
// must be placed here.
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
