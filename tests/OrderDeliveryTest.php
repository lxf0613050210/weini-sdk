<?php

namespace Tests\Unit;

use Seekx2y\WeiniSDK\Weini;
use PHPUnit\Framework\TestCase;

class OrderDeliveryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDevEnv()
    {
        $config = [
            'key' => '',
            'parenter' => '',
//            'debug' => true,
        ];
        $api = new Weini($config);
        $res = $api->request('/api/sup/orderDelivery.shtml', 'orderDelivery', [
            'Delivery' => [
                'OrderNo' => "xian-NS2016112800023",
                'LogisticName' => "圆通快递",
                'PostId' => "807611368401"
            ]
        ]);
        print_r($res);
        $this->assertObjectHasAttribute('success', $res);
        $this->assertEquals(1, $res->success);
    }
}
