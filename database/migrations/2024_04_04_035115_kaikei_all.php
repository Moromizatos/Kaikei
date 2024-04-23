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
            $table->string('name', 255)->nullable();
        });
        Schema::create('revenues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('hours');
            $table->decimal('pay_rate', 10, 2);
            $table->integer('week_number');
            $table->date('week_start');
            $table->date('payday');
            $table->decimal('amount', 10, 2)->storedAs('pay_rate * hours');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->integer('from_account_id')->nullable();
            $table->integer('to_account_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('on_date');
            $table->enum('repeat', ['NEVER', 'DAILY', 'WEEKLY', 'MONTHLY', 'BIANNUAL', 'YEARLY']);
            $table->enum('transfer_type', ['ACCOUNT', 'REVENUE', 'EXPENSE']);
        });
        Schema::create('cashflow_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('cashflow_id');
            $table->integer('from_account_id')->nullable();
            $table->integer('to_account_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('on_date');
            $table->enum('repeat', ['NEVER', 'DAILY', 'WEEKLY', 'MONTHLY', 'BIANNUAL', 'YEARLY']);
            $table->enum('transfer_type', ['ACCOUNT', 'REVENUE', 'EXPENSE']);
        });
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->decimal('balance', 10, 2);
            $table->boolean('is_joint')->nullable();
            $table->enum('currency', ['GBP', 'EUR', 'CZK', 'BRL'])->default('GBP');
            $table->enum('account_type', ['MAIN', 'SAVINGS', 'BILLS', 'INVESTMENTS', 'CURRENCY']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('revenues');
        Schema::dropIfExists('cashflows');
        Schema::dropIfExists('cashflow_histories');
        Schema::dropIfExists('accounts');
    }
};
