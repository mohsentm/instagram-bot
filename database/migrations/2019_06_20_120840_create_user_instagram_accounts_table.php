<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInstagramAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_instagram_accounts', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('instagram_account_id')->unsigned();
            $table->bigInteger('roles_id')->unsigned()->nullable();
            $table->enum('status', ['ENABLE', 'DISABLE']);
            $table->timestamps();

            $table->unique(['user_id', 'instagram_account_id', 'roles_id'],'user_instagram_account_unique');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('instagram_account_id')
                ->references('id')
                ->on('instagram_accounts')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('roles_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_instagram_accounts');
    }
}
