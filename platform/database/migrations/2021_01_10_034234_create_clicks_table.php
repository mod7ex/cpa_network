<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCLicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $collection) {
            // $collection->foreignId('user_id')->constrained('users', '_id');
            // $collection->foreignId('offer_id')->constrained('offers', '_id');
            $collection->index('user_id');
            $collection->index('offer_id');
            $collection->index('cookie');
            /*
            {
                name: string,
                ttl: time,
                ...
            }
            */
            $collection->index('details');
            /*
            {
                os: ...,
                ip: ...,
                datetime: ...,
                .
                ..
                ...
            }
            */
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clicks');
    }
}