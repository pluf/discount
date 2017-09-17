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
 * سرویس تخفیف‌ها را برای ماژولهای داخلی سیستم ایجاد می کند.
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 *
 */
class Discount_Service
{

    public static function discountIsExist($code){
        $discount = Discount_Shortcuts_GetDiscountByCodeOrNull($code);
        return $discount != null;
    }
    
    public static function discountIsValid($code){
        $discount = Discount_Shortcuts_GetDiscountByCodeOrNull($code);
        if($discount == null)
            return false;
        $engine = Discount_Shortcuts_GetEngineOrNull($discount->get_type());
        if($engine == null)
            return false;
        return $engine->isValid($discount);
    }
    
    public static function getPrice($originPrice, $discountCode){
        $discount = Discount_Shortcuts_GetDiscountByCodeOr404($code);
        $engine = Discount_Shortcuts_GetEngineOr404($discount->get_type());
        return $engine->getPrice($originPrice, $discount);
    }
    
    /**
     * فهرست موتورهای تخفیف موجود را تعیین می‌کند
     *
     * @return 
     */
    public static function engines ()
    {
        return array(
            new Discount_Engine_PublicPercent(),
            new Discount_Engine_SpecialPercent()
        );
    }
}