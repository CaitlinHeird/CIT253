CREATE DATABASE forums
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE forums;

CHARSET utf8;

CREATE TABLE forums (
    forum_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    PRIMARY KEY (forum_id),
    UNIQUE (name)
) ENGINE = INNODB;

CREATE TABLE messages (
    message_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    parent_id INT UNSIGNED NOT NULL DEFAULT 0,
    forum_id TINYINT UNSIGNED NOT NULL,
    user_id MEDIUMINT UNSIGNED NOT NULL,
    subject VARCHAR(100) NOT NULL,
    body LONGTEXT NOT NULL,
    date_entered DATETIME NOT NULL,
    PRIMARY KEY (message_id),
    INDEX (parent_id),
    INDEX (forum_id),
    INDEX (user_id),
    INDEX (date_entered)
) ENGINE = INNODB;

CREATE TABLE users (
    user_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    pass CHAR(128) NOT NULL,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    email VARCHAR(60) NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE (username),
    UNIQUE (email),
    INDEX login (pass, email)
) ENGINE = INNODB;

INSERT INTO forums (name) VALUES
('MySQL'),
('PHP'),
('Sports'),
('HTML'),
('CSS'),
('Kindling');

INSERT INTO users (username, pass,
first_name, last_name, email)
VALUES
('troutster', SHA2('mypass', 512),
'Larry', 'Ullman',
'lu@example.com'),
('funny man', SHA2('monkey', 512),
'David', 'Brent',
'db@example.com'),
('Gareth', SHA2('asstmgr', 512),
'Gareth', 'Keenan',
'gk@example.com');

INSERT INTO users (username, pass,
first_name, last_name, email)
VALUES
('tim', SHA2('psych', 512),
'Tim', 'Canterbury',
'tc@example.com'),
('finchy', SHA2('jerk', 512),
'Chris', 'Finch',
'cf@example.com');

INSERT INTO messages (parent_id,
forum_id, user_id, subject,
body, date_entered) VALUES
(0, 1, 1, 'Question about
normalization.', 'I''m confused
about normalization. For the
second normal form (2NF), I
read...',
UTC_TIMESTAMP()),
(0, 1, 2, 'Database Design',
'I''m creating a new database
and am having problems with the
structure. How many
tables should I have?...',
UTC_TIMESTAMP()),
(2, 1, 2, 'Database Design',
'The number of tables
your database includes...',
UTC_TIMESTAMP()),
(0, 1, 3, 'Database Design',
'Okay, thanks!', UTC_TIMESTAMP()),
(0, 2, 3, 'PHP Errors', 'I''m using
the scripts from Chapter 3 and
I can''t get the first
calculator example to work.
When I submit the form...',
UTC_TIMESTAMP());