<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_customers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->integer('customer_id');
            $table->date('date');
            $table->date('validation_date')->comment('Valid Until');
            $table->text('description_of_work')->nullable();
            $table->integer('preparator_id')->comment('Related to user ID');
            $table->decimal('discount_amount',20,2)->default(0);
            $table->decimal('total_quotes',20,2)->default(0);
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
        Schema::dropIfExists('quotation_customers');
    }
}
