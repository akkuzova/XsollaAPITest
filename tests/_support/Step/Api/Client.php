<?php
namespace Step\Api;
use \Codeception\Util\Fixtures as Fixtures;

class Client extends \ApiTester
{
    public function createANewPromotion($merchant_id,
                                     $technical_name,
                                     $label,
                                     $name,
                                     $description,
                                     $project_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPOST("/merchant/merchants/{$merchant_id}/promotions",
                        array(
                            'technical_name' => $technical_name,
                            'label' => $label,
                            'name' => $name,
                            'description' => $description,
                            'project_id' => $project_id

                ));
        $this->seeResponseIsJson();
    }

    public function getThePromotion($merchant_id, $promotion_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendGET("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}");
        $this->seeResponseIsJson();
    }

    public function updateThePromotion($merchant_id,
                                       $promotion_id,
                                       $technical_name,
                                       $label,
                                       $name,
                                       $description,
                                       $project_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPUT("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}",
            array(
                'technical_name' => $technical_name,
                'label' => $label,
                'name' => $name,
                'description' => $description,
                'project_id' => $project_id
            ));
        $this->seeResponseIsJson();
    }

    public function reviewThePromotion($merchant_id, $promotion_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendGET("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}/review");
        $this->seeResponseIsJson();
    }

    public function toggleThePromotion($merchant_id, $promotion_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPUT("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}/toggle");
        $this->seeResponseIsJson();
    }

    public function deleteThePromotion($merchant_id, $promotion_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendDELETE("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}");
    }


    public function listAllPromotions($merchant_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendGET("/merchant/merchants/{$merchant_id}/promotions");
        $this->seeResponseIsJson();
    }

    public function getTheSubject($merchant_id, $promotion_id)
    {

    }

    public function setTheSubject($merchant_id,
                                  $promotion_id,
                                  $purchase,
                                  $items,
                                  $packages,
                                  $subscriptions,
                                  $subscriptions_plans,
                                  $subscription_products,
                                  $subscription_max_charges_count)
    {

    }

    public function getThePaymentSystems($merchant_id, $promotion_id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendGET("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}/payment_systems");
        $this->seeResponseIsJson();
    }

    public function setThePaymentSystems($merchant_id,
                                         $promotion_id,
                                         $payment_systems,
                                         $id)
    {
        $this->haveHttpHeader('Content-Type', 'application/json');
        $this->sendPUT("/merchant/merchants/{$merchant_id}/promotions/{$promotion_id}/payment_systems",
            array(
                "payment_systems" => $payment_systems,
                "id" => $id
            ));
        $this->seeResponseIsJson();
    }

    public function getThePeriods($merchant_id, $promotion_id)
    {

    }

    public function setThePeriods($merchant_id,
                                  $promotion_id,
                                  $periods,
                                  $from,
                                  $to)
    {

    }

    public function getTheRewards($merchant_id, $promotion_id)
    {

    }

    public function setTheRewards($merchant_id,
                                  $promotion_id,
                                  $purchase,
                                  $purchase_discount_percent,
                                  $package_bonus_percent,
                                  $package_bonus_amount,
                                  $item,
                                  $item_discount,
                                  $item_discount_sku,
                                  $item_discount_percent,
                                  $item_discount_max_amount,
                                  $item_bonus,
                                  $item_bonus_sku,
                                  $item_bonus_amount,
                                  $subscription,
                                  $subscription_trial_days)
    {

    }

    public function canSeeResponseIsValidOnJsonSchema($schema)
    {
        Fixtures::get('schemasPath');
        $this->canSeeResponseIsValidOnSchemaFile( Fixtures::get('schemasPath') . $schema . '.json');
    }

}