-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2023 às 23:53
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escola`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `aluno`
--

CREATE TABLE `aluno` (
  `ID_ALUNO` int(11) NOT NULL,
  `RA` int(11) NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `IMG` blob NOT NULL,
  `STATUS` varchar(15) NOT NULL DEFAULT 'AUSENTE',
  `EMAIL` varchar(50) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aluno`
--

INSERT INTO `aluno` (`ID_ALUNO`, `RA`, `NOME`, `IMG`, `STATUS`, `EMAIL`, `SENHA`) VALUES
(1, 5681, 'BELTRANO', '', 'AUSENTE', 'beltrano@email.com', '123'),
(2, 9735, 'FULANO', 0x2d, 'PRESENTE', 'fulano@email.com', '123'),
(3, 18045, 'CICLANO', 0x2d, 'AUSENTE', 'ciclano@email.com', '123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `aula`
--

CREATE TABLE `aula` (
  `ID_AULA` int(11) NOT NULL,
  `COD_MAT` int(11) NOT NULL,
  `N_PRESENCAS` int(11) NOT NULL DEFAULT 0,
  `DATA` date NOT NULL,
  `TITULO` varchar(100) NOT NULL,
  `COMENTARIO` varchar(300) NOT NULL,
  `STATUS` varchar(50) NOT NULL DEFAULT 'NAO REALIZADA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `aula`
--

INSERT INTO `aula` (`ID_AULA`, `COD_MAT`, `N_PRESENCAS`, `DATA`, `TITULO`, `COMENTARIO`, `STATUS`) VALUES
(4, 1, 2, '2023-11-01', 'Fundamentos do Cálculo: Explorando Limites', 'Nesta aula introdutória, mergulharemos nos conceitos fundamentais de limites em cálculo, entendendo sua importância e aplicações em diversas áreas.', 'REALIZADA'),
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
-- Estrutura para tabela `log_entr_said`
--

CREATE TABLE `log_entr_said` (
  `ID_LOG` int(11) NOT NULL,
  `DAT_HOR` datetime NOT NULL DEFAULT current_timestamp(),
  `RA` int(11) NOT NULL,
  `ACAO` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `materia`
--

CREATE TABLE `materia` (
  `COD_MAT` int(11) NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `ANO_SEM` date NOT NULL,
  `ID_PROF` int(11) NOT NULL,
  `ICONE` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `materia`
--

INSERT INTO `materia` (`COD_MAT`, `NOME`, `ANO_SEM`, `ID_PROF`, `ICONE`) VALUES
(1, 'Banco de dados', '2023-07-01', 1, 0x3c7376672077696474683d22343822206865696768743d223630222076696577426f783d22302030203438203630222066696c6c3d226e6f6e652220786d6c6e733d22687474703a2f2f7777772e77332e6f72672f323030302f737667223e0a3c7061746820643d224d343820313243343820352e3439362033372e303131203020323420304331302e3938392030203020352e343936203020313256313843302032342e3530342031302e3938392033302032342033304333372e3031312033302034382032342e3530342034382031385631325a4d32342035314331302e39383920353120302034352e353034203020333956343843302035342e3530342031302e3938392036302032342036304333372e3031312036302034382035342e3530342034382034385633394334382034352e3530342033372e3031312035312032342035315a222066696c6c3d22626c61636b222f3e0a3c7061746820643d224d34382032344334382033302e3530342033372e3031312033362032342033364331302e39383920333620302033302e353034203020323456333343302033392e3530342031302e3938392034352032342034354333372e3031312034352034382033392e3530342034382033335632345a222066696c6c3d22626c61636b222f3e0a3c2f7376673e0a),
(2, 'Hardware', '2023-07-01', 1, 0x3c7376672077696474683d22363022206865696768743d223630222076696577426f783d22302030203630203630222066696c6c3d226e6f6e652220786d6c6e733d22687474703a2f2f7777772e77332e6f72672f323030302f737667223e0a3c7061746820643d224d34312e373835372031372e313432394831382e323134334331372e363232362031372e313432392031372e313432392031372e363232362031372e313432392031382e323134335634312e373835374331372e313432392034322e333737352031372e363232362034322e383537322031382e323134332034322e383537324834312e373835374334322e333737352034322e383537322034322e383537322034322e333737352034322e383537322034312e373835375631382e323134334334322e383537322031372e363232362034322e333737352031372e313432392034312e373835372031372e313432395a222066696c6c3d22626c61636b222f3e0a3c7061746820643d224d35372e383537312032312e343238364335382e343235352032312e343238362035382e393730352032312e323032382035392e333732342032302e383030394335392e373734322032302e333939312036302031392e3835342036302031392e323835374336302031382e373137342035392e373734322031382e313732332035392e333732342031372e373730354335382e393730352031372e333638362035382e343235352031372e313432392035372e383537312031372e313432394835352e373134335631322e383537314335352e373131382031302e353834362035342e3830373920382e34303538392035332e32303120362e37393839374335312e3539343120352e31393230352034392e3431353420342e323838322034372e3134323920342e32383537314834322e3835373156322e31343238364334322e3835373120312e35373435342034322e3633313420312e30323934392034322e3232393520302e3632373632384334312e3832373720302e3232353736352034312e3238323620302034302e3731343320304334302e31343620302033392e3630303920302e3232353736352033392e3139393120302e3632373632384333382e3739373220312e30323934392033382e3537313420312e35373435342033382e3537313420322e313432383656342e32383537314833322e3134323956322e31343238364333322e3134323920312e35373435342033312e3931373120312e30323934392033312e3531353220302e3632373632384333312e3131333420302e3232353736352033302e35363833203020333020304332392e3433313720302032382e3838363620302e3232353736352032382e3438343820302e3632373632384332382e3038323920312e30323934392032372e3835373120312e35373435342032372e3835373120322e313432383656342e32383537314832312e3432383656322e31343238364332312e3432383620312e35373435342032312e3230323820312e30323934392032302e3830303920302e3632373632384332302e3339393120302e3232353736352031392e38353420302031392e3238353720304331382e3731373420302031382e3137323320302e3232353736352031372e3737303520302e3632373632384331372e3336383620312e30323934392031372e3134323920312e35373435342031372e3134323920322e313432383656342e32383537314831322e383537314331302e3538343620342e3238383220382e343035383920352e313932303520362e373938393720362e373938393743352e313932303520382e343035383920342e323838322031302e3538343620342e32383537312031322e383537315631372e3134323948322e313432383643312e35373435342031372e3134323920312e30323934392031372e3336383620302e3632373632382031372e3737303543302e3232353736352031382e3137323320302031382e3731373420302031392e3238353743302031392e38353420302e3232353736352032302e3339393120302e3632373632382032302e3830303943312e30323934392032312e3230323820312e35373435342032312e3432383620322e31343238362032312e3432383648342e32383537315632372e3835373148322e313432383643312e35373435342032372e3835373120312e30323934392032382e3038323920302e3632373632382032382e3438343843302e3232353736352032382e3838363620302032392e34333137203020333043302033302e3536383320302e3232353736352033312e3131333420302e3632373632382033312e3531353243312e30323934392033312e3931373120312e35373435342033322e3134323920322e31343238362033322e3134323948342e32383537315633382e3537313448322e313432383643312e35373435342033382e3537313420312e30323934392033382e3739373220302e3632373632382033392e3139393143302e3232353736352033392e3630303920302034302e31343620302034302e3731343343302034312e3238323620302e3232353736352034312e3832373720302e3632373632382034322e3232393543312e30323934392034322e3633313420312e35373435342034322e3835373120322e31343238362034322e3835373148342e32383537315634372e3134323943342e323838322034392e3431353420352e31393230352035312e3539343120362e37393839372035332e32303143382e34303538392035342e383037392031302e353834362035352e373131382031322e383537312035352e373134334831372e313432395635372e383537314331372e313432392035382e343235352031372e333638362035382e393730352031372e373730352035392e333732344331382e313732332035392e373734322031382e373137342036302031392e323835372036304331392e3835342036302032302e333939312035392e373734322032302e383030392035392e333732344332312e323032382035382e393730352032312e343238362035382e343235352032312e343238362035372e383537315635352e373134334832372e383537315635372e383537314332372e383537312035382e343235352032382e303832392035382e393730352032382e343834382035392e333732344332382e383836362035392e373734322032392e343331372036302033302036304333302e353638332036302033312e313133342035392e373734322033312e353135322035392e333732344333312e393137312035382e393730352033322e313432392035382e343235352033322e313432392035372e383537315635352e373134334833382e353731345635372e383537314333382e353731342035382e343235352033382e373937322035382e393730352033392e313939312035392e333732344333392e363030392035392e373734322034302e3134362036302034302e373134332036304334312e323832362036302034312e383237372035392e373734322034322e323239352035392e333732344334322e363331342035382e393730352034322e383537312035382e343235352034322e383537312035372e383537315635352e373134334834372e313432394334392e343135342035352e373131382035312e353934312035342e383037392035332e3230312035332e3230314335342e383037392035312e353934312035352e373131382034392e343135342035352e373134332034372e313432395634322e383537314835372e383537314335382e343235352034322e383537312035382e393730352034322e363331342035392e333732342034322e323239354335392e373734322034312e383237372036302034312e323832362036302034302e373134334336302034302e3134362035392e373734322033392e363030392035392e333732342033392e313939314335382e393730352033382e373937322035382e343235352033382e353731342035372e383537312033382e353731344835352e373134335633322e313432394835372e383537314335382e343235352033322e313432392035382e393730352033312e393137312035392e333732342033312e353135324335392e373734322033312e313133342036302033302e353638332036302033304336302032392e343331372035392e373734322032382e383836362035392e333732342032382e343834384335382e393730352032382e303832392035382e343235352032372e383537312035372e383537312032372e383537314835352e373134335632312e343238364835372e383537315a4d34372e313432392034322e383537314334372e313432392034332e393933382034362e363931332034352e303833392034352e383837362034352e383837364334352e303833392034362e363931332034332e393933382034372e313432392034322e383537312034372e313432394831372e313432394331362e303036322034372e313432392031342e393136312034362e363931332031342e313132342034352e383837364331332e333038372034352e303833392031322e383537312034332e393933382031322e383537312034322e383537315631372e313432394331322e383537312031362e303036322031332e333038372031342e393136312031342e313132342031342e313132344331342e393136312031332e333038372031362e303036322031322e383537312031372e313432392031322e383537314834322e383537314334332e393933382031322e383537312034352e303833392031332e333038372034352e383837362031342e313132344334362e363931332031342e393136312034372e313432392031362e303036322034372e313432392031372e313432395634322e383537315a222066696c6c3d22626c61636b222f3e0a3c2f7376673e0a),
(3, 'Lógica de Programação', '2023-07-01', 1, 0x3c7376672077696474683d22363022206865696768743d223438222076696577426f783d22302030203630203438222066696c6c3d226e6f6e652220786d6c6e733d22687474703a2f2f7777772e77332e6f72672f323030302f737667223e0a3c7061746820643d224d32352e393537382034372e353938364c32302e323830392034352e393531344331392e363835332034352e373833392031392e333530332034352e313630332031392e353137382034342e353634374c33322e32323120302e3830363139344333322e3338383520302e3231303538372033332e303132202d302e3132343434322033332e3630373620302e303433303732334c33392e3238343520312e363930334333392e3838303120312e38353738312034302e3231353120322e34383133342034302e3034373620332e30373639354c32372e333434342034362e383335354332372e313637362034372e343331312032362e353533342034372e373735342032352e393537382034372e353938365a4d31352e333438352033372e313536394c31392e333936382033322e383338374331392e383234392033322e333832372031392e3739372033312e363536382031392e333232332033312e3233384c31302e383930382032332e383230384c31392e333232332031362e343033374331392e3739372031352e393834392031392e383334322031352e3235392031392e333936382031342e3830334c31352e333438352031302e343834384331342e393239372031302e303338312031342e323232352031302e303130322031332e373636342031302e343338334c302e3335353936392032332e30303139432d302e3131383635362032332e34333933202d302e3131383635362032342e3139333120302e3335353936392032342e363330354c31332e373636342033372e323033344331342e323232352033372e363331352031342e393239372033372e363132392031352e333438352033372e313536395a4d34352e3739392033372e323132374c35392e323039342032342e363339384335392e363834312032342e323032342035392e363834312032332e343438362035392e323039342032332e303131324c34352e3739392031302e3432394334352e333532332031302e303130322034342e3634352031302e303238382034342e323136392031302e343735354c34302e313638362031342e373933374333392e373430352031352e323439372033392e373638342031352e393735362034302e323433312031362e333934344c34382e363734362032332e383230384c34302e323433312033312e3233384333392e373638342033312e363536382033392e373331322033322e333832372034302e313638362033322e383338374c34342e323136392033372e313536394334342e363335372033372e363132392034352e333432392033372e363331352034352e3739392033372e323132375a222066696c6c3d22626c61636b222f3e0a3c2f7376673e0a);

-- --------------------------------------------------------

--
-- Estrutura para tabela `matricula`
--

CREATE TABLE `matricula` (
  `ID_MATR` int(11) NOT NULL,
  `ID_ALUNO` int(11) NOT NULL,
  `COD_MAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `matricula`
--

INSERT INTO `matricula` (`ID_MATR`, `ID_ALUNO`, `COD_MAT`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 1),
(5, 3, 2),
(6, 3, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `presenca`
--

CREATE TABLE `presenca` (
  `ID_PRESENCA` int(11) NOT NULL,
  `ID_AULA` int(11) NOT NULL,
  `ID_MATR` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `PRESENCAS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `presenca`
--

INSERT INTO `presenca` (`ID_PRESENCA`, `ID_AULA`, `ID_MATR`, `DATA`, `PRESENCAS`) VALUES
(1, 4, 4, '2023-11-01', 0),
(2, 4, 1, '2023-11-01', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `professor`
--

CREATE TABLE `professor` (
  `ID_PROF` int(11) NOT NULL,
  `NOME` varchar(150) NOT NULL,
  `EMAIL` varchar(150) NOT NULL,
  `SENHA` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `professor`
--

INSERT INTO `professor` (`ID_PROF`, `NOME`, `EMAIL`, `SENHA`) VALUES
(1, 'Roberto Silva', 'roberto@email.com', '123');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ID_ALUNO`),
  ADD UNIQUE KEY `RA` (`RA`);

--
-- Índices de tabela `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`ID_AULA`);

--
-- Índices de tabela `log_entr_said`
--
ALTER TABLE `log_entr_said`
  ADD PRIMARY KEY (`ID_LOG`);

--
-- Índices de tabela `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`COD_MAT`);

--
-- Índices de tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`ID_MATR`);

--
-- Índices de tabela `presenca`
--
ALTER TABLE `presenca`
  ADD PRIMARY KEY (`ID_PRESENCA`);

--
-- Índices de tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`ID_PROF`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `ID_ALUNO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `aula`
--
ALTER TABLE `aula`
  MODIFY `ID_AULA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `log_entr_said`
--
ALTER TABLE `log_entr_said`
  MODIFY `ID_LOG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `materia`
--
ALTER TABLE `materia`
  MODIFY `COD_MAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `ID_MATR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `presenca`
--
ALTER TABLE `presenca`
  MODIFY `ID_PRESENCA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `ID_PROF` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO `websiga`@`%` IDENTIFIED BY PASSWORD '*0792D93A6C08D3D449C80ACD394A2A123750A44A';

GRANT ALL PRIVILEGES ON `escola`.* TO `websiga`@`%`;
