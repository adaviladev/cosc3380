# noinspection SqlNoDataSourceInspectionForFile

--Basic schema for a postOffice
--Many of the INT(10) for the ids for enum could probably be smaller ex ( states only need INT(2) )

DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id              INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	firstName       VARCHAR(50) ,
	lastName        VARCHAR(50) ,
	address         INT(10) REFERENCES addresses (id) ,
	email           VARCHAR(50) ,
	roleId          INT(10) REFERENCES roles (id),
	postOfficeId    INT(10) REFERENCES postOffices (id) ,

	constraint fkPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
	constraint fkRoleId FOREIGN KEY (roleId) REFERENCES roles (id) ,

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

	userId          INT(10) ,
	postOfficeId    INT(10) ,
	typeId          INT(10) ,
	transactionId   INT(10) ,
	destination     INT(10) ,
	returnAddress   INT(10) ,
	contents        VARCHAR(255) ,
	weight          DOUBLE ,
	priority        BOOL ,
	packageStatus   INT(10) ,

  constraint fkUserId FOREIGN KEY (userId) REFERENCES users (id) ,
  constraint fkPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
  constraint fkTypeId FOREIGN KEY (typeId) REFERENCES packageTypes (id) ,
  constraint fkTransactionId FOREIGN KEY (transactionId) REFERENCES transactions (id) ,
  constraint fkDestination FOREIGN KEY (destination) REFERENCES addresses (id) ,
  constraint fkReturnAddress FOREIGN KEY (returnAddress) REFERENCES addresses (id) ,

	modifiedBy      INT(10) ,
	constraint fkModifiedBy foreign key (modifiedBy) references users (id) ,

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

	customerId    INT(10) ,
	postOfficeId  INT(10) ,
	employeeId    INT(10) ,
	packageId     INT(10) ,
	cost          DOUBLE ,
	
	constraint fkCustomerId FOREIGN KEY (customerId) REFERENCES users (id) ,
  constraint fkPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
  constraint fkEmployeeId FOREIGN KEY (employeeId) REFERENCES users (id) ,
  constraint fkPackageId FOREIGN KEY (packageId) REFERENCES packages (id) ,

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

	modifiedBy    INT(10) --This could possibly be a user id depending on implementation
	constraint fkModifiedBy FOREIGN KEY (modifiedBy) REFERENCES postOffices (id) ,

	createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS addresses;
Create TABLE addresses (
	id          INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

  street      INT(10) ,
  city        VARCHAR(50) ,
  state       INT(10) ,
  zipCode     INT(9) ,

  constraint fkState foreign key (state) references states (id) ,

  createdAt     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);