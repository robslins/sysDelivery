DROP DATABASE IF EXISTS sysdelivery;
CREATE DATABASE IF NOT EXISTS sysdelivery;

use sysdelivery;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Nov-2023 às 12:38
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sysdelivery`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `categorias_id` int NOT NULL,
  `categorias_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categorias_id`, `categorias_nome`) VALUES
(1, 'Pizzas2'),
(4, 'Sanduiches');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imgprodutos`
--

CREATE TABLE `imgprodutos` (
  `imgprodutos_id` int NOT NULL,
  `imgprodutos_link` varchar(255) NOT NULL,
  `imgprodutos_descricao` varchar(255) NOT NULL,
  `imgprodutos_produtos_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `imgprodutos`
--

INSERT INTO `imgprodutos` (`imgprodutos_id`, `imgprodutos_link`, `imgprodutos_descricao`, `imgprodutos_produtos_id`) VALUES
(1, 'uploads/20231125/1700890446_ca53e425aaf024a48619.jpg', 'Calabreza', 1),
(2, 'uploads/20231125/1700890476_ca249c852edcc8f33e21.jpg', 'Catupiri', 2),
(3, 'uploads/20231125/1700890923_4aaacc9e97183f753f74.jpg', 'Mussarela', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `produtos_id` int NOT NULL,
  `produtos_nome` varchar(255) NOT NULL,
  `produtos_descricao` text NOT NULL,
  `produtos_preco_custo` float NOT NULL,
  `produtos_preco_venda` float NOT NULL,
  `produtos_categorias_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produtos_id`, `produtos_nome`, `produtos_descricao`, `produtos_preco_custo`, `produtos_preco_venda`, `produtos_categorias_id`) VALUES
(1, 'Pizza Calabresa', 'Massa, Molho, Mussarela, Calabresa, oregano e tomate', 35.50, 50.99, 1),
(2, 'Pizza Caipira', 'Massa, Molho, Mussarela, Caipira, orégano, ovo e tomate', 32.50, 48.80, 4),
(3, 'Pizza Mussarela', 'Massa, Molho, Mussarela, oregano e tomate', 20.00, 32.99, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int NOT NULL,
  `usuarios_nome` varchar(255) NOT NULL,
  `usuarios_sobrenome` varchar(255) NOT NULL,
  `usuarios_cpf` varchar(14) NOT NULL,
  `usuarios_email` varchar(255) NOT NULL,
  `usuarios_senha` varchar(32) NOT NULL,
  `usuarios_data_nasc` date NOT NULL,
  `usuarios_fone` varchar(15) NOT NULL,
  `usuarios_nivel` int NOT NULL,
  `usuarios_data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_nome`, `usuarios_sobrenome`, `usuarios_cpf`, `usuarios_email`, `usuarios_senha`, `usuarios_data_nasc`, `usuarios_fone`, `usuarios_nivel`, `usuarios_data_cadastro`) VALUES
(1, 'Vilson', 'Soares de Siqueira', '999.999.999-99', 'vilsonsoares@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1981-12-03', '(99) 99999-9999', 1, '2023-11-11 16:56:05'),
(2, 'Guilherme', 'Santos Siqueira', '888.888.888-88', 'gui@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2000-03-24', '(88) 88888-8888', 0, '2023-11-24 20:49:20'),
(3, 'Miguel', 'Santos Siqueira', '777.777.777-77', 'miguel@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2018-04-08', '(77) 77777-7777', 0, '2023-11-24 22:34:08');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`categorias_id`);

--
-- Índices para tabela `imgprodutos`
--
ALTER TABLE `imgprodutos`
  ADD PRIMARY KEY (`imgprodutos_id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`produtos_id`),
  ADD KEY `categorias_produtos` (`produtos_categorias_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `categorias_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `imgprodutos`
--
ALTER TABLE `imgprodutos`
  MODIFY `imgprodutos_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `produtos_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `categorias_produtos` FOREIGN KEY (`produtos_categorias_id`) REFERENCES `categorias` (`categorias_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
