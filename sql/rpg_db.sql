-- Criação da tabela de usuários
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `profile_picture` VARCHAR(255),
    `steam_id` VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Criação da tabela de mesas
CREATE TABLE IF NOT EXISTS `mesas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(20) NOT NULL,
    `descricao` TEXT,
    `categoria` VARCHAR(255) NOT NULL,
    `data_da_sessao` VARCHAR(11) NOT NULL,
    `max_capacity` INT NOT NULL DEFAULT 20,
    `user_id` INT,
    `nome_do_mestre` VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);
-- Criação da tabela de associação entre mesas e usuários
CREATE TABLE IF NOT EXISTS `mesa_usuarios` (
    `mesa_id` INT,
    `user_id` INT,
    PRIMARY KEY (`mesa_id`, `user_id`),
    FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);
-- Criação da tabela de fichas
CREATE TABLE IF NOT EXISTS `fichas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `classe` VARCHAR(255) NOT NULL,
    `nivel` INT NOT NULL,
    `raca` VARCHAR(255) NOT NULL,
    `magias` TEXT NOT NULL,
    `descricao` TEXT,
    `imagem` VARCHAR(255),
    `user_id` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);
-- Criação da tabela de mapas
CREATE TABLE IF NOT EXISTS `mapas` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(255) NOT NULL,
    `caminho` VARCHAR(255) NOT NULL,
    `tipo` VARCHAR(50) NOT NULL,
    `user_id` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
);
-- Criação da tabela de associação entre mesas e mapas
CREATE TABLE IF NOT EXISTS `mesa_mapas` (
    `mesa_id` INT,
    `mapa_id` INT,
    FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
    FOREIGN KEY (`mapa_id`) REFERENCES `mapas` (`id`) ON DELETE CASCADE,
    PRIMARY KEY (`mesa_id`, `mapa_id`)
);
