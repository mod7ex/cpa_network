<?php

use Illuminate\Database\Migrations\Migration;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $collection) {
            $collection->index('name');
            $collection->unique('email');
            $collection->index('roles');
            /**
             * 
             * ['delete' => true , 'update' => true , 'create' => true , 'view' => true, 'viewAny' => false]
             * ['delete' => true , 'update' => true , 'create' => true , 'view' => true, 'viewAny' => false]
             * 
             */
            $collection->string('password');
            $collection->timestamp('email_verified_at')->nullable();
            $collection->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}