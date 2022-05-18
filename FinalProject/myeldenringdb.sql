CREATE DATABASE myeldenringdb;
USE myeldenringdb;

CREATE TABLE bosses (
    id          VARCHAR(64)  NOT NULL,
    name        VARCHAR(64)  NOT NULL,
    image       VARCHAR(128) NOT NULL,
    description VARCHAR(256) NOT NULL,
    location    VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE creatures (
    id          VARCHAR(64)  NOT NULL,
    name        VARCHAR(64)  NOT NULL,
    image       VARCHAR(128) NOT NULL,
    description VARCHAR(256) NOT NULL,
    location    VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE npcs (
    id       VARCHAR(64)  NOT NULL,
    name     VARCHAR(64)  NOT NULL,
    image    VARCHAR(128) NOT NULL,
    quote    VARCHAR(512) NOT NULL,
    location VARCHAR(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE locations (
    id          VARCHAR(64)  NOT NULL,
    name        VARCHAR(64)  NOT NULL,
    image       VARCHAR(128) NOT NULL,
    description VARCHAR(256) NOT NULL,
    PRIMARY KEY (id)
);
