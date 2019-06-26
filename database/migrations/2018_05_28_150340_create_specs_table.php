<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateSpecsTable extends Migration
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

        $Schema->create('specs', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('category_id', 'categories');

            $table->full_timestamps();
        });

        $Schema->create('spec_headers', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('spec_id', 'specs');

            $table->string('title', 50);
            $table->string('description', 255)->nullable();

            $table->full_timestamps();
        });

        $Schema->create('spec_rows', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->foreign_key('spec_header_id', 'spec_headers');

            $table->string('title', 50);
            $table->string('label', 50)->nullable();
            $table->mediumText('values')->nullable();
            $table->mediumText('help')->nullable();
            $table->boolean('multiple')->default(0);

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
        $Schema->dropIfExists('specs');
        $Schema->dropIfExists('spec_headers');
        $Schema->dropIfExists('spec_rows');
    }
}
