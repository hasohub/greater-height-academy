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
       Schema::create('sms_messages', function (Blueprint$table) {
           $table->id();
           $table->string('recipient'); // Phone number
           $table->text('message');
           $table->string('sender_id')->default('GHA');
           $table->string('message_id')->nullable()->unique();
           $table->enum('status', ['pending', 'sent', 'delivered', 'failed'])->default('pending');
           $table->string('type')->default('general'); // general, attendance, fees, exam, notice
           $table->unsignedBigInteger('sender_id_user')->nullable();
           $table->unsignedBigInteger('related_id')->nullable(); // e.g. student_id, fee_id
           $table->json('metadata')->nullable();
           $table->timestamps();

           $table->foreign('sender_id_user')->references('id')->on('users')->onDelete('set null');
       });
   }

   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
       Schema::dropIfExists('sms_messages');
   }
};
