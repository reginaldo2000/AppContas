-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
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

-- Copiando dados para a tabela sistema_contas.categorias: ~6 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `usuario_id`, `nome`, `tipo`, `data_criacao`, `data_modificacao`) VALUES
	(1, 1, 'Alimentação', 'normal', '2022-07-16 16:18:18', '2022-07-16 16:18:18'),
	(2, 1, 'Pamella <3', 'normal', '2022-07-16 16:29:35', '2022-07-16 16:29:35'),
	(3, 1, 'Mercantil', 'normal', '2022-07-16 16:34:19', '2022-07-16 16:34:19'),
	(4, 1, 'Comprinhas', 'normal', '2022-07-16 16:34:41', '2022-07-16 16:34:41'),
	(5, 1, 'Gasto Fixo', 'fixo', '2022-07-16 16:34:56', '2022-07-16 16:34:56'),
	(6, 1, 'Compras Parceladas', 'parcela', '2022-07-16 16:35:43', '2022-07-16 16:35:43'),
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela sistema_contas.contas: ~28 rows (aproximadamente)
INSERT INTO `contas` (`id`, `usuario_id`, `categoria_id`, `descricao`, `valor`, `data_conta`, `data_criacao`, `data_modificacao`) VALUES
	(1, 1, 1, 'Cantina católica', 19.00, '2022-07-12 00:00:00', '2022-07-16 16:19:11', '2022-07-16 16:40:17'),
	(2, 1, 1, 'Paladar', 16.00, '2022-07-11 00:00:00', '2022-07-16 16:23:42', '2022-07-16 16:41:33'),
	(3, 1, 1, 'Ki-sabor', 23.99, '2022-07-12 00:00:00', '2022-07-16 16:25:29', '2022-07-16 16:42:07'),
	(4, 1, 1, 'Doce Mania', 32.00, '2022-07-06 00:00:00', '2022-07-16 16:25:42', '2022-07-16 16:40:22'),
	(5, 1, 1, 'Spaguete Del Chefe', 18.99, '2022-07-16 00:00:00', '2022-07-16 16:26:05', '2022-07-16 16:26:05'),
	(6, 1, 1, 'Sabor Caseiro', 14.99, '2022-07-16 00:00:00', '2022-07-16 16:26:38', '2022-07-16 16:26:38'),
	(7, 1, 1, 'Sabor Caseiro', 28.00, '2022-07-05 00:00:00', '2022-07-16 16:27:02', '2022-07-16 16:40:28'),
	(8, 1, 1, 'Sabor Caseiro', 14.99, '2022-07-16 00:00:00', '2022-07-16 16:27:29', '2022-07-16 16:27:29'),
	(9, 1, 1, 'Gelatos Açaí', 15.89, '2022-07-15 00:00:00', '2022-07-16 16:28:05', '2022-07-16 16:40:44'),
	(10, 1, 2, 'Compra no Ifood', 36.99, '2022-07-02 00:00:00', '2022-07-16 16:30:36', '2022-07-16 16:43:16'),
	(11, 1, 2, 'Crédito de celular', 20.00, '2022-07-03 00:00:00', '2022-07-16 16:31:38', '2022-07-16 16:40:35'),
	(12, 1, 2, 'Uber', 24.95, '2022-07-16 00:00:00', '2022-07-16 16:32:02', '2022-07-16 16:32:02'),
	(13, 1, 4, 'Presente casamento Larissa', 88.73, '2022-07-12 00:00:00', '2022-07-16 16:36:39', '2022-07-16 16:40:50'),
	(14, 1, 7, 'Passagem qxd x for', 44.64, '2022-07-16 00:00:00', '2022-07-16 16:37:36', '2022-07-16 16:37:36'),
	(15, 1, 3, 'São Geraldo', 133.37, '2022-07-04 00:00:00', '2022-07-16 16:40:04', '2022-07-16 16:40:04'),
	(16, 1, 3, 'Bertoldo', 12.93, '2022-07-11 00:00:00', '2022-07-16 16:44:20', '2022-07-16 16:44:20'),
	(17, 1, 3, 'Bertoldo', 33.29, '2022-07-08 00:00:00', '2022-07-16 16:44:54', '2022-07-16 16:44:54'),
	(18, 1, 3, 'Bertoldo', 11.58, '2022-07-07 00:00:00', '2022-07-16 16:45:21', '2022-07-16 16:45:21'),
	(19, 1, 3, 'São Geraldo', 47.35, '2022-07-09 00:00:00', '2022-07-16 16:46:09', '2022-07-16 16:46:09'),
	(20, 1, 3, 'Bertoldo', 16.27, '2022-07-13 00:00:00', '2022-07-16 16:46:25', '2022-07-16 16:46:25'),
	(21, 1, 5, 'Aluguel apartamento', 275.00, '2022-07-08 00:00:00', '2022-07-16 16:47:07', '2022-07-16 16:47:07'),
	(22, 1, 5, 'Internet apartamento', 47.00, '2022-07-01 00:00:00', '2022-07-16 16:49:20', '2022-07-16 16:49:20'),
	(23, 1, 5, 'Internet casa', 73.00, '2022-07-15 00:00:00', '2022-07-16 16:49:37', '2022-07-16 16:49:37'),
	(24, 1, 5, 'Claro movel', 28.99, '2022-07-15 00:00:00', '2022-07-16 17:27:35', '2022-07-16 17:27:35'),
	(25, 1, 5, 'Prime Video', 14.99, '2022-07-09 00:00:00', '2022-07-16 17:28:09', '2022-07-16 17:28:09'),
	(26, 1, 5, 'Amazon Music', 16.90, '2022-07-09 00:00:00', '2022-07-16 17:30:22', '2022-07-16 17:30:22'),
	(27, 1, 5, 'Energia ', 92.00, '2022-07-01 00:00:00', '2022-07-16 17:31:14', '2022-07-16 17:31:14'),
	(32, 1, 6, 'Kit teclado e mouse', 52.78, '2022-08-08 00:00:00', '2022-07-16 19:01:58', '2022-07-16 19:01:58'),
	(33, 1, 6, 'Kit teclado e mouse', 52.78, '2022-09-08 00:00:00', '2022-07-16 19:01:58', '2022-07-16 19:01:58');

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
