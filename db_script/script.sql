-- MySQL Script generated by MySQL Workbench
-- Wed Jul 12 17:31:20 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema muchik
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema muchik
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `muchik` DEFAULT CHARACTER SET utf8 ;
USE `muchik` ;

-- -----------------------------------------------------
-- Table `muchik`.`artist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muchik`.`artist` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `artist_name` VARCHAR(60) NULL,
  `real_name` VARCHAR(100) NULL,
  `born_date` DATE NULL,
  `img` TEXT NULL,
  `views` INT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `muchik`.`disk`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muchik`.`disk` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL,
  `publication_date` DATE NULL,
  `img` TEXT NULL,
  `thumbs_up` INT NULL,
  `views` INT NULL DEFAULT 0,
  `artist_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_disk_artist_idx` (`artist_id` ASC),
  CONSTRAINT `fk_disk_artist`
    FOREIGN KEY (`artist_id`)
    REFERENCES `muchik`.`artist` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `muchik`.`song`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `muchik`.`song` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(60) NULL,
  `publication_date` DATE NULL,
  `is_single` TINYINT(1) NULL,
  `artist_id` INT NULL,
  `thumbs_up` INT NULL DEFAULT 0,
  `views` INT NULL DEFAULT 0,
  `disk_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_song_disk1_idx` (`disk_id` ASC),
  CONSTRAINT `fk_song_disk1`
    FOREIGN KEY (`disk_id`)
    REFERENCES `muchik`.`disk` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;