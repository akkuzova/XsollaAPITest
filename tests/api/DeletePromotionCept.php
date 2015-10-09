<?php
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;

$merchant_id = Fixtures::get('merchant_id');
$api_key = Fixtures::get('api_key');
$promotion_id  = 99999999999999;

$I = new Client($scenario);
$I->wantTo('delete nonexistent promotion');
$I->amHttpAuthenticated($merchant_id, $api_key);
$I->deleteThePromotion($merchant_id,  $promotion_id);
$I->seeResponseCodeIs(404);

