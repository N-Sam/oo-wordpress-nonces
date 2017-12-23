<?php

namespace JosepCrespo\OoWordpressNonces\Tests;

use Brain\Monkey\Functions as MonkeyFunctions;
use JosepCrespo\OoWordpressNonces\WpNonceFactory;
use JosepCrespo\OoWordpressNonces\WpNonce;

/**
 * Test case for the WpNonceFactory class and the WpNonce class constructor.
 */
class WpNonceFactoryTest extends TestCase {
    /**
     * Tests the WpNonceFactory::create method with default parameters.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getAction
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getNonceName
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getToken
     * @return void
     */
    public function testCreateWithDefaultParameters() {
        $defaultAction    = -1;
        $defaultNonceName = '_wpnonce';
        $notSetToken      = '';
        $wpNonceFactory   = new WpNonceFactory();
        $wpNonce          = $wpNonceFactory->create();

        $this->assertInstanceOf(WpNonce::class, $wpNonce);
        $this->assertObjectHasAttribute('action', $wpNonce);
        $this->assertObjectHasAttribute('nonceName', $wpNonce);
        $this->assertObjectHasAttribute('token', $wpNonce);
        $this->assertSame($defaultAction, $wpNonce->getAction());
        $this->assertSame($defaultNonceName, $wpNonce->getNonceName());
        $this->assertSame($notSetToken, $wpNonce->getToken());
    }

    /**
     * Tests the WpNonceFactory::create method with custom parameters.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getAction
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getNonceName
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::getToken
     * @return void
     */
    public function testCreateWithCustomParameters() {
        $customAction    = 'a_custom_action';
        $customNonceName = 'a_custom_nonce_name';
        $token           = 'a_nonce_generated_hash';
        $wpNonceFactory  = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')
            ->with($customAction)
            ->andReturn($token);
        $wpNonce = $wpNonceFactory->create($customAction, $customNonceName);

        $this->assertSame($customAction, $wpNonce->getAction());
        $this->assertSame($customNonceName, $wpNonce->getNonceName());
        $this->assertSame($token, $wpNonce->getToken());
    }
}