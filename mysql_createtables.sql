/* CREATE DB TABLES */


DROP TABLE USER;
DROP TABLE CATEGORY;
DROP TABLE QUESTION;


CREATE TABLE USER (
	NAME		VARCHAR(40),
	EMAIL		VARCHAR(40),
	PASSWORD 	VARCHAR(40)
);


CREATE TABLE CATEGORY (
	U_EMAIL		VARCHAR(40),
	TITLE		VARCHAR(40),
	DESCRIPTION	TEXT
);


CREATE TABLE QUESTION (
	C_TITLE		VARCHAR(40),
	U_EMAIL 	VARCHAR(40),
	TITLE 		VARCHAR(40),
	DEFINITION	TEXT
);