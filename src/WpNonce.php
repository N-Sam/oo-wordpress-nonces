<?php

namespace OopWordPressNonces\src;

/**
 * A class to work with nonces in WordPress.
 * It uses the original WordPress functions (the main ones) to work with nonces.
 *
 * @see https://developer.wordpress.org/?s=nonce
 * @see https://codex.wordpress.org/WordPress_Nonces
 */
class WpNonce {
    /**
     * Process the signup nonce created in signup_nonce_fields().
     * 
     * @var string SIGNUP_NONCE_CHECK
     */
    private const SIGNUP_NONCE_CHECK = 'signup_nonce_check';

    /**
     * Add a nonce field to the signup page.
     * 
     * @var string SIGNUP_NONCE_FIELDS
     */
    private const SIGNUP_NONCE_FIELDS = 'signup_nonce_fields';

    /**
     * The original WordPress nonce `ays` function name.
     *
     * @var string WP_NONCE_AYS_FUNCTION_NAME
     */
    private const WP_CREATE_NONCE_FUNCTION_NAME = 'wp_create_nonce';

    /**
     * The original WordPress nonce `ays` function name.
     *
     * @var string WP_NONCE_AYS_FUNCTION_NAME
     */
    private const WP_NONCE_AYS_FUNCTION_NAME = 'wp_nonce_ays';

    /**
     * The original WordPress nonce `comment_form_unfiltered_html` function name.
     *
     * @var string WP_NONCE_COMMENT_FORM_UNFILTERED_HTML_FUNCTION_NAME
     */
    private const WP_NONCE_COMMENT_FORM_UNFILTERED_HTML_FUNCTION_NAME = 
        'wp_comment_form_unfiltered_html_nonce';

    /**
     * The original WordPress nonce `field` function name.
     *
     * @var string WP_NONCE_FIELD_FUNCTION_NAME
     */
    private const WP_NONCE_FIELD_FUNCTION_NAME = 'wp_nonce_field';

    /**
     * The original WordPress nonce `tick` function name.
     *
     * @var string WP_NONCE_TICK_FUNCTION_NAME
     */
    private const WP_NONCE_TICK_FUNCTION_NAME = 'wp_nonce_tick';

    /**
     * The original WordPress nonce `url` function name.
     *
     * @var string WP_NONCE_URL_FUNCTION_NAME
     */
    private const WP_NONCE_URL_FUNCTION_NAME = 'wp_nonce_url';

    /**
     * The original WordPress nonce `verify` function name.
     *
     * @var string WP_NONCE_VERIFY_FUNCTION_NAME
     */
    private const WP_NONCE_VERIFY_FUNCTION_NAME = 'wp_verify_nonce';

    /**
     * The original WordPress `refresh_post_nonces` function name.
     *
     * @var string WP_REFRESH_POST_NONCES_FUNCTION_NAME
     */
    private const WP_REFRESH_POST_NONCES_FUNCTION_NAME = 'wp_refresh_post_nonces';

    /**
     * Scalar value to add context to the nonce.
     * 
     * @var string $action
     */
    private $action;

    /**
     * The nonce name.
     *
     * @var string $nonceName
     */
    private $nonceName;

    /**
     * Cryptographic token tied to a specific 
     * action, user, user session, and window of time.
     * 
     * @var string $token
     */
    private $token = '';

    /**
     * The constructor.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_create_nonce/
     * @see https://codex.wordpress.org/Function_Reference/wp_create_nonce
     *
     * @param int|string $action        -1|The nonce action.
     * @param string     $nonceName     The nonce name.
     */
    public function __construct($action, $nonceName) {
        $this->action    = $action;
        $this->nonceName = $nonceName;
        if (function_exists($this->WP_CREATE_NONCE_FUNCTION_NAME)) {
            $this->token  = call_user_func(
                $this->WP_CREATE_NONCE_FUNCTION_NAME,
                $action
            );
        }
    }

    /**
     * Display “Are You Sure” message to confirm the action being taken.
     *
     * We can declare this method as `static` since the `$action` parameter is
     * mandatory and, the Class constructor does not enssure us that will be 
     * initialized with a string. If we already are working with a WpNonce 
     * object, we can check if it has an `action` parameter initialized as 
     * string and, use it in this method.
     * 
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_ays/
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_ays
     *
     * @param  string       $action    The nonce action.
     * @return bool|void
     */
    public static function ays($action) {
        if (function_exists(self::WP_NONCE_AYS_FUNCTION_NAME) === false) {
            return false;
        }

        call_user_func(self::WP_NONCE_AYS_FUNCTION_NAME, $action);
    }

    /**
     * Display form token for unfiltered comments.
     *
     * We can declare this method as `static` since it does not depend on any
     * parameter initialized by the Class constructor.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_comment_form_unfiltered_html_nonce/
     *
     * @return bool|void
     */
    public static function commentFormUnfilteredHtml() {
        if (
            function_exists(
                self::WP_NONCE_COMMENT_FORM_UNFILTERED_HTML_FUNCTION_NAME
            ) === false
        ) {
            return false;
        } else {
            call_user_func(
                self::WP_NONCE_COMMENT_FORM_UNFILTERED_HTML_FUNCTION_NAME
            );
        }
    } 

