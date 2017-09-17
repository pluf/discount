<?php

/**
 * خطای تخفیف نامعتبر
 *  
 * @author hadi <mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Discount_Exception_InvalidDiscount extends Pluf_Exception
{

    /**
     * یک نمونه از این کلاس ایجاد می‌کند.
     *
     * @param string $message            
     * @param Pluf_Exception $previous            
     * @param string $link            
     * @param string $developerMessage            
     */
    public function __construct ($message = "discount is not valid.", $previous = null, $link = null, 
            $developerMessage = null)
    {
        parent::__construct($message, 4301, $previous, 400, $link, 
                $developerMessage);
    }
}