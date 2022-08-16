<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationCustomerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_customer_items', function (Blueprint $table){
            $table->id();
            $table->integer('quotation_customer_id');
            $table->string('name');
            $table->string('unit');
            $table->decimal('quantity',20,2);
            $table->decimal('unit_price',20,2);
            $table->decimal('amount',20,2);
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
        Schema::dropIfExists('quotation_customer_items');
    }
}
