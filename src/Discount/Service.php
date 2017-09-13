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
    
//     public static function create ($param, $owner = null, $ownerId = null)
//     {
//         $form = new Discount_Form_DiscountNew($param);
//         $receipt = $form->save(false);
//         $backend = $receipt->get_backend();
//         $engine = $backend->get_engine();
//         $engine->create($receipt);
//         if ($owner instanceof Pluf_Model) { // Pluf module
//             $receipt->owner_class = $owner->getClass();
//             $receipt->owner_id = $owner->getId();
//         } elseif (! is_null($owner)) { // module
//             $receipt->owner_class = $owner;
//             $receipt->owner_id = $ownerId;
//         }
//         $receipt->create();
//         return $receipt;
//     }
    
//     public static function update ($receipt)
//     {
//         $backend = $receipt->get_backend();
//         $engine = $backend->get_engine();
//         if ($engine->update($receipt)) {
//             $receipt->update();
//         }
//         return $receipt;
//     }
    
//     public static function find ($owner, $ownerId = null)
//     {
//         // get class
//         if ($owner instanceof Pluf_Model) { // Pluf module
//             $ownerClass = $owner->getClass();
//             $ownerId = $owner->getId();
//         } elseif (! is_null($owner)) { // module
//             $ownerClass = $owner;
//         }
        
//         // get list
//         $receipt = new Discount_Discount();
//         $q = new Pluf_SQL('owner_class=%s AND owner_id=%s',
//             array(
//                 $ownerClass,
//                 $ownerId
//             ));
//         $list = $receipt->getList(
//             array(
//                 'filter' => $q->gen()
//             ));
//         return $list;
//     }
    
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