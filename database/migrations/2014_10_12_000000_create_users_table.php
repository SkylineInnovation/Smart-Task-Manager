<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->foreignIdFor(User::class, 'add_by')->nullable()->default(0);

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('user_name')->nullable();

            $table->string('phone')->unique()->nullable();
            $table->boolean('is_phone_verified')->nullable()->default(false);

            $table->string('fire_base_uid')->nullable();
            $table->string('device_token')->nullable();

            $table->string('fire_base_phone_uid')->nullable();
            $table->string('fire_base_google_uid')->nullable();
            $table->string('fire_base_facebook_uid')->nullable();
            $table->string('fire_base_apple_uid')->nullable();

            $table->string('email')->unique()->nullable();
            $table->boolean('is_email_verified')->nullable()->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->enum('gender', ['male', 'female'])->nullable()->default('male');
            $table->string('birth_day')->nullable()->default('10/07/1997');
            $table->string('image')->nullable()->default('assets/images/users/12.jpg');

            $table->enum('language', ['ar', 'en'])->nullable()->default('en');
            $table->enum('status', ['active', 'blocked'])->nullable()->default('active');
            $table->timestamp('last_time_use')->nullable();
            $table->timestamp('active_until')->nullable()->default(date('Y-m-d', strtotime("+30 days")));


            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
};
