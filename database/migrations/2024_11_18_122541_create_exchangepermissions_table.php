<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->foreignIdFor(App\Models\User::class)->nullable()->default(0);

            $table->longText('content')->nullable();

            $table->double('amount')->nullable()->default(0.0);

            $table->string('attachment')->nullable();

            $table->string('request_date')->nullable();

            $table->foreignIdFor(App\Models\User::class, 'financial_director_id')->nullable()->default(0);

            $table->longText('financial_director_response')->nullable();

            $table->string('financial_director_time')->nullable();

            $table->foreignIdFor(App\Models\User::class, 'technical_director_id')->nullable()->default(0);

            $table->longText('technical_director_response')->nullable();

            $table->string('technical_director_time')->nullable();

            $table->string('status')->nullable();


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
        Schema::dropIfExists('exchange_permissions');
    }
}
