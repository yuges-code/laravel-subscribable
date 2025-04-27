<?php

namespace Yuges\Subscribable\Tests\Integration;

use Illuminate\Support\Facades\Auth;
use Yuges\Subscribable\Tests\TestCase;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Subscribable\Tests\Stubs\Models\User;
use Yuges\Subscribable\Tests\Stubs\Models\Channel;

class SubscribeTest extends TestCase
{
    public function testSubscribeUserToChannel()
    {
        config(['subscribable.models.subscriber.allowed.classes' => [User::class, Channel::class]]);

        $user = User::query()->create([
            'name' => 'Georgy',
            'email' => 'goshasafonov@yandex.ru',
            'password' => 'test',
        ]);

        $channel = Channel::query()->create([
            'name' => 'Yuges',
        ]);

        $subscription = $user->subscribe($channel);
        $subscription = $channel->subscribe($user);

        $this->assertDatabaseHas(Subscription::getTableName(), [
            'subscriber_id' => $channel->getKey(),
            'subscriber_type' => $channel->getMorphClass(),
            'subscribable_id' => $user->getKey(),
            'subscribable_type' => $user->getMorphClass(),
        ]);

        $this->assertDatabaseHas(Subscription::getTableName(), [
            'subscriber_id' => $user->getKey(),
            'subscriber_type' => $user->getMorphClass(),
            'subscribable_id' => $channel->getKey(),
            'subscribable_type' => $channel->getMorphClass(),
        ]);

        Auth::setUser($user);

        $this->assertEquals($user->getKey(), $channel->subscription->subscriber_id);
        $this->assertEquals($user->getMorphClass(), $channel->subscription->subscriber_type);
    }
}
