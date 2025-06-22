<?php
//./vendor/bin/pest --filter=OrderStatusTest
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;

class OrderStatusTest extends TestCase
{
    public function test_order_status_can_be_set_to_completed()
    {
        $order = new Order();
        $order->status = 'pending';

        $order->status = 'completed';

        $this->assertEquals('completed', $order->status);
    }
}