    /**
     * Retrieve nonce action “Are you sure” message.
     *
     * As the `wp_explain_nonce()` function is deprecated, we map it to the new 
     * `wp_nonce_ays()` function through our own `ays` static method.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_explain_nonce/
     *
     * @param  string       $action    The nonce action.
     * @return bool|void
     */
    public static function explain($action) {
        return self::ays($action);
    }

    /**
     * Retrieves or displays the nonce hidden form field.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_field/
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_field
     *
     * @param  int|string  $action   -1|Action name.
     * @param  string      $name     Nonce name.
     * @param  bool        $referer  Whether to set the referer field for validation.
     * @param  bool        $echo     Whether to display or return hidden form field.
     * @return bool|string $result   false|Nonce field HTML markup.
     */
    public function field(
        $action  = $this->action, 
        $name    = $this->DEFAULT_WP_NONCE_NAME,
        $referer = true,
        $echo    = true
    ) {
        if (function_exists(self::WP_NONCE_FIELD_FUNCTION_NAME) === false) {
            $result = false;
        } else {
            $result = call_user_func(
                self::WP_NONCE_FIELD_FUNCTION_NAME,
                $action, $name, $referer, $echo
            );
        }

        return $result;
    }

    /**
     * Check nonce expiration on the New/Edit Post screen and refresh if needed.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_refresh_post_nonces/
     *
     * @param  array        $response   The Heartbeat response.
     * @param  array        $data       The $_POST data sent.
     * @param  string       $screenId   The screen id.
     * @return bool|array   $result     The Heartbeat response.
     */
    public function refreshPostNonces($response, $data, $screenId) {
        if (
            function_exists(
                self::WP_REFRESH_POST_NONCES_FUNCTION_NAME
            ) === false
        ) {
            $result = false;
        } else {
            $result = call_user_func(self::WP_REFRESH_POST_NONCES_FUNCTION_NAME);
        }

        return $result;
    }

    /**
     * Process the signup nonce created in signup_nonce_fields().
     *
     * @see https://developer.wordpress.org/reference/functions/signup_nonce_check/
     *
     * @param  array      $signUpFields
     * @return bool|array $result
     */
    public function signupNonceCheck($signUpFields) {
        if (function_exists(self::SIGNUP_NONCE_CHECK) === false) {
            $result = false;
        } else {
            $result = call_user_func(self::SIGNUP_NONCE_CHECK, $signUpFields);
        }

        return $result;
    }

    /**
     * Add a nonce field to the signup page.
     *
     * @see https://developer.wordpress.org/reference/functions/signup_nonce_fields/
     *
     * @return bool|void
     */
    public function signupNonceFields() {
        if (function_exists(self::SIGNUP_NONCE_FIELDS) === false) {
            return false;
        } else {
            call_user_func(self::SIGNUP_NONCE_FIELDS);
        }
    }

    /**
     * Get the time-dependent variable for nonce creation.
     *
     * We can declare this method as `static` since it does not depend on any
     * parameter initialized by the Class constructor.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_tick/
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_tick
     *
     * @return bool|float   false|Float value rounded up to the next highest integer.
     */
    public static function tick() {
        if (function_exists(self::WP_NONCE_TICK_FUNCTION_NAME) === false) {
            $result = false;
        } else {
            $result = call_user_func(self::WP_NONCE_TICK_FUNCTION_NAME);
        }

        return $result;
    }

    /**
     * Retrieve URL with nonce added to URL query.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_nonce_url/
     * @see https://codex.wordpress.org/Function_Reference/wp_nonce_url
     *
     * @param  string      $actionurl URL to add nonce action.
     * @param  int|string  $action    -1|Nonce action name.
     * @param  string      $name      Nonce name.
     * @return bool|string            false|Escaped URL with nonce action added.
     */
    public function url(
        $actionurl,
        $action     = $this->action,
        $name       = $this->DEFAULT_WP_NONCE_NAME
    ) {
        if (function_exists(self::WP_NONCE_URL_FUNCTION_NAME) === false) {
            $result = false;
        } else {
            $result = call_user_func(
                self::WP_NONCE_URL_FUNCTION_NAME, $actionurl, $action, $name
            );
        }

        return $result;
    }

    /**
     * Verify that correct nonce was used with time limit.
     *
     * We can declare this method as `static` since the `$token` parameter is
     * mandatory and, the Class constructor does not enssure us that will be 
     * initialized with a `nonce` token. If we already are working with a 
     * WpNonce object, we can check if it has a `token` parameter with a 
     * non empty string and, use it in this method.
     *
     * @see https://developer.wordpress.org/reference/functions/wp_verify_nonce/
     * @see https://codex.wordpress.org/Function_Reference/wp_verify_nonce
     *
     * @param  string     $token     The nonce token to verify.
     * @param  int|string $action    -1|The nonce token to verify.
     * @return int|bool              1 if the nonce is valid and generated 
     *                                between 0-12 hours ago.
     *                               2 if the nonce is valid and generated
     *                                between 12-24 hours ago.
     *                               False if the nonce is invalid.
     */
    public static function verify($token, $action = -1) {
        if (function_exists(self::WP_NONCE_VERIFY_FUNCTION_NAME) === false) {
            $result = false;
        } else {
            $result = call_user_func(
                self::WP_NONCE_VERIFY_FUNCTION_NAME, $token, $action
            );
        }

        return $result;
    }
}