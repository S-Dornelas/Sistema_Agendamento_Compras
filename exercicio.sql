-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2023 às 14:53
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `exercicio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `compras`
--

CREATE TABLE `compras` (
  `cod_compras` int(10) NOT NULL,
  `fornecedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `compras`
--

INSERT INTO `compras` (`cod_compras`, `fornecedor`) VALUES
(2, 'ExtraFarma'),
(15, 'Farmácia do Trabalhador'),
(27, 'Supermercado Atacadão'),
(29, 'Drogasil'),
(31, 'Farmácia Extrafarma'),
(32, 'Farmácia São Paulo'),
(34, 'Pague Menos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `consumo`
--

CREATE TABLE `consumo` (
  `cod_consumo` int(10) NOT NULL,
  `dataConsumo` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `consumo`
--

INSERT INTO `consumo` (`cod_consumo`, `dataConsumo`) VALUES
(59, '2023-11-16'),
(60, '2023-11-15'),
(61, '2023-11-16'),
(62, '2023-11-16'),
(63, '2023-11-16'),
(64, '2023-11-21'),
(65, '2023-11-20'),
(66, '2023-11-21'),
(68, '2023-11-21');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_compras`
--

CREATE TABLE `itens_compras` (
  `cod_itens_cp` int(10) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `id_compras` int(10) NOT NULL,
  `qtd_compras` int(10) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `ultimaCompra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `itens_compras`
--

INSERT INTO `itens_compras` (`cod_itens_cp`, `id_produto`, `id_compras`, `qtd_compras`, `valor`, `ultimaCompra`) VALUES
(5, 10, 2, 60, 54.00, NULL),
(8, 13, 2, 0, 26.00, NULL),
(11, 16, 2, 120, 52.00, NULL),
(14, 19, 2, 1, 20.00, NULL),
(17, 22, 2, 100, 17.00, NULL),
(43, 50, 15, 1, 50.00, NULL),
(55, 62, 27, 2, 10.00, NULL),
(57, 64, 29, 10, 10.00, NULL),
(60, 67, 27, 1, 20.00, '2023-11-17'),
(61, 74, 29, 1, 25.00, '2023-11-20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_consumo`
--

CREATE TABLE `itens_consumo` (
  `cod_itens_consumo` int(10) NOT NULL,
  `consumoDia` varchar(500) NOT NULL,
  `id_produto` int(10) NOT NULL,
  `id_consumo` int(10) NOT NULL,
  `estoqueInicial` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `itens_consumo`
--

INSERT INTO `itens_consumo` (`cod_itens_consumo`, `consumoDia`, `id_produto`, `id_consumo`, `estoqueInicial`) VALUES
(30, '1', 7, 1, NULL),
(34, '1', 8, 0, NULL),
(35, '2', 10, 0, NULL),
(36, '1', 11, 0, NULL),
(37, '1', 12, 0, NULL),
(38, '1', 13, 0, NULL),
(39, '2 comprimidos ao dia.', 14, 0, NULL),
(40, '1', 15, 0, NULL),
(41, '1', 16, 0, NULL),
(42, '1', 17, 0, NULL),
(44, 'Um comprimido ao dia.', 19, 0, NULL),
(45, '1', 20, 0, NULL),
(46, '1', 21, 0, NULL),
(47, '1', 22, 0, NULL),
(49, '1', 24, 0, NULL),
(50, '1', 25, 0, NULL),
(68, '1 comprimido por dia.', 46, 39, NULL),
(69, '2 mascaras por dia.', 47, 40, NULL),
(72, '1', 50, 43, NULL),
(79, '1 Comprimido por semana', 57, 50, NULL),
(82, 'Utilizar após o banho.', 60, 53, NULL),
(84, 'Utilizar no banho.', 62, 55, NULL),
(86, 'usar duas vezes ao dia', 64, 57, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `cod_produto` int(10) NOT NULL,
  `nomeProduto` varchar(50) NOT NULL,
  `unidade` varchar(10) NOT NULL,
  `posologia` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`cod_produto`, `nomeProduto`, `unidade`, `posologia`) VALUES
(2, 'Paracetanol', '12', NULL),
(3, 'Dipirona', '1', NULL),
(7, 'Concor (Hemifumarato de Bisoprolol)', '2.5mg', NULL),
(8, 'Benicar (Olmesartana Medoxomila)', '20mg', NULL),
(10, 'Memantina', '10mg', NULL),
(11, 'Exodus', '20mg', NULL),
(12, 'SEROQUEL (Fumarato Quetiapina)', '25mg', NULL),
(13, 'Rivoltril (Clonazepam)', '2mg', NULL),
(14, 'Daflon', '24', NULL),
(15, 'Diosmin', '45ml', NULL),
(16, 'Luftal gotas ', '100ml', NULL),
(17, 'Mylanta Plus (Hidróxido de Aluminio)', '10ml', NULL),
(19, 'Font D', '6', NULL),
(20, 'Lactulose', '500mg', NULL),
(21, 'Fraldas noturna', '20', NULL),
(22, 'Fraldas diurna', '20', NULL),
(24, 'Luvas', '50', NULL),
(25, 'Nutren', '500mg', NULL),
(46, 'Tilenol', '12', NULL),
(47, 'Mascaras', '100', NULL),
(50, 'Vitamina C', '10', NULL),
(57, 'Vitamina D', '12', NULL),
(60, 'Colônia', '250 ml', NULL),
(62, 'Condicionador', '1 L', NULL),
(64, 'Benalet Pastilha', 'cp', 'Uma pastilha ao dia'),
(67, 'Shampoo', '1', 'Utilizar durante o banho'),
(68, 'Toalhas', '2', 'Toalhas para banho'),
(74, 'Viagra', '8', 'Tomar um comprimido.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`cod_compras`);

--
-- Índices de tabela `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`cod_consumo`);

--
-- Índices de tabela `itens_compras`
--
ALTER TABLE `itens_compras`
  ADD PRIMARY KEY (`cod_itens_cp`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_compras` (`id_compras`);

--
-- Índices de tabela `itens_consumo`
--
ALTER TABLE `itens_consumo`
  ADD PRIMARY KEY (`cod_itens_consumo`),
  ADD KEY `id_consumo` (`id_consumo`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`cod_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `compras`
--
ALTER TABLE `compras`
  MODIFY `cod_compras` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `consumo`
--
ALTER TABLE `consumo`
  MODIFY `cod_consumo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `itens_compras`
--
ALTER TABLE `itens_compras`
  MODIFY `cod_itens_cp` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `itens_consumo`
--
ALTER TABLE `itens_consumo`
  MODIFY `cod_itens_consumo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `cod_produto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_compras`
--
ALTER TABLE `itens_compras`
  ADD CONSTRAINT `id_compra` FOREIGN KEY (`id_compras`) REFERENCES `compras` (`cod_compras`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_compras` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`cod_produto`) ON DELETE CASCADE,
  ADD CONSTRAINT `itens_compras_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`cod_produto`),
  ADD CONSTRAINT `itens_compras_ibfk_2` FOREIGN KEY (`id_compras`) REFERENCES `compras` (`cod_compras`);

--
-- Restrições para tabelas `itens_consumo`
--
ALTER TABLE `itens_consumo`
  ADD CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`cod_produto`) ON DELETE CASCADE,
  ADD CONSTRAINT `itens_consumo_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`cod_produto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
