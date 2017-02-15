/**
	Practice schema using SQL written by Austin
 */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id             INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	username       VARCHAR(50)  NOT NULL ,
	password       VARCHAR(255) NOT NULL ,
	street_adress  VARCHAR(255),
	city           VARCHAR(50),
	-- INT might need to be INT(10) to match the state(id) data type setting
	state_id       INT REFERENCES state (id),
	zip            INT(7),
	email          VARCHAR(50),
	post_office    INT(10),
	role_id        INT(10) REFERENCES roles (id) ,
	modified_by    INT(10) REFERENCES users (id),
	created_at     TIMESTAMP DEFAULT current_timestamp ,
	updated_at     TIMESTAMP DEFAULT current_timestamp ,
	last_login     TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS state;
CREATE TABLE state (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	-- We'll just use the abbreviations
	state       VARCHAR(12) NOT NULL
	-- 12 because RI has the longest name of any state with 12 characters
	-- we could just as easily make this 2 characters using abbreviation
);

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	type       VARCHAR(50) NOT NULL ,
	created_at TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	updated_at TIMESTAMP                    DEFAULT current_timestamp
);

DROP TABLE IF EXISTS packages;
CREATE TABLE packages (
	id             INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	user_id        INT(10) UNSIGNED NOT NULL REFERENCES users (id) ,
	return_address VARCHAR(255),
	destination    VARCHAR(255)     NOT NULL ,
	-- I really think we should make address it's own table as adrian suggested
	-- it would be especially useful here so we don't have 6 individual attributes
	-- having to do with addresses
	-- AD: If we do this, return_address and destination will be references to addresses(id)
	status         INT REFERENCES status (id) ,
	contents       VARCHAR(255) ,
	weight         DOUBLE ,
	priority       BOOL ,
	transaction_id INT(10) REFERENCES transactions (id) ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	updated_at     TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS status;
CREATE TABLE status (
	id    INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	type  VARCHAR(50)
	-- Krishan suggested adding a count value to have immediate access to how many there are
	-- I'm thinking we might also need time stamps
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
	id             INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	user_id        INT(10) REFERENCES users (id) ,
	employee_id    INT(10) REFERENCES users (id) ,
	post_office_id INT(10) REFERENCES post_offices (id) ,
	-- I'm sure this wasn't mentioned, but we will also be
	-- able to specify the number of decimal places
	cost           DOUBLE ,
	package_id     INT(10) REFERENCES packages (id) ,
	created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS post_offices;
CREATE TABLE post_offices (
	id       INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	name     VARCHAR(255) NOT NULL ,
	city     VARCHAR(50),
	state_id INT REFERENCES state (id),
	zip      INT(7)
	-- need timestamps and user records for modification
);