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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // සේවකයාගේ නම
            $table->string('phone');                        // දුරකථන අංකය
            $table->string('nic')->unique();                // ජාතික හැඳුනුම්පත් අංකය (Unique විය යුතුයි)
            $table->string('role');                         // තනතුර (e.g. Mason, Laborer, Supervisor)
            $table->decimal('daily_wage', 10, 2);           // දෛනික වැටුප (Daily rate)
            $table->unsignedBigInteger('site_id')->nullable(); // වැඩ කරන Site එක
            $table->date('joined_date');                    // වැඩට එක්වූ දිනය
            $table->string('emergency_contact')->nullable(); // හදිසි ඇමතුම් අංකය
            $table->text('address')->nullable();            // ලිපිනය
            $table->string('qr_code')->nullable();          // QR code token/code එක
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

            // Site එක Delete වුවහොත් employee delete නොවී site_id එක null වීමට:
            $table->foreign('site_id')->references('Site_id')->on('sites')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};