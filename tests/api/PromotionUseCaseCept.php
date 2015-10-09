<?php
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;

$merchant_id = Fixtures::get('merchant_id');
$api_key = Fixtures::get('api_key');
$project_id = Fixtures::get('project_id');

//Создадим новую промоакцию
$I = new Client($scenario);
$I->wantTo('create new promotion');
$I->amHttpAuthenticated($merchant_id, $api_key);
$I->createANewPromotion(
    $merchant_id,
    'Super Promotion',
    array('en' => '10% Save'),
    array('en' => '10% Save with Paypal'),
    array('en' => '10% Save with Paypal. It is amazing!!'),
    $project_id
);
$I->canSeeResponseIsValidOnJsonSchema('CreatedPromotionResponse');

//Получим id, присвоенный созданной акции
$promotion_id = $I->grabDataFromResponseByJsonPath("$.id")['0'];


//Проверим, правильно ли присвоены все поля
$I->wantTo("get new promotion");
$I->getThePromotion($merchant_id, $promotion_id);
$I->seeResponseCodeIs(200);
$I->canSeeResponseIsValidOnJsonSchema('PromotionViewSchema');
$I->seeResponseContainsJson(array(
    'id'=> $promotion_id,
    'project_id'=> $project_id,
    'technical_name'=> 'Super Promotion',
    'label'=> array(
        'en'=> '10% Save'
),
    'name'=> array(
        'en' => '10% Save with Paypal'
),
    'description' => array(
        'en' => '10% Save with Paypal. It is amazing!!'
),
    'read_only' => false,
    'enabled'=> false
));

//Обновим все поля созданной акции
$I->wantTo("update new promotion");
$I->updateThePromotion($merchant_id,
    $promotion_id,
    'WOW Super Promotion',
    array('en' => '20% Save'),
    array('en' => '20% Save with Paypal'),
    array('en' => '20% Save with Paypal. This is amazing-amazing!!'),
    $project_id
);
$I->seeResponseCodeIs(204);

//Снова проверим, все ли правильно обновилось
$I->getThePromotion($merchant_id, $promotion_id);
$I->seeResponseCodeIs(200);
$I->canSeeResponseIsValidOnJsonSchema('PromotionViewSchema');

$I->seeResponseContainsJson(array(
    'id'=> $promotion_id,
    'project_id'=> $project_id,
    'technical_name'=> 'WOW Super Promotion',
    'label'=> array(
        'en'=> '20% Save'
    ),
    'name'=> array(
        'en' => '20% Save with Paypal'
    ),
    'description' => array(
        'en' => '20% Save with Paypal. This is amazing-amazing!!'
    ),
    'read_only' => false,
    'enabled'=> false
));

//Проверим промоакцию на ошибки
$I->wantTo('review promotion');
$I->reviewThePromotion($merchant_id,  $promotion_id);
$I->seeResponseCodeIs(200);
$I->canSeeResponseIsValidOnJsonSchema('ReviewPromotionView');


$I->setThePaymentSystems($merchant_id, $promotion_id, array(), 1);
$I->seeResponseCodeIs(204);

$I->getThePaymentSystems($merchant_id, $promotion_id);
$I->canSeeResponseIsValidOnJsonSchema('PaymentSystemsView');

//Удалим созданную промоакцию
$I->deleteThePromotion($merchant_id, $promotion_id);
$I->seeResponseCodeIs(204);


//Проверим, что промоакции с таким id больше нет
$I->getThePromotion($merchant_id, $promotion_id);
$I->seeResponseCodeIs(404);


