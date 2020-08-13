-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/02/2020 às 22:12
-- Versão do servidor: 10.4.11-MariaDB
-- Versão do PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `c_auth`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_data`
--

CREATE TABLE `c_data` (
  `c_uid` int(11) NOT NULL,
  `c_username` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_password` varchar(255) NOT NULL,
  `c_admin` int(11) NOT NULL DEFAULT 0,
  `c_expires` varchar(255) DEFAULT NULL,
  `c_hwid` varchar(255) DEFAULT NULL,
  `c_ip` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_keys`
--

CREATE TABLE `c_keys` (
  `c_id` int(11) NOT NULL,
  `c_key` varchar(255) NOT NULL,
  `c_days` int(11) NOT NULL,
  `c_used` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_resets`
--

CREATE TABLE `c_resets` (
  `c_id` int(11) NOT NULL,
  `c_token` varchar(255) NOT NULL,
  `c_email` varchar(255) NOT NULL,
  `c_expires` varchar(255) NOT NULL,
  `c_done` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura para tabela `c_tokens`
--

CREATE TABLE `c_tokens` (
  `c_id` int(11) NOT NULL,
  `c_token` varchar(255) NOT NULL,
  `c_expires` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `c_data`
--
ALTER TABLE `c_data`
  ADD PRIMARY KEY (`c_uid`);

--
-- Índices de tabela `c_keys`
--
ALTER TABLE `c_keys`
  ADD PRIMARY KEY (`c_id`);

--
-- Índices de tabela `c_resets`
--
ALTER TABLE `c_resets`
  ADD PRIMARY KEY (`c_id`);

--
-- Índices de tabela `c_tokens`
--
ALTER TABLE `c_tokens`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `c_data`
--
ALTER TABLE `c_data`
  MODIFY `c_uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `c_keys`
--
ALTER TABLE `c_keys`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `c_resets`
--
ALTER TABLE `c_resets`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `c_tokens`
--
ALTER TABLE `c_tokens`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
