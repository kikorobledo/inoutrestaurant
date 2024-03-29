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
            $table->unsignedInteger('product_number');
            $table->string('name');
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->integer('stock');
            $table->decimal('purchase_price',15,2);
            $table->decimal('sale_price',15,2);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('establishment_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->constrained()->references('id')->on('users');
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
