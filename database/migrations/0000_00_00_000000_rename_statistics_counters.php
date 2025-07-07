<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameStatisticsCounters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if table exists before attempting to rename columns
        if (Schema::hasTable('websockets_statistics_entries')) {
            // Check if old columns exist before renaming
            if (Schema::hasColumn('websockets_statistics_entries', 'peak_connection_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE peak_connection_count peak_connections_count INT DEFAULT NULL');
            }
            
            if (Schema::hasColumn('websockets_statistics_entries', 'websocket_message_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE websocket_message_count websocket_messages_count INT DEFAULT NULL');
            }
            
            if (Schema::hasColumn('websockets_statistics_entries', 'api_message_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE api_message_count api_messages_count INT DEFAULT NULL');
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Check if table exists before attempting to rename columns
        if (Schema::hasTable('websockets_statistics_entries')) {
            // Check if new columns exist before renaming back
            if (Schema::hasColumn('websockets_statistics_entries', 'peak_connections_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE peak_connections_count peak_connection_count INT DEFAULT NULL');
            }
            
            if (Schema::hasColumn('websockets_statistics_entries', 'websocket_messages_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE websocket_messages_count websocket_message_count INT DEFAULT NULL');
            }
            
            if (Schema::hasColumn('websockets_statistics_entries', 'api_messages_count')) {
                DB::statement('ALTER TABLE websockets_statistics_entries CHANGE api_messages_count api_message_count INT DEFAULT NULL');
            }
        }
    }
}
