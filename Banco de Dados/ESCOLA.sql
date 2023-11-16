-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 24/10/2023 às 09:57
-- Versão do servidor: 8.0.34-0ubuntu0.22.04.1
-- Versão do PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `ESCOLA`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ALUNO`
--

CREATE TABLE `ALUNO` (
  `ID_ALUNO` int NOT NULL,
  `RA` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `IMG` varchar(150) NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'AUSENTE',
  `EMAIL` varchar(50) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `ALUNO`
--

INSERT INTO `ALUNO` (`ID_ALUNO`, `RA`, `NOME`, `IMG`, `STATUS`, `EMAIL`, `SENHA`) VALUES
(1, 5681, 'BELTRANO', '', 'AUSENTE', 'beltrano@email.com', '123'),
(2, 9735, 'FULANO', '-', 'PRESENTE', 'fulano@email.com', '123'),
(3, 18045, 'CICLANO', '-', 'AUSENTE', 'ciclano@email.com', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `AULA`
--

CREATE TABLE `AULA` (
  `ID_AULA` int NOT NULL,
  `COD_MAT` int NOT NULL,
  `N_PRESENCAS` int NOT NULL DEFAULT '0',
  `DATA` date NOT NULL,
  `TITULO` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `COMENTARIO` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `STATUS` varchar(50) NOT NULL DEFAULT 'NAO REALIZADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `AULA`
--

INSERT INTO `AULA` (`ID_AULA`, `COD_MAT`, `N_PRESENCAS`, `DATA`, `TITULO`, `COMENTARIO`, `STATUS`) VALUES
(4, 1, 2, '2023-11-01', 'Fundamentos do Cálculo: Explorando Limites', 'Nesta aula introdutória, mergulharemos nos conceitos fundamentais de limites em cálculo, entendendo sua importância e aplicações em diversas áreas.', 'NAO REALIZADA'),
(5, 1, 2, '2023-11-03', 'Derivadas: A Arte de Encontrar Taxas de Variação', 'Explore o mundo das derivadas nesta aula, onde desvendaremos os segredos por trás do cálculo das taxas de variação e sua aplicação em problemas do mundo real.', 'NAO REALIZADA'),
(6, 1, 2, '2023-11-08', 'Integrais Definidas: Calculando Áreas e Além', 'Aprofunde-se no universo das integrais definidas, aprendendo a calcular áreas sob curvas e explorando suas conexões com a acumulação de quantidades e a resolução de problemas práticos.', 'NAO REALIZADA'),
(7, 2, 2, '2023-11-01', 'Introdução à Estatística: Explorando Dados e Tendências\"', 'Nesta aula inaugural, vamos mergulhar no universo da estatística, explorando a importância da análise de dados, medidas de centralidade e dispersão, e começando a identificar padrões e tendências.', 'NAO REALIZADA'),
(8, 2, 2, '2023-11-02', 'Probabilidade: Desvendando o Futuro Incerto', 'Descubra os segredos por trás da probabilidade, aprendendo a quantificar a incerteza e aplicar conceitos probabilísticos em situações do cotidiano, desde jogos de azar até previsões estatísticas.', 'NAO REALIZADA'),
(9, 2, 2, '2023-11-08', 'Distribuições Estatísticas: Modelando o Comportamento dos Dados', 'Explore diversas distribuições estatísticas, compreendendo como elas descrevem o comportamento dos dados. Analisaremos distribuições normais, exponenciais e outras, conectando teoria à prática.', 'NAO REALIZADA'),
(10, 3, 4, '2023-11-03', 'Lógica Matemática: Fundamentos da Matemática Discreta', 'Explore os princípios essenciais da lógica matemática, incluindo proposições, conectivos lógicos e quantificadores, estabelecendo as bases para a compreensão dos conceitos em matemática discreta.', 'NAO REALIZADA'),
(11, 3, 4, '2023-11-10', 'Teoria dos Conjuntos: Construindo a Base da Matemática Discreta', 'Nesta aula, mergulhe na teoria dos conjuntos, entendendo operações, propriedades e aplicações práticas que são cruciais para resolver problemas em matemática discreta.', 'NAO REALIZADA'),
(12, 3, 4, '2023-11-17', 'Álgebra Booleana: Aplicações na Computação e Lógica', 'Descubra como a álgebra booleana, parte integrante da matemática discreta, é fundamental para a computação moderna. Explore seus conceitos e suas implicações em circuitos lógicos e programação.', 'NAO REALIZADA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `LOG_ENTR_SAID`
--

CREATE TABLE `LOG_ENTR_SAID` (
  `ID_LOG` int NOT NULL,
  `DAT_HOR` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `RA` int NOT NULL,
  `ACAO` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `MATERIA`
--

CREATE TABLE `MATERIA` (
  `COD_MAT` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `ANO_SEM` date NOT NULL,
  `ID_PROF` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `MATERIA`
--

INSERT INTO `MATERIA` (`COD_MAT`, `NOME`, `ANO_SEM`, `ID_PROF`) VALUES
(1, 'Cálculo', '2023-07-01', 1),
(2, 'Estatística', '2023-07-01', 1),
(3, 'Matemática Discreta', '2023-07-01', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `MATRICULA`
--

CREATE TABLE `MATRICULA` (
  `ID_MATR` int NOT NULL,
  `ID_ALUNO` int NOT NULL,
  `COD_MAT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `MATRICULA`
--

INSERT INTO `MATRICULA` (`ID_MATR`, `ID_ALUNO`, `COD_MAT`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `PROFESSOR`
--

CREATE TABLE `PROFESSOR` (
  `ID_PROF` int NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `PROFESSOR`
--

INSERT INTO `PROFESSOR` (`ID_PROF`, `NOME`, `EMAIL`, `SENHA`) VALUES
(1, 'Roberto Silva', 'roberto@email.com', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ALUNO`
--
ALTER TABLE `ALUNO`
  ADD PRIMARY KEY (`ID_ALUNO`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Índices de tabela `AULA`
--
ALTER TABLE `AULA`
  ADD PRIMARY KEY (`ID_AULA`);

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
-- AUTO_INCREMENT de tabela `ALUNO`
--
ALTER TABLE `ALUNO`
  MODIFY `ID_ALUNO` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `AULA`
--
ALTER TABLE `AULA`
  MODIFY `ID_AULA` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `LOG_ENTR_SAID`
--
ALTER TABLE `LOG_ENTR_SAID`
  MODIFY `ID_LOG` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `MATERIA`
--
ALTER TABLE `MATERIA`
  MODIFY `COD_MAT` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `MATRICULA`
--
ALTER TABLE `MATRICULA`
  MODIFY `ID_MATR` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `PROFESSOR`
--
ALTER TABLE `PROFESSOR`
  MODIFY `ID_PROF` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
