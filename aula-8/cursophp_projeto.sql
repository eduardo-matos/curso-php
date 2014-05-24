-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Máquina: 127.0.0.1
-- Data de Criação: 24-Maio-2014 às 02:31
-- Versão do servidor: 5.6.14
-- versão do PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de Dados: `cursophp_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`) VALUES
(1, 'Teste editado'),
(3, 'Teste2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) NOT NULL,
  `conteudo` longtext NOT NULL,
  `publicado` tinyint(1) NOT NULL,
  `imagem` varchar(50) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `conteudo`, `publicado`, `imagem`, `categoria_id`) VALUES
(1, 'Post 1', 'Teste de conteÃºdo', 1, '', 1),
(2, 'Teste de Post', 'Teste de conteÃºdo', 0, '', 3),
(3, 'Lorem ipsum', 'ConteÃºdo', 1, '', 3),
(4, 'Outro Post', 'Mais conteÃºdo', 0, '', 1),
(5, 'Dolot Sit Amet', 'Lorem ipsum dolor sit amet', 0, '', 1),
(6, 'Abc teste', 'Outro post com contepudo', 0, '', 1),
(7, 'TÃ­tulo do post', 'ConteÃºdo conteÃºdo conteÃºdo...', 0, '', 1),
(9, 'Meu tÃ­tulo', 'Teste de conteÃºdo', 1, '537e9f143c360.jpg', 3),
(10, 'teste', 'conteudo', 0, '537fc7e1ed3bf.jpg', 1),
(11, 'Post com tags', 'teste', 0, '537fe0b133825.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_tags`
--

CREATE TABLE IF NOT EXISTS `post_tags` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `post_tags`
--

INSERT INTO `post_tags` (`post_id`, `tag_id`) VALUES
(11, 2),
(11, 3),
(11, 7),
(11, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tags`
--

INSERT INTO `tags` (`id`, `titulo`) VALUES
(1, 'javascript'),
(2, 'php'),
(3, 'mysql'),
(4, 'sql'),
(5, 'frontend'),
(6, 'css'),
(7, 'apache'),
(8, 'htaccess');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(4, 'Daniel', 'usuario@email.com', '8a0842c0b0a6a617c38e5cc89bdfbb32618e3711'),
(5, 'Juca', 'ddd@www.com', '5ffd3c1fb92d871e2d3a4b7762867024ec5944b6'),
(11, 'Daniel', 'dangladbeck@gmail.com', '11d831eec5fcaf7e147299389757a356d8990fd3'),
(12, 'JoÃ£o', 'joao@joao.com', '29f2709bd0b5aa0926873045c00f1a2b4c12c843'),
(23, 'Eduardo', 'eduardo.matos.silva@gmail.com', '11d831eec5fcaf7e147299389757a356d8990fd3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
