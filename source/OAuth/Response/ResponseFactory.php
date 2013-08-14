<?php

namespace Odnoklassniki\Client\OAuth\Response;

/**
 * Odnoklassniki OAuth server responses factory
 * @author alxmsl
 * @date 8/12/13
 */ 
final class ResponseFactory {
    /**
     * Create OK OAuth response instance
     * @param string $string response data
     * @return Code|Token|Error response instance
     */
    public static function createResponse($string) {
        $Value = json_decode($string);
        if (json_last_error() === JSON_ERROR_NONE) {
            switch (true) {
                case isset($Value->error):
                    return Error::initializeByObject($Value);
                default:
                    return Token::initializeByObject($Value);
            }
        } else {
            $value = parse_url($string, PHP_URL_QUERY);
            switch (true) {
                case strpos($value, 'error=') === 0:
                    return Error::initializeByString($value);
                case strpos($value, 'code=') === 0:
                    return Code::initializeByString($value);
            }
        }
    }
}
