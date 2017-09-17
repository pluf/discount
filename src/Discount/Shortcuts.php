<?php

/**
 *
 * @param string $code
 * @return Discount_Discount|NULL
 */

/**
 * Returns discount with given code or throws exception if such discount does not exist.
 * 
 * @param string $code
 * @throws Discount_Exception_ObjectNotFound
 * @return Discount_Discount
 */
function Discount_Shortcuts_GetDiscountByCodeOr404($code)
{
    $q = new Pluf_SQL('code=%s', array(
        $code
    ));
    $item = new Discount_Discount();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    if (isset($item) && $item->count() == 1) {
        return $item[0];
    }
    if ($item->count() > 1) {
        Pluf_Log::error(sprintf('more than one Discount exist with the code $s', $code));
        return $item[0];
    }
    throw new Discount_Exception_ObjectNotFound("Discount not found (Discount code:" . $code . ")");
}

/**
 * Returns discount with given code or null if such discount does not exist.
 * 
 * @param string $code
 * @return Discount_Discount|NULL
 */
function Discount_Shortcuts_GetDiscountByCodeOrNull($code)
{
    $q = new Pluf_SQL('code=%s', array(
        $code
    ));
    $item = new Discount_Discount();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    if (isset($item) && $item->count() == 1) {
        return $item[0];
    }
    return null;
}

function Discount_Shortcuts_NormalizeItemPerPage($request)
{
    $count = array_key_exists('_px_c', $request->REQUEST) ? intval($request->REQUEST['_px_c']) : 30;
    if ($count > 30)
        $count = 30;
    return $count;
}

/**
 * یک متور پرداخت را پیدا می‌کند.
 *
 * @param string $type
 * @throws Discount_Exception_EngineNotFound
 * @return Discount_Engine
 */
function Discount_Shortcuts_GetEngineOr404($type)
{
    $item = Discount_Shortcuts_GetEngineOrNull($type);
    if ($item == null)
        throw new Discount_Exception_EngineNotFound();
    return $item;
}

/**
 *
 * @param string $type
 * @return Discount_Engine | NULL
 */
function Discount_Shortcuts_GetEngineOrNull($type)
{
    $items = Discount_Service::engines();
    foreach ($items as $item) {
        if ($item->getType() === $type) {
            return $item;
        }
    }
    return null;
}