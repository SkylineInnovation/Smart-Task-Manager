<?php

use App\Models\DailyTask;
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
        Schema::create('daily_task_user', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(DailyTask::class);
            $table->double('discount')->nullable()->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_task_user');
    }
};
