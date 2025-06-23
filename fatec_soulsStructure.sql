-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/06/2025 às 03:00
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
-- Estrutura para tabela `chefes`
--

CREATE TABLE `chefes` (
  `id_chefe` int(11) NOT NULL,
  `nome_chefe` varchar(50) NOT NULL,
  `vida` int(11) NOT NULL,
  `dano_fis` int(11) NOT NULL,
  `dano_proj` int(11) NOT NULL,
  `id_arma` int(11) NOT NULL,
  `imagem` varchar(50) NOT NULL
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
  `mortes` int(11) NOT NULL,
  `caminho` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Índices de tabela `chefes`
--
ALTER TABLE `chefes`
  ADD PRIMARY KEY (`id_chefe`);

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
  MODIFY `id_armadura` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `armas`
--
ALTER TABLE `armas`
  MODIFY `id_arma` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `chefes`
--
ALTER TABLE `chefes`
  MODIFY `id_chefe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `escalas`
--
ALTER TABLE `escalas`
  MODIFY `id_escala` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `personagens`
--
ALTER TABLE `personagens`
  MODIFY `id_personagem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `presentes`
--
ALTER TABLE `presentes`
  MODIFY `id_presente` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;

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
