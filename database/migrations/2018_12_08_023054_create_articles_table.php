<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateArticlesTable extends Migration
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
        
        $Schema->create('articles', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('user_id', 'users');
            $table->foreign_key('subject_id', true, 'subjects');
                    
            $table->string('title', 50);
            $table->string('slug', 50);
            $table->string('description', 255)->nullable();
            $table->text('body');
            $table->string('image');

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
        $Schema->dropIfExists('articles');
    }
}
