<?php

namespace Yuges\Subscribable\Tests\Integration;

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
            'subscriber_id' => $channel->id,
            'subscriber_type' => $channel->getMorphClass(),
            'subscribable_id' => $user->id,
            'subscribable_type' => $user->getMorphClass(),
        ]);

        $this->assertDatabaseHas(Subscription::getTableName(), [
            'subscriber_id' => $user->id,
            'subscriber_type' => $user->getMorphClass(),
            'subscribable_id' => $channel->id,
            'subscribable_type' => $channel->getMorphClass(),
        ]);
    }
}
