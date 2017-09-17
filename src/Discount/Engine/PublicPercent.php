<?php

class Discount_Engine_PublicPercent extends Discount_Engine
{

    /**
     * Compute new price after use given discount.
     * 
     * @param int $price
     * @param Discount_Discount $discount
     */
    public function getPrice($price, $discount)
    {
        $newPrice = $price - ($price * $discount->get_off_value());
        return $newPrice;
    }

    public function getTitle()
    {
        return 'Public Percentage Discount';
    }

    public function getDescription()
    {
        return 'Discount for all users base on percent of main price';
    }
    public function consumeDiscount($discount)
    {
        // do nothing
    }

    public function isValid($discount)
    {
        $now = strtotime(date("Y-m-d H:i:s"));
        $start = $discount->get_creation_dtime();
        $expiryDay = ' +'.$discount->get_expiry_day().' day';
        $expiryDTime = strtotime($expiryDay, $start);
        return $expiryDTime > $now;
    }

}