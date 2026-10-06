INSERT INTO users
(first_name, last_name, email,
pass, registration_date)
VALUES ('Larry', 'Ullman',
'email@example.com',
SHA2('mypass', 512), NOW());

INSERT INTO users VALUES
(NULL, 'Zoe', 'Isabella',
'email2@example.com',
SHA2('mojito', 512), NOW());

INSERT INTO users
(first_name, last_name, email,
pass, registration_date) VALUES
('John', 'Lennon',
'john@beatles.com',
SHA2('Happin3ss', 512), NOW()),
('Paul', 'McCartney',
'paul@beatles.com',
SHA2('letITbe', 512), NOW()),
('George', 'Harrison',
'george@beatles.com ',
SHA2('something', 512), NOW()),
('Ringo', 'Starr',
'ringo@beatles.com',
SHA2('thisboy', 512), NOW());

INSERT INTO users
(first_name, last_name, email,
pass, registration_date) VALUES
('Emily', 'Carter', 'emily.carter@example.com',
SHA2('horse123', 512), NOW()),
('Daniel', 'Brooks', 'daniel.brooks@example.com',
SHA2('welcome1', 512), NOW()),
('Samantha', 'Reed', 'samantha.reed@example.com',
SHA2('sunshine', 512), NOW()),
('Michael', 'Turner', 'michael.turner@example.com',
SHA2('mypassword', 512), NOW()),
('Jessica', 'Morgan', 'jessica.morgan@example.com',
SHA2('coffee22', 512), NOW()),
('Ryan', 'Foster', 'ryan.foster@example.com',
SHA2('bluebird', 512), NOW()),
('Ashley', 'Parker', 'ashley.parker@example.com',
SHA2('starlight', 512), NOW()),
('Matthew', 'Collins', 'matthew.collins@example.com',
SHA2('river456', 512), NOW()),
('Lauren', 'Bennett', 'lauren.bennett@example.com',
SHA2('autumn77', 512), NOW()),
('Christopher', 'Hayes', 'christopher.hayes@example.com',
SHA2('sunset99', 512), NOW());