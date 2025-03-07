<?php

use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Yuges\Subscribable\Models\Subscription;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct(protected string $table = 'subscriptions')
    {
        $this->table = Config::getSubscriptionClass(Subscription::class)::getTableName();
    }

    public function up()
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->morphs('subscriber');
            $table->morphs('subscribable');
            $table
                ->foreignIdFor(Config::getPlanClass(Plan::class))
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->json('extra')->nullable();

            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
