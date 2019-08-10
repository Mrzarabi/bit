<?php

use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\Helpers\Blueprint;

class CreatePurchaseRecordsTable extends Migration
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

        $Schema->create('purchase_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->foreign_key('user_id', 'users');
            $table->foreign_key('currency_id', 'currencies');
            
            $table->string('transactionId');
            $table->string('refId');

            $table->string('description')->nullable();
            $table->string('purchase');
            $table->string('inventory');
            $table->unsignedBigInteger('bank_cart')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $Schema->dropIfExists('purchase_records');
    }
}
