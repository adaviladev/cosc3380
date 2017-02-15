# noinspection SqlNoDataSourceInspectionForFile

/**
 * Use this file to build out the schema.
 */

DROP TABLE IF EXISTS users;
CREATE TABLE users (

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	first_name     VARCHAR(50) ,
	last_name      VARCHAR(50) ,
	user_address        VARCHAR(100) ,
	user_city            VARCHAR (50),
	user_state        VARCHAR (50),
	user_zipcode      INT(5),
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

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	user_id        INT(10)      NOT NULL ,
	post_office    INT(10)      NOT NULL ,
	type_id        INT ,
	transaction_id INT ,
	destination_address   VARCHAR(255) NOT NULL ,
	destination_city            VARCHAR (50),
	destination_state        VARCHAR (50),
	destination_zipcode      INT(5),
	return_address VARCHAR(255) NOT NULL ,
	return_city     VARCHAR(50),
	return_state    VARCHAR (50),
	return_zipcode          INT(5),

);

DROP TABLE IF EXISTS packageContents;
CREATE TABLE packageContents (

	contents       VARCHAR(255) ,
	weight         DOUBLE ,
	priority       BOOL ,
	package_status INT ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modified_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP

);

DROP TABLE IF EXISTS postOffice;
CREATE TABLE postOffice (

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
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

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	state      VARCHAR(2) ,
	count      INT ,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	user_id        INT(10) ,
	post_office_id INT(10) ,
	cost           DOUBLE ,
	employee_id    INT(10) ,
	package_id     INT(10) ,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	updated_at TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS packageType;
CREATE TABLE packageType (

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	id    INT(10) ,
	type  VARCHAR(50) ,
	count INT

);

DROP TABLE IF EXISTS packagStatus;
CREATE TABLE packageStatus (

	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	type  VARCHAR(50) ,
	count INT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	updated_at TIMESTAMP DEFAULT current_timestamp
);
