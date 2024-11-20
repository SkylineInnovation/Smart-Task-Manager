<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\User::class, 'manager_id')->nullable()->default(0);

            $table->longText('title')->nullable();

            $table->longText('desc')->nullable();

            $table->string('start_time')->nullable()->default(date('Y-m-d'));

            $table->string('end_time')->nullable()->default(date('Y-m-d', strtotime('+60 minutes')));

            $table->string('priority_level')->nullable()->default('low');

            $table->string('comment_type')->nullable()->default('daily');

            $table->integer('max_worning_count')->nullable()->default(1);

            $table->string('status')->nullable()->default('pending');

            $table->foreignIdFor(App\Models\Task::class, 'main_task_id')->nullable()->default(0);

            $table->foreignIdFor(App\Models\DailyTask::class)->nullable()->default(0);

            $table->foreignIdFor(App\Models\Task::class, 'reopen_from_task_id')->nullable()->default(0);

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
        Schema::dropIfExists('tasks');
    }
}
