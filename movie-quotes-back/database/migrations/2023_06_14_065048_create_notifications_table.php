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
			$table->foreignId('sender_id')->constrained()->cascadeOnDelete();
			$table->foreignId('receiver_id')->constrained()->cascadeOnDelete();
			$table->boolean('commented')->default(false);
			$table->boolean('liked')->default(false);
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
