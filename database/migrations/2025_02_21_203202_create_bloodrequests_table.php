<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bloodrequests', function (Blueprint $table) {
            $table->id();
            $table->string('patent_name');
            $table->string('patent_age');
            $table->string('patent_address');
            $table->string('patent_problem');
            $table->string('patent_blood_group');
            $table->string('unit_required');
            $table->string('hospital_name');
            $table->string('hospital_address');
            $table->string('date_required');
            $table->string('attendent_name');
            $table->string('attendent_mobile');
            $table->string('donated_unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloodrequests');
    }
};
