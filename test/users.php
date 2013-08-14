<?php
/**
 * Odnoklassniki API example
 * @author alxmsl
 * @date 8/13/13
 */

include('../source/Autoloader.php');
include '../lib/Network/source/Autoloader.php';

// Create authorization token instance
$Token = new \Odnoklassniki\Client\OAuth\Response\Token();
$Token->setAccessToken('4cCE5s_T0KEn')
    ->setRefreshToken('ReFRE5H_t0Ken')
    ->setTokenType(\Odnoklassniki\Client\OAuth\Response\Token::TYPE_SESSION);

// Create and initialize OK API client instance
$Client = new Odnoklassniki\Client\API\Client();
$Client->setApplicationKey('4Pp1IC4t10n_KEy')
    ->setToken($Token)
    ->setClientId(1234567890)
    ->setClientSecret('C11eNt_SEcREt');

// Check if current user has current application
$Result = $Client->callConfidence('users.isAppUser');
var_dump($Result);

// Get current user info
$Result = $Client->callConfidence('users.getCurrentUser');
var_dump($Result);

// Get current user big size avatar
$Result = $Client->callConfidence('users.getInfo', array(
    'uids' => 1,
    'fields' => 'pic_4',
));
var_dump($Result);

// Get user photos
$Result = $Client->callConfidence('photos.getPhotos');
var_dump($Result);
