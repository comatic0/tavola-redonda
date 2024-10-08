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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create table `mesas`
CREATE TABLE IF NOT EXISTS `mesas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `descricao` TEXT NOT NULL,
    `nome_do_mestre` VARCHAR(255) NOT NULL,
    `numero_max_jogadores` INT NOT NULL,
    `data_da_sessao` VARCHAR(11) NOT NULL,
    `categoria` VARCHAR(255) NOT NULL,
    `user_id` INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create table `mesa_usuarios`
CREATE TABLE IF NOT EXISTS `mesa_usuarios` (
    `mesa_id` INT,
    `user_id` INT,
    PRIMARY KEY (`mesa_id`, `user_id`),
    FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add indexes and constraints
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `mesa_usuarios`
  ADD PRIMARY KEY (`mesa_id`, `user_id`),
  ADD KEY `user_id` (`user_id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

-- Set AUTO_INCREMENT values
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- Add foreign key constraints
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

ALTER TABLE `mesa_usuarios`
  ADD CONSTRAINT `mesa_usuarios_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mesa_usuarios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;