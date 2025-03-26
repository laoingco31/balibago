<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('entries', function (Blueprint $table) {
        $table->id();
        $table->date('date_received');
        $table->string('branch');
        $table->text('description');
        $table->integer('quantity');
        $table->decimal('amount', 10, 2);
        $table->decimal('total', 10, 2);
        $table->date('date_release')->nullable();
        $table->string('received_by');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
