<?php
use \ApiTester;
use \Step\Api\Client as Client;
use \Codeception\Util\Fixtures as Fixtures;


class CreatePromotionCest
{
    public function _before(Client $I)
    {
    }

    public function _after(Client $I)
    {
    }

    // tests
    public function tryToCreatePromotionWithBadProjectId(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');

        $errorIdData = Fixtures::get('errorIdData');

        foreach ($errorIdData as $project_id)
        {
            $I = new Client($scenario);
            $I->wantTo("create new promotion with project_id = $project_id");
            $I->amHttpAuthenticated($merchant_id, $api_key);
            $I->createANewPromotion($merchant_id,
                'Super Promotion',
                array('en' => '10% Save'),
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                $project_id);
            $I->canSeeResponseCodeIs(422);
        }
    }

    public function tryToCreatePromotionWithBadTechnicalName(Client $I, $scenario)
    {
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $project_id = Fixtures::get('project_id');

        $errorStringData = Fixtures::get('errorStringData');

        foreach ($errorStringData as $technical_name)
        {
            $I = new Client($scenario);
            $I->wantTo("create new promotion with technical_name = '$technical_name''");
            $I->amHttpAuthenticated($merchant_id, $api_key);
            $I->createANewPromotion($merchant_id,
                $technical_name,
                array('en' => '10% Save'),
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                $project_id);
            $I->canSeeResponseCodeIs(422);
        }
    }

    public function tryToCreatePromotionWithoutParameter(Client $I, $scenario){
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $project_id = Fixtures::get('project_id');

        $I = new Client($scenario);

        $I->wantTo("create new promotion without technical_name");
        $I->amHttpAuthenticated($merchant_id, $api_key);
        $I->sendPOST("/merchant/merchants/{$merchant_id}/promotions",
            array(
                array('en' => '10% Save'),
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                'project_id' => $project_id
            ));
        $I->canSeeResponseCodeIs(400);

        $I->wantTo("create new promotion without label/name/descr/");
        $I->amHttpAuthenticated($merchant_id, $api_key);
        $I->sendPOST("/merchant/merchants/{$merchant_id}/promotions",
            array(
                array('en' => '10% Save with Paypal'),
                array('en' => '10% Save with Paypal. It is amazing!!'),
                'project_id' => $project_id
            ));
        $I->canSeeResponseCodeIs(400);
    }

    public function tryToCreatePromotionWithNullParameter(Client $I, $scenario){
        $merchant_id = Fixtures::get('merchant_id');
        $api_key = Fixtures::get('api_key');
        $project_id = Fixtures::get('project_id');

        $I = new Client($scenario);
        $I->amHttpAuthenticated($merchant_id, $api_key);

        $I->wantTo("create new promotion with all null parameters");
        $I->createANewPromotion($merchant_id, null, null, null, null, null);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("create new promotion with null technical_name");
        $I->createANewPromotion($merchant_id,
            'Super Promotion',
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("create new promotion with null label");
        $I->createANewPromotion($merchant_id,
            'Super Promotion',
            null,
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("create new promotion with null name");
        $I->createANewPromotion($merchant_id,
            'Super Promotion',
            array('en' => '10% Save'),
            null,
            array('en' => '10% Save with Paypal. It is amazing!!'),
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("create new promotion with null descr");
        $I->createANewPromotion($merchant_id,
            'Super Promotion',
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            null,
            $project_id);
        $I->canSeeResponseCodeIs(422);

        $I->wantTo("create new promotion with null project id");
        $I->createANewPromotion($merchant_id,
            'Super Promotion',
            array('en' => '10% Save'),
            array('en' => '10% Save with Paypal'),
            array('en' => '10% Save with Paypal. It is amazing!!'),
            null);
        $I->canSeeResponseCodeIs(422);
    }
}
