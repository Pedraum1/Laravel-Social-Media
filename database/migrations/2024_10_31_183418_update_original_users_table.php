<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * CONTEXT: This project have beem previously elaborated in other PHP framework,
     * because of this, it is necessary to use and update the previous database to
     * ensure the consistence of the project.
     */
    public function up(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('name',30)->change();
            $table->renameColumn('name','username');
            $table->date('last_login')->nullabel()->default(null);
            $table->string('email',50)->change();
            $table->string('senha',200)->change();
            $table->renameColumn('senha','password');
            $table->renameColumn('followers','followersNumber');
            $table->renameColumn('following','followingNumber');
            $table->tinyInteger('active')->default(1)->after('followingNumber');
            $table->dateTime('email_verified_at')->nullable()->default(null);
            $table->integer('profile_image_id')->default(1);
            $table->integer('banner_image_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn('banner_image_id');
            $table->dropColumn('profile_image_id');
            $table->dropColumn('email_verified_at');
            $table->dropColumn('active');
            $table->renameColumn('followingNumber','following');
            $table->renameColumn('followersNumber','followers');
            $table->renameColumn('password','senha');
            $table->string('senha',50)->change();
            $table->string('email',255)->change();
            $table->dropColumn('last_login');
            $table->renameColumn('username','name');
            $table->string('name',35)->change();
        });
    }
};
