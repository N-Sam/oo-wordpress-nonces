<?php

namespace JosepCrespo\OoWordpressNonces\Tests;

use Brain\Monkey;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

/**
 * Extends the original PHPUnit TestCase class,
 * for setting up the Monkey utility.
 */
class TestCase extends PhpUnitTestCase {
    /**
     * Sets up the environment.
     *
     * @return void
     */
    protected function setUp() {
        parent::setUp();
        Monkey\setUp();
    }

    /**
     * Tears down the environment.
     *
     * @return void
     */
    protected function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}