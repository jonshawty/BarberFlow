-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Nov-2023 às 13:49
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbtcc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id_agendamento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `barbearia` int(11) NOT NULL,
  `data_agendamento` date NOT NULL,
  `horario_agendamento` time NOT NULL,
  `valor_total` decimal(10,0) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'P' COMMENT 'F - finalizado | P - pendente | C - Cancelado',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamento`
--

INSERT INTO `agendamento` (`id_agendamento`, `usuario`, `barbearia`, `data_agendamento`, `horario_agendamento`, `valor_total`, `status`, `data_criacao`) VALUES
(1, 3, 8, '2020-11-22', '14:00:00', 18, 'F', '2020-11-22 15:08:15'),
(12, 3, 8, '2020-11-26', '18:00:00', 18, 'F', '2020-11-26 19:26:34'),
(13, 3, 8, '2020-11-27', '10:00:00', 28, 'F', '2020-11-27 02:05:00'),
(14, 3, 8, '2020-11-27', '12:30:00', 10, 'F', '2020-11-27 02:05:14'),
(15, 3, 8, '2020-11-27', '13:30:00', 10, 'F', '2020-11-27 02:12:40'),
(16, 4, 8, '2020-12-07', '13:00:00', 18, 'F', '2020-12-04 15:16:25'),
(19, 5, 8, '2020-12-07', '17:30:00', 25, 'F', '2020-12-07 18:21:22'),
(20, 3, 8, '2020-12-08', '18:00:00', 34, 'F', '2020-12-08 12:59:19'),
(21, 6, 8, '2023-08-03', '10:31:00', 18, 'F', '2023-08-30 12:59:44'),
(22, 7, 8, '2023-08-07', '15:00:00', 10, 'F', '2023-08-30 14:39:56'),
(23, 8, 8, '2023-09-11', '10:30:00', 18, 'F', '2023-09-09 23:50:52'),
(24, 8, 8, '2023-09-11', '10:30:00', 25, 'F', '2023-09-10 12:09:35'),
(25, 8, 8, '2023-09-21', '10:30:00', 100, 'F', '2023-09-10 17:13:18'),
(26, 8, 8, '2023-09-11', '15:00:00', 25, 'F', '2023-09-10 17:17:28'),
(27, 8, 8, '2023-09-11', '14:30:00', 30, 'F', '2023-09-10 23:11:56'),
(28, 8, 8, '2023-09-16', '10:00:00', 299, 'F', '2023-09-16 00:18:41'),
(29, 8, 8, '2023-09-14', '16:00:00', 299, 'F', '2023-09-21 03:09:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamento_servico`
--

