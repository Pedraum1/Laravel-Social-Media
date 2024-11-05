<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts',function(Blueprint $table){
            $table->renameColumn('writer','user_id');
            $table->renameColumn('original_id','source_id');
            $table->integer('user_id')->after('id')->change();
            $table->integer('source_id')->nullable()->change();
            $table->dateTime('created_at')->after('views')->change();
            $table->dateTime('updated_at')->after('created_at')->nullable()->change();
            $table->dateTime('deleted_at')->after('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts',function(Blueprint $table){
            $table->renameColumn('user_id','writer');
            $table->integer('writer')->after('source_id')->change();
            $table->dateTime('created_at')->after('writer')->change();
            $table->dateTime('updated_at')->after('created_at')->change();
            $table->dateTime('deleted_at')->after('updated_at')->change();
            $table->renameColumn('source_id','original_id');
        });
    }
};
