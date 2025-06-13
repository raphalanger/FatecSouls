-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2025 às 03:16
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
-- Estrutura para tabela `armaduras`
--

CREATE TABLE `armaduras` (
  `id_armadura` int(2) NOT NULL,
  `nome_armadura` varchar(50) NOT NULL,
  `capacete` int(11) NOT NULL,
  `peitoral` int(11) NOT NULL,
  `perneiras` int(11) NOT NULL,
  `manoplas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `armaduras`
--

INSERT INTO `armaduras` (`id_armadura`, `nome_armadura`, `capacete`, `peitoral`, `perneiras`, `manoplas`) VALUES
(1, 'Armadura de Cavaleiro', 35, 50, 27, 15),
(2, 'Armadura Élfica de Couro', 25, 43, 29, 17),
(3, 'Couraça de Escamas', 50, 71, 43, 55),
(4, 'Montanha de Pedra', 42, 67, 42, 28),
(5, 'Placas Tectônicas de Havel', 32, 60, 52, 40);

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

--
-- Despejando dados para a tabela `armas`
--

INSERT INTO `armas` (`id_arma`, `nome_arma`, `tipo`, `dano_fis`, `dano_mag`, `dano_fogo`, `dano_louc`, `dur`) VALUES
(1, 'Espada de Cavaleiro', 'Espada Reta', 105, 0, 0, 15, 99),
(2, 'Arco Rígido da Floresta', 'Arco', 71, 30, 0, 20, 50),
(3, 'Arco Ancestral do Dragão', 'Arco', 80, 40, 30, 0, 60),
(4, 'Lâmina Rúnica do Golem', 'Espada Reta', 95, 10, 0, 0, 100),
(5, 'Dente de Dragão', 'Martelo Grande', 150, 0, 0, 0, 300);

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
(1, 'Humano', 'male_human.jpg', 1, 1, 15, 18, 25, 22, 16, 33, 17, 300, 290, 450, 300),
(2, 'Elfo', 'male_elven.jpg', 2, 2, 32, 22, 19, 16, 24, 9, 10, 90, 330, 465, 630),
(3, 'Dragão', 'dragon.jpg', 3, 3, 50, 21, 31, 42, 15, 9, 10, 760, 340, 365, 400),
(4, 'Golem', 'golem.jpg', 4, 4, 36, 23, 7, 42, 24, 14, 20, 830, 770, 780, 999),
(5, 'Havel', 'havel.jpg', 5, 5, 30, 50, 10, 50, 35, 30, 40, 534, 674, 398, 100);

-- --------------------------------------------------------

--
-- Estrutura para tabela `escalas`
--

CREATE TABLE `escalas` (
  `id_escala` int(2) NOT NULL,
  `tipo_arma` varchar(30) NOT NULL,
  `escala_rank` varchar(1) NOT NULL,
  `tipo_dano` varchar(10) NOT NULL,
  `forca` float NOT NULL,
  `destreza` float NOT NULL,
  `inteligencia` float NOT NULL,
  `fe` float NOT NULL,
  `sorte` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `escalas`
--

INSERT INTO `escalas` (`id_escala`, `tipo_arma`, `escala_rank`, `tipo_dano`, `forca`, `destreza`, `inteligencia`, `fe`, `sorte`) VALUES
(1, 'Espada Reta', 'B', 'dano_fis', 0.15, 0.13, 0, 0, 0),
(2, 'Espada Reta', 'D', 'dano_fogo', 0.04, 0, 0, 0.03, 0),
(3, 'Espada Reta', 'E', 'dano_mag', 0, 0, 0, 0, 0),
(4, 'Espada Reta', 'C', 'dano_louc', 0, 0.05, 0, 0, 0.07),
(5, 'Arco', 'C', 'dano_fis', 0.09, 0.05, 0, 0, 0),
(6, 'Arco', 'B', 'dano_fogo', 0.1, 0, 0, 0.15, 0),
(7, 'Arco', 'A', 'dano_mag', 0, 0, 0.17, 0.14, 0),
(8, 'Arco', 'D', 'dano_louc', 0, 0.05, 0, 0, 0.03),
(9, 'Martelo Grande', 'S', 'dano_fis', 0.3, 0.2, 0, 0, 0),
(10, 'Martelo Grande', 'D', 'dano_fogo', 0.03, 0, 0, 0.01, 0),
(11, 'Martelo Grande', 'E', 'dano_mag', 0, 0, 0, 0, 0),
(12, 'Martelo Grande', 'E', 'dano_louc', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personagens`
--

CREATE TABLE `personagens` (
  `id_personagem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_classe` int(11) NOT NULL,
  `id_presente` int(2) NOT NULL,
  `nome_personagem` varchar(50) NOT NULL,
  `vitalidade` int(2) NOT NULL,
  `vida` int(11) NOT NULL,
  `energia` int(2) NOT NULL,
  `forca` int(2) NOT NULL,
  `destreza` int(2) NOT NULL,
  `inteligencia` int(2) NOT NULL,
  `fe` int(2) NOT NULL,
  `sorte` int(2) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `mortes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `personagens`
--

INSERT INTO `personagens` (`id_personagem`, `id_usuario`, `id_classe`, `id_presente`, `nome_personagem`, `vitalidade`, `vida`, `energia`, `forca`, `destreza`, `inteligencia`, `fe`, `sorte`, `data_criacao`, `mortes`) VALUES
(2, 1, 5, 2, 'Vendetta', 30, 300, 50, 50, 35, 10, 30, 40, '2025-06-07 21:50:12', 0),
(3, 1, 4, 2, 'Cabriolet', 36, 360, 23, 42, 24, 7, 14, 20, '2025-06-07 21:50:30', 0),
(6, 1, 3, 0, 'Seath', 50, 500, 21, 42, 15, 31, 9, 10, '2025-06-07 21:53:39', 0),
(7, 1, 2, 5, 'Legolas', 32, 320, 22, 16, 24, 19, 9, 10, '2025-06-07 21:54:05', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presentes`
--

CREATE TABLE `presentes` (
  `id_presente` int(2) NOT NULL,
  `nome_presente` varchar(50) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `qtd_inicial` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `presentes`
--

INSERT INTO `presentes` (`id_presente`, `nome_presente`, `descricao`, `qtd_inicial`) VALUES
(0, 'Nenhum', 'Nada.', 0),
(1, 'Anel da Vida', 'Aumenta a vida máxima', 1),
(2, 'Bomba de Fogo', 'Explode ao impacto, causando dano de fogo', 3),
(3, 'Osso do Regresso', 'Forte oração leva o usuário à segurança', 2),
(4, 'Humanidade', 'Restaura a integridade física do usuário', 1),
(5, 'Semente da Árvore Gigante', 'Uma semente muito velha, de uma árvore impossibili', 1);

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
-- Índices de tabela `armaduras`
--
ALTER TABLE `armaduras`
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
  ADD PRIMARY KEY (`id_classe`,`id_arma`,`id_armadura`);

--
-- Índices de tabela `escalas`
--
ALTER TABLE `escalas`
  ADD PRIMARY KEY (`id_escala`);

--
-- Índices de tabela `personagens`
--
ALTER TABLE `personagens`
  ADD PRIMARY KEY (`id_personagem`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_classe` (`id_classe`),
  ADD KEY `id_presente` (`id_presente`);

--
-- Índices de tabela `presentes`
--
ALTER TABLE `presentes`
  ADD PRIMARY KEY (`id_presente`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `armaduras`
--
ALTER TABLE `armaduras`
  MODIFY `id_armadura` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `escalas`
--
ALTER TABLE `escalas`
  MODIFY `id_escala` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `personagens`
--
ALTER TABLE `personagens`
  MODIFY `id_personagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `presentes`
--
ALTER TABLE `presentes`
  MODIFY `id_presente` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `personagens_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `personagens_ibfk_2` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`),
  ADD CONSTRAINT `personagens_ibfk_3` FOREIGN KEY (`id_presente`) REFERENCES `presentes` (`id_presente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
