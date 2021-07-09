<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sale_number');
            $table->foreignId('table_id')->nullable()->constrained()->onDelete('set null');
            $table->string('table_name')->nullable();
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->string('client_name');
            $table->decimal('total_price', 15, 2);
            $table->decimal('total_recived', 15, 2)->default(0);
            $table->decimal('change', 15, 2)->default(0);
            $table->string('payment_type')->default('');
            $table->enum('status',['unpaid','paid_out'])->default('unpaid');
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
        Schema::dropIfExists('sales');
    }
}
