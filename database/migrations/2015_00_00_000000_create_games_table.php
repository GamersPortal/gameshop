<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            /**
             * Basic game info
             */
            $table->increments('id');
            // Active in store
            $table->boolean('active')->default(false);
            // New label
            $table->boolean('new')->default(false);
            $table->string('name')->index();
            $table->integer('category_id')->unsigned()->nullable();
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable()->default('img/game-no-image.jpg');
            $table->string('image_thumb')->nullable()->default('img/game-no-image.jpg');
            $table->string('slug', 255)->unique();
            // Discounted price, NULL if there's no discount
            $table->decimal('discounted_price', 8, 2)->nullable();
            /**
             * Stock related info
             */
            $table->string('sku')->unique();
            $table->integer('quantity')->nullable();
            $table->decimal('weight', 8, 2);
            $table->timestamps();
            /**
             * Indices and keys
             */
            $table->foreign('category_id')
              ->references('id')->on('categories')
              ->onDelete('set null')
              ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games');
    }

}
