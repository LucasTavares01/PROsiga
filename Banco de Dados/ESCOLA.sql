-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/10/2023 às 09:14
-- Versão do servidor: 8.0.34-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ESCOLA`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALUNO`
--

CREATE TABLE `ALUNO` (
  `RA` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `IMG` varchar(150) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'AUSENTE',
  `EMAIL` varchar(50) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ALUNO`
--

INSERT INTO `ALUNO` (`RA`, `NOME`, `IMG`, `STATUS`, `EMAIL`, `SENHA`) VALUES
(9735, 'FULANO', '-', 'PRESENTE', 'fulano@email.com', '123'),
(18045, 'CICLANO', '-', 'AUSENTE', 'ciclano@email.com', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `AULA`
--

CREATE TABLE `AULA` (
  `ID_AULA` int NOT NULL,
  `COD_MAT` int NOT NULL,
  `N_PRESENCAS` int NOT NULL DEFAULT '0',
  `DATA` date NOT NULL,
  `TITULO` varchar(50) NOT NULL,
  `COMENTARIO` varchar(150) NOT NULL,
  `STATUS` varchar(50) NOT NULL DEFAULT 'NAO REALIZADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `LOG_ENTR_SAID`
--

CREATE TABLE `LOG_ENTR_SAID` (
  `ID_LOG` int NOT NULL,
  `DAT_HOR` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RA` int NOT NULL,
  `ACAO` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MATERIA`
--

CREATE TABLE `MATERIA` (
  `COD_MAT` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `ANO_SEM` date NOT NULL,
  `ID_PROF` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MATRICULA`
--

CREATE TABLE `MATRICULA` (
  `ID_MATR` int NOT NULL,
  `RA` int NOT NULL,
  `COD_MAT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PRESENCA`
--

CREATE TABLE `PRESENCA` (
  `ID_PRESENCA` int NOT NULL,
  `ID_AULA` int NOT NULL,
  `ID_MATR` int NOT NULL,
  `DATA` date NOT NULL,
  `PRESENCAS` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PROFESSOR`
--

CREATE TABLE `PROFESSOR` (
  `ID_PROF` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ALUNO`
--
ALTER TABLE `ALUNO`
  ADD PRIMARY KEY (`RA`);

--
-- Índices de tabela `LOG_ENTR_SAID`
--
ALTER TABLE `LOG_ENTR_SAID`
  ADD PRIMARY KEY (`ID_LOG`);

--
-- Índices de tabela `MATERIA`
--
ALTER TABLE `MATERIA`
  ADD PRIMARY KEY (`COD_MAT`);

--
-- Índices de tabela `MATRICULA`
--
ALTER TABLE `MATRICULA`
  ADD PRIMARY KEY (`ID_MATR`);

--
-- Índices de tabela `PROFESSOR`
--
ALTER TABLE `PROFESSOR`
  ADD PRIMARY KEY (`ID_PROF`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `LOG_ENTR_SAID`
--
ALTER TABLE `LOG_ENTR_SAID`
  MODIFY `ID_LOG` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `MATERIA`
--
ALTER TABLE `MATERIA`
  MODIFY `COD_MAT` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `MATRICULA`
--
ALTER TABLE `MATRICULA`
  MODIFY `ID_MATR` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `PROFESSOR`
--
ALTER TABLE `PROFESSOR`
  MODIFY `ID_PROF` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
