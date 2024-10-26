<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('store_id');
            $table->uuid('category_id');
            $table->uuid('brand_id');
            $table->uuid('company_id');
            $table->string('title');
            $table->string('article_num')->nullable();
            $table->decimal('price');
            $table->json('image')->nullable();
            $table->json('colors')->nullable();
            $table->json('sizes')->nullable();
            $table->json('description')->nullable();
            $table->integer('stock')->nullable();
            $table->string('sku')->nullable();
            $table->json('dimensions')->nullable();
            $table->integer('minimum_stock_level')->nullable();
            $table->string('barcode')->nullable();
            $table->string('season')->nullable();
            $table->string('type')->nullable();
            $table->string('material')->nullable();
            $table->string('slug');
            $table->integer('discount')->default(0);
            $table->json('meta')->nullable();
            $table->integer('reorder_point')->nullable();
            // Add other product-related fields here
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
