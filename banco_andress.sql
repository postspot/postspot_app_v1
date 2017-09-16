-- MySQL Script generated by MySQL Workbench
-- Wed Sep 13 08:22:34 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema banco_andress
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema banco_andress
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `banco_andress` DEFAULT CHARACTER SET utf8 ;
USE `banco_andress` ;

-- -----------------------------------------------------
-- Table `banco_andress`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(45) NULL,
  `sexo_usuario` VARCHAR(1) NULL,
  `foto_usuario` VARCHAR(45) NULL,
  `idiomas` VARCHAR(45) NULL,
  `funcao_usuario` VARCHAR(1) NULL,
  `email_usuario` VARCHAR(45) NULL,
  `senha_usuario` VARCHAR(45) NULL,
  `cadastro_usuario` TIMESTAMP NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`projetos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`projetos` (
  `id_projeto` INT NOT NULL AUTO_INCREMENT,
  `nome_projeto` VARCHAR(45) NULL,
  `cadastro_projeto` TIMESTAMP NULL,
  `site_projeto` VARCHAR(45) NULL,
  `responsavel_projeto` INT NOT NULL,
  PRIMARY KEY (`id_projeto`, `responsavel_projeto`),
  INDEX `fk_projetos_usuarios_idx` (`responsavel_projeto` ASC),
  CONSTRAINT `fk_projetos_usuarios`
    FOREIGN KEY (`responsavel_projeto`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`equipes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`equipes` (
  `id_equipe` INT NOT NULL AUTO_INCREMENT,
  `cadastro_equipe` TIMESTAMP NULL,
  PRIMARY KEY (`id_equipe`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`membros_equipe`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`membros_equipe` (
  `id_membros` INT NOT NULL AUTO_INCREMENT,
  `id_equipe` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_membros`, `id_equipe`, `id_usuario`),
  INDEX `fk_membro_equipe_equipes1_idx` (`id_equipe` ASC),
  INDEX `fk_membro_equipe_usuarios1_idx` (`id_usuario` ASC),
  CONSTRAINT `fk_membro_equipe_equipes1`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `banco_andress`.`equipes` (`id_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_membro_equipe_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`tarefas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`tarefas` (
  `id_tarefa` INT NOT NULL AUTO_INCREMENT,
  `nome_tarefa` VARCHAR(45) NULL,
  `tipo_tarefa` VARCHAR(1) NULL,
  `palavra_chave` VARCHAR(45) NULL,
  `briefing_tarefa` VARCHAR(45) NULL,
  `estagio_compra` VARCHAR(1) NULL,
  `id_projeto` INT NOT NULL,
  `id_equipe` INT NOT NULL,
  PRIMARY KEY (`id_tarefa`, `id_equipe`, `id_projeto`),
  INDEX `fk_tarefas_projetos1_idx` (`id_projeto` ASC),
  INDEX `fk_tarefas_equipes1_idx` (`id_equipe` ASC),
  CONSTRAINT `fk_tarefas_projetos1`
    FOREIGN KEY (`id_projeto`)
    REFERENCES `banco_andress`.`projetos` (`id_projeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tarefas_equipes1`
    FOREIGN KEY (`id_equipe`)
    REFERENCES `banco_andress`.`equipes` (`id_equipe`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`log_tarefas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`log_tarefas` (
  `id_log` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(1) NULL,
  `etapa` VARCHAR(1) NULL,
  `data_criacao` TIMESTAMP NULL,
  `data_prevista` TIMESTAMP NULL,
  `data_entregue` TIMESTAMP NULL,
  `id_tarefa` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_log`, `id_tarefa`, `id_usuario`),
  INDEX `fk_log_tarefas_usuarios1_idx` (`id_usuario` ASC),
  INDEX `fk_log_tarefas_tarefas1_idx` (`id_tarefa` ASC),
  CONSTRAINT `fk_log_tarefas_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_log_tarefas_tarefas1`
    FOREIGN KEY (`id_tarefa`)
    REFERENCES `banco_andress`.`tarefas` (`id_tarefa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`personas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`personas` (
  `id_persona` INT NOT NULL AUTO_INCREMENT,
  `data_criacao` TIMESTAMP NULL,
  `nome` VARCHAR(45) NULL,
  `idade` VARCHAR(3) NULL,
  `sexo` VARCHAR(1) NULL,
  `caracteristicas` TEXT NULL,
  `educacao` VARCHAR(45) NULL,
  `trabalho` VARCHAR(45) NULL,
  `segmento` VARCHAR(45) NULL,
  `objetivos` TEXT NULL,
  `descricao` TEXT NULL,
  `resolucao` TEXT NULL,
  `id_projeto` INT NOT NULL,
  PRIMARY KEY (`id_persona`, `id_projeto`),
  INDEX `fk_personas_projetos1_idx` (`id_projeto` ASC),
  CONSTRAINT `fk_personas_projetos1`
    FOREIGN KEY (`id_projeto`)
    REFERENCES `banco_andress`.`projetos` (`id_projeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`estrategias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`estrategias` (
  `id_estrategia` INT NOT NULL AUTO_INCREMENT,
  `empresa` TEXT NULL,
  `projeto` TEXT NULL,
  `produtos_servicos` TEXT NULL,
  `links` TEXT NULL,
  `objetivo_primario` VARCHAR(45) NULL,
  `kpis_primario` VARCHAR(45) NULL,
  `objetivo_secundario` VARCHAR(45) NULL,
  `kpis_secundario` TEXT NULL,
  `concorrentes` VARCHAR(45) NULL,
  `com_quem_falar` VARCHAR(45) NULL,
  `com_quem_nao_falar` VARCHAR(45) NULL,
  `abordar` VARCHAR(45) NULL,
  `evitar` VARCHAR(45) NULL,
  `linguagem` VARCHAR(45) NULL,
  `links_ref` VARCHAR(45) NULL,
  `categorias_conteudo` VARCHAR(45) NULL,
  `canais` VARCHAR(45) NULL,
  `acoes` VARCHAR(45) NULL,
  `consideracoes_gerais` VARCHAR(45) NULL,
  `projetos_id_projeto` INT NOT NULL,
  PRIMARY KEY (`id_estrategia`, `projetos_id_projeto`),
  INDEX `fk_estrategias_projetos1_idx` (`projetos_id_projeto` ASC),
  CONSTRAINT `fk_estrategias_projetos1`
    FOREIGN KEY (`projetos_id_projeto`)
    REFERENCES `banco_andress`.`projetos` (`id_projeto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`comentarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`comentarios` (
  `id_comentario` INT NOT NULL AUTO_INCREMENT,
  `data_criacao` TIMESTAMP NULL,
  `comentario` TEXT NULL,
  `id_usuario` INT NOT NULL,
  `id_tarefa` INT NOT NULL,
  PRIMARY KEY (`id_comentario`, `id_usuario`, `id_tarefa`),
  INDEX `fk_comentarios_usuarios1_idx` (`id_usuario` ASC),
  INDEX `fk_comentarios_tarefas1_idx` (`id_tarefa` ASC),
  CONSTRAINT `fk_comentarios_usuarios1`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentarios_tarefas1`
    FOREIGN KEY (`id_tarefa`)
    REFERENCES `banco_andress`.`tarefas` (`id_tarefa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`tipo_tarefa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`tipo_tarefa` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT,
  `nome_tarefa` VARCHAR(45) NULL,
  `id_tarefa` INT NOT NULL,
  PRIMARY KEY (`id_tipo`, `id_tarefa`),
  INDEX `fk_tipo_tarefa_tarefas1_idx` (`id_tarefa` ASC),
  CONSTRAINT `fk_tipo_tarefa_tarefas1`
    FOREIGN KEY (`id_tarefa`)
    REFERENCES `banco_andress`.`tarefas` (`id_tarefa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`anexos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`anexos` (
  `id_anexo` INT NOT NULL AUTO_INCREMENT,
  `data_criacao` TIMESTAMP NULL,
  `id_tarefa` INT NOT NULL,
  `membros_equipe_id_membros` INT NOT NULL,
  PRIMARY KEY (`id_anexo`, `id_tarefa`, `membros_equipe_id_membros`),
  INDEX `fk_anexos_tarefas1_idx` (`id_tarefa` ASC),
  INDEX `fk_anexos_membros_equipe1_idx` (`membros_equipe_id_membros` ASC),
  CONSTRAINT `fk_anexos_tarefas1`
    FOREIGN KEY (`id_tarefa`)
    REFERENCES `banco_andress`.`tarefas` (`id_tarefa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_anexos_membros_equipe1`
    FOREIGN KEY (`membros_equipe_id_membros`)
    REFERENCES `banco_andress`.`membros_equipe` (`id_membros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`habilidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`habilidades` (
  `id_habilidade` INT NOT NULL AUTO_INCREMENT,
  `nome_habilidade` VARCHAR(45) NULL,
  PRIMARY KEY (`id_habilidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`habilidades_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`habilidades_usuario` (
  `id_habilidade_usuario` INT NOT NULL AUTO_INCREMENT,
  `habilidades_id_habilidade` INT NOT NULL,
  `usuarios_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_habilidade_usuario`, `habilidades_id_habilidade`, `usuarios_id_usuario`),
  INDEX `fk_habilidades_usuario_habilidades1_idx` (`habilidades_id_habilidade` ASC),
  INDEX `fk_habilidades_usuario_usuarios1_idx` (`usuarios_id_usuario` ASC),
  CONSTRAINT `fk_habilidades_usuario_habilidades1`
    FOREIGN KEY (`habilidades_id_habilidade`)
    REFERENCES `banco_andress`.`habilidades` (`id_habilidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_habilidades_usuario_usuarios1`
    FOREIGN KEY (`usuarios_id_usuario`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`publicacoes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`publicacoes` (
  `id_publicacao` INT NOT NULL AUTO_INCREMENT,
  `texto_publicacao` TEXT NULL,
  `status_publicacao` VARCHAR(1) NULL,
  `data_criacao` TIMESTAMP NULL,
  `id_tarefa` INT NOT NULL,
  PRIMARY KEY (`id_publicacao`, `id_tarefa`),
  INDEX `fk_publicacoes_tarefas1_idx` (`id_tarefa` ASC),
  CONSTRAINT `fk_publicacoes_tarefas1`
    FOREIGN KEY (`id_tarefa`)
    REFERENCES `banco_andress`.`tarefas` (`id_tarefa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`idiomas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`idiomas` (
  `id_idioma` INT NOT NULL AUTO_INCREMENT,
  `nome_idioma` VARCHAR(45) NULL,
  PRIMARY KEY (`id_idioma`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `banco_andress`.`idiomas_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `banco_andress`.`idiomas_usuario` (
  `id_idiomas_usuario` INT NOT NULL AUTO_INCREMENT,
  `idiomas_id_idioma` INT NOT NULL,
  `usuarios_id_usuario` INT NOT NULL,
  PRIMARY KEY (`id_idiomas_usuario`, `idiomas_id_idioma`, `usuarios_id_usuario`),
  INDEX `fk_idiomas_usuario_idiomas1_idx` (`idiomas_id_idioma` ASC),
  INDEX `fk_idiomas_usuario_usuarios1_idx` (`usuarios_id_usuario` ASC),
  CONSTRAINT `fk_idiomas_usuario_idiomas1`
    FOREIGN KEY (`idiomas_id_idioma`)
    REFERENCES `banco_andress`.`idiomas` (`id_idioma`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_idiomas_usuario_usuarios1`
    FOREIGN KEY (`usuarios_id_usuario`)
    REFERENCES `banco_andress`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
