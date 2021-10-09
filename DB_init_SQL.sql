-- sql commands

CREATE DATABASE Library DEFAULT CHARACTER SET utf8;

USE Library;


CREATE TABLE Users (
	user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    f_name VARCHAR(20) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    username VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(128) NOT NULL,
    role VARCHAR(10) NOT NULL,  -- reader/librarian
    PRIMARY KEY(user_id)
);


CREATE TABLE Books (
	book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    isbn VARCHAR(20) NOT NULL,
    title VARCHAR(50) NOT NULL,
    author VARCHAR(30) NOT NULL,
    year INT,
    category VARCHAR(30),
    PRIMARY KEY(book_id)
);


CREATE TABLE Subscriptions(
	subs_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    subs_status VARCHAR(10) NOT NULL,   -- active/expired
    subs_date DATETIME NOT NULL,
    PRIMARY KEY(subs_id),
    
    CONSTRAINT FOREIGN KEY(user_id)
    	REFERENCES Users (user_id)
    	ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE CardDetails(
	card_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    card_number INT(20) NOT NULL,
    valid_till DATETIME NOT NULL,
    PRIMARY KEY(card_id),
    
    CONSTRAINT FOREIGN KEY(user_id)
    	REFERENCES Users (user_id)
    	ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Favourites(
	fav_entry_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    PRIMARY KEY(fav_entry_id),
    
    CONSTRAINT FOREIGN KEY(user_id)
    	REFERENCES Users (user_id)
    	ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY(book_id)
    	REFERENCES Books (book_id)
    	ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE UserBooks(
	userbook_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    book_id INT UNSIGNED NOT NULL,
    state VARCHAR(10) NOT NULL, -- reading/finished
    PRIMARY KEY(userbook_id),
    
    CONSTRAINT FOREIGN KEY(user_id)
    	REFERENCES Users (user_id)
    	ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY(book_id)
    	REFERENCES Books (book_id)
    	ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Notifications(
	notification_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED,
    notification_type INT,  -- 1 for ? 2 for ?
    PRIMARY KEY(notification_id),
    
    CONSTRAINT FOREIGN KEY(user_id)
    	REFERENCES Users (user_id)
    	ON DELETE CASCADE ON UPDATE CASCADE
);

