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
        $sec = 10;

        DB::unprepared("
        CREATE EVENT IF NOT EXISTS execute_due_transfers
        ON SCHEDULE EVERY $sec SECOND
        STARTS CURRENT_TIMESTAMP()
        DO
        BEGIN
            DECLARE finished INTEGER DEFAULT 0;
            DECLARE flow_id INT DEFAULT 0;
            DECLARE cur CURSOR FOR SELECT id FROM cashflows WHERE on_date = CURRENT_DATE();
            DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
            
            OPEN cur;
            
                transfer_loop: LOOP
                    FETCH cur INTO flow_id;
                    IF finished = 1 THEN 
                        LEAVE transfer_loop;
                    END IF;
                    
                    INSERT INTO cashflow_histories 
                        (cashflow_id, from_account_id, to_account_id, name, amount, on_date, `repeat`, transfer_type) 
                    SELECT 
                        id, from_account_id, to_account_id, name, amount, on_date, `repeat`, transfer_type
                    FROM cashflows WHERE id = flow_id;
                    
                    CASE (SELECT transfer_type FROM cashflows WHERE id = flow_id)
                        WHEN 'ACCOUNT' THEN
                            UPDATE accounts SET balance = balance - (SELECT amount FROM cashflows WHERE id = flow_id) WHERE id = (SELECT from_account_id FROM cashflows WHERE id = flow_id);
                            UPDATE accounts SET balance = balance + (SELECT amount FROM cashflows WHERE id = flow_id) WHERE id = (SELECT to_account_id FROM cashflows WHERE id = flow_id);
                        WHEN 'REVENUE' THEN
                            UPDATE accounts SET balance = balance + (SELECT amount FROM cashflows WHERE id = flow_id) WHERE id = (SELECT to_account_id FROM cashflows WHERE id = flow_id);
                        WHEN 'EXPENSE' THEN
                            UPDATE accounts SET balance = balance - (SELECT amount FROM cashflows WHERE id = flow_id) WHERE id = (SELECT from_account_id FROM cashflows WHERE id = flow_id);
                    END CASE;
                    
                CASE (SELECT `repeat` FROM cashflows WHERE id = flow_id)
                        WHEN 'NEVER' THEN
                            SELECT '';
                        WHEN 'DAILY' THEN
                            UPDATE cashflows SET on_date = on_date + INTERVAL 1 DAY WHERE id = flow_id;
                        WHEN 'WEEKLY' THEN
                            UPDATE cashflows SET on_date = on_date + INTERVAL 7 DAY WHERE id = flow_id;
                        WHEN 'MONTHLY' THEN
                            UPDATE cashflows SET on_date = on_date + INTERVAL 1 MONTH WHERE id = flow_id;
                        WHEN 'BIANNUAL' THEN
                            UPDATE cashflows SET on_date = on_date + INTERVAL 6 MONTH WHERE id = flow_id;
                        WHEN 'YEARLY' THEN
                            UPDATE cashflows SET on_date = on_date + INTERVAL 1 YEAR WHERE id = flow_id;
                    END CASE;
                    
                    DELETE FROM cashflows WHERE `repeat` = 'NEVER' AND id = flow_id;

                END LOOP transfer_loop;
                
            CLOSE cur;
            
        END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP EVENT IF EXISTS execute_due_transfers');
    }
};
