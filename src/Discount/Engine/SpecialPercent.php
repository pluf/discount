<?php

class Discount_Engine_SpecialPercent extends Discount_Engine
{

    /**
     * Compute new price after use given discount.
     *
     * @param int $price
     * @param Discount_Discount $discount
     * @param Pluf_HTTP_Request $request
     */
    public function getPrice($price, $discount, $request)
    {}

    public function getTitle()
    {
        return 'Specific Percentage Discount';
    }

    public function getDescription()
    {
        return 'Discount for specific user base on percent of main price';
    }

    public function consumeDiscount($discount)
    {
        $discount->remain_count -= 1;
        $discount->update();
    }

    public function isValid($discount, $request)
    {
        // Check user
        $currentUser = $request->user;
        if ($currentUser->id !== $discount->get_user()->id) {
            return false;
        }
        // Check remain count
        if ($discount->remain_count <= 0) {
            return false;
        }
        // Check expiration date
        if ($discount->expiry_day != NULL) {
            $now = strtotime(date("Y-m-d H:i:s"));
            $start = $discount->creation_dtime;
            $expiryDay = ' +' . $discount->expiry_day . ' day';
            $expiryDTime = strtotime($expiryDay, $start);
            if ($expiryDTime < $now)
                return false;
        }
        return true;
    }
}