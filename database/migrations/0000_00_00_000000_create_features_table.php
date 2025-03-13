<?php

use Yuges\Package\Enums\KeyType;
use Yuges\Subscribable\Config\Config;
use Yuges\Subscribable\Models\Feature;
use Yuges\Package\Database\Schema\Schema;
use Yuges\Package\Database\Schema\Blueprint;
use Yuges\Package\Database\Migrations\Migration;

return new class extends Migration
{
    public function __construct()
    {
        $this->table = Config::getFeatureClass(Feature::class)::getTableName();
    }

    public function up(): void
    {
        if (Schema::hasTable($this->table)) {
            return;
        }

        Schema::create($this->table, function (Blueprint $table) {
            $table->key(Config::getFeatureKeyType(KeyType::BigInteger));

            $table->string('name');

            $table->timestamps();
            $table->softDeletes();
        });
    }
};
