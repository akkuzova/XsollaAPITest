<?php
use \ApiTester;
use \Codeception\Util\Fixtures as Fixtures;
use \Step\Api\Client as Client;

class GetPromotionCest
{
    public function _before(Client $I)
    {
    }

    public function _after(Client $I)
    {
    }

    // tests
    public function getExistPromotion(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $promotion_id = Fixtures::get('promotion_id');

        $I = new Client($scenario);
        $I->wantTo("get promotion with id $promotion_id of merchant");
        $I->amHttpAuthenticated($merchant_id, $api_key);
        $I->getThePromotion($merchant_id, $promotion_id);
        $I->seeResponseCodeIs(200);
        $I->canSeeResponseIsValidOnJsonSchema('PromotionViewSchema');
    }

    public function getPromotionWithBadId(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');

        $errorIdData = Fixtures::get('errorIdData');

        foreach ($errorIdData as $promotion_id)
        {
            $I = new Client($scenario);
            $I->wantTo("get promotion with id $promotion_id");
            $I->amHttpAuthenticated($merchant_id, $api_key);
            $I->getThePromotion($merchant_id, $promotion_id);
            $I->canSeeResponseCodeIs(404);
        }
    }

    public function getPromotionWithEmptyIdOfMerchant(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');

        $I->wantTo('get promotion with empty id of merchant');
        $I->amHttpAuthenticated($merchant_id, $api_key);
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendGET('/merchant/merchants//promotions/3293');
        $I->seeResponseCodeIs(404);
    }




}
