<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('courses', function (Blueprint $table) {
        // 👇 courses টেবিলে image কলাম যোগ করা হচ্ছে (nullable, কারণ সব কোর্সে ছবি নাও থাকতে পারে)
        $table->string('image')->nullable()->after('description');
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::table('courses', function (Blueprint $table) {
        // 👇 রোলব্যাক করলে image কলামটি মুছে যাবে
        $table->dropColumn('image');
    });
}
};
