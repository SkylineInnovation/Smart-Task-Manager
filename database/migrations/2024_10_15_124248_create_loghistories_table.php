<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_histories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\User::class)->nullable()->default(0);

            $table->string('action')->nullable();

            $table->string('by_model_name')->nullable();

            $table->integer('by_model_id')->nullable();

            $table->string('on_model_name')->nullable();

            $table->integer('on_model_id')->nullable();

            $table->json('from_data')->nullable();

            $table->json('to_data')->nullable();

            $table->json('preaf')->nullable();

            $table->json('desc')->nullable();

            $table->string('color')->nullable();


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
        Schema::dropIfExists('log_histories');
    }
}
