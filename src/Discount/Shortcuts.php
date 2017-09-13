<?php

function Discount_Shortcuts_GetDiscountByCodeOr404($name)
{
    $q = new Pluf_SQL('code=%s', array(
        $name
    ));
    $item = new Discount_Discount();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    if (isset($item) && $item->count() == 1) {
        return $item[0];
    }
    if ($item->count() > 1) {
        Pluf_Log::error(sprintf('more than one tag exist with the name $s', $name));
        return $item[0];
    }
    throw new Discount_Exception_ObjectNotFound("Discount not found (Discount code:" . $name . ")");
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
function Discount_Shortcuts_GetEngineOr404 ($type)
{
    $items = Discount_Service::engines();
    foreach ($items as $item) {
        if ($item->getType() === $type) {
            return $item;
        }
    }
    throw new Discount_Exception_EngineNotFound();
}