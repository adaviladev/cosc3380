# noinspection SqlNoDataSourceInspectionForFile

/**
 * Use this file to build out the schema.
 */

/**
 * I know I used snake_case for the attribute names
 * in the example, but let's switch to camelCase
 * throughout the project to be consistent.
 * Don't worry about it here, though.
 */

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id             INT(10) NOT NULL ,
	first_name     VARCHAR(50) ,
	last_name      VARCHAR(50) ,
	address        VARCHAR(100) ,
	-- May need city, state, zip
	role_id        INT ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	updated_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	email          VARCHAR(50) ,
	modified_by    INT ,
	post_office_id INT
);

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	type       VARCHAR(50) NOT NULL ,
	count      INT ,
	created_at TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	updated_at TIMESTAMP                    DEFAULT current_timestamp
);

DROP TABLE IF EXISTS packages;
CREATE TABLE packages (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id             INT(10)      NOT NULL ,
	user_id        INT(10)      NOT NULL ,
	post_office    INT(10)      NOT NULL ,
	type_id        INT ,
	transaction_id INT ,
	destination    VARCHAR(255) NOT NULL ,
	-- May need city, state, zip
	return_address VARCHAR(255) NOT NULL ,
	-- May need city, state, zip
	-- Here I thought it might be a good idea to
	-- make this into its own entity.
	-- We can discuss tomorrow
	contents       VARCHAR(255) ,
	weight         DOUBLE ,
	priority       BOOL ,
	package_status INT ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modified_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

DROP TABLE IF EXISTS postOffice;
CREATE TABLE postOffice (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id         INT(10) ,
	name       VARCHAR(50) ,
	address    VARCHAR(50) ,
	city       VARCHAR(50) ,
	state      INT ,
	zip_code   INT(9) ,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	updated_at TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS state;
CREATE TABLE state (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id         INT(10) ,
	state      VARCHAR(2) ,
	count      INT ,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id             INT(10) ,
	user_id        INT(10) ,
	post_office_id INT(10) ,
	cost           DOUBLE ,
	employee_id    INT(10) ,
	package_id     INT(10) ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS packageType;
CREATE TABLE packageType (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id    INT(10) ,
	type  VARCHAR(50) ,
	count INT
	-- This probably wasn't on the diagram, but we'll probably need timestamps on every table.
);

DROP TABLE IF EXISTS packagStatus;
CREATE TABLE packageStatus (
	-- 	id does not have attribute constraints.
	-- See roles(id)
	id    INT(10) ,
	type  VARCHAR(50) ,
	count INT
	-- This probably wasn't on the diagram, but we'll probably need timestamps on every table.
);
