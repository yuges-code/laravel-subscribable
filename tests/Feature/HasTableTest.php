<?php

namespace Yuges\Subscribable\Tests\Feature;

use Yuges\Subscribable\Tests\TestCase;
use Yuges\Subscribable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
    }
}
