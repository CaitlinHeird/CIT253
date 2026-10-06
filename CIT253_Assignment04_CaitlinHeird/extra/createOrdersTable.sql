CREATE TABLE Orders (
    order_id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    product_id MEDIUMINT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    customer_id MEDIUMINT UNSIGNED NOT NULL,
    PRIMARY KEY (order_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);