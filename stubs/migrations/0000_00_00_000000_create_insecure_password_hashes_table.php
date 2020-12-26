<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsecurePasswordHashesTable extends Migration {

    public function up()
    {
        Schema::create('insecure_password_hashes', function(Blueprint $table) {
            $table->id();
            $table->longText('hash')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('insecure_password_hashes');
    }

}