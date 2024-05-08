DROP DATABASE kaikei;
CREATE DATABASE kaikei;
USE kaikei;
-- Users Table
CREATE TABLE Users (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) 
);

-- Revenue Table
CREATE TABLE revenues (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT,
    hours INT,
    pay_rate DECIMAL(10, 2),
    week_number INT,
    week_start DATE,
    payday DATE,
    amount DECIMAL(10, 2) AS (pay_rate * hours) STORED,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

-- Cashflow Table
CREATE TABLE cashflows (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    from_account_id INT,
    to_account_id INT,
    name VARCHAR(255),
    amount DECIMAL(10, 2),
    on_date DATE,
    `repeat` ENUM('NEVER', 'DAILY', 'WEEKLY', 'MONTHLY', 'BIANNUAL', 'YEARLY'),
    transfer_type ENUM('ACCOUNT', 'REVENUE', 'EXPENSE')
);

-- Cashflow History Table
CREATE TABLE cashflowHistories (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cashflow_id INT,
    from_account_id INT,
    to_account_id INT,
    name VARCHAR(255),
    amount DECIMAL(10, 2),
    on_date DATE,
    `repeat` ENUM('NEVER', 'DAILY', 'WEEKLY', 'MONTHLY', 'BIANNUAL', 'YEARLY'),
    transfer_type ENUM('ACCOUNT', 'REVENUE', 'EXPENSE')
);

-- accounts Table
CREATE TABLE accounts (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    balance DECIMAL(10, 2),
    is_joint BOOLEAN,
    currency ENUM('GBP', 'EUR', 'CZK', 'BRL') DEFAULT 'GBP',
    account_type ENUM('MAIN', 'SAVINGS', 'BILLS', 'INVESTMENTS', 'CURRENCY')
);


USE kaikei;

-- TRIGGERS
-- Trigger for creating a cashflow record after inserting a record into the Revenue table
DROP TRIGGER IF EXISTS after_revenue_insert;
DELIMITER $$
CREATE TRIGGER after_revenue_insert
AFTER INSERT ON revenues
FOR EACH ROW
BEGIN
    INSERT INTO cashflows (from_account_id, to_account_id, name, amount, on_date, `repeat`, transfer_type)
    VALUES (0, 1, CONCAT("Payref_", CONVERT(NEW.week_number, CHAR), "_", CONVERT(NEW.payday, CHAR)), NEW.amount, NEW.payday, 'NEVER', 'REVENUE');
END$$
DELIMITER ;

SET GLOBAL event_scheduler = ON;


-- EVENTS
DROP EVENT IF EXISTS execute_due_transfers;

DELIMITER $$
CREATE EVENT IF NOT EXISTS execute_due_transfers
ON SCHEDULE EVERY 10 SECOND
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
    
END$$
DELIMITER ;




-- INSERTS
INSERT INTO `users` (`name`) VALUES ('Murilo');
INSERT INTO `accounts` (`name`, `balance`, `is_joint`, `currency`, `account_type`) VALUES 
('Salary', '0', false, 'GBP', 'MAIN'),
('Savings', '0', false, 'GBP', 'SAVINGS');
INSERT INTO `revenues` (`user_id`, `hours`, `pay_rate`, `week_number`, `week_start`, `payday`) VALUES 
(1, 10, 1000, 8, '2024-03-04', CURRENT_DATE);
INSERT INTO `cashflows` 
	(from_account_id, to_account_id, name, amount, on_date, `repeat`, transfer_type) 
VALUES 
	(1, 0, 'expense_test1', 500.00, CURRENT_DATE, 'NEVER', 'EXPENSE'),
	(1, 0, 'expense_test2', 123.45, CURRENT_DATE, 'DAILY', 'EXPENSE'),
	(1, 0, 'expense_test2', 444.44, '2024-04-15', 'NEVER', 'EXPENSE'),
	(1, 0, 'expense_test3', 1350.00, CURRENT_DATE, 'MONTHLY', 'EXPENSE'),
	(1, 0, 'expense_test4', 1350.00, CURRENT_DATE, 'YEARLY', 'EXPENSE'),
	(1, 2, 'saving_test', 50.00, CURRENT_DATE, 'MONTHLY', 'ACCOUNT'),
	(1, 2, 'saving_test2', 150.00, CURRENT_DATE, 'WEEKLY', 'ACCOUNT'),
	(1, 2, 'saving_test3', 300.00, CURRENT_DATE, 'BIANNUAL', 'ACCOUNT');
SHOW EVENTS FROM kaikei;
