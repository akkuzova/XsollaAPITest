<?php
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;

$merchant_id = Fixtures::get('merchant_id');
$api_key = Fixtures::get('api_key');

	$I = new Client($scenario);
	$I->wantTo('get all promotions of merchant');
	$I->amHttpAuthenticated($merchant_id, $api_key);
	$I->listAllPromotions($merchant_id);
	$I->seeResponseCodeIs(200);
	$I->canSeeResponseIsValidOnJsonSchema('AllPromotionsViewSchema');
