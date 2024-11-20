<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletePercentagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complete_percentages', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\Task::class)->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class)->nullable()->default(0);

            $table->integer('percentage')->nullable();

            $table->string('rate_text')->nullable();

            $table->integer('rate_val')->nullable();


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
        Schema::dropIfExists('completepercentages');
    }
}
