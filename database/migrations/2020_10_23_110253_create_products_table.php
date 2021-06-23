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
            $table->id();
            $table->string('unique_id')->unique();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_categories_id');
            $table->unsignedBigInteger('secondary_sub_categories_id')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('emi_id', 110)->nullable();
            $table->string('product_slug');
            $table->string('product_name');
            $table->longText('product_description')->nullable();
            $table->string('feature_image');
            $table->integer('stock');
            $table->string('size')->nullable();
            $table->string('return_policy')->nullable();
            $table->longText('specification')->nullable();
            $table->integer('is_new')->nullable();
            $table->string('model')->nullable();
            $table->double('product_price');
            $table->double('tax')->default(0);
            $table->double('status')->default(1);
            $table->string('manufactured_by')->nullable();
            $table->string('color')->nullable();
            $table->integer('sold')->default(0);
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('sub_categories_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('secondary_sub_categories_id')->references('id')->on('secondary_sub_categories')->onDelete('cascade');
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
