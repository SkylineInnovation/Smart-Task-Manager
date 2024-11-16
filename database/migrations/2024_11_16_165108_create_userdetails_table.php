<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\User::class)->nullable()->default(0);

            $table->string('title')->nullable();

            $table->string('nationality')->nullable();

            $table->string('id_number')->nullable();

            $table->string('address')->nullable();

            $table->string('qualification')->nullable();

            $table->double('salary')->nullable();

            $table->double('home')->nullable();

            $table->double('transport')->nullable();

            $table->foreignIdFor(App\Models\Branch::class)->nullable()->default(0);


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
        Schema::dropIfExists('user_details');
    }
}
