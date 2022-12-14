<?php

use App\Models\LeaveType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function(Blueprint $table){
            $table->id();
            $table->string('type_name');
            $table->string('color');
            $table->timestamps();
        });

        $category = new LeaveType();
        $category->type_name = 'Casual';
        $category->color = '#16813D';
        $category->save();

        $category = new LeaveType();
        $category->type_name = 'Sick';
        $category->color = '#DB1313';
        $category->save();

        $category = new LeaveType();
        $category->type_name = 'Earned';
        $category->color = '#B078C6';
        $category->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_types');
    }
};
