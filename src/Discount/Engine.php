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
     */
    public abstract function getPrice($price, $discount);

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