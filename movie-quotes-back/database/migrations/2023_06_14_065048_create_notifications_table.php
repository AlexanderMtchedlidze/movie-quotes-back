<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('notifications', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->foreignId('quote_id')->constrained()->cascadeOnDelete();
			$table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
			$table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
			$table->boolean('commented')->default(false);
			$table->enum('liked', config('notifications.liked'))->default(false);
			$table->enum('read', config('notifications.commented'))->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('notifications');
	}
};
