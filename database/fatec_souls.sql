-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/06/2025 às 01:05
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
-- Estrutura para tabela `classes`
--

CREATE TABLE `classes` (
  `id_classe` int(11) NOT NULL,
  `nome_classe` varchar(20) NOT NULL,
  `caminho_male` varchar(100) NOT NULL,
  `caminho_female` varchar(100) NOT NULL,
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

INSERT INTO `classes` (`id_classe`, `nome_classe`, `caminho_male`, `caminho_female`, `vitalidade`, `energia`, `inteligencia`, `forca`, `destreza`, `fe`, `sorte`, `res_fogo`, `res_sangrar`, `res_loucura`, `res_afogar`) VALUES
(1, 'Humano', 'male_human.jpg', 'female_human.jpg', 15, 18, 25, 22, 16, 33, 17, 300, 290, 450, 300),
(2, 'Elfo', 'male_elven.jpg', 'female_elven.jpg', 32, 22, 19, 16, 24, 9, 10, 90, 330, 465, 630),
(3, 'Dragão', 'dragon.jpg', 'dragon.jpg', 50, 21, 31, 42, 15, 9, 10, 760, 340, 365, 400),
(4, 'Golem', 'golem.jpg', 'golem.jpg', 36, 23, 7, 42, 24, 14, 20, 830, 770, 780, 999);

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
  `senha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `senha`) VALUES
(1, 'raphael', '1234');

--
-- Índices para tabelas despejadas
--

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
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
