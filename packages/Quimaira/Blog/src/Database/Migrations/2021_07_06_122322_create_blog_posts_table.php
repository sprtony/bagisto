<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 250);
            $table->string('slug', 250);
            $table->string('image', 250);
            $table->date('fecha');
            $table->date('liberacion');
            $table->tinyInteger('status');
            $table->string('image_mobile', 250);
            $table->text('descripcion');
            $table->text('contenido');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->integer('vistas')->default(0);
            $table->text('tags');
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
        Schema::dropIfExists('blog_posts');
    }
}
