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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->date('lastLogin')->nullable();
            $table->string('email',50);
            $table->string('password',200);
            $table->string('username',30);
            $table->string('tag',10);
            $table->integer('followersNumber');
            $table->integer('followingNumber');
            $table->tinyInteger('Active');
            $table->string('profilePicture',45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
