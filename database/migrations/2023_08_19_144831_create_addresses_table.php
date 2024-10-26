<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id')->references('id')->on('companies')->cascadeOnDelete();
            $table->uuid('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('updated_by')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->string('continent');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street', 255);
            $table->string('postal_code', 20);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
