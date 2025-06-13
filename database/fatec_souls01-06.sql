-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/06/2025 às 06:03
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
-- Banco de dados: `fatec_souls`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `armadura`
--

CREATE TABLE `armadura` (
  `id_armadura` int(2) NOT NULL,
  `nome_armadura` varchar(50) NOT NULL,
  `capacete` int(11) NOT NULL,
  `peitoral` int(11) NOT NULL,
  `perneiras` int(11) NOT NULL,
  `manoplas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `armas`
--

CREATE TABLE `armas` (
  `id_arma` int(2) NOT NULL,
  `nome_arma` varchar(50) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `dano_fis` int(4) DEFAULT NULL,
  `dano_mag` int(4) DEFAULT NULL,
  `dano_fogo` int(4) DEFAULT NULL,
  `dano_louc` int(4) DEFAULT NULL,
  `dur` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `classes`
--

CREATE TABLE `classes` (
  `id_classe` int(11) NOT NULL,
  `nome_classe` varchar(20) NOT NULL,
  `caminho` varchar(100) NOT NULL,
  `id_arma` int(2) NOT NULL,
  `id_armadura` int(2) NOT NULL,
  `vitalidade` int(2) NOT NULL,
  `energia` int(2) NOT NULL,
  `inteligencia` int(2) NOT NULL,
  `forca` int(2) NOT NULL,
  `destreza` int(2) NOT NULL,
  `fe` int(2) NOT NULL,
  `sorte` int(2) NOT NULL,
  `res_fogo` int(3) NOT NULL,
  `res_sangrar` int(3) NOT NULL,
  `res_loucura` int(3) NOT NULL,
  `res_afogar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `classes`
--

INSERT INTO `classes` (`id_classe`, `nome_classe`, `caminho`, `id_arma`, `id_armadura`, `vitalidade`, `energia`, `inteligencia`, `forca`, `destreza`, `fe`, `sorte`, `res_fogo`, `res_sangrar`, `res_loucura`, `res_afogar`) VALUES
(1, 'Humano', 'male_human.jpg', 0, 0, 15, 18, 25, 22, 16, 33, 17, 300, 290, 450, 300),
(2, 'Elfo', 'male_elven.jpg', 0, 0, 32, 22, 19, 16, 24, 9, 10, 90, 330, 465, 630),
(3, 'Dragão', 'dragon.jpg', 0, 0, 50, 21, 31, 42, 15, 9, 10, 760, 340, 365, 400),
(4, 'Golem', 'golem.jpg', 0, 0, 36, 23, 7, 42, 24, 14, 20, 830, 770, 780, 999);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personagens`
--

CREATE TABLE `personagens` (
  `id_personagem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `nome_personagem` varchar(50) NOT NULL,
  `genero` tinyint(1) NOT NULL,
  `vitalidade` int(11) NOT NULL,
  `vida` int(2) NOT NULL,
  `energia` int(2) NOT NULL,
  `forca` int(2) NOT NULL,
  `destreza` int(2) NOT NULL,
  `inteligencia` int(2) NOT NULL,
  `fe` int(2) NOT NULL,
  `sorte` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `id_personagem` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `senha`, `id_personagem`) VALUES
(1, 'raphael', '1234', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `armadura`
--
ALTER TABLE `armadura`
  ADD PRIMARY KEY (`id_armadura`);

--
-- Índices de tabela `armas`
--
ALTER TABLE `armas`
  ADD PRIMARY KEY (`id_arma`);

--
-- Índices de tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_classe`);

--
-- Índices de tabela `personagens`
--
ALTER TABLE `personagens`
  ADD PRIMARY KEY (`id_personagem`,`id_usuario`,`id_classe`),
  ADD KEY `char_in_class` (`id_classe`),
  ADD KEY `user_in_char` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_personagens_usuarios` (`id_personagem`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `armadura`
--
ALTER TABLE `armadura`
  MODIFY `id_armadura` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `personagens`
--
ALTER TABLE `personagens`
  MODIFY `id_personagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `personagens`
--
ALTER TABLE `personagens`
  ADD CONSTRAINT `char_in_class` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  ADD CONSTRAINT `user_in_char` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_personagens_usuarios` FOREIGN KEY (`id_personagem`) REFERENCES `personagens` (`id_personagem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
