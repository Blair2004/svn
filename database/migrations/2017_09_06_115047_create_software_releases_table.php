<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoftwareReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_releases', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'version' );
            $table->integer( 'software_id' );
            $table->text( 'changelog' )->nullable();
            $table->text( 'file_path' );
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
        Schema::dropIfExists('software_releases');
    }
}
