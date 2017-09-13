<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Discount_Shortcuts_GetDiscountByCodeOr404');

class Discount_Views_Discount
{

    /**
     * Returns tag with given name.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return Discount_Discount
     */
    public static function getDiscountByCode($request, $match)
    {
        $discount = Discount_Shortcuts_GetDiscountByCodeOr404($match['name']);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return $discount;
    }
    
    public static function getByName($request, $match)
    {
        $tag = Discount_Views_Discount::getDiscountByCode($request, $match);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json($tag);
    }
}