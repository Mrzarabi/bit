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
            // $table->foreign_key('spec_id', 'specs');

            $table->string('title', 50);
            $table->string('slug', 50);
            $table->text('short_description', 255)->nullable();
            $table->text('note', 255)->nullable();
            $table->bigInteger('price');
            $table->string('inventory');
            $table->tinyInteger('status')->default(1);
            $table->string('photo')->nullable();
            $table->string('code')->nullable();
            
            $table->full_timestamps();
        });

        $Schema->create('spec_data', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('spec_row_id', 'spec_rows');
            // $table->foreign_key('currency_id', 'currencies');

            $table->string('data', 255);
            
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
        $Schema->dropIfExists('spec_data');
    }
}
