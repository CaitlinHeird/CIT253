CREATE TABLE Products (
    product_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(40) NOT NULL,
    description VARCHAR(200) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (product_id)
);