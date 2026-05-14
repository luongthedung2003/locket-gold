<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('plan_id')->constrained()->onDelete('cascade');
            $table->string('locket_username')->nullable();
            $table->string('locket_uid')->nullable();
            $table->string('status')->default('pending'); // pending, resolving, injecting, completed, failed
            $table->text('notes')->nullable();
            $table->string('dns_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activations');
    }
};
