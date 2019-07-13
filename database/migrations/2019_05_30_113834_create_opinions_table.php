<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateOpinionsTable extends Migration
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

        $Schema->create('comments', function (Blueprint $table) {
            $table->increments('id');

            $table->foreign_key('user_id');
            $table->foreign_key('article_id', true);
            $table->foreign_key('parent_id', true, 'comments');

            $table->mediumText('message');
            $table->boolean('is_accept')->defult(false);

            $table->full_timestamps();
        });

        $Schema->create('reviews', function (Blueprint $table) {
            $table->increments('id');

            $table->foreign_key('user_id', 'users');
            $table->foreign_key('currency_id', 'currencies');

            $table->array('ranks');
            $table->array('advantages')->nullable();
            $table->array('disadvantages')->nullable();
            $table->mediumText('message');
            $table->boolean('is_accept')->defult(false);

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
        $Schema->dropIfExists('comments');
        $Schema->dropIfExists('reviews');
    }
}
