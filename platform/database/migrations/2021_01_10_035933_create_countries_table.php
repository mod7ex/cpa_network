<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $collection) {
            /*
                'details' => [
                    'name' => $country->name,
                    'code' => $country->alpha3Code,
                    'calling_codes' => $country->callingCodes,
                ]
            */
            $collection->index('details');
            $collection->index('offer_ids');
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
        Schema::dropIfExists('countries');
    }
}