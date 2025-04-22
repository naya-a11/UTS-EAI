<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['user_id']);
            
            // Drop old columns
            $table->dropColumn(['user_id', 'number_of_tickets', 'total_price']);
            
            // Add new columns
            $table->unsignedBigInteger('movie_id')->after('schedule_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('seats');
            $table->string('payment_method');
            
            // Update status column default if it exists
            DB::statement("ALTER TABLE bookings ALTER COLUMN status SET DEFAULT 'pending'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn(['movie_id', 'name', 'email', 'phone', 'seats', 'payment_method']);
            
            // Add back old columns
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('number_of_tickets');
            $table->decimal('total_price', 10, 2);
            
            // Add back foreign key
            $table->foreign('user_id')->references('id')->on('users');
            
            // Reset status column default
            DB::statement("ALTER TABLE bookings ALTER COLUMN status DROP DEFAULT");
        });
    }
};
