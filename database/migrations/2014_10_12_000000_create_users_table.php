<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fullname');
            $table->string('fathername');
            $table->string('gender');
            $table->string('religion')->default('Muslim');
            $table->string('image');
            $table->string('role')->default('visitor');
            $table->boolean('admin')->default(0);
            $table->boolean('leader')->default(0);
            $table->string('ss_id')->default('');
            $table->string('date_of_birth')->default('');
            $table->string('address')->default('');
            $table->string('age')->default('');
            $table->string('phone')->default('');
            $table->string('facebook')->default('#');
            $table->string('twitter')->default('#');
            $table->string('status')->default('offline');
            $table->string('mailing')->default('Everyone');
            $table->string('chat')->default('Everyone');
            $table->string('timeline')->default('Everyone');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->dateTime('last_login_at')->nullable();
            $table->string('api_token')->unique()->nullable();
            $table->string('stripe_id')->unique()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
