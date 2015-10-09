<?php
use \ApiTester;
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;


class UpdatePromotionCest
{
    public function _before(Client $I)
    {
    }

    public function _after(Client $I)
    {
    }

    // tests
    public function tryToUpdatePromotionWithBadProjectId(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $promotion_id = Fixtures::get('promotion_id');

        $errorIdData = Fixtures::get('errorIdData');

        foreach ($errorIdData as $project_id)
        {
            $I = new Client($scenario);
            $I->wantTo("update with project_id = $project_id");
            $I->amHttpAuthenticated($merchant_id, $api_key);
            $I->updateThePromotion(
                $merchant_id,
                $promotion_id,
                'Super Promotion',
                array('en' => '10% Save'),
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                $project_id);
            $I->canSeeResponseCodeIs(422);
        }
    }

    public function tryToUpdatePromotionWithBadTechnicalName(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $project_id = Fixtures::get('project_id');
        $promotion_id = Fixtures::get('promotion_id');

        $errorStringData = Fixtures::get('errorStringData');

        foreach ($errorStringData as $technical_name)
        {
            $I = new Client($scenario);
            $I->wantTo("update promotion with technical_name = '$technical_name''");
            $I->amHttpAuthenticated($merchant_id, $api_key);
            $I->updateThePromotion(
                $merchant_id,
                $promotion_id,
                $technical_name,
                array('en' => '10% Save'),
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                $project_id);
            $I->canSeeResponseCodeIs(422);
        }
    }


    public function tryToUpdatePromotionWithNullParameter(Client $I, $scenario){
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $project_id = Fixtures::get('project_id');
        $promotion_id = Fixtures::get('promotion_id');

        $I = new Client($scenario);
        $I->amHttpAuthenticated($merchant_id, $api_key);

        $I->wantTo("update with all null parameters");
        $I->updateThePromotion($merchant_id, $promotion_id, null, null, null, null, null);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("update promotion with null technical_name");
        $I->updateThePromotion(
            $merchant_id,
            $promotion_id,
            null,
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("update promotion with null label");
        $I->updateThePromotion(
            $merchant_id,
            $promotion_id,
            'Super Promotion',
            null,
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("update promotion with null name");
        $I->updateThePromotion(
            $merchant_id,
            $promotion_id,
            'Super Promotion',
            array('en' => '10% Save'),
            null,
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("update promotion with null descr");
        $I->updateThePromotion(
            $merchant_id,
            $promotion_id,
            'Super Promotion',
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            null,
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("update promotion with null project id");
        $I->updateThePromotion(
            $merchant_id,
            $promotion_id,
            'Super Promotion',
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            null);
        $I->canSeeResponseCodeIs(422);
    }
}
