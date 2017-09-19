<?php

/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. (http://dpq.co.ir)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * سرویس پرداخت‌ها را برای ماژولهای داخلی سیستم ایجاد می کند.
 *
 * @author maso<mostafa.barmshory@dpq.co.ir>
 *        
 */
abstract class Discount_Engine implements JsonSerializable
{

    const ENGINE_PREFIX = 'discount_engine_';

    /**
     * Validcation code to show that discount is valid.
     *
     * @var integer
     */
    const VALIDATION_CODE_VALID = 0;

    /**
     * Validcation code to show that discount is used before.
     *
     * @var integer
     */
    const VALIDATION_CODE_USED = 1;

    /**
     * Validcation code to show that discount is expired.
     * 
     * @var integer
     */
    const VALIDATION_CODE_EXPIRED = 2;

    /**
     * Validcation code to show that discount is not owned by current user.
     * @var integer
     */
    const VALIDATION_CODE_NOT_OWNED = 3;

    /**
     *
     * @return string
     */
    public function getType()
    {
        $name = strtolower(get_class($this));
        // NOTE: hadi, 1395: تمام موتورهای تخفیف باید در پوشه تعیین شده قرار
        // بگیرند
        if (strpos($name, Discount_Engine::ENGINE_PREFIX) !== 0) {
            throw new Discount_Exception_EngineLoad('Engine class must be placed in engine package.');
        }
        return substr($name, strlen(Discount_Engine::ENGINE_PREFIX));
    }

    public abstract function getTitle();

    public abstract function getDescription();

    // /**
    // * یک تخفیف جدید ایجاد می‌کند
    // *
    // * تمام اطلاعات مورد نیاز باید ار تقاضا به دست آید.
    // *
    // * در صورتی که امکان انجام کار وجود نداشت باید خطا صادر شود.
    // *
    // * بعد از این روال ورودی ذخیره خواهد شد.
    // *
    // * @param unknown $receipt
    // */
    // public function create ($receipt)
    // {
    // // XXX: maso, 1395: ایجاد یک پرداخت
    // }
    
    /**
     * Compute new price after use given discount.
     *
     * @param int $price
     * @param Discount_Discount $discount
     * @param Pluf_HTTP_Request $request
     */
    public abstract function getPrice($price, $discount, $request);

    /**
     * Check if give discount is valid or not.
     *
     * @param Discount_Discount $discount
     * @param Pluf_HTTP_Request $request
     */
    public function isValid($discount, $request)
    {
        $code = $this->validate($discount, $request);
        if ($code == Discount_Engine::VALIDATION_CODE_VALID)
            return true;
        return false;
    }

    /**
     * Validate given discount and returns a code as result.
     * Returned code should be as following:
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
    public abstract function validate($discount, $request);

    /**
     * Cosume one unit from given discount
     *
     * @param Discount_Discount $discount
     */
    public abstract function consumeDiscount($discount);

    /**
     * (non-PHPdoc)
     *
     * @see JsonSerializable::jsonSerialize()
     */
    public function jsonSerialize()
    {
        $coded = array(
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription()
        );
        return $coded;
    }
}