-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema seg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema seg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `seg` DEFAULT CHARACTER SET utf8 ;
USE `seg` ;

-- -----------------------------------------------------
-- Table `seg`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `seg`.`Cliente` (
  `idNome` VARCHAR(45) NOT NULL,
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `idPrestador` VARCHAR(45) NOT NULL,
  `idDescricao` VARCHAR(45) NOT NULL,
  `idQntHrs` VARCHAR(45) NOT NULL,
  `idQntPessoas` VARCHAR(45) NOT NULL,
  `idMaterial` VARCHAR(45) NOT NULL,
  `idData` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCliente`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
