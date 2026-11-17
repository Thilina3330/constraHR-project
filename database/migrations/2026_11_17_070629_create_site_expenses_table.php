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
        Schema::create('site_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->date('expense_date');
            $table->string('category'); // Materials, Transport, Equipment, Labor ආදිය
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->timestamps();

            // sites table එක සමඟ සම්බන්ධ කිරීම (Foreign Key)
            $table->foreign('site_id')->references('Site_id')->on('sites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_expenses');
    }
};
