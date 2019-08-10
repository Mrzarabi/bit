<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** start for have default Blueprint class */
        $Schema = DB::connection()->getSchemaBuilder();
        $Schema->blueprintResolver( function( $table, $callback ) {
            return new Blueprint( $table, $callback );
        });
        /** end  */

        $Schema->create('tickets', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('user_id', 'users');

            $table->string('title', 50);
            $table->string('status')->default(0);
            $table->boolean('is_close')->default(0);
            
            $table->full_timestamps();
        });

        $Schema->create('ticket_messages', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('user_id', 'users');
            $table->foreign_key('ticket_id', 'tickets');

            $table->string('title', 50);
            $table->string('image')->nullable();
            $table->text('message');

            $table->full_timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $Schema->dropIfExists('tickets');
        $Schema->dropIfExists('ticket_messages');
    }
}
