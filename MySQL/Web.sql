-- Creating database web
CREATE DATABASE IF NOT EXISTS `web`;

-- Using table web
USE `web`;

-- Creating table users 
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `phone` VARCHAR(20) DEFAULT NULL,
  `city` VARCHAR(50) DEFAULT NULL,
  `age` INT DEFAULT NULL,
  `created_at` DATE DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Loading data into table
INSERT INTO `users` (`id`, `name`, `email`, `phone`, `city`, `age`, `created_at`) VALUES
(1, 'John Doe', 'john.doe@example.com', '555-0101', 'New York', 30, '2025-01-01'),
(2, 'Jane Smith', 'jane.smith@example.com', '555-0102', 'Los Angeles', 25, '2025-01-02'),
(3, 'Alice Johnson', 'alice.johnson@example.com', '555-0103', 'Chicago', 28, '2025-01-03'),
(4, 'Bob Williams', 'bob.williams@example.com', '555-0104', 'Houston', 35, '2025-01-04'),
(5, 'Charlie Brown', 'charlie.brown@example.com', '555-0105', 'Phoenix', 22, '2025-01-05'),
(6, 'Diana Prince', 'diana.prince@example.com', '555-0106', 'Philadelphia', 31, '2025-01-06'),
(7, 'Ethan Hunt', 'ethan.hunt@example.com', '555-0107', 'San Antonio', 29, '2025-01-07'),
(8, 'Fiona Gallagher', 'fiona.g@example.com', '555-0108', 'San Diego', 27, '2025-01-08'),
(9, 'George Michael', 'george.m@example.com', '555-0109', 'Dallas', 33, '2025-01-09'),
(10, 'Hannah Baker', 'hannah.b@example.com', '555-0110', 'San Jose', 24, '2025-01-10'),
(11, 'Ian Curtis', 'ian.curtis@example.com', '555-0111', 'Austin', 26, '2025-01-11'),
(12, 'Jack Sparrow', 'jack.sparrow@example.com', '555-0112', 'Jacksonville', 34, '2025-01-12'),
(13, 'Kathy Griffin', 'kathy.griffin@example.com', '555-0113', 'Fort Worth', 32, '2025-01-13'),
(14, 'Liam Neeson', 'liam.neeson@example.com', '555-0114', 'Columbus', 45, '2025-01-14'),
(15, 'Mia Wallace', 'mia.wallace@example.com', '555-0115', 'Charlotte', 28, '2025-01-15'),
(16, 'Noah Centineo', 'noah.centineo@example.com', '555-0116', 'San Francisco', 23, '2025-01-16'),
(17, 'Olivia Pope', 'olivia.pope@example.com', '555-0117', 'Indianapolis', 30, '2025-01-17'),
(18, 'Paul Walker', 'paul.walker@example.com', '555-0118', 'Seattle', 36, '2025-01-18'),
(19, 'Quincy Adams', 'quincy.adams@example.com', '555-0119', 'Denver', 29, '2025-01-19'),
(20, 'Rachel Green', 'rachel.green@example.com', '555-0120', 'Washington', 27, '2025-01-20'),
(21, 'Steve Rogers', 'steve.rogers@example.com', '555-0121', 'Boston', 33, '2025-01-21'),
(22, 'Tina Turner', 'tina.turner@example.com', '555-0122', 'El Paso', 31, '2025-01-22'),
(23, 'Uma Thurman', 'uma.thurman@example.com', '555-0123', 'Detroit', 30, '2025-01-23'),
(24, 'Victor Hugo', 'victor.hugo@example.com', '555-0124', 'Nashville', 28, '2025-01-24'),
(25, 'Wendy Darling', 'wendy.darling@example.com', '555-0125', 'Memphis', 26, '2025-01-25');
