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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('employee_id')->unique()->after('id'); // e.g. EMP-0245
            $table->string('qr_id')->unique()->after('employee_id'); // e.g. QR-000245
            $table->string('name')->after('qr_id');
            $table->string('phone')->nullable()->after('name');
            $table->string('designation')->after('phone'); // Mason, Laborer, Carpenter, etc.
            $table->unsignedBigInteger('site_id')->after('designation');
            $table->string('status')->default('active')->after('site_id');

           
            $table->foreign('site_id')->references('Site_id')->on('sites')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
            $table->dropColumn(['employee_id', 'qr_id', 'name', 'phone', 'designation', 'site_id', 'status']);
        });
    }
};
