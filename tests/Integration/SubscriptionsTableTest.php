<?php

namespace Yuges\Package\Tests\Feature;

use Yuges\Package\Tests\TestCase;
use Yuges\Subscribable\Models\Subscription;

class SubscriptionsTableTest extends TestCase
{
    public function testCreateSubscription()
    {
        $this->assertDatabaseEmpty(Subscription::getTableName());

        $subscription = Subscription::query()->create([
            'subscriber_id' => 1,
            'subscriber_type' => 'user',
            'subscribable_id' => 1,
            'subscribable_type' => 'channel',
            'plan_id' => 1,
            'expired_at' => null,
        ]);

        $this->assertModelExists($subscription);
    }

    public function testSubscriptionFields()
    {
        $subscription = Subscription::query()->create([
            'subscriber_id' => 1,
            'subscriber_type' => 'user',
            'subscribable_id' => 1,
            'subscribable_type' => 'channel',
            'plan_id' => 1,
            'expired_at' => null,
        ]);


        $this->assertDatabaseHas(Subscription::getTableName(), [
            'subscriber_id' => 1,
            'subscriber_type' => 'user',
            'subscribable_id' => 1,
            'subscribable_type' => 'channel',
            'plan_id' => 1,
            'expired_at' => null,
        ]);
    }
}
