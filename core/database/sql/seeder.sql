/**
 * Use this file to build out the schema.
 */
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	username   VARCHAR(50)  NOT NULL ,
	password   VARCHAR(255) NOT NULL ,
	role       INT(10) REFERENCES roles (id) ,
	created_at TIMESTAMP                    DEFAULT current_timestamp ,
	updated_at TIMESTAMP                    DEFAULT current_timestamp ,
	last_login TIMESTAMP                    DEFAULT current_timestamp
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
	id          INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,
	user_id     INT(10) UNSIGNED NOT NULL REFERENCES users (id) ,
	destination VARCHAR(255)     NOT NULL ,
	status      VARCHAR(50) ,
	created_at  TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	updated_at  TIMESTAMP                    DEFAULT current_timestamp
);