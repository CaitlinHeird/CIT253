CREATE DATABASE clothingStore;
USE clothingStore;

CREATE TABLE Customers (
    customer_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(20) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    street_address VARCHAR(100) NOT NULL,
    city VARCHAR(40) NOT NULL,
    state CHAR(2) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    PRIMARY KEY (customer_id)
);


INSERT INTO Customers
(first_name, last_name, street_address, city, state, zip)
VALUES
('Emily', 'Carter', '123 Oak Street', 'Lenoir', 'NC', '28645'),
('Daniel', 'Brooks', '456 Maple Avenue', 'Hickory', 'NC', '28601'),
('Samantha', 'Reed', '789 Pine Road', 'Morganton', 'NC', '28655'),
('Michael', 'Turner', '321 River Street', 'Charlotte', 'NC', '28202'),
('Jessica', 'Morgan', '654 Willow Lane', 'Boone', 'NC', '28607');


CREATE TABLE Products (
    product_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(40) NOT NULL,
    description VARCHAR(200) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (product_id)
);


INSERT INTO Products
(product_name, description, price)
VALUES
('Shirt', 'Comfortable cotton shirt', 20.00),
('Pants', 'Classic straight-leg denim pants', 30.00),
('Shoes', 'Comfortable everyday walking shoes', 50.00);


CREATE TABLE Orders (
    order_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id MEDIUMINT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    customer_id MEDIUMINT UNSIGNED NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);


INSERT INTO Orders
(product_id, quantity, customer_id)
VALUES
(1, 2, 1),
(2, 1, 1),
(3, 1, 1),

(1, 1, 2),
(2, 2, 2),
(3, 1, 2),

(1, 3, 3),
(2, 1, 3),
(3, 2, 3),

(1, 1, 4),
(2, 3, 4),
(3, 1, 4),

(1, 2, 5),
(2, 2, 5),
(3, 3, 5);
