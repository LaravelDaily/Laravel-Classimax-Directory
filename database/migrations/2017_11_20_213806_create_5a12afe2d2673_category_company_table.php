<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5a12afe2d2673CategoryCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('category_company')) {
            Schema::create('category_company', function (Blueprint $table) {
                $table->integer('category_id')->unsigned()->nullable();
                $table->foreign('category_id', 'fk_p_91029_91033_company__5a12afe2d2772')->references('id')->on('categories')->onDelete('cascade');
                $table->integer('company_id')->unsigned()->nullable();
                $table->foreign('company_id', 'fk_p_91033_91029_category_5a12afe2d27f0')->references('id')->on('companies')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_company');
    }
}
