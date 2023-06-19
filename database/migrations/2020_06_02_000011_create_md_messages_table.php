<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMdMessagesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'md_messages';

    /**
     * Run the migrations.
     * @table md_messages
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('message')->nullable();
            $table->integer('doctor_id');
            $table->integer('user_id');

            $table->index(["user_id"], 'fk_md_chats_md_users2_idx');

            $table->index(["doctor_id"], 'fk_md_chats_md_users1_idx');
            $table->nullableTimestamps();


            $table->foreign('doctor_id', 'fk_md_chats_md_users1_idx')
                ->references('id')->on('md_users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_md_chats_md_users2_idx')
                ->references('id')->on('md_users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
