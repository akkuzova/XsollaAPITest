<?php
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;

$merchant_id = Fixtures::get('merchant_id');
$api_key = Fixtures::get('api_key');
$promotion_id  = 3293;

$I = new Client($scenario);
$I->wantTo('review promotion');
$I->amHttpAuthenticated($merchant_id, $api_key);
$I->reviewThePromotion($merchant_id,  $promotion_id);
$I->seeResponseCodeIs(200);
$I->canSeeResponseIsValidOnJsonSchema('ReviewPromotionView');
