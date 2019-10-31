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
            $table->string('last_name', 30);

            $table->string('national_code', 10)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->string('birthday')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('avatar')->nullable();

            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->boolean('can_buy')->default(0);

            $table->string('image_national_code')->nullable();
            $table->boolean('accept_image_national_code')->default(0);
            $table->string('identify_certificate')->nullable();
            $table->boolean('accept_identify_certificate')->default(0);
            $table->string('image_bill')->nullable();
            $table->boolean('accept_image_bill')->default(0);
            $table->string('image_selfie_national_code')->nullable();
            $table->boolean('accept_image_selfie_national_code')->default(0);

            
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
