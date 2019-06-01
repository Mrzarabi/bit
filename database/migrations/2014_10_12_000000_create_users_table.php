<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreateUsersTable extends Migration
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

        $Schema->create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->string('first_name', 20);
            $table->string('second_name', 20);
            $table->string('last_name', 30);

            $table->string('social_link', 10)->nullable();
            $table->string('phone_number', 11);
            $table->string('birthday')->nullable();
            $table->string('address', 255)->nullable();

            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);

            $table->string('avatar', 50)->nullable();

            $table->string('image_social_link')->nullable();
            $table->string('image_certificate')->nullable();
            $table->string('image_bill')->nullable();
            $table->string('image_selfie_social_link')->nullable();

            
            $table->rememberToken();
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
        $Schema->dropIfExists('users');
    }
}
