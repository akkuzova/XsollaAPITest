<?php
use \ApiTester;
use \Codeception\Util\Fixtures as Fixtures;
use \Step\Api\Client as Client;




class AuthenticateCest
{
    public function _before(Client $I)
    {
    }

    public function _after(Client $I)
    {
    }

    // tests
    public function tryToAuthAndGetPromotionOfNextMerchant(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');

        $I = new Client($scenario);
        $I->wantTo('authenticate and try to get promotion of next merchant');
        $I->amHttpAuthenticated($merchant_id, $api_key);
        $I->listAllPromotions($merchant_id-1);
        $I->seeResponseCodeIs(403);
    }

    public function tryToGetPromotionsWithoutAuth(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');

        $I = new Client($scenario);
        $I->wantTo('try to get promotions without auth');
        $I->listAllPromotions($merchant_id-1);
        $I->seeResponseCodeIs(401);
    }
}
