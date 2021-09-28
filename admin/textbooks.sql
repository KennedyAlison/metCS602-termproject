-- create the tables
CREATE TABLE cs_courses (
  courseID       VARCHAR(12)    NOT NULL,
  courseName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (courseID)
);

CREATE TABLE cs_textbooks (
  textbookID   INT(11)        NOT NULL AUTO_INCREMENT,
  courseID     VARCHAR(12)    NOT NULL,
  title        VARCHAR(255)   NOT NULL,
  author       VARCHAR(255)   NOT NULL,
  about        VARCHAR(255)   NOT NULL,
  price        DECIMAL(10,2)  NOT NULL,
  img          text           NOT NULL,
  quantity     INT(11)        NOT NULL,
  PRIMARY KEY (textbookID)
);

CREATE TABLE administrators (
  adminID      INT(11)        NOT NULL AUTO_INCREMENT,
  email        VARCHAR(255)   NOT NULL,
  password     VARCHAR(255)   NOT NULL,
  firstName    VARCHAR(60),    
  lastName     VARCHAR(60),    
  PRIMARY KEY (adminID)
);

CREATE TABLE customers (
  custID            VARCHAR(12)    NOT NULL,
  firstName         VARCHAR(255)   NOT NULL,
  lastName          VARCHAR(255)   NOT NULL,
  address_street    VARCHAR(255)   NOT NULL,
  address_city      VARCHAR(100)   NOT NULL,
  address_state     VARCHAR(100)   NOT NULL,
  address_zip       VARCHAR(50)    NOT NULL,
  address_country   VARCHAR(100)   NOT NULL,  
  PRIMARY KEY (custID)
);

CREATE TABLE cs_orders (
  orderID      INT(11)        NOT NULL AUTO_INCREMENT,
  custID       VARCHAR(12)    NOT NULL,
  total        DECIMAL(10,2)  NOT NULL,
  orderDate    DATETIME       DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (orderID)
);

CREATE TABLE cs_order_contents (
  id           INT(11)        NOT NULL AUTO_INCREMENT,
  orderID      INT(11)        NOT NULL,
  custID       VARCHAR(12)    NOT NULL,
  textbookID   INT(11)        NOT NULL,
  quantity     INT(11)        NOT NULL,
  PRIMARY KEY (id)
);



-- insert data into the database 
INSERT INTO cs_courses VALUES 
('cs341', 'Data Structures with C++'), 
('cs401', 'Introduction to Web Application Development'), 
('cs425', 'Introduction to Business Data Communications and Networks'), 
('cs526', 'Data Structures and Algorithms'), 
('cs544', 'Foundations of Analytics with R'), 
('cs566', 'Analysis of Algorithms'), 
('cs575', 'Operating Systems'), 
('cs601', 'Web Application Development'), 
('cs602', 'Server-Side Web Development'), 
('cs701', 'Rich Internet Application Development'); 
 
 
INSERT INTO cs_textbooks VALUES 
(1, 'cs341', 'Data Structures and Other Objects Using C++', 'Michael Main; Walter Savitch', 
     'Introduction to object oriented concepts with data structures in C++ including interfaces, classes, namespaces, static member constants, typename keyword, and inheritance.', 
     138.66, 'Main_Data_Structures_C++.jpg', 3000), 
(2, 'cs544', 'Using R for Introductory Statistics', 'John Verzani', 
     'Foundational topics overviewing using R for statistical analysis, including simulations, linear model approaches, and producing linear models.', 
     74.95, 'Verzani_Using_R.jpg', 2000), 
(3, 'cs544', 'R for Everyone: Advanced Analytics and Graphics', 'Jared Lander', 
     'Absolute basics for anybody new to statistical programming and modeling, including hands-on practice and sample code', 
     45.00, 'Lander_R_for_Everyone.jpg', 2000), 
(4, 'cs566', 'Introduction to Algorithms', 'Thomas H. Cormen; Charles E. Leiserson; Ronald L. Rivest; Clifford Stein', 
     'Introduction to the design and analysis of algorithms keeping explanation elementary without sacrificing depth of coverage or mathematical rigor.', 
     99.00, 'Cormen_Algorithms.jpg', 3000), 
(5, 'cs602', 'Web Development with Node & Express', 'Ethan Brown', 
     'Fundamental overview of how to build web applications with Express using Node/JavaScript development stack.', 
     38.86, 'Brown_Node_Express.jpg', 3500), 
(6, 'cs602', "Murach's PHP and MySQL", 'Joel Murach; Ray Harris', 
     'Comprehensive introduction to creating database driven web applications using PHP and MySQL.', 
     41.91, 'Murach_PHP.jpg', 4000), 
(7, 'cs701', 'Pro HTML5 Programming', 'Peter Lubbers; Frank Salim; Brian Albers', 
     'Learn how to use the latest cutting-edge HTML5 web technology to build web applications with unparalleled functionality, speed, and responsiveness.', 
     45.00, 'Lubbers_Pro_HTML5.jpg', 1000), 
(8, 'cs701', 'Angular Development with TypeScript', 'Yakov Fain; Anton Moiseev', 
     'Learn how to use the latest cutting-edge HTML5 web technology to build web applications with unparalleled functionality, speed, and responsiveness.', 
     45.00, 'Fain_Angular_Typescript.jpg', 1000); 
 


INSERT INTO administrators (adminID, email, password) VALUES 
(1, 'admin1@shop.com', '$2y$10$0TQw/FNaJXuo42fkANpLjenPZEVpUE7k9rkfWvrWr6vGUNhqa/5ne'), -- password1
(2, 'admin2@shop.com', '$2y$10$1x.3dK2f/PSBBXBoXNajUuIQLCOdRkeVbb88fvEO95eQBK0tErUk6'), -- password2
(3, 'admin3@shop.com', '$2y$10$gnuj3C0tz9PunigdqZrCLupvSwhuU3veQ2bHT05devOtXpqWWX9AS'); -- password3


INSERT INTO customers (custID, firstName, lastName, address_street, address_city, address_state, address_zip, address_country) VALUES 
('cust123', 'John', 'Doe', '123 4th St', 'Boston', 'MA', '01234', 'United States'), 
('cust456', 'Jane', 'Smith', '456 7th St', 'New York', 'NY', '89101', 'United States'), 
('cust789', 'Joe', 'Sullivan', '1011 12th St', 'Los Angelos', 'CA', '12131', 'United States');

INSERT INTO cs_orders (orderID, custID, total, orderDate) VALUES 
(1, 'cust123', 243.00, '2021-02-20 11:42:41'), 
(2, 'cust456', 80.77, '2021-01-05 08:42:35'), 
(3, 'cust789', 464.75, '2021-02-27 12:49:09');

INSERT INTO cs_order_contents (id, orderID, custID, textbookID, quantity) VALUES 
(1, 1, 'cust123', 3, 1), 
(2, 1, 'cust123', 4, 2), 
(3, 2, 'cust456', 5, 1), 
(4, 2, 'cust456', 6, 1), 
(5, 3, 'cust789', 2, 5),
(6, 3, 'cust789', 3, 2);
