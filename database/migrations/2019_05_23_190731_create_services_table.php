<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //  protected $fillable =['owner','title','image','desciption'];
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->text('owner');
            $table->text('title');
            $table->text('description');
            $table->text('image');
            $table->text('type');
            $table->tinyInteger('selected')->default(0);
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
        Schema::dropIfExists('services');
    }
}
