<?php
use \Codeception\Util\Fixtures as Fixtures;
use \Step\Api\Client as Client;

$merchant_id = Fixtures::get('merchant_id');
$api_key = Fixtures::get('api_key');
$project_id = Fixtures::get('project_id');

$I = new Client($scenario);
$I->amHttpAuthenticated($merchant_id, $api_key);
$I->updateThePromotion(
    $merchant_id,
    3293,
    'WOW Super Promotion',
    array('en' => '20% Save'),
    array('en' => '20% Save with Paypal'),
    array('en' => '20% Save with Paypal. This is amazing-amazing!!'),
    $project_id
);

$I->seeResponseCodeIs(204);
$I->getThePromotion($merchant_id, 3293);
$I->seeResponseEquals('{
    "id": 3293,
    "project_id": 15861,
    "technical_name": "WOW Super Promotion",
    "label": {
        "en": "20% Save"
    },
    "name": {
        "en": "20% Save with Paypal"
    },
    "description": {
        "en": "20% Save with Paypal. This is amazing-amazing!!"
    },
    "read_only": false,
    "enabled": false
}');