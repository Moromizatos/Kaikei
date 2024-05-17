<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER after_revenue_insert
            AFTER INSERT ON revenues
            FOR EACH ROW
            BEGIN
                INSERT INTO cashflows (from_account_id, to_account_id, name, amount, on_date, `repeat`, transfer_type)
                VALUES (0, 1, CONCAT('Payref_', CONVERT(NEW.week_number, CHAR), '_', CONVERT(NEW.payday, CHAR)), NEW.amount, NEW.payday, 'NEVER', 'REVENUE');
            END"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_revenue_insert');
    }
};
