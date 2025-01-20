<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->longText('text_uz')->nullable();
            $table->longText('text_ru')->nullable();
            $table->longText('text_en')->nullable();
            $table->timestamps();
        });

        DB::table('abouts')->insert([
            'text_uz'=>'',
            'text_ru'=>'',
            'text_en'=>'',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
