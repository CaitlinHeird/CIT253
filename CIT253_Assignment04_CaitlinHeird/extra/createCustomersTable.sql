CREATE TABLE Customers (
    customer_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    street_address VARCHAR(100) NOT NULL,
    city VARCHAR(40) NOT NULL,
    state CHAR(2) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    PRIMARY KEY (customer_id)
)