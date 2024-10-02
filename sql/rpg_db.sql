-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/09/2024 às 23:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rpg_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesas`
--

CREATE TABLE `mesas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `nome_do_mestre` varchar(255) NOT NULL,
  `numero_max_jogadores` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mesas`
--

INSERT INTO `mesas` (`id`, `nome`, `descricao`, `nome_do_mestre`, `numero_max_jogadores`, `categoria`, `user_id`) VALUES
(2, `testeetes`, `1234`, `Testa`, 12, `Fantasia`, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesa_usuarios`
--

CREATE TABLE `mesa_usuarios` (
  `mesa_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `mesa_usuarios`
--

INSERT INTO `mesa_usuarios` (`mesa_id`, `user_id`) VALUES
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, `teste`, `$2y$10$DZ9K0/nsp/fCmsbhKT2v5.THZklb/47jkz7uLJXAHZT32FEtiuk5y`, `teste@gmail.com`, `2024-09-28 19:38:57`),
(2, `yuri`, `$2y$10$09ksh9FxBXeCiobXerXjb.yvbGv1VcpNrgLB4sidnbiTdVMCbZ5ma`, `yuri.takahashi@uft.edu.br`, `2024-09-28 19:40:33`);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `mesa_usuarios`
--
ALTER TABLE `mesa_usuarios`
  ADD PRIMARY KEY (`mesa_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `mesas`
--
ALTER TABLE `mesas`
  ADD CONSTRAINT `mesas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `mesa_usuarios`
--
ALTER TABLE `mesa_usuarios`
  ADD CONSTRAINT `mesa_usuarios_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mesa_usuarios_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `fichas` (
    `id_ficha` INT AUTO_INCREMENT PRIMARY KEY,
    `nome_p` VARCHAR(255) NOT NULL,
    `classe_p` VARCHAR(255) NOT NULL,
    `nivel_p` INT NOT NULL,
    `raca_p` VARCHAR(255) NOT NULL,
    `descricao_p` TEXT,
    `user_id` INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); 