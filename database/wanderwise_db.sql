-- Create Database
CREATE DATABASE IF NOT EXISTS wanderwise_db;
USE wanderwise_db;


-- Create Admins Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Store hashed passwords for security
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create Packages Table
CREATE TABLE IF NOT EXISTS packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2),
    duration INT, -- Duration in days
    location VARCHAR(255),
    image VARCHAR(255) -- URL or filename for package image
);

-- Create Bookings Table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    package_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    total_cost DECIMAL(10, 2),
    payment_status ENUM('pending', 'paid') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES packages(id)
);
ALTER TABLE bookings
ADD COLUMN number_of_people INT DEFAULT 1;


-- Create Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    package_id INT,
    rating INT, -- Rating scale 1 to 5
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES packages(id)
);
-- Create Users Table
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) DEFAULT NULL,
  `last_name` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(15) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_picture` VARCHAR(255) DEFAULT 'default_profile.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `packages` (`name`, `description`, `price`, `duration`, `location`, `image`) VALUES
('Thailand (Bangkok, Pattaya, Phuket)', 'Thailand offers vibrant street markets, golden temples, stunning beaches, and a lively nightlife.', 70000, 7, 'Thailand', 'thailand.jpg'),
('Malaysia (Kuala Lumpur, Langkawi, Penang)', 'Known for the Petronas Towers, Chinatown, and Langkawi’s serene beaches. Perfect for adventure & relaxation.', 60000, 6, 'Malaysia', 'malaysia.jpg'),
('Indonesia (Bali, Jakarta)', 'Bali’s beaches, temples, and vibrant culture attract tourists worldwide. Ideal for honeymooners & surfers.', 100000, 8, 'Indonesia', 'indonesia.jpg'),
('Maldives', 'Crystal-clear waters, luxurious resorts, and underwater experiences. Perfect for relaxation & honeymoon trips.', 120000, 5, 'Maldives', 'maldives.jpg'),
('UAE (Dubai, Abu Dhabi)', 'A luxury travel hotspot with skyscrapers, desert safaris, and shopping festivals.', 100000, 6, 'UAE', 'uae.jpg'),
('Japan (Tokyo, Kyoto, Osaka)', 'A blend of tradition and technology. Explore Tokyo’s Shibuya, Kyoto’s temples, and Osaka’s street food scene.', 180000, 10, 'Japan', 'japan.jpg');
