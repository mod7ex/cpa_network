<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $collection) {
            $collection->index('restriction_ids');
            $collection->index('promotion_method_ids');
            $collection->index('niche_ids');
            $collection->index('payout_type_ids');
            $collection->index('vertical_ids');
            $collection->index('device_ids');
            $collection->index('os_ids');
            $collection->index('browser_ids');
            $collection->index('country_ids');

            $collection->index('description');
            $collection->index('payout');
            $collection->index('landing_pages');
            $collection->index('images');
            $collection->index('promotion');
            /*
                {
                    public: boolean,
                    promoters: Array,
                    pending_promoters: Array,
                    rejected_promoters: Array,
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
        Schema::dropIfExists('offers');
    }
}