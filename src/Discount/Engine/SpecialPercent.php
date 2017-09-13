<?php

class Discount_Engine_SpecialPercent extends Discount_Engine{
    
    /**
     * Compute new price after use given discount.
     * @param int $price
     * @param Discount_Discount $discount
     */
    public function getPrice($price, $discount){
        
    }
    
    public function getTitle()
    {
        return 'Specific Percentage Discount';
    }
    
    public function getDescription()
    {
        return 'Discount for specific user base on percent of main price';
    }
    
}