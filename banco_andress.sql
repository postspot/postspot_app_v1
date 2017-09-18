-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18-Set-2017 às 06:18
-- Versão do servidor: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_andress`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexos`
--

CREATE TABLE `anexos` (
  `id_anexo` int(11) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT NULL,
  `id_tarefa` int(11) NOT NULL,
  `membros_equipe_id_membros` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT NULL,
  `comentario` text,
  `id_usuario` int(11) NOT NULL,
  `id_tarefa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipes`
--

CREATE TABLE `equipes` (
  `id_equipe` int(11) NOT NULL,
  `cadastro_equipe` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `equipes`
--

INSERT INTO `equipes` (`id_equipe`, `cadastro_equipe`) VALUES
(1, '2017-09-17 03:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estrategias`
--

CREATE TABLE `estrategias` (
  `id_estrategia` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `empresa` text,
  `projeto` text,
  `produtos_servicos` text,
  `links` text,
  `objetivo_primario` varchar(45) DEFAULT NULL,
  `kpis_primario` varchar(45) DEFAULT NULL,
  `objetivo_secundario` varchar(45) DEFAULT NULL,
  `kpis_secundario` text,
  `concorrentes` varchar(45) DEFAULT NULL,
  `com_quem_falar` varchar(45) DEFAULT NULL,
  `com_quem_nao_falar` varchar(45) DEFAULT NULL,
  `abordar` varchar(45) DEFAULT NULL,
  `evitar` varchar(45) DEFAULT NULL,
  `linguagem` varchar(45) DEFAULT NULL,
  `links_ref` varchar(45) DEFAULT NULL,
  `categorias_conteudo` varchar(45) DEFAULT NULL,
  `canais` varchar(45) DEFAULT NULL,
  `acoes` varchar(45) DEFAULT NULL,
  `consideracoes_gerais` varchar(45) DEFAULT NULL,
  `projetos_id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidades`
--

CREATE TABLE `habilidades` (
  `id_habilidade` int(11) NOT NULL,
  `nome_habilidade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `habilidades`
--

INSERT INTO `habilidades` (`id_habilidade`, `nome_habilidade`) VALUES
(1, 'Agronegócio'),
(2, 'Arquitetura'),
(3, 'Artes'),
(4, 'Atendimento ao cliente'),
(5, 'Automóveis'),
(6, 'Beleza'),
(7, 'Bioquímica'),
(8, 'Coaching'),
(9, 'Comidas e Bebidas'),
(10, 'Decoração'),
(11, 'Design'),
(12, 'Direito'),
(13, 'E-commerce'),
(14, 'Educação'),
(15, 'Empreendedorismo'),
(16, 'Engenharia'),
(17, 'Entreterimento'),
(18, 'Esportes'),
(19, 'Eventos'),
(20, 'Finanças'),
(21, 'História'),
(22, 'Imóveis'),
(23, 'Jardinagem'),
(24, 'Logística'),
(25, 'Marketing Digital'),
(26, 'Medicina'),
(27, 'Meio Ambiente'),
(28, 'Moda'),
(29, 'Negócios'),
(30, 'Nutrição'),
(31, 'Naútica'),
(32, 'Odontologia'),
(33, 'Pets'),
(34, 'Psicologia'),
(35, 'Recursos Humanos'),
(36, 'Saúde e Bem-Estar'),
(37, 'TI'),
(38, 'Turismo'),
(39, 'Vendas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `habilidades_usuario`
--

CREATE TABLE `habilidades_usuario` (
  `id_habilidade_usuario` int(11) NOT NULL,
  `habilidades_id_habilidade` int(11) NOT NULL,
  `usuarios_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `idiomas`
--

CREATE TABLE `idiomas` (
  `id_idioma` int(11) NOT NULL,
  `nome_idioma` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `idiomas`
--

INSERT INTO `idiomas` (`id_idioma`, `nome_idioma`) VALUES
(1, 'Português'),
(2, 'Inglês'),
(3, 'Espanhol'),
(4, 'Francês'),
(5, 'Italiano');

-- --------------------------------------------------------

--
-- Estrutura da tabela `idiomas_usuario`
--

CREATE TABLE `idiomas_usuario` (
  `id_idiomas_usuario` int(11) NOT NULL,
  `idiomas_id_idioma` int(11) NOT NULL,
  `usuarios_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `idiomas_usuario`
--

INSERT INTO `idiomas_usuario` (`id_idiomas_usuario`, `idiomas_id_idioma`, `usuarios_id_usuario`) VALUES
(1, 1, 4),
(2, 1, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_tarefas`
--

CREATE TABLE `log_tarefas` (
  `id_log` int(11) NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `etapa` varchar(1) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT NULL,
  `data_prevista` timestamp NULL DEFAULT NULL,
  `data_entregue` timestamp NULL DEFAULT NULL,
  `id_tarefa` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `membros_equipe`
--

CREATE TABLE `membros_equipe` (
  `id_membros` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(11) NOT NULL,
  `data_criacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` varchar(45) DEFAULT NULL,
  `idade` varchar(3) DEFAULT NULL,
  `sexo` varchar(1) DEFAULT NULL,
  `caracteristicas` text,
  `educacao` varchar(45) DEFAULT NULL,
  `trabalho` varchar(45) DEFAULT NULL,
  `segmento` varchar(45) DEFAULT NULL,
  `objetivos` text,
  `descricao` text,
  `resolucao` text,
  `foto` varchar(45) DEFAULT NULL,
  `id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `personas`
--

INSERT INTO `personas` (`id_persona`, `data_criacao`, `nome`, `idade`, `sexo`, `caracteristicas`, `educacao`, `trabalho`, `segmento`, `objetivos`, `descricao`, `resolucao`, `foto`, `id_projeto`) VALUES
(1, NULL, 'persona mc', '20', '1', 'carac', 'pós', 'trab', 'seg', 'obj', 'desc', 'res', NULL, 1),
(7, '2017-09-18 03:52:14', 'nome', '31', 'm', 'carac', 'edu', 'trab', 'seg', 'obj', 'problems', 'help', 'foto', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id_projeto` int(11) NOT NULL,
  `nome_projeto` varchar(45) DEFAULT NULL,
  `cadastro_projeto` timestamp NULL DEFAULT NULL,
  `site_projeto` varchar(45) DEFAULT NULL,
  `responsavel_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id_projeto`, `nome_projeto`, `cadastro_projeto`, `site_projeto`, `responsavel_projeto`) VALUES
(1, 'projeto melhor compra', NULL, 'www', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacoes`
--

CREATE TABLE `publicacoes` (
  `id_publicacao` int(11) NOT NULL,
  `texto_publicacao` text,
  `status_publicacao` varchar(1) DEFAULT NULL,
  `data_criacao` timestamp NULL DEFAULT NULL,
  `id_tarefa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL,
  `nome_tarefa` varchar(45) DEFAULT NULL,
  `tipo_tarefa` varchar(1) DEFAULT NULL,
  `palavra_chave` varchar(45) DEFAULT NULL,
  `briefing_tarefa` varchar(45) DEFAULT NULL,
  `estagio_compra` varchar(1) DEFAULT NULL,
  `tipo_cta` text,
  `referencias` text,
  `consideracoes_gerais` text,
  `id_persona` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `id_equipe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefa`, `nome_tarefa`, `tipo_tarefa`, `palavra_chave`, `briefing_tarefa`, `estagio_compra`, `tipo_cta`, `referencias`, `consideracoes_gerais`, `id_persona`, `id_projeto`, `id_equipe`) VALUES
(1, 'teste titulo', 'E', 'palavra', 'bri', '1', 'cta', 'ref', 'cons', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_tarefa`
--

CREATE TABLE `tipo_tarefa` (
  `id_tipo` int(11) NOT NULL,
  `nome_tarefa` varchar(45) DEFAULT NULL,
  `id_tarefa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(45) DEFAULT NULL,
  `sexo_usuario` varchar(1) DEFAULT NULL,
  `foto_usuario` varchar(45) DEFAULT NULL,
  `funcao_usuario` varchar(1) DEFAULT NULL,
  `email_usuario` varchar(45) DEFAULT NULL,
  `senha_usuario` varchar(45) DEFAULT NULL,
  `cadastro_usuario` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `sexo_usuario`, `foto_usuario`, `funcao_usuario`, `email_usuario`, `senha_usuario`, `cadastro_usuario`) VALUES
(1, 'teste', 'm', 'assets/img/faces/face-0.jpg', '0', 'email@email.com', 'senha', '2017-09-14 03:28:45'),
(2, 'teste', 'm', 'assets/img/faces/face-0.jpg', '0', 'email@email.com', 'senha', '2017-09-14 03:29:27'),
(3, 'teste', 'm', 'assets/img/faces/face-0.jpg', '0', 'email@email.com', 'senha', '2017-09-14 03:34:12'),
(4, 'aa', 'm', 'assets/img/faces/face-0.jpg', '0', 'aaa@a.com', '123', '2017-09-14 03:37:28'),
(5, 'aa', 'm', 'assets/img/faces/face-0.jpg', '0', 'aaa@a.com', '123', '2017-09-14 03:43:12'),
(6, 'admin mc', '1', 'assets/img/faces/face-0.jpg', '1', 'email@mc.com.br', '123', '2017-09-17 03:03:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id_anexo`,`id_tarefa`,`membros_equipe_id_membros`),
  ADD KEY `fk_anexos_tarefas1_idx` (`id_tarefa`),
  ADD KEY `fk_anexos_membros_equipe1_idx` (`membros_equipe_id_membros`);

--
-- Indexes for table `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`,`id_usuario`,`id_tarefa`),
  ADD KEY `fk_comentarios_usuarios1_idx` (`id_usuario`),
  ADD KEY `fk_comentarios_tarefas1_idx` (`id_tarefa`);

--
-- Indexes for table `equipes`
--
ALTER TABLE `equipes`
  ADD PRIMARY KEY (`id_equipe`);

--
-- Indexes for table `estrategias`
--
ALTER TABLE `estrategias`
  ADD PRIMARY KEY (`id_estrategia`,`projetos_id_projeto`),
  ADD KEY `fk_estrategias_projetos1_idx` (`projetos_id_projeto`);

--
-- Indexes for table `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id_habilidade`);

--
-- Indexes for table `habilidades_usuario`
--
ALTER TABLE `habilidades_usuario`
  ADD PRIMARY KEY (`id_habilidade_usuario`,`habilidades_id_habilidade`,`usuarios_id_usuario`),
  ADD KEY `fk_habilidades_usuario_habilidades1_idx` (`habilidades_id_habilidade`),
  ADD KEY `fk_habilidades_usuario_usuarios1_idx` (`usuarios_id_usuario`);

--
-- Indexes for table `idiomas`
--
ALTER TABLE `idiomas`
  ADD PRIMARY KEY (`id_idioma`);

--
-- Indexes for table `idiomas_usuario`
--
ALTER TABLE `idiomas_usuario`
  ADD PRIMARY KEY (`id_idiomas_usuario`,`idiomas_id_idioma`,`usuarios_id_usuario`),
  ADD KEY `fk_idiomas_usuario_idiomas1_idx` (`idiomas_id_idioma`),
  ADD KEY `fk_idiomas_usuario_usuarios1_idx` (`usuarios_id_usuario`);

--
-- Indexes for table `log_tarefas`
--
ALTER TABLE `log_tarefas`
  ADD PRIMARY KEY (`id_log`,`id_tarefa`,`id_usuario`),
  ADD KEY `fk_log_tarefas_usuarios1_idx` (`id_usuario`),
  ADD KEY `fk_log_tarefas_tarefas1_idx` (`id_tarefa`);

--
-- Indexes for table `membros_equipe`
--
ALTER TABLE `membros_equipe`
  ADD PRIMARY KEY (`id_membros`,`id_equipe`,`id_usuario`),
  ADD KEY `fk_membro_equipe_equipes1_idx` (`id_equipe`),
  ADD KEY `fk_membro_equipe_usuarios1_idx` (`id_usuario`);

--
-- Indexes for table `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`,`id_projeto`),
  ADD KEY `fk_personas_projetos1_idx` (`id_projeto`);

--
-- Indexes for table `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id_projeto`,`responsavel_projeto`),
  ADD KEY `fk_projetos_usuarios_idx` (`responsavel_projeto`);

--
-- Indexes for table `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD PRIMARY KEY (`id_publicacao`,`id_tarefa`),
  ADD KEY `fk_publicacoes_tarefas1_idx` (`id_tarefa`);

--
-- Indexes for table `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`,`id_equipe`,`id_projeto`),
  ADD KEY `fk_tarefas_projetos1_idx` (`id_projeto`),
  ADD KEY `fk_tarefas_equipes1_idx` (`id_equipe`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indexes for table `tipo_tarefa`
--
ALTER TABLE `tipo_tarefa`
  ADD PRIMARY KEY (`id_tipo`,`id_tarefa`),
  ADD KEY `fk_tipo_tarefa_tarefas1_idx` (`id_tarefa`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id_anexo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `equipes`
--
ALTER TABLE `equipes`
  MODIFY `id_equipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `estrategias`
--
ALTER TABLE `estrategias`
  MODIFY `id_estrategia` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `habilidades_usuario`
--
ALTER TABLE `habilidades_usuario`
  MODIFY `id_habilidade_usuario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idiomas`
--
ALTER TABLE `idiomas`
  MODIFY `id_idioma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `idiomas_usuario`
--
ALTER TABLE `idiomas_usuario`
  MODIFY `id_idiomas_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log_tarefas`
--
ALTER TABLE `log_tarefas`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `membros_equipe`
--
ALTER TABLE `membros_equipe`
  MODIFY `id_membros` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `publicacoes`
--
ALTER TABLE `publicacoes`
  MODIFY `id_publicacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tipo_tarefa`
--
ALTER TABLE `tipo_tarefa`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `fk_anexos_membros_equipe1` FOREIGN KEY (`membros_equipe_id_membros`) REFERENCES `membros_equipe` (`id_membros`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_anexos_tarefas1` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefas` (`id_tarefa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_comentarios_tarefas1` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefas` (`id_tarefa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comentarios_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `estrategias`
--
ALTER TABLE `estrategias`
  ADD CONSTRAINT `fk_estrategias_projetos1` FOREIGN KEY (`projetos_id_projeto`) REFERENCES `projetos` (`id_projeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `habilidades_usuario`
--
ALTER TABLE `habilidades_usuario`
  ADD CONSTRAINT `fk_habilidades_usuario_habilidades1` FOREIGN KEY (`habilidades_id_habilidade`) REFERENCES `habilidades` (`id_habilidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_habilidades_usuario_usuarios1` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `idiomas_usuario`
--
ALTER TABLE `idiomas_usuario`
  ADD CONSTRAINT `fk_idiomas_usuario_idiomas1` FOREIGN KEY (`idiomas_id_idioma`) REFERENCES `idiomas` (`id_idioma`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idiomas_usuario_usuarios1` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `log_tarefas`
--
ALTER TABLE `log_tarefas`
  ADD CONSTRAINT `fk_log_tarefas_tarefas1` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefas` (`id_tarefa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_tarefas_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `membros_equipe`
--
ALTER TABLE `membros_equipe`
  ADD CONSTRAINT `fk_membro_equipe_equipes1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_membro_equipe_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_projetos1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projetos`
--
ALTER TABLE `projetos`
  ADD CONSTRAINT `fk_projetos_usuarios` FOREIGN KEY (`responsavel_projeto`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `publicacoes`
--
ALTER TABLE `publicacoes`
  ADD CONSTRAINT `fk_publicacoes_tarefas1` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefas` (`id_tarefa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_tarefas_equipes1` FOREIGN KEY (`id_equipe`) REFERENCES `equipes` (`id_equipe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tarefas_projetos1` FOREIGN KEY (`id_projeto`) REFERENCES `projetos` (`id_projeto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_persona` FOREIGN KEY (`id_persona`) REFERENCES `personas` (`id_persona`);

--
-- Limitadores para a tabela `tipo_tarefa`
--
ALTER TABLE `tipo_tarefa`
  ADD CONSTRAINT `fk_tipo_tarefa_tarefas1` FOREIGN KEY (`id_tarefa`) REFERENCES `tarefas` (`id_tarefa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
