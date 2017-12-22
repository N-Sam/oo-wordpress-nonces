<?php

namespace OoWordpressNonces\src;

/**
 * One of the most commonly used design patterns is the factory pattern.
 * In this pattern, a class simply creates the object you want to use.
 * 
 * @see http://www.phptherightway.com/pages/Design-Patterns.html
 */
class WpNonceFactory {
    /**
     * Default action.
     *
     * @var string DEFAULT_WP_ACTION
     */
    private const DEFAULT_WP_ACTION = -1;

    /**
     * Default nonce name.
     *
     * @var string DEFAULT_WP_NONCE_NAME
     */
    private const DEFAULT_WP_NONCE_NAME = '_wpnonce';

	/**
	 * Creates and returns a new WpNonce instance.
	 *
	 * @param  int|string $action 	-1|Scalar value to add context to the nonce.
	 * @return WpNonce
	 */
	public static function create(
        $action    = $this->DEFAULT_WP_ACTION,
        $nonceName = $this->DEFAULT_WP_NONCE_NAME
    ) {
		return new WpNonce($action, $nonceName);
	}
}