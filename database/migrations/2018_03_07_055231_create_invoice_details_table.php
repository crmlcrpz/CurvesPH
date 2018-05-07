<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('invoice_id')->index('FK_invoice_details_invoice_1')->comment('links to unique record id of invoice');
            $table->integer('item_amount')->comment('amount of the items');
            $table->timestamps();
            $table->integer('created_by')->unsigned()->index('FK_invoice_details_staff_2');
            $table->integer('updated_by')->unsigned()->index('FK_invoice_details_staff_3');
            $table->integer('plan_id')->default(1)->index('invoice_details_plan_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_details');
    }
}
