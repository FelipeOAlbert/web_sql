-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 06/10/2014 às 14h37min
-- Versão do Servidor: 5.5.37
-- Versão do PHP: 5.3.10-1ubuntu3.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `web_sql`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(50) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `criado` datetime NOT NULL,
  `editado` datetime NOT NULL,
  `status_id` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `data`
--

INSERT INTO `data` (`id`, `hash`, `nome`, `email`, `criado`, `editado`, `status_id`) VALUES
(1, 'f591b1084eadba4aa6687309220d1294', 'Felipe Albert Silva', 'teste@maisum.com', '2014-10-06 14:20:04', '2014-10-06 14:24:03', 1),
(2, '1c96a07d25fcb9de3f13acda57db9bda', 'Renato', 'contato@helpmasters.com.br', '2014-10-06 14:20:04', '0000-00-00 00:00:00', 1),
(3, 'e0cf149c62d1953711d50aeeb5226724', 'questa', 'questa@questa.com.br', '2014-10-06 14:20:04', '0000-00-00 00:00:00', 1),
(4, 'a1f76c1c80d1149984da97ceb478bd67', 'Teste Maroto', 'teste@outro.com', '2014-10-06 14:26:27', '2014-10-06 14:26:54', 1),
(5, '8f6b2426d1e5464c998336ea667f68fe', 'carlos', 'felipe@wadtecnologia.com.br', '2014-10-06 14:26:27', '0000-00-00 00:00:00', 1),
(6, '16ad1028c56477e434bf16b925567d1d', 'Renato', 'teste@maisum.com', '2014-10-06 14:36:13', '0000-00-00 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
