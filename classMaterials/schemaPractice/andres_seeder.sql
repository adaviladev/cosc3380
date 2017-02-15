DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id              INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    firstName       VARCHAR(50),
    lastName        VARCHAR(50),
    roleId          INT(10) REFERENCES roles (id),
    email           VARCHAR(50),
    address         INT(10) REFERENCES addresses (id),
    postOfficeId    INT(10) REFERENCES postOffices (id),
    createdAt       TIMESTAMP DEFAULT current_timestamp,
    modifiedAt      TIMESTAMP DEFAULT current_timestamp
    modifiedBy      INT(10) REFERENCES users (id),
);

DROP TABLE IF EXISTS roles;

CREATE TABLE roles (
    id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    type          VARCHAR(50) NOT NULL,
    count         INT,
    createdAt     TIMESTAMP DEFAULT current_timestamp,
    modifiedAt    TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS packages;

CREATE TABLE packages (
    id              INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    priority        BOOL,
    weight          DOUBLE,
    contents        VARCHAR(255),
    userId          INT(10) REFERENCES users (id) NOT NULL,
    postOfficeId    INT(10) REFERENCES postOffices (id) NOT NULL,
    typeId          INT(10) REFERENCES packageTypes (id),
    transactionId   INT(10) REFERENCES transactions (id),
    destination     INT(10) REFERENCES addresses (id),
    returnAddress   INT(10) REFERENCES addresses (id),
    packageStatus   INT(10) REFERENCES packageStatus (id),
    modifiedBy      INT(10) REFERENCES users(id),
    createdAt       TIMESTAMP DEFAULT current_timestamp,
    modifiedAt      TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS states;

CREATE TABLE states (
    id         INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    state      VARCHAR(2),
    count      INT,
);

DROP TABLE IF EXISTS transactions;

CREATE TABLE transactions (
    id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    cost          DOUBLE,
    customerId    INT(10) REFERENCES users (id),
    postOfficeId  INT(10) REFERENCES postOffices (id),
    employeeId    INT(10) REFERENCES users (id),
    packageId     INT(10) REFERENCES packages (id),
    createdAt     TIMESTAMP DEFAULT current_timestamp,
    modifiedAt    TIMESTAMP DEFAULT current_timestamp
);

DROP TABLE IF EXISTS postOffices;

CREATE TABLE postOffices (
    id            INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    state         INT,
    name          VARCHAR(50),
    address       VARCHAR(50),
    city          VARCHAR(50),
    zipCode       INT(9),
    createdAt     TIMESTAMP DEFAULT current_timestamp,
    modifiedAt    TIMESTAMP DEFAULT current_timestamp
);


DROP TABLE IF EXISTS addresses;

CREATE TABLE addresses (
  id          INT(10) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  street      INT(10),
  city        VARCHAR(50),
  zipCode     INT(9),
  state       INT(10) REFERENCES state (id),
  createdAt   TIMESTAMP DEFAULT current_timestamp
);