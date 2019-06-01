<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateCurrenciesTable extends Migration
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

        $Schema->create('currencies', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('user_id', 'users');
            $table->foreign_key('category_id', 'categories');

            $table->string('title', 50);
            $table->string('slug', 50);
            $table->text('description', 255)->nullable();
            $table->integer('price');
            $table->string('inventory');
            $table->string('image')->nullable();
            
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
        $Schema->dropIfExists('currencies');
    }
}
