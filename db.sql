-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14-Dez-2020 às 04:51
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `2m_atacado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_session` varchar(255) NOT NULL,
  `products_id` text NOT NULL,
  `products_quantity` text NOT NULL,
  `products_price` text NOT NULL,
  `cart_total` float NOT NULL,
  `cart_create` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cart_id`),
  UNIQUE KEY `client_session` (`client_session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `client_cnpj` varchar(14) DEFAULT NULL,
  `client_ie` varchar(8) DEFAULT NULL,
  `client_cpf` varchar(11) DEFAULT NULL,
  `client_password` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `client_address` int(11) DEFAULT NULL,
  `client_type` int(11) NOT NULL DEFAULT 0,
  `client_status` int(11) NOT NULL DEFAULT 1,
  `client_points` int(11) NOT NULL DEFAULT 0,
  `client_last_connect` timestamp NOT NULL DEFAULT current_timestamp(),
  `client_last_ip_connect` varchar(32) DEFAULT NULL,
  `client_register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_email` (`client_email`),
  UNIQUE KEY `clinet_cnpj` (`client_cnpj`),
  UNIQUE KEY `clinet_cpf` (`client_cpf`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `client_address`
--

DROP TABLE IF EXISTS `client_address`;
CREATE TABLE IF NOT EXISTS `client_address` (
  `client_address_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `client_address_name` varchar(255) NOT NULL,
  `client_address_contact` varchar(20) NOT NULL,
  `client_address_cep` int(11) NOT NULL,
  `client_address_estado` varchar(45) NOT NULL DEFAULT 'Rio de Janeiro',
  `client_address_cidade` varchar(45) NOT NULL,
  `client_address_bairro` varchar(45) NOT NULL,
  `client_address_rua` varchar(255) NOT NULL,
  `client_address_numero` int(11) NOT NULL,
  `client_address_complemento` varchar(255) NOT NULL,
  PRIMARY KEY (`client_address_id`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `client_register_key`
--

DROP TABLE IF EXISTS `client_register_key`;
CREATE TABLE IF NOT EXISTS `client_register_key` (
  `register_id` int(11) NOT NULL AUTO_INCREMENT,
  `register_key` varchar(255) NOT NULL,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`register_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_icon` text NOT NULL,
  `department_text` varchar(50) NOT NULL,
  `department_href` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_href` (`department_href`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `distributors`
--

DROP TABLE IF EXISTS `distributors`;
CREATE TABLE IF NOT EXISTS `distributors` (
  `distributor_id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor_name` varchar(255) NOT NULL,
  `distributor_address` text NOT NULL,
  `distributor_description` text NOT NULL,
  `distributor_banner` text DEFAULT NULL,
  `distributor_logo` text DEFAULT NULL,
  `distributor_pictures` text DEFAULT NULL,
  `distributor_href` varchar(255) NOT NULL,
  PRIMARY KEY (`distributor_id`),
  UNIQUE KEY `distributor_href` (`distributor_href`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `products_id` text NOT NULL,
  `products_quantity` text NOT NULL,
  `products_price` text NOT NULL,
  `order_subtotal` float NOT NULL,
  `order_address_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT 1,
  `payment_type` int(11) NOT NULL DEFAULT 0,
  `order_payment_status` int(11) NOT NULL DEFAULT 1,
  `order_pickupdate` timestamp NULL DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `panel`
--

DROP TABLE IF EXISTS `panel`;
CREATE TABLE IF NOT EXISTS `panel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `last_connect` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_ip_connect` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `panel` (`id`, `fname`, `lname`, `user`, `password`, `type`, `last_connect`, `last_ip_connect`) VALUES
(1, 'Admin', 'Admin', 'admin', '$2y$12$0vERUcn5kz2fUoTGJfpriuTLUiyG6Aiz91.SUpmL.lNxsWSSpFfPq', 2, '2021-01-01 00:00:00', '127.0.0.01'),

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_ref` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_pictures` text NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `product_price_off` varchar(20) DEFAULT NULL,
  `product_price_off_days` date DEFAULT NULL,
  `product_stock_quantity_off` int(11) DEFAULT NULL,
  `product_stock` int(11) NOT NULL DEFAULT 0,
  `product_views` int(11) NOT NULL DEFAULT 0,
  `product_views_old` int(11) NOT NULL DEFAULT 0,
  `product_date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_ref` (`product_ref`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `site_data`
--

DROP TABLE IF EXISTS `site_data`;
CREATE TABLE IF NOT EXISTS `site_data` (
  `site_data_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_data_name` varchar(255) NOT NULL,
  `site_data_description` text NOT NULL,
  `site_data_banner` text NOT NULL,
  `site_data_logo` text NOT NULL,
  `site_data_pictures` text NOT NULL,
  `site_data_address` text NOT NULL,
  `site_data_cnpj` varchar(20) NOT NULL,
  `site_data_ie` varchar(14) NOT NULL,
  `site_data_tel` text NOT NULL,
  `site_data_email` varchar(255) NOT NULL,
  `site_data_oh` text NOT NULL,
  PRIMARY KEY (`site_data_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `site_data`
--

INSERT INTO `site_data` (`site_data_id`, `site_data_name`, `site_data_description`, `site_data_banner`, `site_data_logo`, `site_data_pictures`, `site_data_address`, `site_data_cnpj`, `site_data_ie`, `site_data_tel`, `site_data_email`, `site_data_oh`) VALUES
(1, '2M Atacado', '#span{Quem somos}\r#br{}#p{A 2M Atacado é uma empresa familiar fundada em abril de 2019, estabelecida na cidade de Cabo Frio - RJ.	\r#p{Somos o elo entre a indústria e o varejo focado em oferecer as melhores soluções de negócio para os}#p{lojistas atuando com grandes marcas nacionais e importadas no segmento da construção civil.}}#br{}#span{Parceria é o nosso compromisso}\r#br{}#p{Atuamos com 3 plataformas de vendas para a sua comodidade:}#br{}#p{1 - Venda assistida - Representantes comerciais atuando na região.}#p{2 - Site / WhatsApp - Faça sua compra e programe o dia e horário da retirada de mercadoria.}#p{3 - Balcão de vendas - Uma pequena loja para retirada imediata do seu pedido (não perca venda).}#br{}#span{Missão}\r#br{}#p{Ser uma empresa empreendedora com produtos e serviços de excelência com marcas fortes buscando o}#p{crescimento sustentável e rentável. Valorizando os nossos clientes e assegurando a plena satisfação}#p{de nossos colaboradores e parceiros comerciais.}#br{}#span{Visão}\r#br{}#p{Ser reconhecida como a melhor empresa de atacado no ramo de material de construção e bazar atuante na região dos lagos.}#br{}#span{Valores}\r#br{}#p{- Comprometimento}#p{- Objetividade}#p{- Simplicidade}#p{- Empreendedorismo}#p{- Respeito}#p{- Integridade}', 'banner.webp', 'logo.webp', '', 'R. Curitiba, 6 - Jardim Olinda - Cabo Frio - CEP: 28911-140', '33.252.591/0001-43', '11.404.40-5', '(22) 2041-4814 | (22) 9 9864-6410', 'contato@2matacado.com.br', 'Seg. à Sex. das 8h às 17:45h');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_img` text NOT NULL,
  `slider_href` text NOT NULL,
  `slider_description` text NOT NULL,
  `slider_status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
