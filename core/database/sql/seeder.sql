# noinspection SqlNoDataSourceInspectionForFile

/**
	Basic schema for a postOffice
	Many of the INT(10) for the ids for enum could probably be smaller ex ( states only need INT(2) )
 */

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
	id    INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	state VARCHAR(2)
);

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
	id        INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	street    VARCHAR(100) ,
	city      VARCHAR(100) ,
	state     INT(10) UNSIGNED ,
	zipCode   INT(9) ,

	CONSTRAINT fkAddressToState FOREIGN KEY (state) REFERENCES `states` (`id`) ,

	createdAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP,
	modifiedAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type       VARCHAR(50) NOT NULL ,

	createdAt  TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `postOffices`;
CREATE TABLE `postOffices` (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	name       VARCHAR(50) ,
	address    VARCHAR(50) ,
	city       VARCHAR(50) ,
	state      INT ,
	zipCode    INT(9) ,

	createdAt  TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `packageStatus`;
CREATE TABLE `packageStatus` (
	id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type       VARCHAR(50) ,

	modifiedBy INT(10) UNSIGNED,
	/*
		This could possibly be a USER id depending ON implementation
	*/
	CONSTRAINT fkPackageStatusModifiedByUser FOREIGN KEY (modifiedBy) REFERENCES postOffices (id) ,

	createdAt  TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `packageTypes`;
CREATE TABLE `packageTypes` (
	id   INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	type VARCHAR(50) ,

	createdAt  TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
	id           INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	firstName    VARCHAR(50) ,
	lastName     VARCHAR(50) ,
	addressId      INT(10) REFERENCES addresses (id) ,
	email        VARCHAR(50) ,
	roleId       INT(10) UNSIGNED REFERENCES roles (id) ,
	postOfficeId INT(10) UNSIGNED NULL REFERENCES postOffices (id) ,

	CONSTRAINT fkUserToPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
	CONSTRAINT fkUserToRoleId FOREIGN KEY (roleId) REFERENCES roles (id) ,

	modifiedBy   INT(10) UNSIGNED REFERENCES users (id) ,
	createdAt    TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	createdBy   INT(10) UNSIGNED REFERENCES users (id) ,
	modifiedAt   TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	CONSTRAINT fkUserToCreatedUserId FOREIGN KEY (createdBy) REFERENCES users (id) ,
	CONSTRAINT fkUserToModifiedUserId FOREIGN KEY (modifiedBy) REFERENCES users (id)
);

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
	id           INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	customerId   INT(10) UNSIGNED ,
	postOfficeId INT(10) UNSIGNED ,
	employeeId   INT(10) UNSIGNED ,
	packageId    INT(10) UNSIGNED ,
	cost         DOUBLE ,

	CONSTRAINT fkTransactionToCustomerId FOREIGN KEY (customerId) REFERENCES users (id) ,
	CONSTRAINT fkTransactionToPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
	CONSTRAINT fkTransactionToEmployeeId FOREIGN KEY (employeeId) REFERENCES users (id) ,
	CONSTRAINT fkTransactionToPackageId FOREIGN KEY (packageId) REFERENCES packages (id) ,

	createdAt    TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt   TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
	id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT ,

	userId        INT(10) UNSIGNED ,
	postOfficeId  INT(10) UNSIGNED ,
	typeId        INT(10) UNSIGNED ,
	transactionId INT(10) UNSIGNED ,
	destination   INT(10) UNSIGNED ,
	returnAddress INT(10) UNSIGNED ,
	contents      VARCHAR(255) ,
	weight        DOUBLE ,
	priority      BOOL ,
	packageStatus INT(10) UNSIGNED ,

	CONSTRAINT fkPackagesToUserId FOREIGN KEY (userId) REFERENCES users (id) ,
	CONSTRAINT fkPackagesToPostOfficeId FOREIGN KEY (postOfficeId) REFERENCES postOffices (id) ,
	CONSTRAINT fkPackagesToTypeId FOREIGN KEY (typeId) REFERENCES packageTypes (id) ,
	CONSTRAINT fkPackagesToTransactionId FOREIGN KEY (transactionId) REFERENCES transactions (id) ,
	CONSTRAINT fkPackagesToDestination FOREIGN KEY (destination) REFERENCES addresses (id) ,
	CONSTRAINT fkPackagesToReturnAddress FOREIGN KEY (returnAddress) REFERENCES addresses (id) ,

	modifiedBy    INT(10) UNSIGNED,
	CONSTRAINT fkModifiedBy FOREIGN KEY (modifiedBy) REFERENCES users (id) ,

	createdAt     TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP ,
	modifiedAt    TIMESTAMP                    DEFAULT CURRENT_TIMESTAMP
);