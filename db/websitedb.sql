-- -----------------------------------------------------
-- Schema websitedb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `websitedb` DEFAULT CHARACTER SET utf8 ;
USE `websitedb` ;

-- -----------------------------------------------------
-- Table `websitedb`.`cadastro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `websitedb`.`cadastro` (
  `idcadastro` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(20) NULL,
  `email` VARCHAR(254) NULL,
  `senha` VARCHAR(128) NULL,
  PRIMARY KEY (`idcadastro`));