CREATE TABLE `agendamento_servico` (
  `agendamento` int(11) NOT NULL,
  `servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamento_servico`
--

INSERT INTO `agendamento_servico` (`agendamento`, `servico`) VALUES
(12, 1),
(13, 1),
(13, 2),
(14, 2),
(15, 2),
(16, 1),
(19, 15),
(20, 15),
(20, 17),
(21, 1),
(22, 2),
(23, 1),
(24, 15),
(25, 22),
(26, 15),
(27, 23),
(28, 25),
(29, 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `barbearia`
--

CREATE TABLE `barbearia` (
  `barbearia_id` int(11) NOT NULL,
  `nome_dono` varchar(45) NOT NULL,
  `cpf_dono` varchar(45) NOT NULL,
  `email_dono` varchar(45) NOT NULL,
  `senha_dono` varchar(45) NOT NULL,
  `nome_barbearia` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `cnpj` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `num_bar` varchar(10) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(45) NOT NULL,
  `horario_abertura` time DEFAULT NULL,
  `horario_fechamento` time DEFAULT NULL,
  `horario_abertura_final_semana` time DEFAULT NULL,
  `horario_fechamento_final_semana` time DEFAULT NULL,
  `imagem_barbearia` varchar(100) DEFAULT NULL,
  `sobre_barber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `barbearia`
--

INSERT INTO `barbearia` (`barbearia_id`, `nome_dono`, `cpf_dono`, `email_dono`, `senha_dono`, `nome_barbearia`, `telefone`, `cep`, `cnpj`, `rua`, `num_bar`, `bairro`, `cidade`, `uf`, `horario_abertura`, `horario_fechamento`, `horario_abertura_final_semana`, `horario_fechamento_final_semana`, `imagem_barbearia`, `sobre_barber`) VALUES
(8, 'Savionei', '111.111.111-11', 'savionei@hotmail.com', 'b400de1f64beb532d80982347ebb5989', 'Savionei careca', '(28) 98006-6233', '44032-568', '11.111.111/1111-11', 'Rua Bernardo Vargas ', '116', 'Rive', 'Alegre', 'ES', '08:00:00', '19:00:00', '08:00:00', '19:00:00', 'https://casaeconstrucao.org/wp-content/uploads/2018/08/fachada-barbearia-moderna3.jpg', NULL),
(17, 'Savionei P', '888.288.882-88', 'savio@gmail.com', '$2y$10$Zn6DLP.Xh19hxvAmcdnGL.xxZPCyONzofo0q2L', 'Savio raspa ', '(28) 97778-7671', '29520-000', '21.738.937/2187-63', 'Bernardo vargas', '116', 'Rive', 'Alegre', 'ES', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'gustavoducorte', '437.247.382-78', 'gustavo@hotmail.com', '$2y$10$3tkK3b0gSLNZxekLFYs3Uuau3aC2tiwBTkm/Uw', 'Gustavo Cortes', '(43) 82794-7238', '29704-100', '38.273.892/1783-21', 'Rua Gonçalves Dias', '1111', 'Santo Antônio', 'Colatina', 'ES', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'maria clara', '202.688.187-11', 'maria@hotmail.com', '$2y$10$cZV8kkR4lREhww6MQaKnb.n540O.0TaR4RGNT6', 'Maria Clara Makeup', '(28) 99935-9293', '29285-000', '44.444.444/4444-44', 'Joao abraao', '165', 'Acaica', 'Piúma', 'ES', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco` decimal(10,0) NOT NULL,
  `barbearia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `nome`, `preco`, `barbearia`) VALUES
(1, 'Corte de Cabelo', 18, 8),
(2, 'Corte de Barba', 10, 8),
(15, 'Cabelo e Barba', 25, 8),
(17, 'Sombracelha', 9, 8),
(22, 'maquiagem', 100, 8),
(23, 'Pintar cabelo', 30, 8),
(25, 'rasparo seu saco', 299, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `data_de_nascimento` date NOT NULL,
  `cpf` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`user_id`, `nome`, `telefone`, `data_de_nascimento`, `cpf`, `email`, `senha`) VALUES
(1, 'joao', '(78) 97897-9878', '2000-03-29', '324.423.432-43', 'ewqewqe@asdasd.com', '123456789'),
(2, 'teste', '(42) 34234-3243', '1999-03-31', '343.434.343-43', 'asdasdsad@ajsdk.com', '315eb115d98fcbad39ffc5edebd669c9'),
(3, 'Admin', '(77) 88888-8888', '2001-02-28', '999.999.999-99', 'teste@teste.com', '17003122b89ccb2a3d7d4970de0d91ae'),
(4, 'Testador', '(75) 98887-7747', '2000-07-04', '565.656.565-65', 'testador@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(5, 'Mateus', '(23) 21353-4534', '1999-12-10', '325.454.365-46', 'mateus@gmail.com', '25f9e794323b453885f5181f1b624d0b'),
(6, 'savionei02', '(28) 99935-9230', '1996-02-13', '732.717.321-78', 'savio02@gmail.com', 'e3999f4225c54b24266e3a72d0c0b949'),
(7, 'jonata horsth', '(28) 99935-9201', '2001-03-20', '180.807.207-38', 'jonata@gmail.com', '74f82c32249582faff19fccfaea76cf4'),
(8, 'Ana Celeste Horsth', '(28) 99974-3305', '1966-03-24', '090.528.677-47', 'ana@gmail.com', 'e4e0bc2ca5e8b32f7f80be62097cb973');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_user_id` (`usuario`),
  ADD KEY `fk_barbearia_id` (`barbearia`);

--
-- Índices para tabela `agendamento_servico`
--
ALTER TABLE `agendamento_servico`
  ADD KEY `fk_agendamento_servico` (`agendamento`),
  ADD KEY `fk_servico_agendamento` (`servico`);

--
-- Índices para tabela `barbearia`
--
ALTER TABLE `barbearia`
  ADD PRIMARY KEY (`barbearia_id`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`),
  ADD KEY `fk_barbearia_servico` (`barbearia`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `barbearia`
--
ALTER TABLE `barbearia`
  MODIFY `barbearia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `fk_barbearia_id` FOREIGN KEY (`barbearia`) REFERENCES `barbearia` (`barbearia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`usuario`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `agendamento_servico`
--
ALTER TABLE `agendamento_servico`
  ADD CONSTRAINT `fk_agendamento_servico` FOREIGN KEY (`agendamento`) REFERENCES `agendamento` (`id_agendamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servico_agendamento` FOREIGN KEY (`servico`) REFERENCES `servico` (`id_servico`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico`
--
ALTER TABLE `servico`
  ADD CONSTRAINT `fk_barbearia_servico` FOREIGN KEY (`barbearia`) REFERENCES `barbearia` (`barbearia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
