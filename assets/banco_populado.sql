-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.24-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela sistema_contas.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `data_criacao` datetime DEFAULT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__usuarios` (`usuario_id`),
  CONSTRAINT `FK__usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema_contas.categorias: ~7 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `usuario_id`, `nome`, `tipo`, `data_criacao`, `data_modificacao`) VALUES
	(1, 1, 'Alimentação', 'normal', '2022-07-16 16:18:18', '2022-07-16 16:18:18'),
	(2, 1, 'Pamella <3', 'normal', '2022-07-16 16:29:35', '2022-07-16 16:29:35'),
	(3, 1, 'Mercantil', 'normal', '2022-07-16 16:34:19', '2022-07-16 16:34:19'),
	(4, 1, 'Comprinhas', 'normal', '2022-07-16 16:34:41', '2022-07-16 16:34:41'),
	(5, 1, 'Gasto Fixo', 'fixo', '2022-07-16 16:34:56', '2022-07-16 16:34:56'),
	(6, 1, 'Parcelamentos', 'parcela', '2022-07-16 16:35:43', '2022-07-21 18:51:14'),
	(7, 1, 'Transporte', 'normal', '2022-07-16 16:37:03', '2022-07-16 16:37:03');

-- Copiando estrutura para tabela sistema_contas.contas
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  `valor` decimal(9,2) NOT NULL,
  `data_conta` datetime NOT NULL,
  `data_criacao` datetime NOT NULL,
  `data_modificacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__usuarios_2` (`usuario_id`),
  KEY `FK__categorias` (`categoria_id`),
  CONSTRAINT `FK__categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__usuarios_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema_contas.contas: ~63 rows (aproximadamente)
INSERT INTO `contas` (`id`, `usuario_id`, `categoria_id`, `descricao`, `valor`, `data_conta`, `data_criacao`, `data_modificacao`) VALUES
	(1, 1, 1, 'Cantina católica', 19.00, '2022-08-12 00:00:00', '2022-07-16 16:19:11', '2022-07-20 10:22:08'),
	(2, 1, 1, 'Paladar', 16.00, '2022-08-11 00:00:00', '2022-07-16 16:23:42', '2022-07-20 10:25:06'),
	(3, 1, 1, 'Ki-sabor', 23.99, '2022-08-12 00:00:00', '2022-07-16 16:25:29', '2022-07-20 10:28:39'),
	(4, 1, 1, 'Doce Mania', 32.00, '2022-08-06 00:00:00', '2022-07-16 16:25:42', '2022-07-20 10:28:47'),
	(5, 1, 1, 'Spaguete Del Chefe', 18.99, '2022-08-16 00:00:00', '2022-07-16 16:26:05', '2022-07-20 10:29:00'),
	(6, 1, 1, 'Sabor Caseiro', 14.99, '2022-08-16 00:00:00', '2022-07-16 16:26:38', '2022-07-20 10:29:07'),
	(7, 1, 1, 'Sabor Caseiro', 28.00, '2022-08-05 00:00:00', '2022-07-16 16:27:02', '2022-07-20 10:29:11'),
	(8, 1, 1, 'Sabor Caseiro', 14.99, '2022-08-16 00:00:00', '2022-07-16 16:27:29', '2022-07-20 10:29:15'),
	(9, 1, 1, 'Gelatos Açaí', 15.89, '2022-08-15 00:00:00', '2022-07-16 16:28:05', '2022-07-20 10:29:18'),
	(10, 1, 2, 'Compra no Ifood', 36.99, '2022-08-02 00:00:00', '2022-07-16 16:30:36', '2022-07-20 10:29:32'),
	(11, 1, 2, 'Crédito de celular', 20.00, '2022-08-03 00:00:00', '2022-07-16 16:31:38', '2022-07-20 10:29:35'),
	(12, 1, 2, 'Uber', 24.95, '2022-08-16 00:00:00', '2022-07-16 16:32:02', '2022-07-20 10:29:40'),
	(13, 1, 4, 'Presente casamento Larissa', 88.73, '2022-08-12 00:00:00', '2022-07-16 16:36:39', '2022-07-20 10:30:45'),
	(14, 1, 7, 'Passagem qxd x for', 44.64, '2022-08-16 00:00:00', '2022-07-16 16:37:36', '2022-07-20 10:31:27'),
	(15, 1, 3, 'São Geraldo', 133.37, '2022-08-04 00:00:00', '2022-07-16 16:40:04', '2022-07-20 10:30:00'),
	(16, 1, 3, 'Bertoldo', 12.93, '2022-08-11 00:00:00', '2022-07-16 16:44:20', '2022-07-20 10:30:20'),
	(17, 1, 3, 'Bertoldo', 33.29, '2022-08-08 00:00:00', '2022-07-16 16:44:54', '2022-07-20 10:30:28'),
	(18, 1, 3, 'Bertoldo', 11.58, '2022-08-07 00:00:00', '2022-07-16 16:45:21', '2022-07-20 10:30:32'),
	(19, 1, 3, 'São Geraldo', 47.35, '2022-08-09 00:00:00', '2022-07-16 16:46:09', '2022-07-20 10:30:36'),
	(20, 1, 3, 'Bertoldo', 16.27, '2022-08-13 00:00:00', '2022-07-16 16:46:25', '2022-07-20 10:30:41'),
	(21, 1, 5, 'Aluguel apartamento', 275.00, '2022-08-08 00:00:00', '2022-07-16 16:47:07', '2022-07-20 10:30:56'),
	(22, 1, 5, 'Internet apartamento', 47.00, '2022-08-01 00:00:00', '2022-07-16 16:49:20', '2022-07-20 10:31:01'),
	(23, 1, 5, 'Internet casa', 73.00, '2022-08-15 00:00:00', '2022-07-16 16:49:37', '2022-07-20 10:31:07'),
	(24, 1, 5, 'Claro movel', 28.99, '2022-08-15 00:00:00', '2022-07-16 17:27:35', '2022-07-20 10:32:20'),
	(25, 1, 5, 'Prime Video', 14.99, '2022-08-09 00:00:00', '2022-07-16 17:28:09', '2022-07-20 10:32:16'),
	(26, 1, 5, 'Amazon Music', 16.90, '2022-08-09 00:00:00', '2022-07-16 17:30:22', '2022-07-20 10:32:05'),
	(27, 1, 5, 'Energia ', 92.00, '2022-08-01 00:00:00', '2022-07-16 17:31:14', '2022-07-20 10:31:52'),
	(32, 1, 6, 'Kit teclado e mouse', 52.78, '2022-08-08 00:00:00', '2022-07-16 19:01:58', '2022-07-16 19:01:58'),
	(33, 1, 6, 'Kit teclado e mouse', 52.78, '2022-09-08 00:00:00', '2022-07-16 19:01:58', '2022-07-16 19:01:58'),
	(34, 1, 2, 'Ração', 15.99, '2022-08-19 00:00:00', '2022-07-19 22:48:02', '2022-07-19 22:48:02'),
	(35, 1, 2, 'Pizza com amorzinho', 36.99, '2022-08-19 00:00:00', '2022-07-19 22:51:46', '2022-07-19 22:51:46'),
	(36, 1, 2, 'Mercantil com amorzinho', 162.00, '2022-08-19 00:00:00', '2022-07-19 22:56:10', '2022-07-19 22:56:10'),
	(37, 1, 2, 'Donuts', 46.00, '2022-08-19 00:00:00', '2022-07-19 22:56:31', '2022-07-19 22:56:31'),
	(38, 1, 6, 'SSD amada', 64.20, '2022-08-19 00:00:00', '2022-07-19 22:58:20', '2022-07-19 22:58:20'),
	(39, 1, 6, 'SSD amada', 64.20, '2022-09-19 00:00:00', '2022-07-19 22:58:20', '2022-07-19 22:58:20'),
	(40, 1, 6, 'SSD amada', 64.20, '2022-10-19 00:00:00', '2022-07-19 22:58:20', '2022-07-19 22:58:20'),
	(41, 1, 6, 'SSD amada', 64.20, '2022-11-19 00:00:00', '2022-07-19 22:58:20', '2022-07-19 22:58:20'),
	(42, 1, 6, 'SSD amada', 64.20, '2022-12-19 00:00:00', '2022-07-19 22:58:20', '2022-07-19 22:58:20'),
	(43, 1, 6, 'Gabinete do PC', 38.60, '2022-08-20 00:00:00', '2022-07-20 10:52:17', '2022-07-20 10:52:17'),
	(44, 1, 6, 'Gabinete do PC', 38.60, '2022-09-20 00:00:00', '2022-07-20 10:52:17', '2022-07-20 10:52:17'),
	(45, 1, 6, 'Gabinete do PC', 38.60, '2022-10-20 00:00:00', '2022-07-20 10:52:17', '2022-07-20 10:52:17'),
	(46, 1, 6, 'Gabinete do PC', 38.60, '2022-11-20 00:00:00', '2022-07-20 10:52:17', '2022-07-20 10:52:17'),
	(47, 1, 6, 'Curso de javascript', 54.63, '2022-08-20 00:00:00', '2022-07-20 10:54:42', '2022-07-20 10:54:42'),
	(48, 1, 6, 'Curso de javascript', 54.63, '2022-09-20 00:00:00', '2022-07-20 10:54:42', '2022-07-20 10:54:42'),
	(49, 1, 6, 'Curso de javascript', 54.63, '2022-10-20 00:00:00', '2022-07-20 10:54:42', '2022-07-20 10:54:42'),
	(50, 1, 6, 'Curso de PHP', 48.57, '2022-08-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(51, 1, 6, 'Curso de PHP', 48.57, '2022-09-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(52, 1, 6, 'Curso de PHP', 48.57, '2022-10-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(53, 1, 6, 'Curso de PHP', 48.57, '2022-11-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(54, 1, 6, 'Curso de PHP', 48.57, '2022-12-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(55, 1, 6, 'Curso de PHP', 48.57, '2023-01-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(56, 1, 6, 'Curso de PHP', 48.57, '2023-02-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(57, 1, 6, 'Curso de PHP', 48.57, '2023-03-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(58, 1, 6, 'Curso de PHP', 48.57, '2023-04-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(59, 1, 6, 'Curso de PHP', 48.57, '2023-05-20 00:00:00', '2022-07-20 10:55:43', '2022-07-20 10:55:43'),
	(60, 1, 1, 'Bolinho de limao', 15.00, '2022-08-20 00:00:00', '2022-07-20 17:48:34', '2022-07-20 17:48:34'),
	(61, 1, 1, 'Sorvete', 21.00, '2022-08-20 00:00:00', '2022-07-20 17:48:52', '2022-07-20 17:48:52'),
	(62, 1, 2, 'Mercantil com mozinho', 84.16, '2022-08-20 00:00:00', '2022-07-20 17:50:47', '2022-07-20 17:50:47'),
	(68, 1, 4, 'Contas de julho', 2408.00, '2022-07-10 00:00:00', '2022-07-21 11:53:07', '2022-07-21 11:53:07'),
	(69, 1, 4, 'Contas de junho', 1800.96, '2022-06-10 00:00:00', '2022-07-21 11:54:53', '2022-07-21 11:54:53'),
	(70, 1, 4, 'Contas de maio', 1563.43, '2022-05-10 00:00:00', '2022-07-21 11:55:54', '2022-07-21 11:55:54'),
	(71, 1, 4, 'Contas de março', 2173.77, '2022-04-10 00:00:00', '2022-07-21 11:58:25', '2022-07-21 11:58:25'),
	(72, 1, 4, 'Contas de março', 2084.70, '2022-03-10 00:00:00', '2022-07-21 11:59:17', '2022-07-21 11:59:17');

-- Copiando estrutura para tabela sistema_contas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `nome_completo` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema_contas.usuarios: ~0 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `usuario`, `senha`, `nome_completo`) VALUES
	(1, 'teste', '698dc19d489c4e4db73e28a713eab07b', 'Reginaldo Cândido');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
