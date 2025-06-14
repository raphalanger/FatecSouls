SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `armaduras` (`id_armadura`, `nome_armadura`, `capacete`, `peitoral`, `perneiras`, `manoplas`) VALUES
(1, 'Armadura de Cavaleiro', 35, 50, 27, 15),
(2, 'Armadura Élfica de Couro', 25, 43, 29, 17),
(3, 'Couraça de Escamas', 50, 71, 43, 55),
(4, 'Montanha de Pedra', 42, 67, 42, 28),
(5, 'Placas Tectônicas de Havel', 32, 60, 52, 40);

INSERT INTO `armas` (`id_arma`, `nome_arma`, `tipo`, `dano_fis`, `dano_mag`, `dano_fogo`, `dano_louc`, `dur`) VALUES
(1, 'Espada de Cavaleiro', 'Espada Reta', 105, 0, 0, 15, 99),
(2, 'Arco Rígido da Floresta', 'Arco', 71, 30, 0, 20, 50),
(3, 'Arco Ancestral do Dragão', 'Arco', 80, 40, 30, 0, 60),
(4, 'Lâmina Rúnica do Golem', 'Espada Reta', 95, 10, 0, 0, 100),
(5, 'Dente de Dragão', 'Martelo Grande', 150, 0, 0, 0, 300);

INSERT INTO `classes` (`id_classe`, `nome_classe`, `caminho`, `id_arma`, `id_armadura`, `vitalidade`, `energia`, `inteligencia`, `forca`, `destreza`, `fe`, `sorte`, `res_fogo`, `res_sangrar`, `res_loucura`, `res_afogar`) VALUES
(1, 'Humano', 'male_human.jpg', 1, 1, 15, 18, 25, 22, 16, 33, 17, 300, 290, 450, 300),
(2, 'Elfo', 'male_elven.jpg', 2, 2, 32, 22, 19, 16, 24, 9, 10, 90, 330, 465, 630),
(3, 'Dragão', 'dragon.jpg', 3, 3, 50, 21, 31, 42, 15, 9, 10, 760, 340, 365, 400),
(4, 'Golem', 'golem.jpg', 4, 4, 36, 23, 7, 42, 24, 14, 20, 830, 770, 780, 999),
(5, 'Havel', 'havel.jpg', 5, 5, 30, 50, 10, 50, 35, 30, 40, 534, 674, 398, 100);

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

INSERT INTO `personagens` (`id_personagem`, `id_usuario`, `id_classe`, `id_presente`, `nome_personagem`, `vitalidade`, `vida`, `energia`, `forca`, `destreza`, `inteligencia`, `fe`, `sorte`, `data_criacao`, `mortes`, `caminho`) VALUES
(2, 1, 5, 2, 'Vendetta', 30, 300, 50, 50, 35, 10, 30, 40, '2025-06-07 21:50:12', 0, 'havel.jpg'),
(3, 1, 4, 2, 'Cabriolet', 36, 360, 23, 42, 24, 7, 14, 20, '2025-06-07 21:50:30', 0, 'golem.jpg'),
(6, 1, 3, 0, 'Seath', 50, 500, 21, 42, 15, 31, 9, 10, '2025-06-07 21:53:39', 0, 'dragon.jpg'),
(7, 1, 2, 5, 'Legolas', 32, 320, 22, 16, 24, 19, 9, 10, '2025-06-07 21:54:05', 0, 'male_elven.jpg'),
(8, 2, 2, 3, 'Lady Maria', 32, 320, 22, 16, 24, 19, 9, 10, '2025-06-09 19:15:32', 0, 'male_elven.jpg'),
(9, 2, 1, 0, 'crazy frog', 15, 150, 18, 22, 16, 25, 33, 17, '2025-06-11 16:44:01', 0, 'male_human.jpg'),
(10, 2, 3, 5, 'Tchola', 50, 500, 21, 42, 15, 31, 9, 10, '2025-06-11 17:18:14', 0, 'dragon.jpg'),
(11, 2, 4, 3, '3sda', 36, 360, 23, 42, 24, 7, 14, 20, '2025-06-11 17:19:05', 0, 'golem.jpg');

INSERT INTO `presentes` (`id_presente`, `nome_presente`, `descricao`, `qtd_inicial`) VALUES
(0, 'Nenhum', 'Nada.', 0),
(1, 'Anel da Vida', 'Aumenta a vida máxima', 1),
(2, 'Bomba de Fogo', 'Explode ao impacto, causando dano de fogo', 3),
(3, 'Osso do Regresso', 'Forte oração leva o usuário à segurança', 2),
(4, 'Humanidade', 'Restaura a integridade física do usuário', 1),
(5, 'Semente da Árvore Gigante', 'Uma semente muito velha, de uma árvore impossibili', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
