<?php

namespace JosepCrespo\OoWordpressNonces\Tests;

use Brain\Monkey\Functions as MonkeyFunctions;
use JosepCrespo\OoWordpressNonces\WpNonceFactory;
use JosepCrespo\OoWordpressNonces\WpNonce;

/**
 * Test case for the WpNonce class methods.
 */
class WpNonceTest extends TestCase {
    /**
     * Tests the WpNonce::ays method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::ays
     * @return void
     */
    public function testAys() {
        $customAction = 'a_custom_action';
        $result       = WpNonce::ays($customAction);
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_nonce_ays')
            ->once()
            ->with($customAction);
        WpNonce::ays($customAction);
    }

    /**
     * Tests the WpNonce::commentFormUnfilteredHtml method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::commentFormUnfilteredHtml
     * @return void
     */
    public function testCommentFormUnfilteredHtml() {
        $result = WpNonce::commentFormUnfilteredHtml();
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_comment_form_unfiltered_html_nonce')
            ->once();
        WpNonce::commentFormUnfilteredHtml();
    }

    /**
     * Tests the WpNonce::field method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::field
     * @return void
     */
    public function testField() {
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $wpNonce = $wpNonceFactory->create();
        $result  = $wpNonce->field();
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_nonce_field')
            ->once()
            ->andReturn('<html>field</html>');
        $result = $wpNonce->field();
        $this->assertEquals('<html>field</html>', $result);
    }

    /**
     * Tests the WpNonce::refreshPostNonces method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::refreshPostNonces
     * @return void
     */
    public function testRefreshPostNonces() {
        $customResponse = ['a_custom_array'];
        $customData     = ['a_custom_data_array'];
        $customScreenId = 'a_custom_screen_id';
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $wpNonce = $wpNonceFactory->create();
        $result  = $wpNonce->refreshPostNonces($customResponse, $customData, $customScreenId);
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_refresh_post_nonces')
            ->once()
            ->with($customResponse, $customData, $customScreenId)
            ->andReturn([]);
        $result = $wpNonce->refreshPostNonces($customResponse, $customData, $customScreenId);
        $this->assertEquals([], $result);
    }

    /**
     * Tests the WpNonce::signupNonceCheck method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::signupNonceCheck
     * @return void
     */
    public function testSignupNonceCheck() {
        $customSignUpFields = ['a', 'custom', 'signup', 'fields', 'array'];
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $wpNonce = $wpNonceFactory->create();
        $result  = $wpNonce->signupNonceCheck($customSignUpFields);
        $this->assertFalse($result);
        MonkeyFunctions\expect('signup_nonce_check')
            ->once()
            ->with($customSignUpFields)
            ->andReturn([]);
        $result = $wpNonce->signupNonceCheck($customSignUpFields);
        $this->assertEquals([], $result);
    }

    /**
     * Tests the WpNonce::signupNonceFields method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::signupNonceFields
     * @return void
     */
    public function testSignupNonceFields() {
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $wpNonce = $wpNonceFactory->create();
        $result  = $wpNonce->signupNonceFields();
        $this->assertFalse($result);
        MonkeyFunctions\expect('signup_nonce_fields')->once();
        $wpNonce->signupNonceFields();
    }

    /**
     * Tests the WpNonce::tick method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::tick
     * @return void
     */
    public function testTick() {
        $result  = WpNonce::tick();
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_nonce_tick')
            ->once()
            ->andReturn(10);
        $result = WpNonce::tick();
        $this->assertEquals(10, $result);
    }

    /**
     * Tests the WpNonce::url method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::url
     * @return void
     */
    public function testUrl() {
        $actionUrl      = 'http://www.supercooldomain.com';
        $wpNonceFactory = new WpNonceFactory();
        MonkeyFunctions\expect('wp_create_nonce')->once();
        $wpNonce = $wpNonceFactory->create();
        $result  = $wpNonce->url($actionUrl);
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_nonce_url')
            ->once()
            ->andReturn($actionUrl . '?escaped=with-nonce-action');
        $result = $wpNonce->url($actionUrl);
        $this->assertStringStartsWith('http', $result);

    }

    /**
     * Tests the WpNonce::verify method.
     *
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::__construct
     * @covers JosepCrespo\OoWordpressNonces\WpNonceFactory::create
     * @covers JosepCrespo\OoWordpressNonces\WpNonce::verify
     * @return void
     */
    public function testVerify() {
        $customToken = 'a_custom_token';
        $result      = WpNonce::verify($customToken);
        $this->assertFalse($result);
        MonkeyFunctions\expect('wp_verify_nonce')
            ->once()
            ->andReturn(1);
        $result = WpNonce::verify($customToken);
        $this->assertEquals(1, $result);
        MonkeyFunctions\expect('wp_verify_nonce')
            ->once()
            ->andReturn(2);
        $result = WpNonce::verify($customToken);
        $this->assertEquals(2, $result);
    }
}