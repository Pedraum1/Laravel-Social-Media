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
        Schema::table('users',function(Blueprint $table){
            $table->dropColumn('profile_image_id');
            $table->dropColumn('banner_image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('profile_image_id')->default(1)->after('valdiation_token');
            $table->integer('banner_image_id')->default(1)->after('profile_image_id');
        });
    }
};
