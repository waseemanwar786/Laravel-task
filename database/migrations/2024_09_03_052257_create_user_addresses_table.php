<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->index();
            $table->string('address');
            $table->timestamps();

            // Index for efficient querying on user_id
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}

