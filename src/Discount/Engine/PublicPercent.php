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
        if(!Discount_Engine_PublicPercent::isValid($discount, $request))
            throw new Discount_Exception_InvalidDiscount();
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

    /**
     * Validate given discount and returns a code as result. Returned code should be as following:
     *
     * <ul>
     * <li> 0: discount is valid. </li>
     * <li> 1: discount is used before.</li>
     * <li> 2: discount is expired.</li>
     * <li> 3: discount is not owned by current user.</li>
     * </ul>
     *
     * @param Discount_Discount $discount
     * @param Pluf_Http_Request $request
     */
    public function validate($discount, $request)
    {
        $now = strtotime(date("Y-m-d H:i:s"));
        $start = $discount->get_creation_dtime();
        $expiryDay = ' +' . $discount->get_expiry_day() . ' day';
        $expiryDTime = strtotime($expiryDay, $start);
        if($expiryDTime < $now)
            return 2;
        return 0;
    }
}