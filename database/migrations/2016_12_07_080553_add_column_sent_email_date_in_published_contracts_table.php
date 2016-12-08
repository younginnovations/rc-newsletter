<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSentEmailDateInPublishedContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('published_contracts', function (Blueprint $table) {
            $table->date('sent_email_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('published_contracts', function (Blueprint $table) {
            $table->dropColumn('sent_email_date');
        });
    }
}