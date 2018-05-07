<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToInquiryFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquiry_followups', function (Blueprint $table) {
            $table->foreign('inquiry_id', 'FK_inquiry_followups_inquiries_1')->references('id')->on('inquiries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('created_by', 'FK_inquiry_followups_staff_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('updated_by', 'FK_inquiry_followups_staff_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquiry_followups', function (Blueprint $table) {
            $table->dropForeign('FK_inquiry_followups_inquiries_1');
            $table->dropForeign('FK_inquiry_followups_staff_2');
            $table->dropForeign('FK_inquiry_followups_staff_3');
        });
    }
}
