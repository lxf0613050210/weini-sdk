<?php

namespace Tests\Unit;

use Seekx2y\WeiniSDK\Weini;
use PHPUnit\Framework\TestCase;

class SearchOrdersTest extends TestCase
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
        $res = $api->request('/api/sup/searchOrder.shtml','searchOrder', [
            'StartModified' => date('Y-m-d H:i:s', time() - 86000),
            'EndModified' => date('Y-m-d H:i:s'),
//            'Status' => '',
            'PageNo' => 1,
            'PageNum' => 100,
//            'IfReturnTotal' => '',
        ]);

        $this->assertObjectHasAttribute('success', $res);
        $this->assertEquals(1, $res->success);
    }
}
