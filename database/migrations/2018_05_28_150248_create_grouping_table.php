<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateGroupingTable extends Migration
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

        $Schema->create('categories', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('parent', true, 'categories');
                    
            $table->string('title', 50);
            $table->text('description', 255)->nullable();
            $table->string('logo');
            
            $table->full_timestamps();
        });
        
        $Schema->create('subjects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            
            // $table->foreign_key('parent_id', true, 'subjects');
            
            $table->string('title', 50);
            $table->text('description', 255)->nullable();
            $table->string('logo');

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
        $Schema->dropIfExists('categories');
        $Schema->dropIfExists('subjects');
    }
}
