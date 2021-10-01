<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('CASCADE');
            $table->text('description');
            $table->integer('price');
            $table->text('image');
            $table->foreignId('admin_id')->constrained()->onDelete('CASCADE');
            $table->enum('status', [0,1])->default(1)->comment("[0 => inactive , 1 => active]");
            $table->enum('feature', [0,1])->default(1)->comment("[0 => no , 1 => yes]");
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
        Schema::dropIfExists('products');
    }
}
