# noinspection SqlNoDataSourceInspectionForFile

--Basic schema for a postOffice
--Many of the INT(10) for the ids for enum could probably be smaller ex ( states only need INT(2) )

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id              INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	firstName       VARCHAR(50) ,
	lastName        VARCHAR(50) ,
	address         INT(10) REFERENCES addresses (id) ,
	roleId          INT(10) REFERENCES roles (id),
	email           VARCHAR(50) ,
	postOfficeId    INT(10) REFERENCES postOffices (id) ,

	modifiedBy      INT(10) REFERENCES users (id),
	createdAt       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS roles;
CREATE TABLE roles (
	id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type          VARCHAR(50) NOT NULL ,
	count         INT ,

	createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS packages;
CREATE TABLE packages (
	id              INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	userId         INT(10) REFERENCES users (id) NOT NULL ,
	postOfficeId    INT(10) REFERENCES postOffices (id) NOT NULL ,
	typeId          INT(10) REFERENCES packageTypes (id) ,
	transactionId   INT(10) REFERENCES transactions (id) ,
	destination     INT(10) REFERENCES addresses (id) ,
	returnAddress   INT(10) REFERENCES addresses (id) ,
	contents        VARCHAR(255) ,
	weight          DOUBLE ,
	priority        BOOL ,
	packageStatus   INT(10) REFERENCES packageStatus (id) ,

	modifiedBy      INT(10) REFERENCES users(id) ,
	createdAt       TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS postOffices;
CREATE TABLE postOffices (
	id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	name          VARCHAR(50) ,
	address       VARCHAR(50) ,
	city          VARCHAR(50) ,
	state         INT ,
	zipCode       INT(9) ,

	createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS states;
CREATE TABLE states (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	state      VARCHAR(2) ,
	count      INT ,
);

DROP TABLE IF EXISTS transactions;
CREATE TABLE transactions (
	id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	customerId        INT(10) REFERENCES users (id) ,
	postOfficeId  INT(10) REFERENCES postOffices (id) ,
	employeeId    INT(10) REFERENCES users (id) ,
	packageId     INT(10) REFERENCES packages (id),
	cost          DOUBLE ,
	
	createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS packageTypes;
CREATE TABLE packageTypes (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type       VARCHAR(50) ,
	count      INT ,
);

DROP TABLE IF EXISTS packagStatus;
CREATE TABLE packageStatus (
	id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type          VARCHAR(50) ,
	count         INT ,
	
	modifiedBy    INT(10) REFERENCES postOffice (id), --This could possibly be a user id depending on implementation
	createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS addresses;
Create TABLE addresses (
	id          INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

  street      INT(10) ,
  city        VARCHAR(50) ,
  state       INT(10) REFERENCES state (id) ,
  zipCode     INT(9) ,

  createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);