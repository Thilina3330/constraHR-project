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
        Schema::create('site_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_id');
            $table->string('task_name'); // e.g. Foundation, 2nd Floor Slab
            $table->enum('status', ['completed', 'in_progress', 'pending'])->default('pending');
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
        Schema::dropIfExists('site_tasks');
    }
};
