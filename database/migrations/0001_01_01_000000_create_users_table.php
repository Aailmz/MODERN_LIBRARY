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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role');
            $table->string('profile_picture')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('writer');
            $table->string('publisher');
            $table->string('category');
            $table->string('type');
            $table->integer('page');
            $table->string('language');
            $table->string('rate');
            $table->longtext('sinopsis');
            $table->integer('stock')->nullable();
            $table->string('book_picture')->nullable();
            $table->string('book_file')->nullable();
            $table->integer('like')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('category');
            $table->string('name');
            $table->string('email');
            $table->dateTime('borrow_duration');
            $table->timestamps();
        });

        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('category');
            $table->string('name');
            $table->string('email');
            $table->dateTime('date');
            $table->dateTime('borrow_duration');
            $table->string('status');
            $table->string('condition');
            $table->string('note')->nullable();
            $table->timestamps();
        });

        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('category');
            $table->string('name');
            $table->string('email');
            $table->dateTime('request_date');
            $table->dateTime('borrow_duration');
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('name');
            $table->dateTime('date');
            $table->dateTime('borrow_duration');
            $table->string('status');
            $table->string('condition');
            $table->string('header');
            $table->string('note')->nullable();
            $table->string('mail_status');
            $table->timestamps();
        });

        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('book_id');
            $table->string('title');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
