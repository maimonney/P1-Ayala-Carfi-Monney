<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaTable extends Migration
{
    public function up()
    {
        Schema::create('reserva', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); 
            $table->string('status');
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('reserva');
    }
}
