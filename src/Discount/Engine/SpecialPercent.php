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
    {
        if(!$this->isValid($discount, $request))
            throw new Discount_Exception_InvalidDiscount();
        $newPrice = $price - ($price * $discount->off_value / 100);
        return $newPrice;
    }

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
        // Check user
        $currentUser = $request->user;
        if ($currentUser->id !== $discount->get_user()->id) {
            return Discount_Engine::VALIDATION_CODE_NOT_OWNED;
        }
        // Check expiration date
        if ($discount->expiry_day != NULL) {
            $now = strtotime(date("Y-m-d H:i:s"));
            $start = strtotime($discount->creation_dtime);
            $expiryDay = ' +' . $discount->expiry_day . ' day';
            $expiryDTime = strtotime($expiryDay, $start);
            if ($expiryDTime < $now)
                return Discount_Engine::VALIDATION_CODE_EXPIRED;
        }
        // Check remain count
        if ($discount->remain_count <= 0) {
            return Discount_Engine::VALIDATION_CODE_USED;
        }
        return Discount_Engine::VALIDATION_CODE_VALID;
    }

}