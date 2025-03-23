<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Subscribable\Models\Subscription;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getSubscriptionClass(Subscription::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getSubscriptionKeyType(KeyType::BigInteger));

            $table->keyMorphs(Config::getSubscriberKeyType(KeyType::BigInteger), 'subscriber');
            $table->keyMorphs(Config::getSubscribableKeyType(KeyType::BigInteger), 'subscribable');
            $table
                ->foreignIdFor(Config::getPlanClass(Plan::class))
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
