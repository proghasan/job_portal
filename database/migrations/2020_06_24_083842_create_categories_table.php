<?php

use App\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        $cat = ['Design/Creative', 'IT & Telecommunication','Electrician/ Construction/ Repair',
        'Production/Operation','Hospitality/ Travel/ Tourism','Beauty Care/ Health & Fitness'];
        foreach($cat as $cat){
            $category = new Category();
            $category->name = "$cat";
            $category->save();
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
