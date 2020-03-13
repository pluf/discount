<?php
namespace Pluf\Test;

use Discount_Discount;
use Pluf;

class BasicModelTest extends TestCase
{

    /**
     *
     * @beforeClass
     */
    public static function initTest()
    {
        Pluf::start(__DIR__ . '/conf/config.php');
    }

    /**
     *
     * @test
     */
    public function simpleModelTest()
    {
        $discount = new Discount_Discount();
        $this->assertNotNull($discount);
    }
}

