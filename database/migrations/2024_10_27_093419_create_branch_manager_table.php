<?php

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
        Schema::create('branch_manager', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Branch::class)->nullable()->default(0);
            $table->foreignIdFor(App\Models\User::class, 'manager_id')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_manager');
    }
};
