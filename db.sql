DROP DATABASE IF EXISTS purchases_project;
CREATE DATABASE purchases_project;
USE purchases_project;


CREATE TABLE Users (
    Username VARCHAR(30) NOT NULL PRIMARY KEY,
    Password VARCHAR(60) NOT NULL,
    Role Enum('Admin', 'User'),
    Active BOOLEAN DEFAULT False
);