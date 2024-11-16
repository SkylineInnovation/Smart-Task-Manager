<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignIdFor(User::class, 'add_by')->default(0);
            $table->string('slug')->nullable();


            $table->string('name')->nullable();

            $table->string('location')->nullable();

            $table->string('phone')->nullable();

            $table->string('number')->nullable();

            $table->string('fax')->nullable();

            $table->string('email')->nullable();

            $table->string('password')->nullable();

            $table->string('website')->nullable();

            $table->string('commercial_register')->nullable();

            $table->foreignIdFor(App\Models\Area::class)->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class, 'manager_id')->nullable()->default(0);

            $table->foreignIdFor(App\Models\User::class, 'responsible_id')->nullable()->default(0);


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
        Schema::dropIfExists('branches');
    }
}
