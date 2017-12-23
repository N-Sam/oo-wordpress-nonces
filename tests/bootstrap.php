<?php

/**
 * A bootstrap file for PHPUnit.
 */

$vendor = dirname(__DIR__) . '/vendor/';

if (!realpath($vendor)) {
    die(
    	'Please, install all the necessary dependencies, 
    	using Composer, before trying to run the tests.'
    );
}

require_once $vendor . 'autoload.php';

unset($vendor);