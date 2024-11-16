<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->string('name')->nullable();

            $table->string('address')->nullable();

            $table->string('phone')->nullable();

            $table->string('number')->nullable();

            $table->string('fax')->nullable();

            $table->string('email')->nullable();

            $table->string('website')->nullable();

            $table->string('commercial_register')->nullable();

            $table->foreignIdFor(App\Models\User::class, 'technical_director_id')->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class, 'financial_director_id')->nullable()->default(0);

            $table->string('logo')->nullable();


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
        Schema::dropIfExists('companies');
    }
}
