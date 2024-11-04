<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\User::class, 'manager_id')->nullable()->default(0);

            $table->longText('title')->nullable();

            $table->longText('description')->nullable();

            $table->string('start_time')->nullable()->default(date('Y-m-d'));

            $table->string('end_time')->nullable()->default(date('Y-m-d', strtotime('+60 minutes')));

            $table->string('priority_level')->nullable()->default('low');

            $table->string('status')->nullable()->default('pending');

            $table->string('repeat_time')->nullable();

            $table->string('repeat_evrey')->nullable();


            $table->boolean('show')->default(true);
            $table->integer('sort')->default(1000);
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
        Schema::dropIfExists('daily_tasks');
    }
}
