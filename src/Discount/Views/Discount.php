<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Discount_Shortcuts_GetDiscountByCodeOr404');

class Discount_Views_Discount
{

    /**
     * Returns discount with given id.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match 
     * @return Discount_Discount
     */
    public static function get($request, $match)
    {
        $discount = Discount_Views_Discount::getDiscount($request, $match);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json($discount);
    }

    /**
     * Returns discount with given id.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match$match['code']
     * @return Discount_Discount
     */
    public static function getDiscount($request, $match)
    {
        $discount = Pluf_Shortcuts_GetObjectOr404('Discount_Discount', $match['modelId']);
        $discountEngine = $discount->get_engine();
        $validationCode = $discountEngine->validate($discount, $request);
        $discount->__set('validation_code', $validationCode);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return $discount;
    }

    /**
     * Returns tag with given name.
     *
     * @param Pluf_HTTP_Request $request
     * @param string $code
     * @return Discount_Discount
     */
    public static function getDiscountByCode($request, $code)
    {
        $discount = Discount_Shortcuts_GetDiscountByCodeOr404($code);
        $discountEngine = $discount->get_engine();
        $validationCode = $discountEngine->validate($discount, $request);
        $discount->__set('validation_code', $validationCode);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return $discount;
    }

    public static function getByCode($request, $match)
    {
        $discount = Discount_Views_Discount::getDiscountByCode($request, $match['code']);
        // حق دسترسی
        // CMS_Precondition::userCanAccessContent($request, $content);
        // اجرای درخواست
        return new Pluf_HTTP_Response_Json($discount);
    }
}
