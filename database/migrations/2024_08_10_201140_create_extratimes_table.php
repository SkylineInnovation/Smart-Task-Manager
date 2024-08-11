<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_times', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\Task::class)->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class)->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class, 'accepted_by_user_id')->nullable()->default(0);

            $table->string('reason')->nullable();

            $table->string('result')->nullable();

            $table->string('request_time')->nullable()->default(date('Y-m-d H:i A'));

            $table->string('response_time')->nullable();

            $table->string('status')->nullable()->default('pending');

            $table->integer('duration')->nullable();


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
        Schema::dropIfExists('extra_times');
    }
}
