-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `rpg_db`;
USE `rpg_db`;

-- Create table `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `profile_picture` VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create table `mesas`
CREATE TABLE IF NOT EXISTS `mesas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descricao` TEXT,
    `user_id` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);

-- Create table `mesa_usuarios`
CREATE TABLE IF NOT EXISTS `mesa_usuarios` (
    `mesa_id` INT,
    `user_id` INT,
    PRIMARY KEY (`mesa_id`, `user_id`),
    FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);

-- Create table `fichas`
CREATE TABLE IF NOT EXISTS `fichas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `classe` VARCHAR(255) NOT NULL,
    `nivel` INT NOT NULL,
    `raca` VARCHAR(255) NOT NULL,
    `descricao` TEXT,
    `user_id` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);