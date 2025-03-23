<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Subscribable\Models\Plan;
use Yuges\Subscribable\Config\Config;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getPlanClass(Plan::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getPlanKeyType(KeyType::BigInteger));

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('active')->default(true);
            $table->decimal('price')->nullable();

            $table->json('extra')->nullable();
            $table->order();

            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
