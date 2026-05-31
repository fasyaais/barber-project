<?php

use App\Models\Job;
use App\Models\Merchant;
use App\Models\Position;
use App\Models\User;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username');
            $table->string('no_whatsapp');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role',['admin','owner']);
            $table->timestamps();
        });

        Schema::create('positions',function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('merchants',function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->foreignIdFor(User::class,'user_id')->constrained()->cascadeOnDelete();
            $table->string('locate')->comment('Location in google maps');
            $table->string('img');
            $table->timestamps();
        });

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Merchant::class,'merchant_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Position::class,'position_id')->nullable()->constrained()->nullOnDelete();
            $table->longText('description');
            $table->integer('slot');
            $table->enum('status',['unavailable','available'])->default('available');
            $table->date('due_date');
            $table->timestamps();
        });

        Schema::create('applications',function(Blueprint $table){
            $table->id();
            $table->foreignIdFor(Job::class,'job_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('cv');
            $table->string('no_whatsapp');
            $table->string('email');
            $table->timestamp('submited_at');
            $table->timestamps();
        });

        Schema::create('features',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('img');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('features');
        Schema::dropIfExists('applications');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('merchants');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
